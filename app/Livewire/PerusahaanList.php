<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\Auth;

class PerusahaanList extends Component
{   
    public $search;

    public function render()
    {
        $user = Auth::user();
        $pengajuanData = collect(); // Default inisialisasi sebagai koleksi kosong
    
        switch ($user->role) {
            case 'admin':
            // case 'kabag':
            //     $pengajuanData = Pengajuan::orderBy('created_at', 'desc')
            //         ->when($this->search, function ($query) {
            //             $query->where('nama_perusahaan', 'like', '%' . $this->search . '%');
            //         })
            //         ->get();
            //     break;
            
            case 'vp':
                // $pengajuanData = Pengajuan::whereHas('approvals', function ($query) {
                //         $query->where('approver_role', 'kabag')->where('approval_status', 'approved');
                //     })
                //     ->when($this->search, function ($query) {
                //         $query->where('nama_perusahaan', 'like', '%' . $this->search . '%');
                //     })
                //     ->orderBy('created_at', 'desc')
                //     ->get();
                $pengajuanData = Pengajuan::orderBy('created_at', 'desc')
                    ->when($this->search, function ($query) {
                        $query->where('nama_perusahaan', 'like', '%' . $this->search . '%');
                    })
                    ->get();
                break;
            case 'user':
                $pengajuans = Pengajuan::where('user_id', $user->id)
                    ->orderBy('created_at', 'desc')
                    ->when($this->search, function ($query) {
                        $query->where('nama', 'like', '%' . $this->search . '%');
                    })
                    ->get();
                break;    
            case 'avp':
                $pengajuanData = Pengajuan::whereHas('approvals', function ($query) {
                        $query->where('approver_role', 'vp')->where('approval_status', 'approved');
                    })
                    ->when($this->search, function ($query) {
                        $query->where('nama_perusahaan', 'like', '%' . $this->search . '%');
                    })
                    ->orderBy('created_at', 'desc')
                    ->get();
                break;
            case 'svp_operation':
                $pengajuanData = Pengajuan::where('area', 'pabrik')
                    ->whereHas('approvals', function ($query) {
                        $query->where('approver_role', 'avp')->where('approval_status', 'approved');
                    })
                    ->when($this->search, function ($query) {
                        $query->where('nama_perusahaan', 'like', '%' . $this->search . '%');
                    })
                    ->orderBy('created_at', 'desc')
                    ->get();
                break;
            case 'vp_security':
                $pengajuanData = Pengajuan::where('area', 'kantor')
                    ->whereHas('approvals', function ($query) {
                        $query->where('approver_role', 'avp')->where('approval_status', 'approved');
                    })
                    ->when($this->search, function ($query) {
                        $query->where('nama_perusahaan', 'like', '%' . $this->search . '%');
                    })
                    ->orderBy('created_at', 'desc')
                    ->get();
                break;
        }
        if (Auth::user()->role != 'user') {
            // Grupkan pengajuan berdasarkan nama perusahaan dan tentukan status
            $pengajuans = $pengajuanData->groupBy('nama_perusahaan')->map(function ($group) {
                $statuses = $group->pluck('status');
                

                if ($statuses->contains('rejected')) {
                    $status = 'rejected';
                } elseif ($statuses->contains('Menunggu Approval')) {
                    $status = 'pending';
                } else {
                    $status = 'approved';
                }
                return [
                    'nama_perusahaan' => $group->first()->nama_perusahaan,
                    'status' => $status,
                    'latest_created_at' => $group->max('created_at')
                ];
            });
            $pengajuans = $pengajuans->sortByDesc('latest_created_at');
        }

    
        return view('livewire.perusahaan-list', [
            'pengajuans' => $pengajuans
        ]);
    }
        

}
