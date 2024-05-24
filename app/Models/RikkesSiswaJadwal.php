<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RikkesSiswaJadwal extends Model
{
   use HasFactory;
   protected $table = 'rikkes_siswa_jadwal';
   protected $guarded = [];

   protected $casts = [
      'created_at' => 'datetime:d-m-Y  H:i:s',
      'updated_at' => 'datetime:d-m-Y  H:i:s',
      'tgl' => 'datetime:d-m-Y',
   ];
}
