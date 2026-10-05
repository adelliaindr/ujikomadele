<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'nama_sekolah',
        'sejarah',
        'visi',
        'misi',
        'foto_sekolah',
    ];

    protected $casts = [
        'misi' => 'array', // Mengubah JSON otomatis menjadi array PHP
    ];
}
