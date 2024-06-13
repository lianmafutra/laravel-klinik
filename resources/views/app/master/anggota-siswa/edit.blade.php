@extends('admin.layouts.master')
@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/flatpicker/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/admin/plugins/summernote/summernote-bs4.min.css') }}">
    <style>
    </style>
@endpush
@section('header')
    <x-header title="Edit Data User Siswa" back-button="true"></x-header>
@endsection
@section('content')
    <div class="col-lg-8 col-sm-12">
        <form id="form_sample" method="post">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-body">
                  <x-select2 required id="angkatan_id" label="Pilih Angkatan" placeholder="Pilih Angkatan">
                     @foreach ($angkatan as $index => $item)
                     <option value="{{ $item->id }}">{{ $item->nama }}</option>
                     @endforeach
                 </x-select2>
                  <x-input label="Nama Lengkap" id="nama" required />
                    <x-input label="Tempat Lahir" id="tempat_lahir" required />
                    <x-datepicker id="tgl_lahir" label="Tanggal Lahir" required />
                    <x-select2 required id="agama" label="Agama" placeholder="Pilih Agama">
                     <option value="ISLAM">ISLAM</option>
                     <option value="PROTESTAN">PROTESTAN</option>
                     <option value="KHATOLIK">KHATOLIK</option>
                     <option value="HINDU">HINDU</option>
                     <option value="BUDDHA">BUDDHA</option>
                     <option value="KHONGHUCU">KHONGHUCU</option>
                     <option value="KRISTEN">KRISTEN</option>
                    </x-select2>
                    <x-select2 required id="jenis_kelamin" label="Jenis Kelamin" placeholder="Pilih Jenis Kelamin">
                        <option value="L">Laki-Laki</option>
                        <option value="P">Perempuan</option>

                    </x-select2>
                   
              
                    <x-textarea  id="alamat" label="Alamat" placeholder="Alamat Tempat Tinggal" required />
                    <x-input-number label="NIK (Nomor Induk Kependudukan)" id="nik" />
                    <x-input-number label="NOSIS" id="nosis" />
                    <x-input-number label="Nomor BPJS" id="no_bpjs" />
                    <x-input-float label="Tinggi Badan" id="tinggi_badan" required name="tinggi_badan"
                        info="Gunaka Titik untuk Pemisah Desimal" />
                 
                    <x-input-phone id="no_hp" label="Nomor HP" placeholder="Nomor Telepon Aktif" />

                </div>
                <div class="card-footer">
                    <div style="gap:8px;" class="d-flex">
                        <a href="{{ route('master-data.siswa.store') }}" type="button" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn_submit btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@push('js')
    {{-- filepond --}}
    {{-- masking input currency,date input --}}
    <script src="{{ asset('plugins/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    {{-- flatcpiker format date input --}}
    <script src="{{ asset('plugins/flatpicker/flatpickr.min.js') }}"></script>
    <script src="{{ asset('plugins/flatpicker/id.min.js') }}"></script>

    {{-- password toggle show/hide --}}
    <script src="{{ asset('plugins/toggle-password.js') }}"></script>
    <script>
        $(function() {
            $('.select2bs4').select2({
                theme: 'bootstrap4',
                allowClear: true,
            })
            const tgl_lahir = flatpickr("#tgl_lahir", {
                allowInput: true,
                locale: "id",
                dateFormat: "d/m/Y",
                defaultDate: ''
            });
            $('#form_sample').submit(function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: route('master-data.siswa.update', @json($siswa->id)),
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    beforeSend: function() {
                        _showLoading()
                    },
                    success: (response) => {
                        if (response) {
                            Swal.fire({
                                icon: 'success',
                                title: response.message,
                                showCancelButton: true,
                                allowEscapeKey: false,
                                showCancelButton: false,
                                allowOutsideClick: false,
                            }).then((result) => {
                                window.location.replace(route('master-data.siswa.index'))
                            })
                        }
                    },
                    error: function(response) {
                        _showError(response)
                    }
                })
            })



          
            // set data 
            $('#nama').val(@json($siswa->nama))
            $('#tempat_lahir').val(@json($siswa->tempat_lahir))
            tgl_lahir.setDate(@json($siswa->tgl_lahir))
            $('#agama').val(@json($siswa->agama)).change()
            $('#jenis_kelamin').val(@json($siswa->jenis_kelamin)).change()
            $('#angkatan_id').val(@json($siswa->angkatan_id)).change()
            $('#jenis').val(@json($siswa->jenis)).change()
            $('#nik').val(@json($siswa->nik))
            $('#nosis').val(@json($siswa->nosis))
            $('#alamat').val(@json($siswa->alamat))
            $('#no_bpjs').val(@json($siswa->no_bpjs))
            $('#tinggi_badan').val(@json($siswa->tinggi_badan))
            $('#no_hp').val(@json($siswa->no_hp))
        })
    </script>
@endpush
