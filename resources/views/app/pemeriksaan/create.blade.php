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
    <x-header title="Input Data Pemeriksaan" back-button="true"></x-header>
@endsection
@section('content')
    <div class="col-lg-12 col-sm-12">
        <form id="form_sample" method="post">
            @csrf
            <div class="card">
                <div class="card-header">
                    <i class="far fa-user pr-2"></i> Data Pasien
                </div>
                <div class="card-body">
                    <table class="table table-bordered display text-sm" style="width:100%">
                        <tr>
                            <th>No Rekam Medis:</th>
                            <td id="no_rm">{{ $pasien?->kode_rm }}</td>
                        </tr>
                        <tr>
                            <th>Nama Lengkap:</th>
                            <td id="nama">{{ $pasien?->nama }}</td>
                        </tr>
                        {{-- <tr>
                            <th>NIK</th>
                            <td id="nik">{{ $pasien?->nik }}</td>
                        </tr>
                        <tr>
                            <th>NRP</th>
                            <td id="nrp">{{ $pasien?->nrp }}</td>
                        </tr> --}}
                        <tr>
                            <th>Alamat</th>
                            <td id="alamat">{{ $pasien?->alamat }}</td>
                        </tr>
                        <tr>
                            <th>Tgl Lahir</th>
                            <td id="tgl_lahir">{{ $pasien?->toArray()['tgl_lahir'] }}</td>
                        </tr>
                        <tr>
                            <th>Usia</th>
                            <td id="usia">{{ $pasien?->getUsia() }}</td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td id="jenis_kelamin">{{ $pasien?->getJenisKelaminDetail() }}</td>
                        </tr>
                        <tr>
                            <th>No HP</th>
                            <td id="no_hp">{{ $pasien?->no_hp }}</td>
                        </tr>
                        {{-- <tr>
                            <th>No BPJS</th>
                            <td id="no_bpjs">{{ $pasien?->no_bpjs }}</td>
                        </tr> --}}
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-stethoscope pr-2"></i> Data Diagnosa
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-sm-6">
                            <x-input label="Nomor Pemeriksaan" id="nomor_pemeriksaan" required />
                            <x-select2 id="dokter_id" label="Pilih Dokter" placeholder="Pilih Dokter">
                                @foreach ($dokter as $item)
                                    <option value="{{ $item->id }}"> {{ $item->nama }}
                                    </option>
                                @endforeach
                            </x-select2>
                            <x-datepicker id="tgl_pemeriksaan" label="Tanggal Pemeriksaan" required />
                            <x-textarea id="keluhan" label="Keluhan Pasien" placeholder="" required />
                            <x-textarea id="diagnosis" label="Diagnosis Pasien" placeholder="" required />
                            <x-textarea id="riwayat_penyakit" label="Riwayat Penyakit" placeholder="" required />
                            <x-textarea id="catatan" label="Catatan Tambahan" placeholder="" required />
                        </div>
                        <div class="col-lg-6 col-sm-6">
                           <x-input label="Berat Badan (Kg)" id="berat_badan"  />
                            <x-input label="Tensi Darah (mmHg)" id="tensi"  />
                            <x-input label="Denyut Nadi" id="denyut_nadi"  />
                            <x-input label="Suhu Tubuh (Derajat Celcius)" id="suhu"  />
                            <x-input label="Tensi Darah" id="tensi"  />
                            <x-input label=" Laju Pernafasan" id="nafas"  />
                            
                           
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-pills pr-2"></i> Data Resep Obat
                </div>
                <div class="card-body">
                    <a href="#" id="btn_tambah_obat" class="button mb-3  btn btn-primary">+ Tambah Obat</a>
                    <x-datatable id="datatable" :th="[
                        'No',
                        'Kode Obat',
                        'Nama',
                        'Jumlah',
                        'Dosis Perhari',
                        'Harga Satuan',
                        'Keterangan',
                        'Aksi',
                    ]" style="width: 100%; margin-top: 40px"></x-datatable>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div style="gap:8px; float: right;" class="d-flex">
                        <a href="{{ route('pasien.index') }}" type="button" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn_submit btn btn-primary">Simpan Pemeriksaan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @include('app.pemeriksaan.modal-input-obat')
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
    <script src="{{ asset('template/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(function() {
            var dataSet = [{
                    "No": "1",
                    "kode_obat": "OBT-01",
                    "nama": "Paracetamol",
                    "jumlah": "1",
                    "dosis": "2",
                    "keterangan": "Sesudah Makan",
                    "harga": "0",
                    "aksi": `
                    <a href="" data-toggle="tooltip" data-placement="bottom"
        title="Edit" class="btn btn-sm btn-primary btn-edit" data-id=""><i class="fas fa-edit"></i>
        Edit</a>
                    <a href="" data-toggle="tooltip" data-placement="bottom"
         title="Edit Data" class="btn btn-sm btn-danger btn-hapus" data-id=""><i class="fas fa-trash-alt"></i>
         Hapus</a>`
                },
                {
                    "No": "2",
                    "kode_obat": "OBT-02",
                    "nama": "Paracetamol",
                    "jumlah": "1",
                    "dosis": "2",
                    "keterangan": "Sesudah Makan",
                    "harga": "0",
                    "aksi": `
                    <a href="" data-toggle="tooltip" data-placement="bottom"
        title="Edit" class="btn btn-sm btn-primary btn-edit" data-id=""><i class="fas fa-edit"></i>
        Edit</a>
                    <a href="" data-toggle="tooltip" data-placement="bottom"
         title="Edit Data" class="btn btn-sm btn-danger btn-hapus" data-id=""><i class="fas fa-trash-alt"></i>
         Hapus</a>`
                }
            ];
            $('#datatable').DataTable({
                data: dataSet,
                lengthChange: false,
                searching: false,
                serverSide: false,
                paging: false,
                info: false,
                columns: [{
                        data: 'No'
                    },
                    {
                        data: 'kode_obat'
                    },
                    {
                        data: 'nama'
                    },
                    {
                        data: 'jumlah'
                    },
                    {
                        data: 'dosis'
                    },
                    {
                        data: 'harga'
                    },
                    {
                        data: 'keterangan'
                    },
                    {
                        data: 'aksi'
                    }
                ]
            });
            $('#btn_tambah_obat').click(function(e) {
                e.preventDefault();
                $('#modal_input_obat').modal('show');
                _clearInput()
            });
            $('.select2bs4').select2({
                theme: 'bootstrap4',
            })
            const tgl_pemeriksaan = flatpickr("#tgl_pemeriksaan", {
                allowInput: true,
                locale: "id",
                dateFormat: "d/m/Y",
                defaultDate: ''
            });
            $('#btn_tambah_obat').click(function(e) {
                e.preventDefault();
                console.log($('#obat').val())
                console.log($('#dosis_perhari').val())
                console.log($('#jumlah').val())
                console.log($('#keterangan_obat').val())
            });

            $('#form_sample').submit(function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: route('pasien.pemeriksaan.store', @json($pasien)),
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
                                
                            })
                        }
                    },
                    error: function(response) {
                        _showError(response)
                    }
                })
            })


            $('#form_input_obat').submit(function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: route('master-data.obat.index'),
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
                            }).then((result) => {})
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
