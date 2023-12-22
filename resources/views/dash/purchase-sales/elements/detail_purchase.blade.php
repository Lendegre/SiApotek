@extends('layouts.app')

@section('content-app')
<hr>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div style="border: 1px solid navy; padding: 8px;">
                    <p class="mb-0">No. Surat: <strong>{{ $purchase->no_surat }}</strong></p>
                    <p class="mb-0">Tanggal Pemesanan: <strong>{{ $purchase->tgl_pengajuan }}</strong></p>
                    <p class="mb-0">Status: <strong>{{ $purchase->status }}</strong></p>
                    <p class="mb-0">Supplier: <strong>{{ $purchase->supplier->nama_supplier }}</strong></p>
                    <p>Golongan: <strong>{{ $purchase->golongan->jenis_golongan }}</strong></p>
                    
                    @if ($purchase->status == 'Diterima')
                        
                    <form action="{{ route('surat-pesanan', $purchase->purchase_id) }}" method="POST" class="mt-3">  
                        @csrf
                        <button formtarget="_blank" type="submit" class="btn btn-danger">Download PDF <i data-feather="file-text"></i></button>
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
                                <th>Bentuk</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $item)
                            <tr>
                                <td>{{ $loop->iteration . '.' }}</td>
                                <td>{{ $item->nama_brg }}</td>
                                <td>{{ $item->jumlah . ' ' . $item->satuan->satuan_barang }} </td>
                                <td>{{ $item->bentuk }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<button class="btn btn-dark" onclick="history.back()"><- Kembali</button>
@endsection