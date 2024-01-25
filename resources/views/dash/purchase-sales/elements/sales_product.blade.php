@extends('layouts.app')

@section('content-app')
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4><strong>{{ $customer->jenis_obat }}</strong></h4>
                    <hr>
                    <form class="row" action="{{ route('create-order-item') }}" method="POST">
                        @csrf
                        <input type="hidden" name="customer_id" value="{{ $customer->customer_id }}">
                        <div class="row">
                            <div class="mb-3 col-md-3">
                                <label for="tanggal">Tanggal</label>
                                <input type="text" readonly class="form-control bg bg-secondary text-light" name="tanggal" id="tanggal" value="{{ date('Y/m/d', strtotime('now')) }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="barang_id">Barang</label>
                            <select class="form-control" name="barang_id" required id="barang_id">
                                <option value="">-Pilih Barang-</option>
                                @foreach ($barang as $item)
                                <option value="{{ $item->barang_id }}">{{ $item->nama_barang }} (stok: {{ $item->stok }} {{ $item->satuan_jual }})</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="col-md-6">
                            <label for="stok">Jumlah</label>
                            <input required type="number" name="stok" id="stok" placeholder="Masukkan jumlah" class="form-control">
                        </div>
                        
                        <div class="col-12">    
                            <button type="submit" class="mt-4 btn btn-primary" style="width: 100%;">
                                Tambah Pesanan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5><strong>Daftar Barang:</strong></h5>
                        <a href="{{ route('detail-order', $customer->customer_id) }}">
                            <u>Detail Pemesanan</u>
                        </a>
                    </div>
                    <hr>
                    <table class="table" id="data">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                                <th>Harga (satuan jual * harga jual)</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $item)
                                <tr>
                                    <td>{{ $loop->iteration . '.' }}</td>
                                    <td>{{ $item->barang->nama_barang }}</td>
                                    <td>{{ $item->stok . ' ' . $item->barang->satuan_jual }}</td>
                                    <td>Rp. {{ number_format($item->harga) }}</td>
                                    <td>
                                        <button class="btn btn-info modal-open" data-modal="{{ 'update'.$item->order_id }}"><i data-feather="edit"></i></button>
                                        <button class="btn btn-danger modal-open" data-modal="{{ 'delete'.$item->order_id }}"><i data-feather="trash"></i></button>
                                    
                                        <div id="{{ 'update'.$item->order_id }}" class="modal">
                                            <div class="modal-content">
                                                <span class="close" data-modal="{{ 'update'.$item->order_id }}">&times;</span>
                                                <h3>Update Item</h3>
                                                <hr>
                                                <form action="{{ route('update-order-item', $item->order_id) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" value="{{ $item->barang->barang_id }}" name="barang_id">
                                                    <div class="row" style="row-gap: 15px;">
                                                        <div class="col-md-12">
                                                            <label for="stok">Jumlah ({{ $item->barang->satuan_jual }})</label>
                                                            <input required type="number" name="stok" value="{{ $item->stok }}" id="stok" placeholder="Masukkan stok pesanan" class="form-control">
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="mt-3">
                                                        <button type="submit" class="btn btn-info">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
    
                                        <div id="{{ 'delete'.$item->order_id }}" class="modal">
                                            <div class="modal-content">
                                                <span class="close" data-modal="{{ 'delete'.$item->order_id }}">&times;</span>
                                                <h3>Apakah anda yakin?</h3>
                                                <hr>
                                                <form action="{{ route('delete-order-item', $item->order_id) }}" method="POST">
                                                    @csrf
                                                    <p>Yakin untuk menghapus barang <strong>{{ $item->barang->nama_barang }}</strong></p>
                                                    <div class="mt-3">
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if (!$products->isEmpty())
                    
                <div class="card-footer">
                    <form action="{{ route('finish', $customer->customer_id) }}" method="POST">
                        @csrf
                        @foreach ($products as $item)
                            <input type="hidden" value="{{ $item->stok }}" name="stok{{ $item->order_id }}" id="stok">
                        @endforeach
                        <button type="submit" class="btn btn-success">Selesaikan Pembayaran</button>
                        <a href="{{ route('sales-report') }}" class="btn btn-dark">Laporan Penjualan</a>
                    </form>
                </div>

                @endif
            </div>
        </div>
    </div>
@endsection