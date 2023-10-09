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
                    <div class="col-12">
                        <label for="barang_id">Barang</label>
                        <select class="form-control" name="barang_id" required id="barang_id">
                            <option value="">-Pilih Barang-</option>
                            @foreach ($barang as $item)
                            <option value="{{ $item->barang_id }}">{{ $item->nama_barang }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-3">
                            <label for="jumlah">Jumlah</label>
                            <input required type="number" name="jumlah" id="jumlah" placeholder="Masukkan jumlah pesanan" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="satuan_id">Satuan</label>
                            <select name="satuan_id" class="form-control" id="satuan_id">
                                <option value="">-Pilih Satuan-</option>
                                @foreach ($satuan as $item)
                                <option value="{{ $item->satuan_id }}">{{ $item->satuan_barang }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="isi">Isi/Stok</label>
                            <input required type="number" name="isi" id="isi" placeholder="Masukkan stok pesanan" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="bentuk_id">Bentuk Sediaan</label>
                            <select name="bentuk_id" class="form-control" id="bentuk_id">
                                <option value="">-Pilih Bentuk Sediaan-</option>                                
                                @foreach ($bentuk as $item)
                                <option value="{{ $item->bentuk_id }}">{{ $item->bentuk_barang }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <button type="submit" class="mt-4 btn btn-primary">
                        Tambah Pesanan
                    </button>
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
                                <td>{{ $item->jumlah . ' ' . $item->satuan->satuan_barang}} </td>
                                <td>{{ $item->isi . ' ' . $item->bentuk->bentuk_barang }}</td>
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
                                                        <label for="jumlah">Jumlah</label>
                                                        <input required type="number" value="{{ $item->jumlah }}" name="jumlah" id="jumlah" placeholder="Masukkan jumlah pesanan" class="form-control">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="satuan_id">Satuan</label>
                                                        <select name="satuan_id" class="form-control" id="satuan_id">
                                                            <option value="{{ $item->satuan_id }}">{{ $item->satuan->satuan_barang }}</option>
                                                            @foreach ($satuan as $satuanItem)
                                                            <option value="{{ $satuanItem->satuan_id }}">{{ $satuanItem->satuan_barang }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="isi">Isi/Stok</label>
                                                        <input required type="number" name="isi" value="{{ $item->isi }}" id="isi" placeholder="Masukkan stok pesanan" class="form-control">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="bentuk_id">Bentuk Sediaan</label>
                                                        <select name="bentuk_id" class="form-control" id="bentuk_id">
                                                            <option value="{{ $item->bentuk_id }}">{{$item->bentuk->bentuk_barang}}</option>                                
                                                            @foreach ($bentuk as $bentukItem)
                                                            <option value="{{ $bentukItem->bentuk_id }}">{{ $bentukItem->bentuk_barang }}</option>
                                                            @endforeach
                                                        </select>
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
        </div>
    </div>
</div>


@endsection