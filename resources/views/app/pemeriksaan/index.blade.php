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
   .select2-results { background-color: #a9cffa; }
   /* Add shadow to the dropdown */
.select2-container--open .select2-dropdown {
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
}
.select2-results__option[aria-selected=true] 
{ 
   background-color: #509aef !important;

  overflow-x:  inherit;
}

/* Ensure the dropdown has a white background */


</style>
@section('header')
    <x-header title="Data Pemeriksaan Pasien"></x-header>
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
    @include('app.pemeriksaan.modal-input-pasien')
@endsection

@push('js')
    <script src="{{ asset('template/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function() {
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
                        width: '20%',
                        orderable: false,
                        searchable: false,
                    },
                ]
            })
          
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

        });
    </script>
@endpush
