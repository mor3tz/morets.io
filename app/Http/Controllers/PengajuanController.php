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
        return view('dashboard');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function perusahaan($perusahaan)
    {   
       
        return view('perusahaan', compact('perusahaan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {      
        $request->validate([
            'nama' => ['required','string'],
            'no_hp'=> ['required','string'],
            'no_ktp'=> ['required','string'],
            // 'foto_ktp'=> ['required', 'image'],
            // 'kartu_vaksin' => ['required', 'image'],
            // 'surat_kesehatan' => ['required', 'image'],
            // 'bebas_narkoba' => ['required', 'image'],
            // 'skck' => ['required', 'image'],
            // 'surat_pengajuan_user' => ['required', 'image'],
            'area' => ['required'],
            'keperluan' => ['required'],
            'tujuan_berkunjung' => ['required'],
            'lama_kunjungan' => ['required'],
            'unit_kerja' => ['required','string'],
            'nama_perusahaan' => ['required','string'],
            'start' => ['required'],
            'end' => ['required']
        ]);

        try {
            $foto_ktp = $request->file('foto_ktp');
            $ktp_filename_hashed = $foto_ktp->hashName();
            $foto_ktp->storeAs('public/foto_ktp', $ktp_filename_hashed);

            $kartu_vaksin = $request->file('kartu_vaksin');
            $vaksin_filename_hashed = $kartu_vaksin->hashName();
            $kartu_vaksin->storeAs('public/kartu_vaksin', $vaksin_filename_hashed);

            $surat_kesehatan = $request->file('surat_kesehatan');
            $surat_kesehatan_filename_hashed = $surat_kesehatan->hashName();
            $surat_kesehatan->storeAs('public/surat_kesehatan', $surat_kesehatan_filename_hashed);
            
            $bebas_narkoba = $request->file('bebas_narkoba');
            $bebas_narkoba_filename_hashed = $bebas_narkoba->hashName();
            $bebas_narkoba->storeAs('public/bebas_narkoba', $bebas_narkoba_filename_hashed);

            $skck = $request->file('skck');
            $skck_filename_hashed = $skck->hashName();
            $skck->storeAs('public/skck', $skck_filename_hashed);

            $surat_keterangan_user = $request->file('surat_keterangan_user');
            $surat_keterangan_user_filename_hashed = $surat_keterangan_user->hashName();
            $surat_keterangan_user->storeAs('public/surat_keterangan_user', $surat_keterangan_user_filename_hashed);

            $pengajuanData = [
                'user_id' => Auth::user()->id,
                'nama' => $request->nama,
                'no_hp' => $request->no_hp,
                'no_ktp' => $request->no_ktp,
                'foto_ktp' => $ktp_filename_hashed,
                'kartu_vaksin' => $vaksin_filename_hashed,
                'surat_kesehatan' => $surat_kesehatan_filename_hashed,
                'bebas_narkoba' => $bebas_narkoba_filename_hashed,
                'skck' => $skck_filename_hashed,
                'surat_keterangan_user' => $surat_keterangan_user_filename_hashed,
                'area' => $request->area,
                'keperluan' => $request->keperluan,
                'tujuan' => $request->tujuan_berkunjung,
                'unit_kerja' => $request->unit_kerja,
                'nama_perusahaan' => $request->nama_perusahaan,
                'lama_kunjungan' => $request->lama_kunjungan,
                'tanggal_mulai' => $request->start,
                'tanggal_selesai' => $request->end,
                'status' => "Menunggu Approval"
            ];
            
            // Check if keperluan is "other" and set keperluan_lainnya
            if ($request->keperluan == 'other') {
                $pengajuanData['keperluan_lainnya'] = $request->keperluan_lainnya;
            }
            // Check if tujuan is "other" and set keperluan_lainnya
            if ($request->keperluan == 'other') {
                $pengajuanData['tujuan_lainnya'] = $request->tujuan_lainnya;
            }
            
            Pengajuan::create($pengajuanData);


        } catch (\Exception $e) {
            Log::error("Error in storing data: " . $e->getMessage());
            return redirect()->back()->with(['error' => 'Data gagal disimpan!']);
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


        return redirect()->route('perusahaan', ['perusahaan' => $pengajuan->nama_perusahaan])->with(['sukses'=> 'Pengajuan telah ' . $request->approval_status]);
    }


    public function manyApprove(Request $request, $nama_perusahaan){
        $user = Auth::user();
        if($request->pengajuans == null){
            return redirect()->route('perusahaan', ['perusahaan' => $nama_perusahaan])->with(['error' => 'Pengajuan belum dipilih!']);
        }
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
                if( $user->role == 'svp_operation' || $user->role == 'vp_security'){
                    $pengajuan->status = 'approved';
                    $pengajuan->save();
                }
            }

        }
        return redirect()->route('perusahaan', ['perusahaan' => $nama_perusahaan])->with(['sukses'=> 'Pengajuan telah diapprove']);

    }

    public function delete($id){
        $pengajuan = Pengajuan::findOrFail($id);
        $nama_perusahaan = $pengajuan->nama_perusahaan;
        $pengajuan->approvals()->delete();
        $pengajuan->delete();
        return redirect()->route('perusahaan', ['perusahaan' => $nama_perusahaan])->with(['sukses'=> 'Pengajuan telah dihapus']);
    }
}
