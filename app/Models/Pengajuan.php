<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;


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

}
