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
    <x-header title="Edit Data Rikkes" back-button="true"></x-header>
@endsection
@section('content')
    <div class="col-lg-8 col-sm-12">
        <form id="form_sample" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-body">
                    <x-input label="Judul Rikkes" id="nama" required value="{{ $rikkes_bintara->nama }}" />
                    <div class="form-group">
                        <label for="file">File Rikkes :</label>
                        <input type="file" name="file" id="file"class="form-control">

                    </div>
                    {!! $file !!}
                </div>
                <div class="card-footer">
                    <div style="gap:8px;" class="d-flex">
                        <a href="{{ route('rikkes-bintara.index') }}" type="button" class="btn btn-secondary">Kembali</a>
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
    <script>
        $(function() {
            $('.select2bs4').select2({
                theme: 'bootstrap4',
            })

            $('#form_sample').submit(function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: route('rikkes-bintara.update', @json( $rikkes_bintara)),
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
                                window.location.replace(route(
                                    'rikkes-bintara.index'))
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
