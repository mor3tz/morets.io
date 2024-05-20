<?php

namespace App\Http\Controllers;

use App\Models\Approval;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $pengajuans = collect(); // Default inisialisasi sebagai koleksi kosong
    
        switch ($user->role) {
            case 'admin':
            case 'kabag':
                $pengajuans = Pengajuan::orderBy('created_at', 'desc')->get();
                break;
            case 'user':
                $pengajuans = Pengajuan::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
                break;
            case 'vp':
                $pengajuans = Pengajuan::whereHas('approvals', function ($query) {
                    $query->where('approver_role', 'kabag')->where('approval_status', 'approved');
                })->orderBy('created_at', 'desc')->get();
                break;
            case 'avp':
                $pengajuans = Pengajuan::whereHas('approvals', function ($query) {
                    $query->where('approver_role', 'vp')->where('approval_status', 'approved');
                })->orderBy('created_at', 'desc')->get();
                break;
            case 'svp_operation':
                $pengajuans = Pengajuan::where('area', 'pabrik')->whereHas('approvals', function ($query) {
                    $query->where('approver_role', 'avp')->where('approval_status', 'approved');
                })->orderBy('created_at', 'desc')->get();
                break;
            case 'vp_security':
                $pengajuans = Pengajuan::where('area', 'kantor')->whereHas('approvals', function ($query) {
                    $query->where('approver_role', 'avp')->where('approval_status', 'approved');
                })->orderBy('created_at', 'desc')->get();
                break;
        }
    
        // Proses pengajuans untuk menambahkan status tambahan
        $pengajuans->each(function ($pengajuan) use ($user) {
            if ($user->role == 'user') {
                $pengajuan->rejected = $pengajuan->approvals()
                                                ->where('approval_status', 'rejected')
                                                ->exists();
                $pengajuan->approved_by_svp = $pengajuan->approvals()
                                                        ->where('approval_status', 'approved')
                                                        ->whereIn('approver_role', ['svp_operation', 'vp_security'])
                                                        ->exists();
            } else {
                $pengajuan->approved = $pengajuan->approvals()
                                                ->where('approver_role', $user->role)
                                                ->where('approval_status', 'approved')
                                                ->exists();
                $pengajuan->rejected = $pengajuan->approvals()
                                                ->where('approver_role', $user->role)
                                                ->where('approval_status', 'rejected')
                                                ->exists();
                if ($user->role == 'admin') {
                    $latestApproval = $pengajuan->approvals()->latest()->first();
                    if ($latestApproval) {
                        $pengajuan->latest_status = $latestApproval->approval_status . ' by ' . $latestApproval->user->name;
                        $pengajuan->latest_status_color = $latestApproval->approval_status === 'approved' ? 'lime' : ($latestApproval->approval_status === 'rejected' ? 'red' : 'yellow');
                    }
                }
            }
        });
    
        // Kelompokkan pengajuans berdasarkan nama_perusahaan
        $pengajuansByPerusahaan = $pengajuans->groupBy('nama_perusahaan');
        $pengajuansByPerusahaan = $pengajuans->groupBy(function($item) {
            return strtoupper($item->nama_perusahaan);
        });

        // Struktur data yang diinginkan
        $perusahaan = $pengajuansByPerusahaan->map(function ($items, $key) {
            return [
                'nama_perusahaan' => $key,
                'pengajuans' => $items
            ];
        });
    
        return view('dashboard', ['perusahaan' => $perusahaan]);
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => ['required','string'],
            'no_ktp'=> ['required','string'],
            'foto_ktp'=> ['required', 'image'],
            'kartu_vaksin' => ['required', 'image'],
            'area' => ['required'],
            'unit_kerja' => ['required','string'],
            'nama_perusahaan' => ['required','string'],
            'lama_bekerja' => ['required'],
            'tanggal_mulai' => ['required']
        ]);

        try {
            $foto_ktp = $request->file('foto_ktp');
            $ktp_filename_hashed = $foto_ktp->hashName();
            $foto_ktp->storeAs('public/foto_ktp', $ktp_filename_hashed);

            $kartu_vaksin = $request->file('kartu_vaksin');
            $vaksin_filename_hashed = $kartu_vaksin->hashName();
            $kartu_vaksin->storeAs('public/kartu_vaksin', $vaksin_filename_hashed);

            Pengajuan::create([
                'user_id' => Auth::user()->id,
                'nama' => $request->nama,
                'no_ktp' => $request->no_ktp,
                'foto_ktp' => $ktp_filename_hashed,
                'kartu_vaksin' => $vaksin_filename_hashed,
                'area' => $request->area,
                'unit_kerja' => $request->unit_kerja,
                'nama_perusahaan' => $request->nama_perusahaan,
                'lama_bekerja' => $request->lama_bekerja,
                'tanggal_mulai' => $request->tanggal_mulai,
                'status' => "Menunggu Approval"
            ]);

        } catch (\Exception $e) {
            Log::error("Error in storing data: " . $e->getMessage());
            return redirect()->back()->with(['errors' => 'Data Gagal Disimpan!']);
        }

        return redirect()->route('dashboard')->with(['sukses' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {   
        $user = Auth::user();
        $pengajuan = Pengajuan::find($id);
        $latestApproval = $pengajuan->approvals()->latest()->first();

        if($latestApproval){            
            if ($latestApproval->role != "svp_operation" && $latestApproval->role != "vp_security") {
                $pengajuan->latest_status = $latestApproval->approval_status . ' by ' . $latestApproval->user->name;
                $pengajuan->latest_status_color = $latestApproval->approval_status === 'approved' ? 'lime' : ($latestApproval->approval_status === 'rejected' ? 'red' : 'yellow');
            }
        }

        
        if (!$pengajuan) {
            return redirect()->back();
        }

        switch ($user->role) {
            case 'admin':
            case 'kabag':
                // Tidak perlu mengubah apa pun untuk admin dan kabag
                break;
            case 'vp':
                if (!$pengajuan->approvals()->where('approver_role', 'kabag')->where('approval_status', 'approved')->exists()) {
                    return redirect()->back();
                }
                break;
            case 'avp':
                if (!$pengajuan->approvals()->where('approver_role', 'vp')->where('approval_status', 'approved')->exists()) {
                    return redirect()->back();
                }
                break;
            case 'svp_operation':
                if ($pengajuan->area != 'pabrik' || !$pengajuan->approvals()->where('approver_role', 'avp')->where('approval_status', 'approved')->exists()) {
                    return redirect()->back();
                }
                break;
            case 'vp_security':
                if ($pengajuan->area != 'kantor' || !$pengajuan->approvals()->where('approver_role', 'avp')->where('approval_status', 'approved')->exists()) {
                    return redirect()->back();
                }
                break;
            default:
                return redirect()->back();
        }

        return view('pengajuan.dtail', ['pengajuan' => $pengajuan]);
    }

    public function approveOrReject(Request $request, $id){
        $request->validate([
            'approval_status' => 'required|in:approved,rejected',
        ]);

        $user = Auth::user();
        $pengajuan = Pengajuan::findOrFail($id);

        // Buat entri baru di tabel approvals
        Approval::create([
            'pengajuan_id' => $pengajuan->id,
            'approver_id' => $user->id,
            'approver_role' => $user->role,
            'approval_status' => $request->approval_status,
            'approval_date' => now(),
        ]);
        if($request->approval_status == 'rejected'){
            $pengajuan->status = 'rejected';
            $pengajuan->save();
        }
        if($request->approval_status == 'approved' && $user->role == 'svp_operation' || $user->role == 'vp_security'){
            $pengajuan->status = 'approved';
            $pengajuan->save();
        }


        return redirect()->route('dashboard')->with(['sukses'=> 'Pengajuan telah ' . $request->approval_status]);
    }


    public function manyApprove(Request $request){
        $user = Auth::user();
        foreach($request->pengajuans as $id){
            $pengajuan = Pengajuan::findOrFail($id);
            if(!$pengajuan->approvals()->where('approver_role', $user->role )->where('approval_status', 'approved')->exists()){     
                Approval::create([
                    'pengajuan_id' => $pengajuan->id,
                    'approver_id' => $user->id,
                    'approver_role' => $user->role,
                    'approval_status' => 'approved',
                    'approval_date' => now(),
                ]);
            }

        }
        return redirect()->route('dashboard')->with(['sukses'=> 'Pengajuan telah diapprove']);

    }

    public function delete($id){
        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->approvals()->delete();
        $pengajuan->delete();
        return redirect()->back()->with(['sukses'=> 'Pengajuan telah dihapus']);
    }
}
