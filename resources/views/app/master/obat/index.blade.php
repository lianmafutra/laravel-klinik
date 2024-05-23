@extends('admin.layouts.master')
@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<style>

</style>
    @endpush

@section('header')
    <x-header title="Data Master Obat"></x-header>
@endsection
@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('master-data.obat.create') }}" id="btn_input_data" class="btn btn-sm btn-primary"><i
                        class="fas fa-plus"></i> Input
                    Data</a>

                <a href="{{ route('penyesuaian.stok.obat') }}" id="btn_penyesuaian_stok" class="btn btn-sm btn-primary"><i
                        class="fas fa-database"></i> Penyesuaian Stok</a>
                        <a href="{{ route('penyesuaian.stok.obat.riwayat') }}" id="btn_penyesuaian_stok" class="btn btn-sm btn-primary"><i
                           class="fas fa-history"></i> Riwayat Penyesuaian</a>
            </div>
            <div class="card-body">
                <x-datatable id="datatable" :th="['No', 'Kode', 'Nama', 'Harga', 'Stok','Tgl Expired','Status Expired', 'Aksi']" style="width: 100%"></x-datatable>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('template/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $('#btn_input_pasien').click(function(e) {
            e.preventDefault();
            $('#modal_input_pasien').modal('show');
            _clearInput()
        });
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

            ajax: route('master-data.obat.index'),
            columns: [{
                    data: "DT_RowIndex",
                    orderable: false,
                    searchable: false,
                    width: '1%'
                },
                {
                    data: 'kode_obat',
                    name: 'kode_obat',
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
                    data: 'harga_format',
                    name: 'harga',
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
                    data: 'tgl_expired',
                    name: 'tgl_expired',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'status_expired',
                    name: 'status_expired',
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
