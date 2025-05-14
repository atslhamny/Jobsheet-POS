<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserModel extends Authenticatable
{
    use HasFactory;

    protected $table = 'm_user'; // nama tabel
    protected $primaryKey = 'user_id'; // primary key bukan "id"
    protected $fillable = ['username', 'nama', 'password', 'level_id'];

    protected $hidden = ['password']; // kolom yang tidak ingin ditampilkan
    protected $casts = [
        'password' => 'hashed', // casting password ke hashed
    ]; // casting kolom level_id menjadi integer
    public $timestamps = false; // jika tabel tidak punya kolom created_at dan updated_at


    public function level(): BelongsTo
    {
        return $this->belongsTo(LevelModel::class, 'level_id', 'level_id');
    }

    // Mendapatkan nama role
    public function getRoleName() : string
    {
        return $this->level->level_name;
    }

    // Cek apakah user memiliki role tertentu
    public function hasRole($role): bool
    {
        return $this->level->level_kode === $role;
    }

    // mendapatkan kode role
    public function getRole(): string
    {
        return $this->level->level_kode;
    }
}

?>