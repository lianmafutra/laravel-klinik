<?php

namespace App\Imports;


use App\Models\AnggotaSiswa;
use App\Models\AnggotaSiswaAngkatan;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::default('none');
class SiswaImport implements ToModel, WithHeadingRow
{
   /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

   private $angkatan;

   public function __construct($angkatan)
   {
      $this->angkatan = $angkatan;
   }


   public function model(array $row)
   {

     
      $angkatan = AnggotaSiswaAngkatan::where('id', $this->angkatan)->first()->id;

      return new Anggotasiswa([
         'nama'     => $row['NAMA'],
         'angkatan_id'     => $angkatan,
         'nosis'    => $row['NOSIS'],
         'nik'    => $row['NIK'],
         'tgl_lahir' => Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['TGL_LAHIR'])),
         'jenis_kelamin' => $row['JENIS_KELAMIN'],
         'tempat_lahir' => $row['TEMPAT_LAHIR'],
         'agama' => $row['AGAMA'],
         'alamat' => $row['ALAMAT'],
         'no_hp' => $row['NO_HP'],
         'import_at' => Carbon::now(),
      ]);
   }
}
