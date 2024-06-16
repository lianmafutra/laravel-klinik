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
                        <x-input hidden value="{{ $pasien->id }}" label="" id="pasien_id" />
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
                            <x-textarea id="riwayat_penyakit" label="Riwayat Penyakit" placeholder=""  />

                            <x-select2 required id="tindakan_array_id" name="tindakan_array_id[]"
                                label="Pilih Tindakan Yang Diberikan" placeholder="Pilih Tindakan" multiple>
                                @foreach ($tindakan as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach

                            </x-select2>

                            <x-select2 required id="status_pemeriksaan" label="Status Pemeriksaan"
                                placeholder="Pilih Status Pemeriksaan">
                                <option value="selesai" selected>Selesai</option>
                                <option value="rujukan">Rujukan</option>
                            </x-select2>

                            <div style="display: none" id="layout_rujukan">
                                <hr style="margin-top: 20px">
                                <label style="color:blue"> -- Rujukan --</label>
                                <x-input label="Nomor Rujukan" id="rujukan_no"  />
                                <x-textarea id="rujukan_ket" label="rujukan_ket" placeholder="" />
                                <x-textarea id="rujukan_tujuan" label="Tujuan Klinik/Rumah Sakit" placeholder=""  />
                            </div>

                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <x-input-number label="Berat Badan (Kg)" id="berat_badan" />
                            <x-input-float label="Tinggi (Cm)" id="tinggi_badan" name="tinggi_badan" />
                            <x-input label="Tensi Darah (mmHg)" id="tensi" />
                            <x-input label="Denyut Nadi" id="denyut_nadi" />
                            <x-input label="Suhu Tubuh (Derajat Celcius)" id="suhu" />
                            <x-input label="Pernafasan" id="nafas" />
                            <x-input label="SPO2" id="spo2" />
                            <x-textarea id="catatan" label="Catatan Tambahan" placeholder="" />
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
                        'Nama Obat',
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

            $("#nomor_pemeriksaan").val(@json($nomor_pemeriksaan));

            let datatable_obat = $('#datatable').DataTable({
                serverSide: true,
                processing: true,
                searching: true,
                lengthChange: true,
                paging: true,
                info: true,
                ordering: true,
                aaSorting: [],
                // order: [3, 'desc'],
                scrollX: true,

                ajax: route('pemeriksaan-obat.show', $('#nomor_pemeriksaan').val()),
                columns: [{
                        data: "DT_RowIndex",
                        orderable: false,
                        searchable: false,
                        width: '1%'
                    },
                    {
                        data: 'kode_obat'
                    },
                    {
                        data: 'nama_obat'
                    },

                    {
                        data: 'jumlah'
                    },
                    {
                        data: 'dosis_perhari'
                    },
                    {
                        data: 'harga'
                    },
                    {
                        data: 'keterangan_obat'
                    },
                    {
                        data: 'action'
                    }
                ]
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

            
            $("#layout_rujukan").css('display','none')

            $("#status_pemeriksaan").on("select2:select", function(e) {
                let value = $(this).val();
                if (value == "rujukan") {
                  $("#layout_rujukan").css('display','block')
                } else {
                    $("#layout_rujukan").css('display','none')
                }
            });

         


            $("#select_obat").on("select2:select", function(e) {
                let obat_id = $(this).val();
                $.ajax({
                    type: "GET",
                    url: route('obat.detail', obat_id),
                    dataType: "json",
                    success: function(response) {
                     console.log(response)
                        $("#stok").val(response.data.stok);
                        $("#harga").val(response.data.harga_rupiah);
                        $("#tgl_expired").val(response.data.tgl_expired);
                    }
                });
            });


            $('#btn_tambah_obat').click(function(e) {
                e.preventDefault();
                $(".modal-title").text("Tambah Data Obat");
                $('#modal_input_obat').modal('show');
                _clearInput()
            });




            $('#form_sample').submit(function(e) {
                e.preventDefault();
                const formData = new FormData(this);

                Swal.fire({
                    title: 'Apakah anda yakin ingin Simpan Data Pemeriksaan pasien ?',
                    text: $(this).attr('data-action'),
                    icon: 'warning',
                    showCancelButton: true,

                    confirmButtonText: 'Yes, Lanjutkan '
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'POST',
                            url: route('pemeriksaan.store', @json($pasien)),
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
                                        title: "Sukses, Data Pemeriksaan Disimpan Di riwayat",
                                        showCancelButton: true,
                                        allowEscapeKey: false,
                                        showCancelButton: false,
                                        allowOutsideClick: false,
                                    }).then((result) => {
                                        window.location.replace(route(
                                            'pemeriksaan.riwayat.index'
                                        ))
                                    })
                                }
                            },
                            error: function(response) {
                                _showError(response)
                            }
                        })
                    }
                })

            })


            $('#form_input_obat').submit(function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                formData.append('nomor_pemeriksaan', $('#nomor_pemeriksaan').val())


                $.ajax({
                    type: 'POST',
                    url: route('pemeriksaan-obat.store'),
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    beforeSend: function() {
                        _showLoading()
                    },
                    success: (response) => {
                        if (response) {
                            $('#modal_input_obat').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: response.message,
                                showCancelButton: true,
                                allowEscapeKey: false,
                                showCancelButton: false,
                                allowOutsideClick: false,
                            }).then((result) => {
                                datatable_obat.ajax.reload()

                            })
                        }
                    },
                    error: function(response) {
                        _showError(response)
                    }
                })
            })

            $('#datatable').on('click', '.btn_hapus_obat', function(e) {
                e.preventDefault()
                Swal.fire({
                    title: 'Apakah anda yakin ingin menghapus data Obat?',
                    text: $(this).attr('data-action'),
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6 ',
                    confirmButtonText: 'Yes, Delete'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                _method: 'DELETE'
                            },
                            url: $(this).attr('data-url'),
                            beforeSend: function() {
                                _showLoading()
                            },
                            success: (response) => {
                                datatable_obat.ajax.reload()
                                _alertSuccess(response.message)
                            },
                            error: function(response) {
                                _showError(response)
                            }
                        })
                    }
                })
            })

            $('#datatable').on('click', '.btn_edit_obat', function(e) {
                e.preventDefault()
                $(".modal-title").text("Edit Data Obat");
                let pemeriksaan_obat_id = $(this).attr('data-id');
                $('#modal_input_obat').modal('show');
                $('#pemeriksaan_obat_id').val(pemeriksaan_obat_id);
                $.ajax({
                    type: "GET",
                    url: route('pemeriksaan-obat.edit', pemeriksaan_obat_id),
                    dataType: "json",
                    success: function(response) {
                        console.log(response)
                        $("#jumlah").val(response.data.jumlah);
                        $("#harga").val(response.data.obat.harga_rupiah);
                        $("#select_obat").val(response.data.obat.id).change();
                        $("#stok").val(response.data.obat.stok);
                        $("#tgl_expired").val(response.data.obat.tgl_expired);
                        $("#dosis_perhari").val(response.data.dosis_perhari);
                        $("#keterangan_obat").val(response.data.keterangan_obat);
                    }
                });
            })


        })
    </script>
@endpush
