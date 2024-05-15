<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Approval extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'approvals';

    protected $fillable = [
        'approver_id',
        'pengajuan_id',
        'approver_role',
        'approval_status',
        'approval_date',
    ];


    public function user(){
        return $this->belongsTo(User::class, 'approver_id', 'id');
    }
}
