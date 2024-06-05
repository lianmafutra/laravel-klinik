@extends('admin.layouts.master')
@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/flatpicker/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/admin/plugins/summernote/summernote-bs4.min.css') }}">
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
    <x-header title="Edit Data Obat" back-button="true"></x-header>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-6 col-sm-12">
            <form id="form_sample" method="post">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-body">
                        <x-input label="Kode Obat" id="kode_obat"  />
                        <x-input label="Nama Obat" id="nama" required />
                        <x-input-rupiah label="Harga" id="harga" />
                        <x-input-number label="Jumlah Stok" id="stok" />
                        <x-datepicker id="tgl_expired" label="Tanggal Expired"  />
                        <x-textarea id="keterangan" label="Keterangan" placeholder="Keterangan" />
                    </div>
                    <div class="card-footer">
                        <div style="gap:8px;" class="d-flex">
                            <button type="submit" class="btn_submit btn btn-primary">Update Data</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
       
    </div>
@endsection
@push('js')
    {{-- filepond --}}
    {{-- masking input currency,date input --}}
    <script src="{{ asset('plugins/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    {{-- flatcpiker format date input --}}
    <script src="{{ asset('plugins/flatpicker/flatpickr.min.js') }}"></script>
    <script src="{{ asset('plugins/flatpicker/id.min.js') }}"></script>
    {{-- password toggle show/hide --}}
    <script src="{{ asset('plugins/toggle-password.js') }}"></script>
    {{-- currency format input --}}
    <script src="{{ asset('plugins/autoNumeric.min.js') }}"></script>
    <script>
        $(function() {
         const tgl_penyesuaian = flatpickr("#tgl_penyesuaian", {
                allowInput: true,
                locale: "id",
                dateFormat: "d/m/Y",
                defaultDate: ''
            });

            const tgl_expired = flatpickr("#tgl_expired", {
                allowInput: true,
                locale: "id",
                dateFormat: "d/m/Y",
                defaultDate: ''
            });


            AutoNumeric.multiple('.rupiah', {
                digitGroupSeparator: '.',
                decimalPlaces: 0,
                minimumValue: 0,
                decimalCharacter: ',',
                formatOnPageLoad: true,
                allowDecimalPadding: false,
                alwaysAllowDecimalCharacter: false
            });
            $('.select2bs4').select2({
                theme: 'bootstrap4',
            })
            $('#form_sample').submit(function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: route('master-data.obat.update', @json($obat->id)),
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
                                window.location.replace(route('master-data.obat.index'))
                            })
                        }
                    },
                    error: function(response) {
                        _showError(response)
                    }
                })
            })
            $('#form_penyesuaian_stok').submit(function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: "",
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
                                window.location.replace(route('master-data.obat.index'))
                            })
                        }
                    },
                    error: function(response) {
                        _showError(response)
                    }
                })
            })
            $('#nama').val(@json($obat->nama))
            $('#kode_obat').val(@json($obat->kode_obat))
            AutoNumeric.getAutoNumericElement('#harga').set(@json($obat->harga))
            $('#stok').val(@json($obat->stok))
            tgl_expired.setDate(@json($obat->tgl_expired))
            $('#keterangan').val(@json($obat->keterangan))
            $('#penyesuaian_jumlah_stok').val(0)
        })
    </script>
@endpush
