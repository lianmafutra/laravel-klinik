<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;
    protected $table = 'anggota';
    protected $guarded = [];
    protected $casts = [
      'created_at' => 'date:d-m-Y H:m:s',
      'updated_at' => 'date:d-m-Y H:m:s',
      'tgl_lahir' => 'date:d/m/Y',
  ];
}
