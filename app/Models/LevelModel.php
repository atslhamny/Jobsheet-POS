<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LevelModel extends Model
{
    use HasFactory;

    // Ini penting! Supaya Laravel tahu nama tabel yang kamu pakai
    protected $table = 'm_level';

    // Kalau primary key-nya bukan 'id', misalnya 'level_id':
    protected $primaryKey = 'level_id';

    public function user()
    {
        return $this->belongsTo(UserModel::class, 'level_id', 'level_id');
    }
}
