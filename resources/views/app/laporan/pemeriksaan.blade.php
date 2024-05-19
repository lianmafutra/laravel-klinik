@extends('admin.layouts.master')
@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/flatpicker/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

    <style>
    </style>
@endpush
@section('header')
    <x-header title="Buat Laporan Data Pemeriksaan" back-button="true"></x-header>
@endsection
@section('content')
    <div class="col-lg-8 col-sm-12">
        <div class="card">
            <div class="card-body">
                <x-date-picker-column label="">
                    <x-slot:date_start>
                        <x-datepicker id='start_date' label='Tanggal Awal' />
                    </x-slot:date_start>
                    <x-slot:date_end>
                        <x-datepicker id='end_date' label='Tanggal Akhir' />
                    </x-slot:date_end>
                </x-date-picker-column>
            </div>
            <div class="card-footer">
                <div style="gap:8px;" class="d-flex">
                    <button type="submit" class="btn_submit btn btn-primary">Cetak Laporan</button>
                </div>
            </div>
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

    <script>
        $(function() {
            $('.select2bs4').select2({
                theme: 'bootstrap4',
            })
            flatpickr.setDefaults({
                dateFormat: "d/m/Y",
                locale: "id",
                disableMobile: "true",
            })

            
            const start_date = flatpickr("#start_date", {
                allowInput: true,

                defaultDate: ''
            });

            const end_date = flatpickr("#end_date", {
                allowInput: true,

                defaultDate: ''
            });


        })
    </script>
@endpush
