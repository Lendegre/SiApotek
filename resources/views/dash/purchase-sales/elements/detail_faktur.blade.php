@extends('layouts.app')

@section('content-app')
<hr>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div style="border: 1px solid black; padding: 8px;" class="rounded-3">
                    <p class="mb-0">No. Surat: <strong>{{ $barang_msk[0]->purchase->no_surat }}</strong></p>
                    <p class="mb-0">Tanggal Terima: <strong>{{ $barang_msk[0]->tgl_trm }}</strong></p>
                    <p class="mb-0">Tanggal Pelunasan: <strong>{{ $barang_msk[0]->tgl_tempo }}</strong></p>
                    <p class="mb-0">Status Bayar: <strong>{{ $barang_msk[0]->sbayar }}</strong></p>
                    <p class="mb-0">Supplier: <strong>{{ $barang_msk[0]->purchase->supplier->nama_supplier }}</strong></p>
                </div>

                <div class="row table-responsive mt-4">
                    <table class="table" id="data">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Barang</th>
                                {{-- <th>Jumlah Pesanan</th> --}}
                                <th>Jumlah Terima</th>
                                <th>Harga Beli</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($barang_msk as $b_msk)
                            <tr>
                                <td>{{ $loop->iteration . '.' }}</td>
                                <td>{{ $b_msk->barang->nama_barang }}</td>
                                {{-- <td>{{ $b_msk->purchase->purchaseproduct->jumlah }}</td> --}}
                                <td>{{ $b_msk->jumlah_trm }} </td>
                                <td>Rp. {{ $b_msk->h_beli }} </td>
                                <td>Rp. {{ $b_msk->total }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="col-md-4 my-3">
                      <strong> Grand Total: <input readonly type="text" class="border border-dark rounded-2" value=" Rp. {{ $b_msk->g_total }}"></strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<button class="btn btn-dark" onclick="history.back()"><- Kembali</button>
{{-- <a href="{{ route('detail-faktur', $bm->purchase_id) }}" class="btn btn-warning"><i data-feather="eye"></i></a> --}}
@endsection