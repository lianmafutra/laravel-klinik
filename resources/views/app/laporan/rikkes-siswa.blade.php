@extends('admin.layouts.master')
@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/flatpicker/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

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
                    <x-select2 required id="select_jadwal_rikkes" label="Jadwal Rikkes" placeholder="Pilih Jadwal Rikkes">
                      @foreach ($data as $item)
                      <option value="{{  $item->id }}">{{  $item->nama }}</option>
                      @endforeach
                       
                    </x-select2>

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



            $('.select2bs4').select2({
                theme: 'bootstrap4',
            })
      

            $('#form_sample').submit(function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                window.open(route('laporan.rikkes.siswa.cetak', {
                    _query: {
                        jadwal_rikkes:   $("#select_jadwal_rikkes").val(),
                    },
                }), "_blank", "noopener,noreferrer");
            })


        })
    </script>
@endpush
