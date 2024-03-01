@extends('layouts.app')

@section('content-app')
<hr>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div style="border: 1px solid navy; padding: 8px;">
                    <p>No. Surat: <strong>{{ $purchase->no_surat }}</strong></p>
                    <p>Tanggal Pemesanan: <strong>{{ $purchase->tgl_pengajuan }}</strong></p>
                    <p>Status: <strong>{{ $purchase->status }}</strong></p>
                    <p>Supplier: <strong>{{ $purchase->supplier->nama_supplier }}</strong></p>
                    <p>Golongan: <strong>{{ $purchase->golongan->jenis_golongan }}</strong></p>
                    <p>Keterangan: <strong>{{ $purchase->keterangan }}</strong></p>
                    
                    @if ($purchase->status == 'Diterima')
                        
                    <form action="{{ route('surat-pesanan', $purchase->purchase_id) }}" method="POST" class="mt-3">  
                        @csrf
                        <button formtarget="_blank" type="submit" class="btn btn-danger">Download PDF <i data-feather="file-text"></i></button>
                    </form>

                    @endif
                </div>

                <div class="row table-responsive mt-4">
                    <table class="table text-center" id="data">
                        <thead>
                            <tr>
                                <th class="text-center">No.</th>
                                <th class="text-center">Nama Barang</th>
                                <th class="text-center">Jumlah</th>
                                <th class="text-center">Bentuk</th>
                                <th class="text-center">Isi Dalam Kemasan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $item)
                            <tr>
                                <td>{{ $loop->iteration . '.' }}</td>
                                <td>{{ $item->barang->nama_barang }}</td>
                                <td>{{ $item->jumlah . ' ' . $item->barang->satuan->satuan_barang }} </td>
                                <td>{{ $item->barang->bentuk->nama_bentuk }}</td>
                                <td>{{ $item->isi}} {{ $item->barang->satuan_jual }} / {{ $item->barang->satuan->satuan_barang }}</td>
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