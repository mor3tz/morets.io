<?php

namespace App\Livewire;

use App\Models\Pengajuan;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PengajuanList extends Component
{   
    public $perusahaan;
    public $search;
    public function render(){   
        $user = Auth::user();
        $query = Pengajuan::where('nama_perusahaan', $this->perusahaan);

        switch ($user->role) {
            case 'admin':
            case 'kabag':
                break;
            case 'vp':
                $query->whereHas('approvals', function ($query) {
                    $query->where('approver_role', 'kabag')->where('approval_status', 'approved');
                });
                break;
            case 'avp':
                $query->whereHas('approvals', function ($query) {
                    $query->where('approver_role', 'vp')->where('approval_status', 'approved');
                });
                break;
            case 'svp_operation':
                $query->whereHas('approvals', function ($query) {
                    $query->where('approver_role', 'avp')->where('approval_status', 'approved')->where('area','pabrik');
                });
                break;
            case 'vp_security':
                $query->whereHas('approvals', function ($query) {
                    $query->where('approver_role', 'avp')->where('approval_status', 'approved')->where('area','kantor');
                });
                break;
        }

        if ($this->search) {
            $query->where(function($q) {
                $q->where('nama', 'like', '%' . $this->search . '%')
                ->orWhere('no_ktp', 'like', '%' . $this->search . '%')
                ->orWhere('unit_kerja', 'like', '%' . $this->search . '%')
                ->orWhere('area', 'like', '%' . $this->search . '%');
            });
        }

        $pengajuan = $query->orderBy('created_at', 'desc')->get();

        if ($user->role == 'admin') {
            $pengajuan->each(function ($pengajuan) use ($user) {
                $latestApproval = $pengajuan->approvals()->latest()->first();
                if ($latestApproval) {
                    $pengajuan->latest_status = $latestApproval->approval_status . ' by ' . $latestApproval->user->name;
                    $pengajuan->latest_status_color = $latestApproval->approval_status === 'approved' ? 'lime' : ($latestApproval->approval_status === 'rejected' ? 'red' : 'yellow');
                }
            });
        }
        if($user->role != 'admin' && $user->role != 'user'){
            $pengajuan->each(function ($pengajuan) use ($user) {
                $pengajuan->approved = $pengajuan->approvals()
                                                ->where('approver_role', $user->role)
                                                ->where('approval_status', 'approved')
                                                ->exists();
                $pengajuan->rejected = $pengajuan->approvals()
                                                ->where('approver_role', $user->role)
                                                ->where('approval_status', 'rejected')
                                                ->exists();
            });
        }
        return view('livewire.pengajuan-list' , ['pengajuan' => $pengajuan, 'perusahaan'=> $this->perusahaan]);
    }
}
