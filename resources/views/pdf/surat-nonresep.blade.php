<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        .center-line {
          border-left: 3cm solid black; /* Garis sebelah kiri dengan panjang 3 cm dan warna hitam (sesuaikan sesuai keinginan Anda) */
          height: 2.5px; /* Atur tinggi elemen sesuai keinginan Anda */
          margin-left: 20px;
        }
      </style>
    <title>{{ $title->no_order }} | Resep | Arfa Farma</title>
</head>
<body>
    <style>
    table {
    width: 100%; /* Lebar tabel 100% dari container */
    border-collapse: collapse;
    margin-bottom: 10px;
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
      margin: 30px;
    }

    #paragraph-container2 {
      text-align: center; /* Mengatur rata kanan dan kiri */
      margin: 10px;
    }

      </style>
      <body>
      <table style="width:90%">
        <tr>
          <th>
            <div id="header">
                    <div id="logo">
                        <img src="{{ public_path() . '/img/logo.png' }}" width="350" alt="logo farmasi"> 
                    </div>
                    {{-- <h3 style="float: left"><b>APOTEK ARFA FARMA</b></h3> --}}
                    <br>
                    <br>
                    <br>
                    <div id="paragraph-container">
                        <h4>JALAN RAYA SUKAMANTRI 1 RT.01 RW.01
                            <br> 
                            DESA SUKAMANTRI
                            <br>
                            NO. HP. 0852-9459-5949 / 0856-2447-0315
                        </h4>
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
      <hr style="margin-top: -30px;">
    <br>
    <table border="1" style="width: 100%; border: 1px solid black; margin-top: -10px;">
        <thead>
            <tr>
                <th style="padding: 10px;">Banyaknya</th>
                <th style="padding: 10px;">Nama Produk</th>
                <th style="padding: 10px;">Harga</th>
                <th style="padding: 10px;">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td style="text-align: center; padding: 5px;">{{ $order->stok }} {{ $order->barang->satuan_jual }}</td>
                    <td style="text-align: center; padding: 5px;">{{ $order->barang->nama_barang }}</td>
                    <td style="text-align: center; padding: 5px;">Rp. {{ $order->barang->harga_jual }}</td>
                    <td style="text-align: center; padding: 5px;">Rp. {{ $order->harga }}</td>
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
            <p style="font-size: 10pt; margin-top: 5px;">Irwan Hilmy. S.Farm.,Apt</p>
        </th>
        <th>
            <p>Tanda Terima</p>
            <br>
            <br>
            <br>
            <div class="center-line"></div>
        </th>
        <th>
            <p style="padding-left: 150px; margin-top: 20px;">Sub Total</p>
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