@extends('layouts.app')

@section('content-app')
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4><strong>{{ $purchase->supplier->nama_supplier }}</strong></h4>
                    <hr>

                    <form action="{{ route('create-purchase-product') }}" method="POST" id="myForm">
                        @csrf
                        <input type="hidden" name="purchase_id" value="{{ $purchase->purchase_id }}">
                        <div class="row justify-content-between">
                            <div class="col-md-3">
                                <label for="barang_id">Barang</label>
                                <select class="form-select" name="barang_id" required id="barang_id">
                                    <option value="">-Pilih Barang-</option>
                                    @foreach ($barang as $b)
                                        <option value="{{ $b->barang_id }}" data-satuan_beli="{{ $b->satuan->satuan_barang }}" data-bentuk="{{ $b->bentuk->nama_bentuk }}" data-isi="{{ $b->isi }}">{{ $b->nama_barang }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="jumlah">Jumlah</label>
                                <input required type="number" name="jumlah" id="jumlah" placeholder="Masukkan jumlah pesanan" class="form-control">
                            </div>
                            <div class="col-md-3" id="formZat">
                                <label for="zat">Zat Aktif (Opsional)</label>
                                <input type="string" name="zat" id="zat" placeholder="Zat Aktif"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="row mt-3 justify-content-between">
                            <div class="col-md-3">
                                <label for="satuan_beli">Satuan Beli</label>
                                <input type="text" name="satuan_beli" class="form-control" id="satuan_beli" readonly>
                            </div>
                            <div class="col-md-3">
                                <label for="bentuk_id">Bentuk Sediaan</label>
                                <input required type="string" name="bentuk_id" id="bentuk_id" class="form-control" readonly>
                            </div>
                            <div class="col-md-3">
                                <label for="isi">isi dalam kemasan</label>
                                <input required type="string" name="isi" id="isi" class="form-control" readonly>
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
                                <th>Zat Aktif</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $item)
                                <tr>
                                    <td>{{ $loop->iteration . '.' }}</td>
                                    <td>{{ $item->barang->nama_barang }}</td>
                                    <td>{{ $item->jumlah . ' ' . $item->barang->satuan->satuan_barang }} </td>
                                    <td>{{ $item->zat }} </td>
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
                                                            <label for="jumlah">Jumlah ({{ $item->barang->satuan->satuan_barang }})</label>
                                                            <input required type="number" value="{{ $item->jumlah }}" name="jumlah" id="jumlah" placeholder="Masukkan jumlah pesanan" class="form-control">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="zat">Zat Aktif {{ $item->purchase->golongan->jenis_golongan }}</label>
                                                            <input type="text" value="{{ $item->zat }}" name="zat" id="zat" placeholder="Masukkan Zat Aktif (Opsional)" class="form-control">
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

                <a type="button" class="btn btn-dark" href="{{ route('data-surat') }}">Simpan</a>

            </div>
        </div>
    </div>

    <script>
        // Tambahkan script JavaScript untuk menangani peristiwa perubahan pada form select
        document.getElementById('barang_id').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            var satuanInput1 = document.getElementById('satuan_beli');
            var satuanInput2 = document.getElementById('bentuk_id');
            var satuanInput3 = document.getElementById('isi');
            satuanInput1.value = selectedOption.getAttribute('data-satuan_beli');
            satuanInput2.value = selectedOption.getAttribute('data-bentuk');
            satuanInput3.value = selectedOption.getAttribute('data-isi');
        });
    </script>

@endsection
