<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PemeriksaanObat extends Model
{
   use HasFactory;
   protected $table = 'pemeriksaan_obat';
   protected $guarded = [];
   protected $casts = [
     'created_at' => 'date:d-m-Y H:i:s',
     'updated_at' => 'date:d-m-Y H:i:s',
 ];


 /**
  * Get the user that owns the PemeriksaanObat
  *
  * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
  */
 public function pemeriksaan(): BelongsTo
 {
     return $this->belongsTo(Pemeriksaan::class, 'nomor_pemeriksaan', 'nomor_pemeriksaan');
 }

 public function obat(): BelongsTo
 {
     return $this->belongsTo(Obat::class, 'obat_id', 'id');
 }
}
