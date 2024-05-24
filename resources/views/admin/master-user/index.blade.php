@extends('admin.layouts.master')
@push('css')
    <link rel="stylesheet" href="{{ asset('template/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link href="{{ asset('plugins/filepond/filepond.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <style>


    </style>
@endpush
@section('header')
    <x-header title="Master Data User ( Pengguna )"></x-header>
@endsection
@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <a href="#" id="btn_create_user" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Add New
                    User</a>
            </div>
            <div class="card-body">
                <x-datatable class="table-hover" id="datatable" :th="[
                    'No',
                    'Foto',
                    'Username',
                    'Nama',
                    'Role',
                    'Status',
                    'Last Login',
                    'IP',
                    'Action',
                ]"></x-datatable>
            </div>
        </div>
    </div>
@endsection
@push('js')
    @include('admin.master-user.modal-create-edit')
    @include('admin.master-user.modal-reset-password')
    <script src="{{ asset('template/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('plugins/toggle-password.js') }}"></script>
    <script>
        $('.select2bs4').select2({
            theme: 'bootstrap4',
        })
        let datatable = $("#datatable").DataTable({
            serverSide: true,
            processing: true,
            searching: true,
            lengthChange: true,
            paging: true,
            // scrollX: true,
            info: true,
            ordering: true,
            order: [
                [4, 'desc']
            ],
            ajax: @json(route('master-user.index')),
            columns: [{
                    data: "DT_RowIndex",
                    orderable: false,
                    searchable: false,
                    width: '1%'
                },
                {
                    data: 'foto',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'username',
                    orderable: false,
                },
                {
                    data: 'name',
                    orderable: true,
                },
                {
                    data: 'role',
                    orderable: true,
                },
                {
                    data: 'status',
                    className: 'dt-body-center',
                    orderable: true,
                    width: '10px',
                    searchable: false,
                },
                {
                    data: 'last_login_human',
                    data: 'last_login_at',
                    className: 'dt-body-center',
                    orderable: true,
                    searchable: false,
                },
                {
                    data: 'last_login_ip',
                    visible: false,
                    className: 'dt-body-center',
                    orderable: true,
                    searchable: false,
                },
                {
                    data: "action",
                    orderable: false,
                    searchable: false,
                },
            ]
        })
        $('#btn_create_user').click(function(e) {
            e.preventDefault()
            _clearInput()
            $('#modal_create_edit_user').modal('show')
            $('.modal-title').text('Add New user')
        })
        $('#form_modal_create_edit').submit(function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: @json(route('master-user.store')),
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                beforeSend: function() {
                    _showLoading()
                },
                success: (response) => {
                    if (response) {
                        this.reset()
                        $('#modal_create_edit_user').modal('hide')
                        datatable.ajax.reload()
                        _alertSuccess(response.message)
                    }
                },
                error: function(response) {
                    _showError(response)
                }
            })
        })
        $('#form_reset_password').submit(function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            $.ajax({
                url: route('master-user.password-reset'),
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                beforeSend: function() {
                    _showLoading()
                },
                success: (response) => {
                    if (response) {
                        this.reset()
                        $('#modal_reset_password').modal('hide')
                        datatable.ajax.reload()
                        _alertSuccess(response.message)
                    }
                },
                error: function(response) {
                    _showError(response)
                }
            })
        })
        $('body').on('click', '.btn_edit', function(e) {
            _clearInput()
            $('#modal_create_edit_user').modal('show')
            $('.modal-title').text('Ubah Data')
            $('.error').hide();
            let url = $(this).attr('data-url');
            $.get(url, function(response) {
                $('#modal_create_edit_user input[name=user_id]').val(response.data.id)
                $('#username').val(response.data.username)
                $('#nama_lengkap').val(response.data.nama_lengkap)
                $('#kontak').val(response.data.kontak)
                $('#role').val(response.data.role).trigger("change")
                $('#email').val(response.data.email)
            })
        })
        $('body').on('click', '.btn_delete', function(e) {
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
        $('body').on('click', '.btn_reset_password', function(e) {
            e.preventDefault();
            $('#modal_reset_password').modal('show')
            let name = $(this).attr('data-name');
            $('#modal_reset_password input[name=user_id]').val($(this).attr('data-id'))
        })
        $('body').on('click', '.btn_nonaktifkan', function(e) {
            e.preventDefault();
            let data = $(this).attr('data-user');
            let status = $(this).attr('data-status');
            Swal.fire({
                title: 'Apakah anda yakin ingin ' + status + ' User ?',
                text: data,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, NonAktifkan',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).find('#form-nonaktifkan').submit();
                }
            })
        })
        $('body').on('click', '.btn_force_login', function(e) {
            e.preventDefault();
            let user = $(this).attr('data-user');
            Swal.fire({
                title: 'Force Login for User ?',
                text: user,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirm to Login',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).find('#form-force-login').submit();
                }
            })
        });
    </script>
@endpush
