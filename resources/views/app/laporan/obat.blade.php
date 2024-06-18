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
    <x-header title="Buat Laporan Data Stok Obat"></x-header>
@endsection
@section('content')
    <form id="form_sample" method="post">
        @csrf
        <div class="col-lg-8 col-sm-12">
            <div class="card">
                <div class="card-body">

                    <x-select2 required id="select_jenis_laporan" label="Pilih Jenis Laporan"
                        placeholder="Pilih  Jenis Laporan">
                        <option value="obat_terkini">Stok Obat Terkini</option>
                        <option value="obat_penyesuaian">Penyesuaian Stok Obat</option>
                    </x-select2>

                    <div style="display: none" class="select_jenis_penyesuaian">
                        <x-select2 required id="select_jenis_penyesuaian" label="Pilih Jenis Penyesuaian"
                            placeholder="Pilih  Jenis Penyesuaian">
                            <option value="semua">Semua</option>
                            <option value="pengurangan">Pengurangan</option>
                            <option value="penambahan">Penambahan</option>
                        </x-select2>
                    </div>



                    <div class="filter_date">
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


            $("#select_jenis_laporan").on("select2:select", function(e) {
                var select_val = $(e.currentTarget).val();

                if (select_val == 'obat_terkini') {
                    $(".filter_date").css('display', 'none')
                      $(".select_jenis_penyesuaian").css('display', 'none')
                      $("#select_jenis_penyesuaian").removeAttr("required");
                      $("#start_date").removeAttr("required");
                      $("#end_date").removeAttr("required");

                }
                if (select_val == 'obat_penyesuaian') {
                    $(".filter_date").css('display', 'block')
                      $(".select_jenis_penyesuaian").css('display', 'block')
                      $("#select_jenis_penyesuaian").attr("required", "required");
                      $("#start_date").attr("required", "required");
                      $("#end_date").attr("required", "required");
                }

            });

            $('#form_sample').submit(function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                window.open(route('cetak.laporan.obat', {
                    _query: {
                        jenis_laporan: $("#select_jenis_laporan").val(),
                        jenis_penyesuaian: $("#select_jenis_penyesuaian").val(),
                        start_date: $("#start_date").val(),
                        end_date: $("#end_date").val(),
                    },
                }), "_blank", "noopener,noreferrer");
            })

        })
    </script>
@endpush
