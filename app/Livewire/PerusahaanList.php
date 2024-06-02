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
        $pengajuans = collect(); // Default inisialisasi sebagai koleksi kosong
        switch ($user->role) {
            case 'admin':
            case 'kabag':
                $pengajuans = Pengajuan::orderBy('created_at', 'desc')
                    ->when($this->search, function ($query) {
                        $query->where('nama_perusahaan', 'like', '%' . $this->search . '%');
                    })
                    ->distinct('nama_perusahaan')->pluck('nama_perusahaan');
                break;
            case 'user':
                $pengajuans = Pengajuan::where('user_id', $user->id)
                ->orderBy('created_at', 'desc')->when($this->search, function ($query) {
                    $query->where('nama', 'like', '%' . $this->search . '%');
                })->get();
                break;
            case 'vp':
                $pengajuans = Pengajuan::whereHas('approvals', function ($query) {
                    $query->where('approver_role', 'kabag')->where('approval_status', 'approved');
                })->when($this->search, function ($query) {
                    $query->where('nama_perusahaan', 'like', '%' . $this->search . '%');
                })
                ->orderBy('created_at', 'desc')->distinct('nama_perusahaan')->pluck('nama_perusahaan');
                break;
            case 'avp':
                $pengajuans = Pengajuan::whereHas('approvals', function ($query) {
                    $query->where('approver_role', 'vp')->where('approval_status', 'approved');
                })->when($this->search, function ($query) {
                    $query->where('nama_perusahaan', 'like', '%' . $this->search . '%');
                })
                ->orderBy('created_at', 'desc')->distinct('nama_perusahaan')->pluck('nama_perusahaan');
                break;
            case 'svp_operation':
                $pengajuans = Pengajuan::where('area', 'pabrik')->whereHas('approvals', function ($query) {
                    $query->where('approver_role', 'avp')->where('approval_status', 'approved');
                })->when($this->search, function ($query) {
                    $query->where('nama_perusahaan', 'like', '%' . $this->search . '%');
                })
                ->orderBy('created_at', 'desc')->distinct('nama_perusahaan')->pluck('nama_perusahaan');
                break;
            case 'vp_security':
                $pengajuans = Pengajuan::where('area', 'kantor')->whereHas('approvals', function ($query) {
                    $query->where('approver_role', 'avp')->where('approval_status', 'approved');
                })->when($this->search, function ($query) {
                    $query->where('nama_perusahaan', 'like', '%' . $this->search . '%');
                })
                ->orderBy('created_at', 'desc')->distinct('nama_perusahaan')->pluck('nama_perusahaan');
                break;
        }
        return view('livewire.perusahaan-list', [
            'pengajuans' => $pengajuans
        ]);
    }
}
