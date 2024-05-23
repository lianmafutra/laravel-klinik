<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pasien extends Model
{
   use HasFactory;
   protected $table = 'pasien';
   protected $guarded = [];
 
   protected $casts = [
     'created_at' => 'datetime:d-m-Y  H:i:s',
     'updated_at' => 'datetime:d-m-Y  H:i:s',
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

 public function getUsia(){
   if($this->attributes['tgl_lahir']){
      return Carbon::parse($this->attributes['tgl_lahir'])->age . " Tahun";
   }
 }

 public function getJenisKelaminDetail(){
   $jenis_kelamin = $this->attributes['jenis_kelamin'];
   if($this->attributes['jenis_kelamin']){
      if( $jenis_kelamin == "L"){
         return "LAKI-LAKI";
      }else{
         return "PEREMPUAN";
      }
   }
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
