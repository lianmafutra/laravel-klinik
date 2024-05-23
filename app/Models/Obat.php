<?php

namespace App\Models;

use App\Utils\Rupiah;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    use HasFactory;
    protected $table = 'obat';
    protected $guarded = [];
    protected $casts = [
      'created_at' => 'date:d-m-Y H:i:s',
      'updated_at' => 'date:d-m-Y H:i:s',
      'tgl_expired' => 'date:d-m-Y',
  ];


  protected $appends = ['harga_rupiah'];
  public function getHargaRupiahAttribute() {
     return Rupiah::toRupiah($this->attributes['harga']);
  }

}
