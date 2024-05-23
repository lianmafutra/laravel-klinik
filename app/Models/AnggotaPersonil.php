<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggotaPersonil extends Model
{
   use HasFactory;
   protected $table = 'anggota_personil';
   protected $guarded = [];
   protected $casts = [
     'created_at' => 'date:d-m-Y H:i:s',
     'updated_at' => 'date:d-m-Y H:i:s',
     'tgl_lahir' => 'date:d-m-Y',
 ];

 protected $appends = ['jenis_anggota'];
   public function getJenisAnggotaAttribute() {
       return 'personil';
   }
}
