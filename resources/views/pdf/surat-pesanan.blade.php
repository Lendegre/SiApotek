<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $purchase->no_surat }} | Arfa Farma</title>
</head>
<body>
    <h3 style="text-align: center">SURAT PESANAN</h3>
    <p style="text-align: center">Golongan: {{ $purchase->golongan->jenis_golongan }}</p>
    <hr>

    <p>Yang bertanda tangan di bawah ini:</p>
    <p>Nama : <strong>Irwan Hilmy, S.Farm.,Apt</strong></p>
    <p>Jabatan : <strong>Apoteker</strong></p>
    <p>Nomor SIPA : <strong>32.07/2019/1030.1</strong></p>
    <br>
    <p>Mengajukan pesanan tertentu kepada:</p>
    <p>Nama Distributor : <strong>{{ $purchase->supplier->nama_supplier }}</strong></p>
    <p>Alamat : <strong>{{ $purchase->supplier->alamat }}</strong></p>
    <p>Telp : <strong>{{ $purchase->supplier->no_telp }}</strong></p>
    <br>
    <p>Dengan pesanan tertentu adalah:</p>
    <table border="1" style="width: 100%;">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Pesanan</th>
                <th>Bentuk Kesediaan</th>
                <th>Satuan</th>
                <th>Jumlah</th>
                <th>Stok/Isi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $product->barang->nama_barang }}</td>
                    <td>{{ $product->barang->bentuk->bentuk_barang }}</td>
                    <td>{{ $product->barang->satuan->satuan_barang }}</td>
                    <td>{{ $product->jumlah }}</td>
                    <td>{{ $product->isi }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <p>Pesanan tersebut akan dipergunakan untuk:</p>
    <p>Nama Sarana : <strong>Apotek Arfa Farma</strong></p>
    <table>
        <tr>
            <td style="white-space: nowrap">Alamat Sarana : </td>
            <td><strong>Jalan Raya Sukamantri 1 Rt.01 Rw.01 Desa Sukamantri Kecamatan Sukamantri Kabupaten Ciamis</strong></td>
        </tr>
    </table>
    <p>Surat Izin Apotek : <strong>503.28/146/SIA/DPMPTSP.03/III/2018</strong></p>

</body>
</html>