
   <a href="{{ route('rikkes-siswa-absensi.input', $data->id) }}" data-toggle="tooltip" data-placement="bottom" title="" class="btn btn-sm btn-default "
      data-id="">Absensi Rikkes</a>
   <a href="{{ route('rikkes-siswa-jadwal.edit', $data->id) }}" data-toggle="tooltip" data-placement="bottom" title="Edit Data" class="p-2 btn btn-sm btn-primary btn-edit"
       data-id=""><i class="fas fa-pencil-alt"></i></a>
   <a href="#" data-url="{{ route('rikkes-siswa-jadwal.destroy', $data->id) }}" data-action="{{ $data->nama }}" data-toggle="tooltip" data-placement="bottom" title="Delete Data" class="p-2 btn button btn-sm btn-danger btn_delete"><i class="fas fa-trash"></i></a>

