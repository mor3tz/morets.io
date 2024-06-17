<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pengajuan extends Model
{
    use HasFactory, SoftDeletes;


    protected $table = 'pengajuans';

    protected $fillable = [
        'user_id',
        'nama',
        'no_ktp',
        'foto_ktp',
        'kartu_vaksin',
        'surat_kesehatan',
        'bebas_narkoba',
        'skck',
        'surat_keterangan_user',
        'keperluan',
        'keperluan_lainnya',
        'tujuan',
        'tujuan_lainnya',
        'lama_kunjungan',
        'area',
        'unit_kerja',
        'nama_perusahaan',
        'tanggal_mulai',
        'tanggal_selesai',
        'status'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function approvals(){
        return $this->hasMany(Approval::class);
    }

}
