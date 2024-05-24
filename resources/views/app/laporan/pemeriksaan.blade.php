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
    <x-header title="Buat Laporan Data Pemeriksaan"></x-header>
@endsection
@section('content')
    <form id="form_sample" method="post">
        @csrf
        <div class="col-lg-8 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <x-select2 required id="select_jenis_laporan" label="Pilih Jenis Laporan" placeholder="Pilih  Jenis Laporan">
                        <option value="semua_pasien"> Semua Pasien</option>
                        <option value="pasien_tertentu"> Pilih Pasien</option>
                    </x-select2>
                    <div class="select_pasien">
                        <x-select2 id="select_pasien" label="Pilih Pasien" placeholder="Pilih Pasien">
                            @foreach ($pasien as $item)
                                <option value="{{ $item->id }}"> {{ $item->kode_rm }}
                                    | {{ $item->nama }} </option>
                            @endforeach
                        </x-select2>
                    </div>

                    <x-date-picker-column label="">
                        <x-slot:date_start>
                            <x-datepicker id='start_date' label='Tanggal Awal' required />
                        </x-slot:date_start>
                        <x-slot:date_end>
                            <x-datepicker id='end_date' label='Tanggal Akhir' required />
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
    </form>
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


            $(".select_pasien").css('display', 'none')
            $("#select_pasien").removeAttr("required");
            $("#select_jenis_laporan").on("select2:select", function(e) {
                var select_val = $(e.currentTarget).val();

                if (select_val == 'semua_pasien') {
                    $(".select_pasien").css('display', 'none')
                    $("#select_pasien").removeAttr("required");
                }
                if (select_val == 'pasien_tertentu') {
                    $(".select_pasien").css('display', 'block')
                    $("#select_pasien").attr("required", "required");
                }
            });


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

            $('#form_sample').submit(function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                window.open(route('cetak.laporan.pemeriksaan', {
                    _query: {
                        jenis_laporan:   $("#select_jenis_laporan").val(),
                        pasien_id:  $("#select_pasien").val(),
                        start_date:  $("#start_date").val(),
                        end_date: $("#end_date").val(),
                    },
                }), "_blank", "noopener,noreferrer");
            })


        })
    </script>
@endpush
