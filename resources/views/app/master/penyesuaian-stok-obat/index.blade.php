
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
    <x-header title="Penyesuaian Obat" back-button="true"></x-header>
@endsection
@section('content')
<div class="col-lg-12 col-sm-12">
   <form id="form_penyesuaian_stok" method="post">
       @csrf
      
       <div class="card">
           <div class="card-header">
               <i class="fas fa-database mr-2"></i> Penyesuaian Stok Obat
           </div>
           <div class="card-body">
            <x-select2 id="select_obat" label="Data Obat" placeholder="Pilih Obat" >
               @foreach ($obat as $item)
                   <option value="{{ $item->id }}">{{ $item->kode_obat }} -
                       {{ $item->nama }}
                   </option>
               @endforeach
           </x-select2>
           <x-input-number label="Stok Saat ini" id="stok" disabled/>
               <x-select2 required id="penyesuaian_aksi" label="Pilih Aksi" placeholder="Pilih Aksi Penyesuaian">
                   <option value="pengurangan">(-) Pengurangan </option>
                   <option value="penambahan">(+) Penambahan</option>
               </x-select2>
               <x-input-number label="Jumlah Stok" id="penyesuaian_jumlah_stok" />
               <x-datepicker id="tgl_penyesuaian" label="Tanggal" required />
              
               <x-textarea id="penyesuaian_keterangan" label="Keterangan" placeholder="Keterangan" />
          
            </div>
           <div class="card-footer">
               <div style="gap:8px;" class="d-flex">
                   <button type="submit" class="btn_submit_penyesuaian btn btn-primary">Simpan Penyesuaian Stok</button>
               </div>
           </div>
       </div>
   </form>
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

         $("#select_obat").on("select2:select", function(e) {
                let obat_id = $(this).val();
                $.ajax({
                    type: "GET",
                    url: route('obat.detail', obat_id),
                    dataType: "json",
                    success: function(response) {
                        $("#stok").val(response.data.stok);
                       
                    }
                });
            });



         const tgl_penyesuaian = flatpickr("#tgl_penyesuaian", {
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
       
            $('#form_penyesuaian_stok').submit(function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: route('penyesuaian.stok.obat.store'),
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
           
        })
    </script>
@endpush
