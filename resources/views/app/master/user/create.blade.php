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
    <x-header title="Input Data User" back-button="true"></x-header>
@endsection
@section('content')
    <div class="col-lg-8 col-sm-12">
        <form id="form_sample" method="post">
            @csrf
            <div class="card">
                <div class="card-body">
                    <x-input label="Nama Lengkap" id="name" required />
                    <x-input label="Tempat Lahir" id="tmpt_lahir" required />
                    <x-datepicker id="tgl_lahir" label="Tanggal Lahir" required />
                    <x-select2 required id="agama" label="Agama" placeholder="Pilih Agama">
                        <option value="islam">Islam</option>
                        <option value="kristen">Kristen</option>
                        <option value="katolik">Katolik</option>
                        <option value="hindu">Hindu</option>
                        <option value="buddha">Buddha</option>
                        <option value="khonghucu">Khonghucu</option>
                    </x-select2>
                    <x-select2 required id="jenis_kelamin" label="Jenis Kelamin" placeholder="Pilih Jenis Kelamin">
                     <option value="L">Laki-Laki</option>
                     <option value="P">Perempuan</option>
               
                 </x-select2>
                    <x-select2 required id="jenis_user" label="Jenis User" placeholder="Pilih Jenis User">
                     <option value="siswa">Siswa</option>
                     <option value="personil">Personil</option>
                     <option value="pimpinan">Pimpinan</option>
                     <option value="admin">Admin</option>
                    </x-select2>
                
                   <x-textarea  id="alamat" label="Alamat" placeholder="Alamat Tempat Tinggal" required />
                    <x-input-number label="NIK (Nomor Induk Kependudukan)" id="nik" />
                    <x-input-number label="NRP (Nomor Register Pokok)" id="nrp" />
                    <x-input-number label="Nomor BPJS" id="no_bpjs" />
                    <x-input-float label="Tinggi Badan" id="tinggi_badan" required  info="Gunaka Titik untuk Pemisah Desimal"/>
                    <x-select2  id="pangkat" label="Pangkat" placeholder="Pilih Pangkat">
                        @foreach ($pangkat as $item)
                            <option value="{{ $item->nama }}">{{ $item->nama }}</option>
                        @endforeach
                    </x-select2>
                    <x-select2  id="jabatan" label="Jabatan" placeholder="Pilih Jabatan">
                        @foreach ($jabatan as $item)
                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endforeach
                    </x-select2>

                    <x-input-phone id="no_hp" label="Nomor HP" placeholder="Nomor Telepon Aktif" />
                    <x-input-password id="password" placeholder="Password" label="Password" value="123456" info="Password Default : 123456"/>
                </div>
                <div class="card-footer">
                    <div style="gap:8px;" class="d-flex">
                        <a href="{{ route('master-data.user.store') }}" type="button" class="btn btn-secondary">Kembali</a>
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
                    url: route('master-data.user.store'),
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
                                window.location.replace(route('master-data.user.index'))
                            })
                        }
                    },
                    error: function(response) {
                        _showError(response)
                    }
                })
            })
        })
    </script>
@endpush
