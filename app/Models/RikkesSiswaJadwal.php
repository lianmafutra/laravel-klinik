<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

   /**
    * Get the angkatan that owns the RikkesSiswaJadwal
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
   public function angkatan(): BelongsTo
   {
       return $this->belongsTo(AnggotaSiswaAngkatan::class, 'angkatan_id', 'id');
   }
}
