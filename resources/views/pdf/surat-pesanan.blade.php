<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $purchase->no_surat }} | Arfa Farma</title>
</head>

<style>
    p {
        line-height: 0.5;
    }

    .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        th, td {
            padding: 8px;
            border: 1px solid #000000;
            text-align: center;
        }

        /* Apply striping to even rows */
        th {
            background-color: white;
        }
        
    #table2 {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }
        #th, #td {
            padding: 1px;
            font-weight:normal;
            text-align: left;
            border: 1px solid white;
            background-color: white;
        }
</style>

<body>
    <h3 style="text-align: center">SURAT PESANAN</h3>
    <p style="text-align: center"><strong>Nomor: {{ $purchase->no_surat }}</strong></p>
    <p style="text-align: center">Golongan: {{ $purchase->golongan->jenis_golongan }}</p>
    <hr>
    <p>Yang bertanda tangan dibawah ini :</p>
    <table id="table2" style="margin-top: -10px;">
        <tr>
            <th id="th" style="width: 20%">Nama</th>
            <th id="th">: <strong>Irwan Hilmy, S.Farm.,Apt</strong></th>
        </tr>
        <tr>
            <th id="th" style="width: 20%">Jabatan</th>
            <th id="th">: <strong>Apoteker</strong></th>
        </tr>
        <tr>
            <th id="th" style="width: 20%">Nomor SIPA</th>
            <th id="th">: <strong>32.07/2019/1030.1</strong></th>
        </tr>
    </table>
    <br>
    <p>Mengajukan pesanan tertentu kepada:</p>
    <table id="table2" style="margin-top: -10px;">
        <tr>
            <th id="th" style="width: 20%">Nama Distributor</th>
            <th id="th">: <strong>{{ $purchase->supplier->nama_supplier }}</strong></th>
        </tr>
        <tr>
            <th id="th" style="width: 20%">Alamat</th>
            <th id="th">: <strong>{{ $purchase->supplier->alamat }}</strong></th>
        </tr>
        <tr>
            <th id="th" style="width: 20%">Telp</th>
            <th id="th">: <strong>{{ $purchase->supplier->no_telp }}</strong></th>
        </tr>
    </table>
    <br>
    <p>Dengan pesanan tertentu adalah:</p>
    <table class="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Pesanan</th>
                <th>Zat Aktif {{ $purchase->golongan->jenis_golongan }}</th>
                <th>Jumlah</th> 
                <th>Satuan</th> 
                <th>Bentuk</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $product->barang->nama_barang}}</td>
                    <td>{{ $product->zat }}</td>
                    <td>{{ $product->jumlah }}</td>
                    <td>{{ $product->barang->satuan->satuan_barang }}</td>
                    <td>{{ $product->bentuk }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <p style="margin-top: 30px;">Pesanan tersebut akan dipergunakan untuk:</p>
    <table id="table2" style="margin-top: -10px;">
        <tr>
            <th id="th" style="width: 20%">Nama Sarana</th>
            <th id="th">: <strong>Apotek Arfa Farma</strong></th>
        </tr>
        <tr>
            <th id="th" style="width: 20%">Alamat Sarana</th>
            <th id="th">: <strong>Jalan Raya Sukamantri 1 Rt.01 Rw.01 Desa Sukamantri Kecamatan</strong></th>
        </tr>
        <tr>
            <th id="th" style="width: 20%"></th>
            <th id="th" style="padding-left: 10px"><strong>Sukamantri Kabupaten Ciamis</strong></th>
        </tr>
        <tr>
            <th id="th" style="width: 20%">Surat Izin Apotek</th>
            <th id="th">: <strong>503.28/146/SIA/DPMPTSP.03/III/2018</strong></th>
        </tr>
    </table>
</body>
</html>