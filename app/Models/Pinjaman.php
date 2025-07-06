<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pinjaman extends Model
{
    use HasFactory;

    protected $table = 'pinjamen'; // nama tabel sesuai migrasi

    protected $fillable = [
        'alat_id',
        'jumlah',
        'durasi',
        'total_harga',
        'nama',
        'nomor_hp',
        'alamat',
        'email',
    ];

    // Relasi Pinjaman ke Alat (banyak pinjaman punya satu alat)
    public function alat()
{
    return $this->belongsTo(Alat::class);
}

}
