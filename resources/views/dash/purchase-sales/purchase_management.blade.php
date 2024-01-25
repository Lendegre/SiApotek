@extends('layouts.app')

@php
    date_default_timezone_set('Asia/Jakarta');
@endphp

@section('content-app')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('create-purchase') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-2 mb-3">
                                Tanggal: <input readonly class="form-control" type="text"
                                    value="{{ date('Y/m/d', strtotime('now')) }}">
                            </div>
                        </div>
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <label for="no_surat">Nomor Surat</label>
                                <input required readonly
                                    value="{{ 'NS.' . date('Ymd', strtotime('now')) . $purchase_count }}" type="text"
                                    class="form-control" name="no_surat" id="no_surat">
                            </div>
                            <div class="col-md-4">
                                <label for="supplier_id">Supplier</label>
                                <select class="form-select" name="supplier_id" required id="supplier_id"
                                    @if (session('success')) disabled @endif>
                                    <option value="">-Pilih Supplier-</option>
                                    @foreach ($supplier as $item)
                                        <option {{ old('supplier_id') == $item->supplier_id ? 'selected' : '' }}
                                            value="{{ $item->supplier_id }}">{{ $item->nama_supplier }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="golongan_id">Golongan</label>
                                <select class="form-select" name="golongan_id" required id="golongan_id"
                                    @if (session('success')) disabled @endif>
                                    <option value="">-Pilih Golongan-</option>
                                    @foreach ($golongan as $item)
                                        <option {{ old('golongan_id') == $item->golongan_id ? 'selected' : '' }}
                                            value="{{ $item->golongan_id }}">{{ $item->jenis_golongan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success mt-3">Lanjut</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


    {{-- @if (session('success'))
                        <!-- Button trigger modal -->
                        <button class="btn btn-primary modal-open mt-3" data-modal=""><i data-feather="edit"></i> Edit</button>
                        
                        <!-- Modal -->
                        <div id="" class="modal">
                            <div class="modal-content">
                                <span class="close"
                                    data-modal="">&times;</span>
                                <h3>Update Item?</h3>
                                <hr>
                                <form
                                    action="{{ route('update-purchase') }}"
                                    method="POST">
                                    @csrf
                                    <div class="row" style="row-gap: 15px;">
                                        <div class="col-md-4">
                                            <label for="supplier_id">Supplier</label>
                                            <select class="form-select" name="supplier_id" required id="supplier_id">
                                                <option value="">-Pilih Supplier-</option>
                                                @foreach ($supplier as $item)
                                                <option {{ old('supplier_id') == $item->supplier_id ? "selected" : "" }} value="{{ $item->supplier_id }}">{{ $item->nama_supplier }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="golongan_id">Golongan</label>
                                            <select class="form-select" name="golongan_id" required id="golongan_id">
                                                <option value="">-Pilih Golongan-</option>
                                                @foreach ($golongan as $item)
                                                <option  {{ old('golongan_id') == $item->golongan_id ? "selected" : "" }} value="{{ $item->golongan_id }}">{{ $item->jenis_golongan }}</option>
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
                    @else
                        <button type="submit" class="btn btn-success mt-3">Lanjut</button>
                    @endif
                    {{-- <button type="submit" class="btn btn-success mt-3">Lanjut</button> --}}
    {{-- </form>
            </div>
        </div>
    </div>
</div> --}}

    {{-- Form Lanjutan Pembelian Barang --}}
    {{-- @if (session('success'))
<div class="row" id="myCard">
    <div class="col-12">
        <div class="card">
            <div class="card-body"> --}}
    {{-- <h4><strong>{{ $purchase->supplier->nama_supplier }}</strong></h4> --}}
    {{-- <hr>

                <form action="{{ route('create-purchase-product') }}" method="POST">
                    @csrf --}}
    {{-- <input type="hidden" name="purchase_id" value="{{ $purchase->purchase_id }}"> --}}
    {{-- <div class="row align-items-end">
                        <div class="col-md-3">
                            <label for="nama_brg">Barang</label>
                            <select class="form-select" name="nama_brg" required id="nama_brg">
                                <option value="">-Pilih Barang-</option> --}}
    {{-- @foreach ($barang as $b)
                                    <option value="{{ $b->barang_id }}">{{ $b->nama_barang }}</option>
                                @endforeach --}}
    {{-- </select>
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
                                <option value="">-Pilih Satuan Barang-</option> --}}
    {{-- @foreach ($satuan as $satuan)
                                    <option value="{{ $satuan->satuan_id }}">{{ $satuan->satuan_barang }}</option>
                                @endforeach --}}
    {{-- </select>
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
                    </button> --}}
    {{-- @endif --}}
    {{-- </form>
            </div>
        </div>
    </div>
</div>
@endif --}}


    <!-- Tambahkan script JavaScript -->
    {{-- <script>
    // Menonaktifkan form pertama setelah submit
    document.addEventListener('DOMContentLoaded', function () {
        @if (session('success'))
            document.getElementById('formPertama').addEventListener('submit', function() {
                // Menonaktifkan semua elemen input pada form pertama
                var inputs = document.getElementById('formPertama').getElementsByTagName('supplier_id');
                for (var i = 0; i < inputs.length; i++) {
                    inputs[i].setAttribute('readonly', 'true');
                }

                // Menonaktifkan tombol "Lanjut"
                document.getElementById('formPertama').querySelector('button[type="submit"]').setAttribute('disabled', 'true');
            });
        @endif
    });
</script> --}}
