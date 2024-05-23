<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PenyesuaianObat extends Model
{
   use HasFactory;
   protected $table = 'obat_penyesuaian';
   protected $guarded = [];
   protected $casts = [
      'created_at' => 'datetime:d-m-Y  H:i:s',
      'updated_at' => 'date:d-m-Y H:i:s',
      'tgl_penyesuaian' => 'datetime:d-m-Y',
   ];


   public static function generateKode()
   {
       // Ambil pasien dengan kode_rm terakhir
       $lastPatient = self::orderBy('nama', 'desc')->first();
  
       if (!$lastPatient) {
           // Jika belum ada pasien, mulai dari RM-00001
           return 'PY-00001';
       }
  
       // Ambil kode terakhir dan tambahkan 1
       $lastKode = $lastPatient->nama;
       $number = intval(substr($lastKode, 3)) + 1;
  
       // Format kembali dengan leading zeros
       return 'PY-' . str_pad($number, 5, '0', STR_PAD_LEFT);
   }

   /**
    * Get the user that owns the PenyesuaianObat
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
   public function obat(): BelongsTo
   {
       return $this->belongsTo(Obat::class, 'obat_id', 'id');
   }

   
}
