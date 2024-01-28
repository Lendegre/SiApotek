<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <!-- Include Bootstrap CSS (optional, for styling purposes) -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        .grand-total {
            display: flex;
            align-items: center;
            margin-top: 20px;
        }

        .line {
            flex-grow: 1;
            height: 1px;
            background-color: #000;
            margin-left: 100px; /* Adjust the margin as needed */
            width: 100px; /* Adjust the margin as needed */
        }

        .table-cell {
        font-size: 12px;
        padding: 5px; /* Sesuaikan dengan kebutuhan Anda */
        overflow: hidden;
        text-overflow: ellipsis;
        /* white-space: nowrap; */
        }
    </style>
</head>
<body>
    <div id="logo">
       <center><img src="{{ public_path() . '/img/logo.png' }}" style="" width="300" alt="logo farmasi"></center>
    </div>
    <h2 style="text-align: center">LAPORAN PENJUALAN</h2>
    <p style="text-align: center">Periode: ({{ $tanggalAwal }}) - ({{ $tanggalAkhir }})</p>
    <hr class="bg bg-dark">
    <table border="1" style="width: 100%" class="border border-dark">
        <thead>
            <tr>
                <th class="table-cell text-center">No</th>
                <th class="table-cell text-center">Nota Transaksi</th>
                <th class="table-cell text-center">Tanggal</th>
                <th class="table-cell text-center">Nama Pembeli</th>
                <th class="table-cell text-center">Nama Barang</th>
                <th class="table-cell text-center">Harga</th>
                <th class="table-cell text-center">Jumlah</th>
                <th class="table-cell text-center">Total</th>
                <th class="table-cell text-center">Sisa Stok</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sales_report as $sale)
                <tr>
                    <td class="table-cell">{{ $loop->iteration }}</td>
                    <td class="table-cell">{{ $sale->no_order }}</td>
                    <td class="table-cell">{{ $sale->tanggal }}</td>
                    <td class="table-cell">{{ $sale->customer->nama }}</td>
                    <td class="table-cell">{{ $sale->barang->nama_barang }}</td>
                    <td class="table-cell">Rp. {{ $sale->barang->harga_jual }}</td>
                    <td class="table-cell">{{ $sale->stok }} {{ $sale->barang->satuan_jual }}</td>
                    <td class="table-cell">Rp. {{ number_format($sale->stok * $sale->barang->harga_jual, 0, ',', '.') }}</td>
                    <td class="table-cell">{{ $sale->barang->stok }} {{ $sale->barang->satuan_jual }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="container">
        <div class="grand-total float-right">
            <span>Grand Total :</span>
           Rp. <strong>{{ number_format($grandTotal, 2) }}</strong><div class="line"></div>
        </div>
    </div>

</body>
</html>