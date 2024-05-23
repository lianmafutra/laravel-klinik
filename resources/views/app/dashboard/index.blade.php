@extends('admin.layouts.master')
@section('header')
    <x-header title="Dashboard"></x-header>
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <style>


    </style>
@endpush
@section('content')
    <div class="row">
        <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Pasien</span>
                    <span style="font-size: 20px" class="info-box-number">
                        <span style="font-size: 20px" class="info-box-number">{{ $count_pasien_total }} Orang</span>
                        {{-- <small>%</small> --}}
                    </span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Pasien Hari ini</span>
                    <span style="font-size: 20px" class="info-box-number">{{ $count_pasien_hari_ini }} Orang</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Pasien Bulan Ini</span>
                    <span style="font-size: 20px" class="info-box-number"></span>
                    <span style="font-size: 20px" class="info-box-number">{{ $count_pasien_bulan_ini }} Orang</span>
                </div>
            </div>
        </div>
        <div class="clearfix hidden-md-up"></div>
        {{-- <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Obat</span>
                    <span style="font-size: 20px" class="info-box-number">100</span>

                </div>
            </div>
        </div> --}}

    </div>


    <div class="row">
        <div class="col-12 col-sm-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <canvas id="pemeriksaanChart" width="800" height="400"></canvas>
                </div>
            </div>
        </div>
        {{-- <div class="col-6 col-sm-6 col-md-6">
            <div class="card">
                <div class="card-body">
                    <canvas id="pemeriksaanChart" width="800" height="400"></canvas>
                </div>
            </div>
        </div> --}}
    </div>
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12">
            <div class="card">

                <div style="padding: 0 20px 0 20px" class="card-header d-flex bd-highlight">
                    <div class="align-content-center bd-highlight">
                        <h6 id="text_filter_pasien">Pasien Hari Ini</h6>
                    </div>
                    <div class="ml-auto col-2  bd-highlight">
                        <x-select2 id="select_waktu" label="" placeholder="Filter Sesuai Waktu">
                            <option value="hari_ini">Pasien Hari ini</option>
                            <option value="minggu_ini">Minggu Ini</option>
                            <option value="bulan_ini">Bulan Ini</option>
                            <option value="tahun_ini">Tahun Ini</option>
                        </x-select2>
                    </div>
                </div>

                <div class="card-body">
                    <x-datatable id="datatable" :th="['No', 'Kode Pemeriksaan', 'Kode RM', 'Nama', 'Tgl Pemeriksaan', 'Dokter']" style="width: 100%"></x-datatable>
                </div>
            </div>
        </div>
        {{-- <div class="col-6 col-sm-6 col-md-6">
          <div class="card">
              <div class="card-body">
                  <canvas id="pemeriksaanChart" width="800" height="400"></canvas>
              </div>
          </div>
      </div> --}}
    </div>
@endsection
@push('js')
    <script src="{{ asset('template/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script> <!-- Import plugin chartjs-plugin-datalabels -->
    <script>
        $('.select2bs4').select2({
            theme: 'bootstrap4',
        })


        var ctx = document.getElementById('pemeriksaanChart').getContext('2d');
        Chart.register(ChartDataLabels);
        var myChart = new Chart(ctx, {

            type: 'bar',
            data: {
                labels: {!! json_encode($labels) !!},
                datasets: [{
                    label: 'Pasien per Bulan',
                    data: {!! json_encode($data) !!},
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    datalabels: {
                        // anchor: 'end',
                        // align: 'top',
                        formatter: function(value, context) {
                            if (value != 0) {
                                return value;
                            } else {
                                return ""
                            }

                        }
                    }
                },
                scales: {
                    y: {
                        min: 0,
                        ticks: {
                            // forces step size to be 50 units
                            stepSize: 1
                        }
                    },

                }
            }
        });


        $('#select_waktu').on('select2:select', function(e) {
            datatable.ajax.reload()
            $waktu = $('#select_waktu').val();

            if ($waktu == "hari_ini") {
                $('#text_filter_pasien').text("Pasien Hari Ini");
            } else if ($waktu == "minggu_ini") {
                $('#text_filter_pasien').text("Pasien Minggu Ini");
            } else if ($waktu == "bulan_ini") {
                $('#text_filter_pasien').text("Pasien Bulan Ini");
            }
            else if ($waktu == "tahun_ini") {
                $('#text_filter_pasien').text("Pasien Tahun Ini");
            }
        });


        let datatable = $('#datatable').DataTable({
            serverSide: true,
            processing: true,
            searching: true,
            lengthChange: true,
            paging: true,
            info: true,
            ordering: true,
            aaSorting: [],
            scrollX: true,
            ajax: {
                url: route('klinik.dashboard.index'),
                data: function(d) {
                    d.waktu = $('#select_waktu').val();
                }
            },

            columns: [{
                    data: "DT_RowIndex",
                    orderable: false,
                    searchable: false,
                    width: '1%'
                },
                {
                    data: 'nomor_pemeriksaan',
                    name: 'nomor_pemeriksaan',
                },
                {
                    data: 'kode_rm',
                    name: 'kode_rm',
                },
                {
                    data: 'nama',
                    name: 'nama',
                },
                {
                    data: 'tgl_pemeriksaan',
                    name: 'tgl_pemeriksaan',
                },

                {
                    data: 'dokter.nama',
                    name: 'dokter.nama',
                },

            ]
        });
    </script>
@endpush
