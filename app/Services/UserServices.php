<?php
namespace App\Services;
class UserServices
{
   public function getJenisUserColor($role)
   {
      $color = '';
      switch ($role) {
         case 'siswa':
            $color = '#f44336';
            break;
         case 'personil':
            $color = '#3f51b5';
            break;
      }
      return '<span style="color: #fff;  opacity: 0.6; background-color:' . $color . '"  class="badge">' . $role . '</span>';
   }

   public static function validationInsertUsername($jenis_user, $nip, $nrp)
   {
      if ($jenis_user == "personil") {
         return $nrp;
      } else if ($jenis_user == "siswa") {
         return $nip;
      }
   }

   public function getRoleColor($role)
   {
      // // Seed the random number generator to ensure consistent colors for the same input string
      // srand(crc32($role));
      // // Generate random RGB values based on the characters in the string
      // $red = rand(0, 255);
      // $green = rand(0, 255);
      // $blue = rand(0, 255);
      // // Return the RGB values as a hexadecimal color code
      // $color = sprintf('#%02x%02x%02x', $red, $green, $blue);
      return '<span   class="badge badge badge-info">' . $role . '</span>';
   }
}
