@extends('layouts.app')

@section('content-app')
<hr>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-secondary text-light">
                Total: Rp. {{ number_format($total_harga, 0, ',', '.') }}
            </div>
            <div class="card-body">
                <div style="border: 1px solid gray; padding: 8px;">
                    <p class="mb-0">Nama: <strong>{{ $customer->nama }}</strong></p>
                    <p class="mb-0">Jenis Obat: <strong>{{ $customer->jenis_obat }}</strong></p>
                    <p class="mb-0">Golongan: <strong>{{ $customer->golongan->jenis_golongan }}</strong></p>
                    <p class="mb-0">Tanggal: <strong>{{ $products[0]->tanggal }}</strong></p>
                    @if ($customer->status == 'Dibayar')
                        @if($customer->jenis_obat == 'Resep') <form action="{{ route('surat-resep', $customer->customer_id) }}" method="POST"> @endif
                        @if($customer->jenis_obat == 'Non-Resep') <form action="{{ route('surat-nonresep', $customer->customer_id) }}" method="POST"> @endif
                            @csrf
                            <button formtarget="_blank" type="submit" class="btn btn-secondary my-2">Cetak Nota Penjualan</button>
                        </form>
                    @endif
                </div>

                <div class="row table-responsive mt-4">
                    <table class="table" id="data">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                                <th>Harga (satuan jual * harga jual)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $item)
                            <tr>
                                <td>{{ $loop->iteration . '.' }}</td>
                                <td>{{ $item->barang->nama_barang }}</td>
                                <td>{{ $item->isi . ' ' . $item->barang->bentuk->bentuk_barang }}</td>
                                <td>Rp. {{ number_format($item->isi * $item->barang->harga_jual, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <button onclick="history.back()" class="btn card-footer text-light rounded" style="background: #181818"><strong>Kembali</strong></button>
        </div>
    </div>
</div>
@endsection