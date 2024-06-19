@extends('admin.layouts.master')
@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/flatpicker/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/admin/plugins/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <style>
    </style>
@endpush
@section('header')
    <x-header title="{{ $jadwal->nama }}" back-button="true"></x-header>
@endsection
@section('content')
    <div class="col-sm-12">
        <form id="form_sample" method="post">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="card-body">

                        <x-datatable id="datatable" :th="[
                            'No',
                            'Nama',
                            'NOSIS',
                            'Tensi',
                            'Tinggi',
                            'BB',
                            'IMT',
                            'Nilai',
                            'Keterangan',
                            'Aksi',
                        ]" style="width: 100%"></x-datatable>
                    </div>
                </div>

            </div>
        </form>
    </div>
    @include('app.master.rikkes-siswa-absensi.modal-input-rikkes')
@endsection
@push('js')
    {{-- filepond --}}
    {{-- masking input currency,date input --}}
    <script src="{{ asset('plugins/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    {{-- flatcpiker format date input --}}
    <script src="{{ asset('plugins/flatpicker/flatpickr.min.js') }}"></script>
    <script src="{{ asset('plugins/flatpicker/id.min.js') }}"></script>
    <script src="{{ asset('template/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    {{-- password toggle show/hide --}}
    <script src="{{ asset('plugins/toggle-password.js') }}"></script>
    <script>
        $(function() {

            const beratBadanInput = document.getElementById('bb');
            const tinggiBadanInput = document.getElementById('tinggi');
            const imtInput = document.getElementById('imt');
            const kategoriInput = document.getElementById('ket_imt');

            function calculateIMT() {
                const beratBadan = parseFloat(beratBadanInput.value);
                const tinggiBadan = parseFloat(tinggiBadanInput.value);
                if (!isNaN(beratBadan) && !isNaN(tinggiBadan) && tinggiBadan > 0) {
                    const tinggiBadanMeter = tinggiBadan / 100; // convert to meters
                    num = tinggiBadanMeter * tinggiBadanMeter;
                    let numStr = num.toString();
                    let decimalIndex = numStr.indexOf('.');
                    if (decimalIndex !== -1) {
                        numStr = numStr.substring(0, decimalIndex + 3);
                    }
                    const imt = beratBadan / (numStr);
                    imtInput.value = imt.toFixed(2);
                    updateKategori(imt.toFixed(2));
                } else {
                    imtInput.value = '';
                    kategoriInput.value = '';
                }
            }

            function updateKategori(imt) {
                if (imt < 17.0) {
                    kategoriInput.value = 'Berat Badan Kurus Tingkat Berat';
                } else if (imt >= 17.0 && imt <= 18.4) {
                    kategoriInput.value = 'Berat Badan Kurus Tingkat Ringan';
                } else if (imt >= 18.5 && imt <= 25.0) {
                    kategoriInput.value = 'Berat Badan Normal';
                } else if (imt >= 25.1 && imt <= 27.0) {
                    kategoriInput.value = 'Berat Badan Gemuk Tingkat Ringan (Over Weight)';
                } else if (imt > 27.0) {
                    kategoriInput.value = 'Berat Badan Gemuk Tingkat Berat (Obesitas)';
                } else {
                    kategoriInput.value = '';
                }

            }

            function handleIMTInput() {

                const imt = parseFloat(imtInput.value);
                if (!isNaN(imt)) {
                    updateKategori(imt);
                } else {
                    kategoriInput.value = '';
                }
            }
            beratBadanInput.addEventListener('input', calculateIMT);
            tinggiBadanInput.addEventListener('input', calculateIMT);
            imtInput.addEventListener('input', handleIMTInput);
            
            $('.select2bs4').select2({
                theme: 'bootstrap4',
            })

            $('#form_input_rikkes').submit(function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: route('rikkes-siswa-absensi.store'),
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    beforeSend: function() {
                        _showLoading()
                    },
                    success: (response) => {
                        if (response) {
                            $('#modal_input_rikkes').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: response.message,
                                showCancelButton: true,
                                allowEscapeKey: false,
                                showCancelButton: false,
                                allowOutsideClick: false,
                            }).then((result) => {
                                datatable.ajax.reload()
                            })
                        }
                    },
                    error: function(response) {
                        _showError(response)
                    }
                })
            })

            let datatable = $("#datatable").DataTable({
                serverSide: true,
                processing: true,
                searching: true,
                pageLength: 30,
                lengthChange: true,
                paging: true,
                info: true,
                ordering: true,
                aaSorting: [],
                order: [1, 'asc'],
                scrollX: true,

                ajax: route('rikkes-siswa-absensi.input', @json($jadwal->id)),
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
                        name: 'nosis',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'tensi',
                        name: 'rikkes_absensi.tensi',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'tinggi',
                        name: 'rikkes_absensi.tinggi',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'bb',
                        name: 'rikkes_absensi.bb',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'imt',
                        name: 'rikkes_absensi.imt',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'nilai',
                        name: 'rikkes_absensi.nilai',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'keterangan',
                        name: 'rikkes_absensi.keterangan',
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


            $('#datatable').on('click', '.btn_input', function(e) {
                e.preventDefault()
                _clearInput()
                let user = JSON.parse($(this).attr('data-user'));
                $('#modal_input_rikkes').modal('show');
                
               
                $('#nama').val(user.nama)
                $('#user_id').val(user.id)
                $('#nosis').val(user.nosis)
                $('#rikkes_siswa_absensi_id').val($(this).attr('data-absensi'))
                $('#rikkes_siswa_jadwal_id').val($(this).attr('data-jadwal'))
                $.ajax({
                    type: "GET",
                    url: route('rikkes-siswa-absensi.detail', $(this).attr('data-absensi')),
                    dataType: "json",
                    success: function(response) {
                        console.log(response)
                        $("#tensi").val(response.data.tensi);
                        $("#tinggi").val(response.data.tinggi);
                        $("#bb").val(response.data.bb);
                        $("#imt").val(response.data.imt);
                        $("#nilai").val(response.data.nilai);
                        $("#keterangan").val(response.data.keterangan);
                        handleIMTInput()
                    }
                });

            })
        })
    </script>
@endpush
