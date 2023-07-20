<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function mahasiswa()
    {
         //    One to Many (Inverse) => 1 data nilai bisa memiliki banyak data mahasiswa Dan 1 mahasiswa hanya bisa dimiliki 1 nilai.
        return $this->hasMany(Mahasiswa::class);
    }
}
