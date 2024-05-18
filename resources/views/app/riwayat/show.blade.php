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
    <x-header title="Data Riwayat Rekam Medis User"></x-header>
@endsection
@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">

            </div>
            <div class="card-body">
                <x-datatable id="datatable" :th="['No','Kode Pemeriksaan', 'Kode RM', 'Nama', 'Tgl Pemeriksaan','Dokter', 'Aksi']" style="width: 100%"></x-datatable>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('template/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        var dataSet = [{
                "No": "1",
                "kode_pemeriksaan": "RM-902380",
                "kode_rm": "RM-902380",
                "nama": "Abdullah ",
                "tgl_pemeriksaan": "19-02-2024",
                "dokter": "Dr. Huda",
                "aksi": `
                <a href="" data-toggle="tooltip" data-placement="bottom"
        title="Cetak" class="btn btn-sm btn-warning btn-edit" data-id=""><i class="fas fa-print"></i>
        Cetak</a>
                    <a href="" data-toggle="tooltip" data-placement="bottom"
        title="Edit" class="btn btn-sm btn-primary btn-edit" data-id="">
        Detail</a>
                    <a href="" data-toggle="tooltip" data-placement="bottom"
         title="Edit Data" class="btn btn-sm btn-danger btn-hapus" data-id=""><i class="fas fa-trash-alt"></i>
         Hapus</a>`
            },

        ];

        $('#datatable').DataTable({
            data: dataSet,
            lengthChange: false,
            searching: false,
            serverSide: false,
            paging: false,
            info: false,
            columns: [
               {
                    data: 'No'
                },
                {
                    data: 'kode_pemeriksaan'
                },
                {
                    data: 'kode_rm'
                },
                {
                    data: 'nama'
                },

                {
                    data: 'tgl_pemeriksaan'
                },
                {
                    data: 'dokter'
                },
                {
                    data: 'aksi'
                }
            ]
        });
    </script>
@endpush
