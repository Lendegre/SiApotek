<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        .center-line {
          border-left: 2.5cm solid black; /* Garis sebelah kiri dengan panjang 3 cm dan warna hitam (sesuaikan sesuai keinginan Anda) */
          height: 0.1%; /* Atur tinggi elemen sesuai keinginan Anda */
          margin-left: 20px;
        }
      </style>
    <title>{{ $title->no_order }} | Resep | Arfa Farma</title>
</head>
<body>
    <style>
    table {
    width: 100%; /* Lebar tabel 100% dari container */
  }

    #header {
      padding: 10px;
      text-align: center;
    }

    #logo {
      float: left;
      height: auto; /* Untuk menjaga aspek rasio logo */
      margin-right: 20px; /* Jarak antara logo dan teks */
    }

    #paragraph-container {
      text-align: center; /* Mengatur rata kanan dan kiri */
      margin: 20px;
    }

    #paragraph-container2 {
      text-align: center; /* Mengatur rata kanan dan kiri */
      margin: 10px;
    }

    .signature {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            margin-top: 20px; /* Adjust this value to set the distance from the bottom */
    }
      </style>
      <body>
      <table style="width:90%">
        <tr>
          <th>
            <div id="header">
                    <div id="logo">
                        <img src="{{ public_path() . '/img/logo.png' }}" width="300" alt="logo farmasi"> 
                    </div>
                    {{-- <h3 style="float: left"><b>APOTEK ARFA FARMA</b></h3> --}}
                    <br>
                    <br>
                    <br>
                    <div id="paragraph-container">
                        <p>JALAN RAYA SUKAMANTRI 1 RT.01 RW.01
                            <br> 
                            DESA SUKAMANTRI
                            <br>
                            NO. HP. 0852-9459-5949 / 0856-2447-0315
                        </p>
                    </div>
                </div>
            </th>
          <th>
            <div id="paragraph-container2">
            <p style="margin-top: 50px">No Invoice  : <strong>{{ $title->no_order }}</strong></p>
            <br>
            <p style="margin-bottom: 28px">Kepada Tuan/Ny : 
            <br>
            {{ $customer->nama }}</p>
            </div>
        </th>
      </table>
      <hr>
  

    {{-- <p>Biodata konsumen dengan resep obat:</p>
    <p>Konsumen  : <strong>{{ $customer->nama_customer }}</strong></p>
    <p>Usia : <strong>{{ $customer->usia }}</strong></p>
    <table>
        <tr>
            <td style="white-space: nowrap">Alamat : </td>
            <td><strong>{{ $customer->alamat }}</strong></td>
        </tr>
    </table> --}}
    {{-- <p>Dengan pesanan tertentu adalah:</p> --}}
    <br>
    <table border="1" style="width: 100%; border: 1px solid #000">
        <thead>
            <tr>
                <th>
                    Banyak
                    <br>
                    nya
                </th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td style="text-align: center">{{ $order->stok }} {{ $order->barang->satuan_jual }}</td>
                    <td style="text-align: center">{{ $order->barang->nama_barang }}</td>
                    <td style="text-align: center">Rp. {{ $order->barang->harga_jual }}</td>
                    <td style="text-align: center">Rp. {{ $order->harga }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <br>
    <br>
    <div class="signature">
      <table style="width: 100% border-collapse: collapse">
        <th>
            <p>Hormat Kami</p>
            <div id="ttd">
              <img src="{{ public_path() . '/img/ttd.png' }}" width="45" alt="logo farmasi"> 
            </div>
            <div class="center-line"></div>
            <p style="font-size: 10pt; margin-top: -20px;">Irwan Hilmy. S.Farm.,Apt</p>
        </th>
        <th>
            <p>Tanda Terima</p>
            <br>
            <br>
            <br>
            <div class="center-line"></div>
        </th>
        <th>
            <p style="padding-left: 150px">Sub Total</p>
            <br>
            <br>
        </th>
        <th>
            <br>
            Rp. {{ $total_harga }}
            <div class="center-line"></div>
        </th>
    </table>
    </div>
</body>
</html>