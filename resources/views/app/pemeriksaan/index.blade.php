@extends('admin.layouts.master')
@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush
<style>

</style>
@section('header')
    <x-header title="Input Data Pemeriksaan"></x-header>
@endsection
@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <a href="#" id="btn_input_pasien" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Input
                    Data Pasien</a>
            </div>
            <div class="card-body">
                <x-datatable id="datatable" :th="['No', 'Kode RM', 'Nama', 'Jenis Kelamin', 'Tgl Lahir', 'No Hp', 'Alamat', 'Aksi']" style="width: 100%"></x-datatable>
            </div>
        </div>
    </div>
@endsection
@include('app.pemeriksaan.modal-input-pasien')
@push('js')
    <script src="{{ asset('template/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $('.select2bs4').select2({
            theme: 'bootstrap4',
            allowClear: true,
        })
        $('#btn_input_pasien').click(function(e) {
            e.preventDefault();
            $('#modal_input_pasien').modal('show');
            _clearInput()

        });

        $("#select_user").on("select2:select", function(e) {
            var select_val = $(e.currentTarget).val();
            $.ajax({
                type: "GET",
                url: route('user.detail', select_val),
                dataType: "json",
                success: function(response) {
                    console.log(response)
                    $("#name").text(response.data.name);
                    $("#nik").text(response.data.user_detail.nik);
                    $("#nrp").text(response.data.user_detail.nrp);
                    $("#alamat").text(response.data.user_detail.alamat);
                    $("#jenis_kelamin").text(response.data.user_detail.jenis_kelamin);
                    $("#pangkat_jabatan").text(response.data.user_detail.pangkat);
                    $("#no_hp").text(response.data.user_detail.no_hp);
                    $("#no_bpjs").text(response.data.user_detail.no_bpjs);
                }
            });
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

            ajax: route('pemeriksaan.index'),
            columns: [{
                    data: "DT_RowIndex",
                    orderable: false,
                    searchable: false,
                    width: '1%'
                },
                {
                    data: 'kode_rm',
                    name: 'kode_rm',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'user.name',

                    orderable: true,
                    searchable: true
                },
                {
                    data: 'user.user_detail.jenis_kelamin',

                    orderable: true,
                    searchable: true
                },
                {
                    data: 'user.user_detail.tgl_lahir',

                    orderable: true,
                    searchable: true
                },
                {
                    data: 'user.user_detail.no_hp',

                    orderable: true,
                    searchable: true
                },
                {
                    data: 'user.user_detail.alamat',

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
