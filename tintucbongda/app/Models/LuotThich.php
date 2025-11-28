<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LuotThich extends Model
{
    use HasFactory;

    protected $table = 'luot_thiches';

    protected $fillable = [
        'bai_viet_id',
        'nguoi_dung_id',
        'ngay_tao',
    ];
}
