
   <a   href="{{ route('rikkes-siswa-jadwal.edit', $data->id) }}" 
      data-jadwal={{ $jadwal_id }}
      data-absensi="{{ $data?->rikkes_absensi?->first()?->id }}"
      data-user="{{  $data }}" 
      data-toggle="tooltip" data-placement="bottom" title="Input Pemeriksaan Rikkes" class="p-2 btn btn-sm btn-primary btn_input"
       data-id="">Input </a>
  


       