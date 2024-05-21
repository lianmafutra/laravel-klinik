<style>
   .dropdown-menu.show {
       left: -50px !important;
   }
</style>
<x-dropdown-action>


   <li><a href='{{ route('pemeriksaan.create.user', $data?->id) }}' href="#" class="btn_pemeriksaan dropdown-item">
           <i class="fas fa-check"></i> Pemeriksaan</a> </li>

   <div class="dropdown-divider"></div>

   <li><a href="{{ route('riwayat.show', $data?->id) }}" class="btn_edit dropdown-item">
           <i class="fas fa-edit"></i> Edit</a> </li>

   <div class="dropdown-divider"></div>

   <li><a href="{{ route('riwayat.show', $data?->id) }}" class="btn_riwayat dropdown-item">
           <i class="fas fa-history"></i> Riwayat</a> </li>

   <div class="dropdown-divider"></div>

   <li><a data-action="{{ $anggota?->nama }}" data-url="{{ route('pasien.destroy',$data?->id) }}" class="btn_hapus dropdown-item">
           <i class="fas fa-trash"></i> Hapus</a> </li>

</x-dropdown-action>
