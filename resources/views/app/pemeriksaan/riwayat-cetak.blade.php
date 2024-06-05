<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klinik Punai Merindu</title>
    <style>
      @page { margin: 0; }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            box-sizing: border-box;
        }

        .header {
            text-align: center;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .header p {
            margin: 5px 0;
            font-size: 14px;
        }

        .info {
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .info div {
            width: 48%;
            margin-bottom: 10px;
        }

        .info label {
            font-weight: bold;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table,
        .table th,
        .table td {
            border: 1px solid black;
        }

        .table th,
        .table td {
            padding: 10px;
            text-align: left;
        }

        .table th {
            background-color: #f2f2f2;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
        }

        hr.double-line {
            border: none;
            border-top-style: double;
            border-top-width: 5px;
            border-top-color: black;
            margin: 20px 0;
        }
    </style>
</head>

<body onload="window.print()">
    <div class="container">
        <div class="header">
            <h1>Klinik Punai Merindu</h1>
            {{-- <p>Jl. Jend. Sudirman No.45, Tambak Sari, Kec. Jambi Sel., Kota Jambi</p> --}}
            <p>Telp: xxxx</p>
        </div>
        <hr class="double-line">
        <div class="info">
            <div>
                <label>Nomor Pemeriksaan: </label> {{ $data->nomor_pemeriksaan }}
            </div>
            <div>
                <label>Waktu Pemeriksaan: </label> {{ $data?->toArray()['created_at'] }}
            </div>
            <div>
                <label>No. RM: </label> {{ $data?->pasien?->kode_rm }}
            </div>
            <div>
                <label>Nama Pasien: </label> {{ $data?->pasien?->nama }}
            </div>
            <div>
                <label>Tgl Lahir: </label> {{ $data?->pasien->toArray()['tgl_lahir'] }}
            </div>
            <div>
                <label>Alamat: </label> {{ $data?->pasien?->alamat }}
            </div>
            <div>
                <label>Berat Badan: </label> {{ $data?->berat_badan }} Kg
            </div>

            <div>
                <label>Dokter: </label> {{ $data?->dokter?->nama }}
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Tindakan</th>
                    <th>Keluhan</th>
                    <th>Diagnosa</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $data->tindakan_array_format }}</td>
                    <td>{{ $data->keluhan }}</td>
                    <td>{{ $data->diagnosis }}</td>
                </tr>
            </tbody>
        </table>

        @if ($data?->status_pemeriksaan == 'rujukan')
            <h5>Rujukan</h5>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nomor Rujukan</th>
                        <th>Keterangan</th>
                        <th>klinik/Rumah Sakit</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $data->rujukan_no }}</td>
                        <td>{{ $data?->rujukan_ket }}</td>
                        <td>{{ $data?->rujukan_tujuan }} </td>
                    </tr>
                </tbody>
            </table>
        @endif

        <h5>Resep Obat:</h5>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Jenis Obat</th>
                    <th>Jumlah</th>
                    <th>Dosis</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data?->pemeriksaan_obat as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->obat->nama }}</td>
                        <td>{{ $item?->jumlah }}</td>
                        <td>{{ $item?->dosis_perhari }} X Sehari</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <h5>Catatan Tambahan :</h5>
        <p style="font-style: italic"> {{ $data?->catatan }}</p>
    </div>
</body>

</html>
