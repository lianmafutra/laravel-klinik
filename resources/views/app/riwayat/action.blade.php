<div class="d-flex justify-content-center">
   <div class="d-flex flex-column me-2">
       <a href="{{ route('pemeriksaan.create.user', $data?->user?->id) }}" data-toggle="tooltip" data-placement="bottom"
           title="Input Pemeriksaan" class="btn btn-xs btn-primary btn-edit mb-2" data-id=""><i class=" fas fa-plus fa-xs"></i>
           Pemeriksaan</a>
       <a href="{{ route('pemeriksaan.create.user', $data?->user?->id) }}" data-toggle="tooltip" data-placement="bottom"
           title="Riwayat Rekam Medis Pasien" class="btn btn-xs btn-secondary btn-edit" data-id=""><i class="far fa-file fa-sm"></i>
           Riwayat</a>
   </div>
   <div class="d-flex align-items-start">
       <a data-url="{{ route('pemeriksaan.destroy',$data?->user?->id) }}" data-toggle="tooltip" data-placement="bottom"
           title="Hapus Data" class="btn btn-xs btn-danger btn-hapus ml-1 p-2" data-action="{{ $data?->user?->name }}"><i class="fas fa-trash-alt"></i>
           </a>
   </div>
</div>
