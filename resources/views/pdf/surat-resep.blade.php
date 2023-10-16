ini surat resep<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title->no_order }} | Arfa Farma</title>
</head>
<body>
    <h3 style="text-align: center">RESEP OBAT</h3>
    <hr>

    <p>Biodata konsumen dengan resep obat:</p>
    <p>Nama Konsumen : <strong>{{ $customer->nama_customer }}</strong></p>
    <p>Usia : <strong>{{ $customer->usia }}</strong></p>
    <table>
        <tr>
            <td style="white-space: nowrap">Alamat : </td>
            <td><strong>{{ $customer->alamat }}</strong></td>
        </tr>
    </table>
    <br>

    <p>Dengan pesanan tertentu adalah:</p>
    <table border="1" style="width: 100%;">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Produk</th>
                <th>Permintaan Stok</th>
                <th>Bentuk Kesediaan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $order->barang->nama_barang }}</td>
                    <td>{{ $order->isi }}</td>
                    <td>{{ $order->barang->bentuk->bentuk_barang }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>