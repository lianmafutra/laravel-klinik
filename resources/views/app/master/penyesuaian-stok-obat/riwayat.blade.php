@extends('admin.layouts.master')
@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
@endpush
@section('header')
    <x-header title="Riwayat Penyesuaian Stok Obat" back-button="true"></x-header>
@endsection
@section('content')
    <div class="col-lg-12 col-sm-12">
        <form id="form_penyesuaian_stok" method="post">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-header">
                    {{-- <i class="fas fa-database mr-2"></i> Penyesuaian Stok Obat --}}
                </div>
                <div class="card-body">
                    <x-datatable id="datatable" :th="[
                        'No',
                        'Kode Obat',
                        'Kode',
                        'Aksi',
                        'Stok',
                        'Tanggal',
                        'Keterangan',
                        'Tgl Input',
                        'Aksi',
                    ]" style="width: 100%"></x-datatable>
                </div>
            </div>
        </form>
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
            paging: true,
            info: true,
            ordering: true,
            aaSorting: [],
            // order: [3, 'desc'],
            scrollX: true,

            ajax: route('penyesuaian.stok.obat.riwayat'),
            columns: [{
                    data: "DT_RowIndex",
                    orderable: false,
                    searchable: false,
                    width: '1%'
                },
                {
                    data: 'obat_nama',
                    name: 'obat_nama',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'nama',
                    name: 'nama',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'aksi',
                    name: 'aksi',
                    orderable: true,
                    searchable: true
                },

                {
                    data: 'stok',
                    name: 'stok',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'tgl_penyesuaian',
                    name: 'tgl_penyesuaian',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'keterangan',
                    name: 'keterangan',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    orderable: true,
                    searchable: true
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
