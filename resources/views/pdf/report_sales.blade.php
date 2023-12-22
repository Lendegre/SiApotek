<!DOCTYPE html>
<html>
<head>
    <title>Sales Report</title>
</head>
<body>
    <div id="logo">
       <center><img src="{{ public_path() . '/img/logo.png' }}" style="" width="300" alt="logo farmasi"></center>
    </div>
    <h2 style="text-align: center">LAPORAN PENJUALAN</h2>
    <p style="text-align: center">Periode: {{ $tanggalAwal }} to {{ $tanggalAkhir }}</p>
    <hr>
    <br>
    <table border="1" style="width: 100%">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Sisa Stok</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sales as $sale)
                <tr>
                    <td style="text-align: center">{{ $sale->tanggal }}</td>
                    <td style="text-align: center">{{ $sale->barang->nama_barang }}</td>
                    <td style="text-align: center">{{ $sale->isi }}</td>
                    <td style="text-align: center">{{ $sale->barang->isi }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>