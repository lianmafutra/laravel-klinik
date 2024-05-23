<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Laporan Pemeriksaan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>

<body onload="window.print()">
    <div class="container mt-4">
        <h4 class="alert alert-success">Laporan Pemeriksaan Pasien, Tanggal : {{ $start_date }} - {{ $end_date }}</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>No Pemeriksaan</th>
                    <th>Kode RM</th>
                    <th>Nama</th>
                    <th>Tgl Pemeriksaan</th>
                    <th>Dokter</th>
                    <th>Keluhan</th>
                    <th>Diagnosa</th>
                    <th>Tindakan</th>
                    <th>Catatan</th
                </tr>
            </thead>
            <tbody>

                @foreach ($data as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->nomor_pemeriksaan }}</td>
                        <td>{{ $item?->pasien?->kode_rm }}</td>
                        <td>{{ $item?->pasien?->nama }}</td>
                        <td>{{ $item?->toArray()['tgl_pemeriksaan'] }}</td>
                        <td>{{ $item?->dokter->nama }}</td>
                        <td>{{ $item?->keluhan }}</td>
                        <td>{{ $item?->diagnosis }}</td>
                        <td>{{ $item?->tindakan_array_format }}</td>
                        <td>{{ $item?->catatan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</body>

</html>
