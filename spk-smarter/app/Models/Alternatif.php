<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    protected $fillable = ['nama', 'kelas']; // ✅ tambahkan ini

    public function penilaians()
    {
        return $this->hasMany(Penilaian::class);
    }
}
