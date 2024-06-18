@extends('admin.layouts.master')
@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <style>
    </style>
@endpush
@section('header')
    <x-header title="Data Master Anggota Siswa"></x-header>
@endsection
@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex flex-row bd-highlight align-items-center">
                    <div class="p-2">
                        <a href="{{ route('master-data.siswa.create') }}" id="btn_input_data"
                            class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Input
                            Data</a>
                        <a href="{{ route('rikkes-siswa-jadwal.create') }}" id="btn_upload_excel"
                            class="btn btn-sm btn-secondary"><i class="fas fa-upload"></i> Upload Excel</a>

                        {{-- <a href="#" id="btn_undo" class="btn btn-sm btn-warning"><i class="fas fa-undo-alt"></i> Undo
                            Last Import</a> --}}
                    </div>
                    <div class="ml-auto p-2 bd-highlight">
                        <x-select2 id="select_angkatan" label="" placeholder="Pilih Angkatan Siswa">
                            @foreach ($angkatan as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </x-select2>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <x-datatable id="datatable" :th="['No', 'Nama', 'Nosis', 'NIK', 'Tgl Lahir', 'Alamat', 'Aksi']" style="width: 100%"></x-datatable>
            </div>
        </div>
    </div>
    @include('app.master.anggota-siswa.modal-upload-excel')
@endsection
@push('js')
    <script src="{{ asset('template/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $('.select2bs4').select2({
            theme: 'bootstrap4',
        })
        let datatable_angkatan = $("#datatable_angkatan").DataTable({
            serverSide: true,
            processing: true,
            searching: false,
            lengthChange: false,
            pageLength: 20,
            paging: false,
            info: false,
            ordering: false,
            aaSorting: [],
            order: [1, 'asc'],
            scrollX: false,
            ajax: route('angkatan.index'),
            columns: [{
                    data: "DT_RowIndex",
                    orderable: false,
                    searchable: false,
                    width: '1%'
                },
                {
                    data: 'nama',
                    name: 'nama',
                    orderable: true,
                    searchable: true
                },
                {
                    data: "action",
                    orderable: false,
                    searchable: false,
                },
            ]
        })
        $('#select_angkatan').val(1).trigger('change')
        $("#select_angkatan").on("select2:select", function(e) {
            var select_val = $(e.currentTarget).val();
            datatable.draw();
        })
        let datatable = $("#datatable").DataTable({
            serverSide: true,
            processing: true,
            searching: true,
            lengthChange: true,
            pageLength: 20,
            paging: true,
            info: true,
            ordering: true,
            aaSorting: [],
            order: [1, 'asc'],
            scrollX: true,
            ajax: {
                url: route('master-data.siswa.index'),
                data: function(d) {
                    d.angkatan = $('#select_angkatan').val();
                }
            },
            columns: [{
                    data: "DT_RowIndex",
                    orderable: false,
                    searchable: false,
                    width: '1%'
                },
                {
                    data: 'nama',
                    name: 'nama',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'nosis',
                    data: 'nosis',
                    orderable: true,
                    searchable: true,
                },
                {
                    data: 'nik',
                    data: 'nik',
                    orderable: true,
                    searchable: true,
                },
                {
                    data: 'tgl_lahir',
                    name: 'tgl_lahir',
                    orderable: true,
                    searchable: false,
                },
                {
                    data: 'alamat',
                    name: 'alamat',
                    orderable: true,
                    searchable: false,
                },
                {
                    data: "action",
                    width: '15%',
                    orderable: false,
                    searchable: false,
                },
            ]
        })
        $('#datatable').on('click', '.btn_delete', function(e) {
            e.preventDefault()
            Swal.fire({
                title: 'Are you sure, you want to delete this data ?',
                text: $(this).attr('data-action'),
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6 ',
                confirmButtonText: 'Yes, Delete'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            _method: 'DELETE'
                        },
                        url: $(this).attr('data-url'),
                        beforeSend: function() {
                            _showLoading()
                        },
                        success: (response) => {
                            datatable.ajax.reload()
                            _alertSuccess(response.message)
                        },
                        error: function(response) {
                            _showError(response)
                        }
                    })
                }
            })
        })
        $('#btn_upload_excel').click(function(e) {
            e.preventDefault();
            $('#modal_upload_excel').modal('show');
            _clearInput()
        });

        $('#btn_undo').click(function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Apakah Yakin Ingin Membatalkan Import Data Siswa ?',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6 ',
                confirmButtonText: 'Yes, Batalkan'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        dataType: 'json',
                        url: route('anggota.siswa.importExcel.undo'),
                        beforeSend: function() {
                            _showLoading()
                        },
                        success: (response) => {
                           datatable.ajax.reload();
                            _alertSuccess("Berhasil Undo Data Siswa")
                        },
                        error: function(response) {
                            _showError(response)
                        }
                    })
                }
            })
        });

        $('#form_upload_excel').submit(function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: route('anggota.siswa.importExcel'),
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
                            title: "Berhasil Import Data Excel Siswa",
                            showCancelButton: true,
                            allowEscapeKey: false,
                            showCancelButton: false,
                            allowOutsideClick: false,
                        }).then((result) => {
                            $('#modal_upload_excel').modal('hide');
                            datatable.ajax.reload();
                        })
                    }
                },
                error: function(response) {
                    _showError(response)
                }
            })
        })
    </script>
@endpush
