@extends('layouts.app')

@section('content-app')

<a href="{{ route('purchase-report') }}" class="btn btn-dark">Purchase Report</a>


<div class="row mt-3">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4><strong>{{ $purchase->supplier->nama_supplier }}</strong></h4>
                <hr>

                <form action="{{ route('create-purchase-product') }}" method="POST">
                    @csrf
                    <input type="hidden" name="purchase_id" value="{{ $purchase->purchase_id }}">

                    <div class="row align-items-end">
                        <div class="col-10">
                            <label for="barang_id">Barang</label>
                            <select class="form-control" name="barang_id" required id="barang_id">
                                <option value="">-Pilih Barang-</option>
                                @foreach ($barang as $item)
                                    <option @if(old('barang_id') == $item->barang_id) selected @endif value="{{ $item->barang_id }}">{{ $item->nama_barang }}</option>
                                @endforeach
                            </select>
                        </div>
                    

                        <div class="col-2">
                        @if (session()->has('dataSelected'))
                            <a href="javascript:window.location.reload(true)" class="btn btn-secondary">Cancel</a>    
                        @else
                            <button name="getProduct" type="submit" class="btn btn-primary">Get Product</button>
                        @endif
                        </div>
                    </div>

                    @if (session()->has('dataSelected'))
                        <div class="row mt-3">
                            <div class="col-md-3">
                                <label for="jumlah">Jumlah</label>
                                <input required type="number" name="jumlah" id="jumlah" placeholder="Masukkan jumlah pesanan" class="form-control border border-success">
                            </div>
                            <div class="col-md-3">
                                <label for="jumlah">Satuan</label>
                                <input disabled value="{{ session('dataSelected')->satuan->satuan_barang }}" placeholder="Satuan Jumlah" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label for="isi">Isi/Stok</label>
                                <input required type="number" name="isi" id="isi" placeholder="Masukkan stok pesanan" class="form-control border border-success">
                            </div>
                            <div class="col-md-3">
                                <label for="isi">Bentuk Sediaan</label>
                                <input disabled value="{{ session('dataSelected')->bentuk->bentuk_barang }}" placeholder="Brntuk sediaan stok" class="form-control">
                            </div>
                        </div>
                        
                        <button name="tambahPesanan" type="submit" class="mt-4 btn btn-primary">
                            Tambah Pesanan
                        </button>
                    @endif
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
                    <h5><strong>Item List:</strong></h5>
                    <a href="{{ route('detail-purchase', $purchase->purchase_id) }}">
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
                            <th>Isi/Stok</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $item)
                            <tr>
                                <td>{{ $loop->iteration . '.' }}</td>
                                <td>{{ $item->barang->nama_barang }}</td>
                                <td>{{ $item->jumlah . ' ' . $item->barang->satuan->satuan_barang }} </td>
                                <td>{{ $item->isi . ' ' . $item->barang->bentuk->bentuk_barang }}</td>
                                <td>
                                    <button class="btn btn-info modal-open" data-modal="{{ 'update'.$item->purchase_product_id }}"><i data-feather="edit"></i></button>
                                    <button class="btn btn-danger modal-open" data-modal="{{ 'delete'.$item->purchase_product_id }}"><i data-feather="trash"></i></button>
                                
                                    <div id="{{ 'update'.$item->purchase_product_id }}" class="modal">
                                        <div class="modal-content">
                                            <span class="close" data-modal="{{ 'update'.$item->purchase_product_id }}">&times;</span>
                                            <h3>Update Item?</h3>
                                            <hr>
                                            <form action="{{ route('update-purchase-product', $item->purchase_product_id) }}" method="POST">
                                                @csrf
                                                <div class="row" style="row-gap: 15px;">
                                                    <div class="col-md-6">
                                                        <label for="jumlah">Jumlah ({{ $item->barang->satuan->satuan_barang }})</label>
                                                        <input required type="number" value="{{ $item->jumlah }}" name="jumlah" id="jumlah" placeholder="Masukkan jumlah pesanan" class="form-control">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="isi">Isi/Stok ({{ $item->barang->bentuk->bentuk_barang }})</label>
                                                        <input required type="number" name="isi" value="{{ $item->isi }}" id="isi" placeholder="Masukkan stok pesanan" class="form-control">
                                                    </div>
                                                </div>
                                                
                                                <div class="mt-3">
                                                    <button type="submit" class="btn btn-info">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <div id="{{ 'delete'.$item->purchase_product_id }}" class="modal">
                                        <div class="modal-content">
                                            <span class="close" data-modal="{{ 'delete'.$item->purchase_product_id }}">&times;</span>
                                            <h3>Apakah anda yakin?</h3>
                                            <hr>
                                            <form action="{{ route('delete-purchase-product', $item->purchase_product_id) }}" method="POST">
                                                @csrf
                                                <p>Yakin untuk menghapus item <strong>{{ $item->barang->nama_barang }}</strong></p>
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
        </div>
    </div>
</div>


@endsection