@extends('admin.layouts.master')
@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <style>

    </style>
@endpush

@section('header')
    <x-header title="Data Master Anggota Personil"></x-header>
@endsection
@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('master-data.personil.create') }}" id="btn_input_data" class="btn btn-sm btn-primary"><i
                        class="fas fa-plus"></i> Input
                    Data</a>
            </div>
            <div class="card-body">
                <x-datatable id="datatable" :th="['No', 'Nama', 'NRP', 'Pangkat','Jabatan', 'Tgl Lahir','Umur', 'Alamat', 'Aksi']" style="width: 100%"></x-datatable>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('template/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script>
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
            // order: [1, 'asc'],
            scrollX: true,
            ajax: {
                url: route('master-data.personil.index'),
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
                    data: 'nrp',
                    name: 'nrp',
                    orderable: true,
                    searchable: true,
                },
                {
                    data: 'pangkat',
                    name: 'pangkat',
                    orderable: true,
                    searchable: true,
                },
                {
                    data: 'jabatan',
                    name: 'jabatan',
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
                    data: 'umur',
                    name: 'umur',
                    orderable: true,
                    searchable: false,
                },
                {
                    data: 'alamat',
                    name: 'alamat',
                    orderable: true,
                    searchable: true,
                },
                {
                    data: "action",
                    width: '15%',
                    orderable: false,
                    searchable: false,
                },
            ]
        })


        $('#datatable').on('click', '.btn_hapus', function(e) {
            let data = $(this).attr('data-hapus');
            Swal.fire({
                title: 'Apakah anda yakin ingin menghapus data ?',
                text: data,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).find('#form-delete').submit();
                }
            })
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
    </script>
@endpush
