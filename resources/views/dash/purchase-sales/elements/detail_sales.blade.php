@extends('layouts.app')

@section('content-app')
<button class="btn btn-dark" onclick="history.back()"><- Kembali</button>
<hr>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div style="border: 1px solid green; padding: 8px;">
                    <p class="mb-0">Nama Konsumen: <strong>{{ $customer->nama_customer }}</strong></p>
                    <p class="mb-0">Usia: <strong>{{ $customer->usia }}</strong></p>
                    <p class="mb-0">Jenis: <strong>{{ $customer->jenis_obat }}</strong></p>
                    @if ($customer->jenis_obat == 'Resep')
                        @if ($customer->status == 'Dibayar')
                        <form action="{{ route('surat-resep', $customer->customer_id) }}" method="POST">
                            @csrf
                            <button formtarget="_blank" type="submit" class="btn btn-secondary my-2">Resep Obat</button>
                        </form>
                        @endif
                    @endif
                </div>

                <div class="row table-responsive mt-4">
                    <table class="table" id="data">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Barang</th>
                                <th>Permintaan Stok</th>
                                <th>Harga (isi * harga jual)</th>
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
            <div class="card-footer bg-secondary text-light">
                Total: Rp. {{ number_format($total_harga, 0, ',', '.') }}
            </div>
        </div>
    </div>
</div>
@endsection