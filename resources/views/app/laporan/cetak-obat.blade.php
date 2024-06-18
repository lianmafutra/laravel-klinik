<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Laporan Obat</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>

<body onload="window.print()">
    <div class="container mt-4">
      <h4 class="alert alert-success">Laporan Data Obat</h4>
      <table style="margin-bottom: 10px">
          <tr>
              <th>Deskripsi</th>
              <td class="ml-2 mr-2"> : </td>
              <td> {{ $deskripsi }}</td>
          </tr>
          <tr>
             <th>Tanggal </th>
             <td class="ml-2 mr-2"> : </td>
             <td> {{ $start_date }} - {{ $end_date }}</td>
         </tr>
      </table>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Sisa Stok</th>
                    <th>Tgl Expired</th>
            </thead>
            <tbody>


                @foreach ($obat as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item?->nama }}</td>
                        <td>{{ $item?->harga }}</td>
                        <td>{{ $item?->stok }}</td>
                        <td>{{ $item?->toArray()['tgl_expired'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</body>
<script></script>

</html>
