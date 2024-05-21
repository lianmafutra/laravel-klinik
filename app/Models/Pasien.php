<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pasien extends Model
{
   use HasFactory;
   protected $table = 'pasien';
   protected $guarded = [];
 
   protected $casts = [
     'created_at' => 'date:d-m-Y H:m:s',
     'updated_at' => 'date:d-m-Y H:m:s',
     'tgl_lahir' => 'date:d/m/Y',
 ];

 public function siswa(): BelongsTo
 {
     return $this->belongsTo(AnggotaSiswa::class, 'anggota_id', 'id');
 }

 public function personil(): BelongsTo
 {
     return $this->belongsTo(AnggotaPersonil::class, 'anggota_id', 'id');
 }

 public static function generateKodeRm()
 {
     // Ambil pasien dengan kode_rm terakhir
     $lastPatient = self::orderBy('kode_rm', 'desc')->first();

     if (!$lastPatient) {
         // Jika belum ada pasien, mulai dari RM-00001
         return 'RM-00001';
     }

     // Ambil kode terakhir dan tambahkan 1
     $lastKode = $lastPatient->kode_rm;
     $number = intval(substr($lastKode, 3)) + 1;

     // Format kembali dengan leading zeros
     return 'RM-' . str_pad($number, 5, '0', STR_PAD_LEFT);
 }
}
