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

 public function anggota(): BelongsTo
 {
     return $this->belongsTo(Anggota::class);
 }
}
