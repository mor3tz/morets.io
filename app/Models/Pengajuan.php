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
        'area',
        'unit_kerja',
        'nama_perusahaan',
        'lama_bekerja',
        'tanggal_mulai',
        'status'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function approvals(){
        return $this->hasMany(Approval::class);
    }

}
