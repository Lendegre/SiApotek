<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pembelian</title>
    <!-- Include Bootstrap CSS (optional, for styling purposes) -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        .grand-total {
            display: flex;
            align-items: center;
        }

        .line {
            flex-grow: 1;
            height: 1px;
            background-color: #000;
            margin-left: 110px; /* Adjust the margin as needed */
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
    <h2 style="text-align: center">LAPORAN PEMBELIAN</h2>
    <p style="text-align: center">Periode: ({{ $tanggalAwal }}) - ({{ $tanggalAkhir }})</p>
    <hr class="bg bg-dark">
    <table border="1" style="width: 100%" class="border border-dark">
        <thead>
            <tr>
                <th class="table-cell text-center">No</th>
                <th class="table-cell text-center">No faktur</th>
                <th class="table-cell text-center">Tanggal</th>
                <th class="table-cell text-center">Supplier</th>
                <th class="table-cell text-center">Nama Barang</th>
                <th class="table-cell text-center">Harga</th>
                <th class="table-cell text-center">Jumlah</th>
                <th class="table-cell text-center">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($barangmasuk as $bm)
                <tr>
                    <td class="table-cell">{{ $loop->iteration }}</td>
                    <td class="table-cell">{{ $bm->no_faktur }}</td>
                    <td class="table-cell">{{ $bm->tgl_trm }}</td>
                    <td class="table-cell">{{ $bm->purchase->supplier->nama_supplier }}</td>
                    <td class="table-cell">{{ $bm->nama_brg }}</td>
                    <td class="table-cell">{{ $bm->h_beli }}</td>
                    <td class="table-cell">{{ $bm->jumlah_trm }}</td>
                    <td class="table-cell">{{ $bm->total }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="container">
        <div class="grand-total float-right mt-5">
            <span>Grand Total :</span>
           Rp. <strong>{{ number_format($grandTotal, 2) }}</strong><div class="line"></div>
        </div>
    </div>

</body>
</html>