<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    // Daftar kolom yang boleh diisi massal (mass assignable)
    protected $fillable = ['kode', 'nama', 'bobot', 'jenis'];

    public function penilaians()
    {
        return $this->hasMany(Penilaian::class);
    }
}
