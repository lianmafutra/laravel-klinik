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
                    <th>Tensi</th>
                    <th>Tinggi</th>
                    <th>BB</th>
                    <th>IMT</th>
                    <th>Ket IMT</th>
                    <th>Nilai</th>
                    <th>Ket</th </tr>
            </thead>
            <tbody>


                @foreach ($data as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item?->nama }}</td>
                        <td>{{ $item?->rikkes_absensi?->first()?->tensi }}</td>
                        <td>{{ $item?->rikkes_absensi?->first()?->tinggi }}</td>
                        <td>{{ $item?->rikkes_absensi?->first()?->catatan }}</td>
                        <td>{{ $item?->rikkes_absensi?->first()?->bb }}</td>
                     
                        <td id="ket_imt">

                            @php
                                if ($item?->rikkes_absensi?->first()?->imt) {
                                    $imt = $item?->rikkes_absensi?->first()?->imt;
                                } else {
                                    $imt = 0;
                                }

                            @endphp


                            @switch(true)
                                @case($imt == 0)
                                @break

                                @case($imt < 17.0)
                                    Kurus Tingkat Berat
                                @break

                                @case($imt >= 17.0 && $imt <= 18.4)
                                    Kurus Tingkat Ringan
                                @break

                                @case($imt >= 18.5 && $imt <= 24.9)
                                    Normal
                                @break

                                @case($imt >= 25.1 && $imt <= 27.0)
                                    Gemuk Tingkat Ringan (Over Weight)
                                @break

                                @case($imt > 27.0)
                                   <span style="color: red"> Gemuk Tingkat Berat (Obesitas) </span>
                                @break

                                @default
                            @endswitch


                        </td>
                        <td>{{ $item?->rikkes_absensi?->first()?->imt }}</td>
                        <td>{{ $item?->rikkes_absensi?->first()?->keterangan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</body>
<script></script>

</html>
