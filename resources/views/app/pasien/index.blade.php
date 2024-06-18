@extends('admin.layouts.master')
@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('plugins/flatpicker/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
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
@endpush
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
                <x-datatable id="datatable" :th="['No', 'Kode RM', 'Nama', 'Jenis Kelamin', 'Tgl Lahir', 'Umur', 'Tgl Input', 'Aksi']" style="width: 100%"></x-datatable>
            </div>
        </div>
    </div>
    @include('app.pasien.modal-input-pasien')
@endsection
@push('js')
    <script src="{{ asset('template/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    {{-- flatcpiker format date input --}}
    <script src="{{ asset('plugins/flatpicker/flatpickr.min.js') }}"></script>
    <script src="{{ asset('plugins/flatpicker/id.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
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
            const edit_tgl_lahir = flatpickr("#edit_tgl_lahir", {
                allowInput: true,
                locale: "id",
                dateFormat: "d/m/Y",
                defaultDate: ''
            });
            $('input[type=radio][name=radio]').change(function() {
                var selectedValue = $('input[name=radio]:checked').val();
                if (selectedValue == "anggota") {
                    $("[name=select_user]").css('display', 'block')
                    $("[name=select_user]").attr("required", "required");
                } else if (selectedValue == "lainnya") {
                    $("[name=select_user]").css('display', 'none')
                    $("[name=select_user]").removeAttr("required");
                }
            });
            $('#btn_input_pasien').click(function(e) {
                e.preventDefault();
                $('#modal_input_pasien').modal('show');
                $("[name=select_user]").css('display', 'block')
                $("[name=select_user]").attr("required", "required");
                $(".select_jenis_pasien").css('display', 'block')

                $(".select_jenis_anggota").css('display', 'block');
                $("#select_jenis_anggota").attr("required", "required");
                _clearInput()
            });
            $('#form_submit_pasien').submit(function(e) {
                e.preventDefault();
                var selectedOption = $("#select_user").find('option:selected');
                const formData = new FormData(this);
                var selectedValue = $('input[name=radio]:checked').val();
                if (selectedValue == "anggota") {
                    var jenis_anggota = selectedOption.data('jenis');
                } else if (selectedValue == "lainnya") {
                    var jenis_anggota = "lainnya";
                }
                formData.append('jenis_anggota', jenis_anggota);
                $.ajax({
                    type: 'POST',
                    url: route('pasien.store'),
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
                                $('#modal_input_pasien').modal('hide');
                                datatable.ajax.reload();
                            })
                        }
                    },
                    error: function(response) {
                        _showError(response)
                    }
                })
            })
            // Function to format the options in the dropdown
            $("#select_jenis_anggota").on("select2:select", function(e) {
                var select_val = $(e.currentTarget).val();
                var select = $('#select_user');
                // Show loading message
                select.empty().append(new Option('Loading...', '', false, false)).trigger('change');
                $.ajax({
                    type: "GET",
                    url: route('anggota.list.jenis', select_val),
                    dataType: "json",
                    success: function(response) {
                        var newOptions = response.data.map(function(item) {
                            if (select_val == 'siswa') {
                                return new Option(item.nama + ' (' + item.nik + ')',
                                    item
                                    .id,
                                    false, false);
                            } else {
                                return new Option(item.nama + ' (' + item.nrp + ')',
                                    item
                                    .id,
                                    false, false);
                            }
                        });
                        // Initialize Select2 with placeholder
                        select.select2({
                            theme: 'bootstrap4',
                            placeholder: "select anggota",
                            allowClear: true
                        });
                        // Clear the loading message and add the new options
                        select.empty().trigger('change');
                        select.append(new Option('', '', true, true)).trigger(
                        'change'); // Placeholder option
                        select.append(newOptions).trigger('change');
                    }
                });
            });


            $("#select_user").on("select2:select", function(e) {
                var select_val = $(e.currentTarget).val();
                var selectedOption = $(this).find('option:selected');
                $.ajax({
                    type: "GET",
                    url: route('anggota.detail', [select_val, $("#select_jenis_anggota").val()]),
                    dataType: "json",
                    success: function(response) {
                        $("#nama").val(response.data.nama);
                        $("#alamat").val(response.data.alamat);
                        $("#jenis_kelamin").val(response.data.jenis_kelamin).change();
                        $("#no_hp").val(response.data.no_hp);
                        tgl_lahir.setDate(response.data.tgl_lahir)
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
                order: [6, 'desc'],
                scrollX: true,
                ajax: route('pasien.index'),
                columns: [{
                        data: "DT_RowIndex",
                        orderable: false,
                        searchable: false,
                        width: '1%'
                    },
                    {
                        data: 'kode_rm',
                        nama: 'kode_rm',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'nama',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'jenis_kelamin',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'tgl_lahir',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'umur',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'created_at',
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
            $('body').on('click', '.btn_edit', function(e) {
                $("[name=select_user]").css('display', 'block')
                $(".select_jenis_anggota").css('display', 'none');
                $("#select_jenis_anggota").removeAttr("required");

                e.preventDefault()
                $('#modal_input_pasien').modal('show');
                _clearInput()
                $.ajax({
                    type: "GET",
                    url: route('pasien.show', $(this).attr('data-id')),
                    dataType: "json",
                    success: function(response) {
                        $(".select_jenis_pasien").css('display', 'none')
                        $("[name=select_user]").css('display', 'none')
                        $("[name=select_user]").removeAttr("required");
                        $("#select_user").val(response.data.anggota_kode).change();
                        $("#nama").val(response.data.nama);
                        $("#alamat").val(response.data.alamat);
                        $("#jenis_kelamin").val(response.data.jenis_kelamin).change();
                        $("#select_user").val(response.data.anggota_kode).change();
                      
                        $("#no_hp").val(response.data.no_hp);
                        $("#pasien_id").val(response.data.id);
                        $("#pasien_id").css('display', 'none')
                        tgl_lahir.setDate(response.data.tgl_lahir)
                    }
                });
            })
            $('body').on('click', '.btn_hapus', function(e) {
                e.preventDefault()
                Swal.fire({
                    title: 'Apakah anda yakin ingin menghapus data pasien ?',
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
