<div style=" gap:5px;" class="d-flex justify-content-center">
    <a href="{{ route('pemeriksaan.create', $data->id) }}" data-toggle="tooltip" data-placement="bottom"
        title="Edit Data" class="btn btn-sm btn-primary btn-edit" data-id=""><i class="fas fa-plus"></i>
        Pemeriksaan</a>
    <a href="#" data-url="{{ route('pemeriksaan.destroy', $data->id) }}" data-action="{{ $data->name }}"
        data-toggle="tooltip" data-placement="bottom" title="Delete Data" class="btn btn-sm btn-danger btn_delete"><i
            class="fas fa-trash"></i></a>
</div>
