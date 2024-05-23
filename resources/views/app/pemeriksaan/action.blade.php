

<div class="dt-buttons">
   {{-- <button type="button" class="btn btn-warning btn-sm" data-toggle="tooltip" title="Add New Record">
       <i class="fa fa-print"></i> Cetak
   </button> --}}
   <a href="{{ route('pemeriksaan.edit', $data->id) }}"  type="button" class="btn button btn-primary btn-sm" data-toggle="tooltip" title="Edit">
       <i class="fa fa-pencil"></i> Edit
   </a>
   <button  data-url="{{ route('pemeriksaan.destroy',$data?->id) }}" type="button"  data-action="{{ $data?->nomor_pemeriksaan }} | {{ $data?->pasien?->nama }}" class="btn btn-danger  btn-hapus btn-sm" data-toggle="tooltip" title="Delete ">
       <i class="fa fa-trash p-1"></i> 
   </button>
</div>