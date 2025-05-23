<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LevelModel extends Model
{
    use HasFactory;

    protected $table = 'm_level';
    protected $primaryKey = 'level_id';

    // Tambahkan kolom yang ingin diisi secara massal ke dalam $fillable
    protected $fillable = [
        'level_id',
        'level_kode',
        'level_nama'
    ];
}
