<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pemeriksaan extends Model
{
   use HasFactory;
   protected $table = 'pemeriksaan';
   protected $guarded = [];
   protected $casts = [
      'created_at' => 'date:d-m-Y H:m:s',
      'updated_at' => 'date:d-m-Y H:m:s',
      'tgl_pemeriksaan' => 'date:d/m/Y',
   ];

   public static function generateNomorPemeriksaan()
   {
      // Ambil pasien dengan kode_rm terakhir
      $lastPatient = self::orderBy('nomor_pemeriksaan', 'desc')->first();

      if (!$lastPatient) {
         // Jika belum ada pasien, mulai dari RM-00001
         return 'PM-00001';
      }

      // Ambil kode terakhir dan tambahkan 1
      $lastKode = $lastPatient->nomor_pemeriksaan;
      $number = intval(substr($lastKode, 3)) + 1;

      // Format kembali dengan leading zeros
      return 'PM-' . str_pad($number, 5, '0', STR_PAD_LEFT);
   }

   public function user(): BelongsTo
   {
      return $this->belongsTo(User::class);
   }

   public function dokter(): BelongsTo
   {
      return $this->belongsTo(Dokter::class, 'dokter_id', 'id');
   }

   public function pasien(): BelongsTo
   {
      return $this->belongsTo(pasien::class, 'pasien_id', 'id');
   }
}
