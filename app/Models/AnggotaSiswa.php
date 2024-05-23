<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggotaSiswa extends Model
{
   use HasFactory;
   protected $table = 'anggota_siswa';
   protected $guarded = [];
   protected $appends = ['jenis_anggota'];
   protected $casts = [
      'created_at' => 'date:d-m-Y H:i:s',
      'updated_at' => 'date:d-m-Y H:i:s',
      'tgl_lahir' => 'date:d-m-Y',
   ];



   public function getJenisAnggotaAttribute() {
       return 'siswa';
   }

}
