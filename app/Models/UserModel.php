<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    use HasFactory;

    protected $table = 'm_user'; // nama tabel
    protected $primaryKey = 'user_id'; // primary key bukan "id"

    public $timestamps = false; // jika tabel tidak punya kolom created_at dan updated_at

    protected $fillable = ['username', 'nama', 'password', 'level_id'];

    public function level()
    {
        return $this->hasOne(LevelModel::class, 'level_id', 'level_id');
    }
}

?>