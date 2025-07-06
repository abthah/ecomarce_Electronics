<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    use HasFactory;

   protected $table = 'alats';
    protected $fillable = [
        'foto',     // path/filename foto alat
        'nama',     // nama alat
        'stok',     // stok tersedia
        'harga',    // harga sewa
        'deskripsi',
    ];

     public function pinjamen()
    {
        return $this->hasMany(Pinjaman::class);
    }
}
