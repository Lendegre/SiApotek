@extends('layouts.app')

@section('content-app')
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
                            <div class="col-6">
                                <label for="nama_brg">Barang</label>
                                <input class="form-control" placeholder="Nama Barang" type="string" name="nama_brg"
                                    id="nama_brg" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-3">
                                <label for="jumlah">Jumlah</label>
                                <input required type="number" name="jumlah" id="jumlah"
                                    placeholder="Masukkan jumlah pesanan" class="form-control border border-success">
                            </div>
                            <div class="col-md-3">
                                <label for="satuan_id">Satuan Barang</label>
                                <select class="form-select" name="satuan_id" required id="satuan_id">
                                    <option value="">-Pilih Satuan Barang-</option>
                                    @foreach ($satuan as $satuan)
                                        <option value="{{ $satuan->satuan_id }}">{{ $satuan->satuan_barang }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="bentuk">Bentuk Sediaan</label>
                                <input required type="string" name="bentuk" id="bentuk"
                                    placeholder="Bentuk sediaan barang" class="form-control">
                            </div>
                            <div class="col-md-3" id="formZat">
                                <label for="zat">Zat Aktif (Opsional)</label>
                                <input type="string" name="zat" id="zat" placeholder="Zat Aktif"
                                    class="form-control">
                            </div>
                        </div>

                        <button name="tambahPesanan" type="submit" class="mt-4 btn btn-primary">
                            Tambah Pesanan
                        </button>
                        {{-- @endif --}}
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
                        <h5><strong>Daftar Barang :</strong></h5>
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
                                <th>Bentuk</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $item)
                                <tr>
                                    <td>{{ $loop->iteration . '.' }}</td>
                                    <td>{{ $item->nama_brg }}</td>
                                    <td>{{ $item->jumlah . ' ' . $item->satuan->satuan_barang }} </td>
                                    <td>{{ $item->bentuk }}</td>
                                    <td>
                                        <button class="btn btn-info modal-open"
                                            data-modal="{{ 'update' . $item->purchase_product_id }}"><i
                                                data-feather="edit"></i></button>
                                        <button class="btn btn-danger modal-open"
                                            data-modal="{{ 'delete' . $item->purchase_product_id }}"><i
                                                data-feather="trash"></i></button>

                                        <div id="{{ 'update' . $item->purchase_product_id }}" class="modal">
                                            <div class="modal-content">
                                                <span class="close"
                                                    data-modal="{{ 'update' . $item->purchase_product_id }}">&times;</span>
                                                <h3>Update Item?</h3>
                                                <hr>
                                                <form
                                                    action="{{ route('update-purchase-product', $item->purchase_product_id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <div class="row" style="row-gap: 15px;">
                                                        <div class="col-md-6">
                                                            <label for="jumlah">Jumlah
                                                                ({{ $item->satuan->satuan_barang }})</label>
                                                            <input required type="number" value="{{ $item->jumlah }}"
                                                                name="jumlah" id="jumlah"
                                                                placeholder="Masukkan jumlah pesanan" class="form-control">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="bentuk">Bentuk ({{ $item->bentuk }})</label>
                                                            <input required type="string" name="bentuk"
                                                                value="{{ $item->bentuk }}" id="bentuk"
                                                                placeholder="Masukkan bentuk" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="mt-3">
                                                        <button type="submit" class="btn btn-info">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                        <div id="{{ 'delete' . $item->purchase_product_id }}" class="modal">
                                            <div class="modal-content">
                                                <span class="close"
                                                    data-modal="{{ 'delete' . $item->purchase_product_id }}">&times;</span>
                                                <h3>Apakah anda yakin?</h3>
                                                <hr>
                                                <form
                                                    action="{{ route('delete-purchase-product', $item->purchase_product_id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <p>Yakin untuk menghapus item <strong>{{ $item->nama_brg }}</strong>
                                                    </p>
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

                    @if (!$products)
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                            <a href="{{ route('purchase-report') }}" class="btn btn-dark">Simpan</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
