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
        <h3 style="text-align: center"> KEPOLISIAN NEGARA REPOBLIK INDONESIA
            DAERAH JAMBI
            SEKOLAH POLISI NEGARA</h3>
        <hr>
        <h5 style="text-align: center" class="alert alert-success">{{ $jadwal->nama }}</h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Peleton</th>
                    <th>Tensi</th>
                    <th>Tinggi</th>
                    <th>BB</th>
                    <th>IMT</th>
                    <th>Nilai</th>
                    <th>Ket</th </tr>
            </thead>
            <tbody>


                @foreach ($data as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item?->nama }}</td>
                        <td>{{ $item?->peleton }}</td>
                        <td>{{ $item?->rikkes_absensi?->first()?->tensi }}</td>
                        <td>{{ $item?->rikkes_absensi?->first()?->tinggi }}</td>
                        <td>{{ $item?->rikkes_absensi?->first()?->catatan }}</td>
                        <td>{{ $item?->rikkes_absensi?->first()?->bb }}</td>
                        <td>{{ $item?->rikkes_absensi?->first()?->imt }}</td>
                        <td>{{ $item?->rikkes_absensi?->first()?->keterangan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</body>

</html>
