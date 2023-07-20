<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function nilai()
    {
        return $this->hasMany(Nilai::class);
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }
}
