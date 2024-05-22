@extends('admin.layouts.master')
@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/flatpicker/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/admin/plugins/summernote/summernote-bs4.min.css') }}">
    <style>
    </style>
@endpush
@section('header')
    <x-header title="Edit Data Tindakan" back-button="true"></x-header>
@endsection
@section('content')
<div class="col-lg-8 col-sm-12">
   <form id="form_sample" method="post">
       @csrf
       @method('PUT')
       <div class="card">
           <div class="card-body">
               <x-input label="Nama Tindakan" id="nama" required />
               <x-input-rupiah  label="Biaya" id="biaya" />
               <x-textarea id="keterangan" label="keterangan" placeholder=""  />
           </div>
           <div class="card-footer">
               <div style="gap:8px;" class="d-flex">
                   <a href="{{ route('master-data.tindakan.index') }}" type="button" class="btn btn-secondary">Kembali</a>
                   <button type="submit" class="btn_submit btn btn-primary">Simpan</button>
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
    <script src="{{ asset('plugins/autoNumeric.min.js') }}"></script>
    <script>
        $(function() {
            $('.select2bs4').select2({
                theme: 'bootstrap4',
            })
            AutoNumeric.multiple('.rupiah', {
                digitGroupSeparator: '.',
                decimalPlaces: 0,
                minimumValue: 0,
                decimalCharacter: ',',
                formatOnPageLoad: true,
                allowDecimalPadding: false,
                alwaysAllowDecimalCharacter: false
            });
            $('#form_sample').submit(function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: route('master-data.tindakan.update', @json($tindakan->id)),
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
                                window.location.replace(route('master-data.tindakan.index'))
                            })
                        }
                    },
                    error: function(response) {
                        _showError(response)
                    }
                })
            })

            $('#keterangan').val(@json($tindakan?->keterangan))
                // set data 
                $('#nama').val(@json($tindakan?->nama))
       
                AutoNumeric.getAutoNumericElement('#biaya').set(@json($tindakan->biaya))
      
        })
    </script>
@endpush
