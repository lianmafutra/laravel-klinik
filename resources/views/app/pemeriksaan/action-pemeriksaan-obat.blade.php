<a href="#" data-action="" data-url="" data-id="{{ $data?->id }}" data-toggle="tooltip" data-placement="bottom"
        title="Edit" class="btn btn-sm btn-primary btn_edit_obat" ><i class="fas fa-edit"></i>
        Edit</a>
<a href="#" data-action="{{ $data?->obat?->nama }}"  data-url="{{ route('pemeriksaan-obat.destroy', $data->id) }}" data-toggle="tooltip" data-placement="bottom"
         title="Edit Data" class="btn btn-sm btn-danger btn_hapus_obat" data-id=""><i class="fas fa-trash-alt"></i>
         Hapus</a>