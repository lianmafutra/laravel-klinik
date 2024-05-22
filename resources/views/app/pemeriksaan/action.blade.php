<div class="d-flex justify-content-center">
   <div class="d-flex flex-column me-2">
    
       <a href="" data-toggle="tooltip" data-placement="bottom"
           title="Riwayat Rekam Medis Pasien" class="btn btn-xs btn-secondary btn-edit" data-id=""><i class="far fa-file fa-sm"></i>
           Edit</a>
   </div>
   <div class="d-flex align-items-start">
       <a href="#" data-url="{{ route('pemeriksaan.destroy',$data?->id) }}" data-toggle="tooltip" data-placement="bottom"
           title="Hapus Data" class="btn btn-xs btn-danger btn-hapus ml-1 p-2" data-action="{{ $data?->nomor_pemeriksaan }} | {{ $data?->pasien?->nama }}"><i class="fas fa-trash-alt"></i>
           </a>
   </div>
</div>
