@extends('admin.layouts.master')
@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush
<style>
    /* .select2-search { background-color: #528fd5; } */
    /* .select2-search input { background-color: #528fd5; } */
    .select2-results {
        background-color: #a9cffa;
    }

    /* Add shadow to the dropdown */
    .select2-container--open .select2-dropdown {
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

    .select2-results__option[aria-selected=true] {
        background-color: #509aef !important;

        overflow-x: inherit;
    }

    /* Ensure the dropdown has a white background */
</style>
@section('header')
    <x-header title="Data Riwayat Rekam Medis"></x-header>
@endsection
@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">

            </div>
            <div class="card-body">
                <x-datatable id="datatable" :th="[
                    'No',
                    'Kode Pemeriksaan',
                    'Kode RM',
                    'Nama',
                    'Tgl Pemeriksaan',
                    'Dokter',
                    'Status',
                    'Waktu Input',
                    'Aksi',
                ]" style="width: 100%"></x-datatable>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('template/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        let datatable = $('#datatable').DataTable({
            serverSide: true,
            processing: true,
            searching: true,
            lengthChange: true,
            paging: true,
            info: true,
            ordering: true,
            aaSorting: [],
            order: [7, 'desc'],
            scrollX: true,
            ajax: route('pemeriksaan.riwayat.index'),
            columns: [{
                    data: "DT_RowIndex",
                    orderable: false,
                    searchable: false,
                    width: '1%'
                },
                {
                    data: 'nomor_pemeriksaan',
                    name: 'nomor_pemeriksaan',
                },
                {
                    data: 'kode_rm',
                    name: 'kode_rm',
                },
                {
                    data: 'nama',
                    name: 'nama',
                },

                {
                    data: 'tgl_pemeriksaan',
                    name: 'tgl_pemeriksaan',
                },

                {
                    data: 'dokter.nama',
                    name: 'dokter.nama',
                },
                {
                    data: 'status_pemeriksaan',
                    name: 'status_pemeriksaan',
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                },
                {
                    data: "action",
                    orderable: false,
                    searchable: false,
                },
            ]
        });


        $('#datatable').on('click', '.btn-hapus', function(e) {
            e.preventDefault()
            Swal.fire({
                title: 'Apakah anda yakin ingin menghapus data ?',
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
