<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pembelian</title>
    <!-- Include Bootstrap CSS (optional, for styling purposes) -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        .center-line {
          border-left: 3cm solid black; /* Garis sebelah kiri dengan panjang 3 cm dan warna hitam (sesuaikan sesuai keinginan Anda) */
          height: 1px; /* Atur tinggi elemen sesuai keinginan Anda */
          margin-left: 20px;
        }
        .grand-total {
            display: flex;
            align-items: center;
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

        .signature {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            margin-top: 20px; /* Adjust this value to set the distance from the bottom */
        }

        /* .container {
            width: 100%;
        } */

    </style>
</head>
<body>
    <div id="logo">
       <center><img src="{{ public_path() . '/img/logo.png' }}" style="" width="300" alt="logo farmasi"></center>
    </div>
    <h3 style="text-align: center; margin-top: 10px;">LAPORAN BARANG HAMPIR HABIS</h3>
    <p style="text-align: center">Periode : {{ $periode }}</p>
    <hr class="bg bg-dark">
    <table border="1" style="width: 100%" class="border border-dark">
        <thead>
            <tr>
                <th class="table-cell text-center">No</th>
                <th class="table-cell text-center">Nama Barang</th>
                <th class="table-cell text-center">Stok saat ini</th>
                <th class="table-cell text-center">Minimal Stok</th>s
            </tr>
        </thead>
        <tbody>
            @foreach($barang as $sb)
                <tr style="margin: 10px;">
                    <td class="table-cell text-center">{{ $loop->iteration }}</td>
                    <td class="table-cell text-center">{{ $sb->nama_barang }}</td>
                    <td class="table-cell text-center">{{ $sb->stok }} {{ $sb->satuan_jual }}</td>
                    <td class="table-cell text-center">{{ $sb->minimal_stok }} {{ $sb->satuan_jual }}</td>
                </tr>
                @endforeach
        </tbody>
    </table>

    {{-- <table border="1" style="width: 68%; margin-top:15px;" class="border border-dark">
        <thead>
            <tr>
                <td class="table-cell" style="width: 45%;"><strong>TOTAL KESELURUHAN</strong></td>
                <td class="table-cell text-center" style="width: 25%;">{{ $barang->sum('stok') }} Stok</td>
            </tr>
        </thead>
    </table> --}}

    <div class="signature">
        <table style="width: 100% border-collapse: collapse; margin-top: 100px">
            <th>
                <p style="font-weight: normal; text-align: center;">Mengetahui</p>
                <br>
                <br>
                <div class="center-line"></div>
                <p style="font-size: 10pt"><strong>Irwan Hilmy, S.Farm.Apt</strong></p>
            </th>
        </table>
    </div>

</body>
</html>