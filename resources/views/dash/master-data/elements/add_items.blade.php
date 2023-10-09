@extends('layouts.app')

@section('content-app')

    <button class="btn btn-dark modal-open" data-modal="confirm">
        <- Kembali
    </button>

    <div id="confirm" class="modal">
        <div class="modal-content">
            <span class="close" data-modal="confirm">&times;</span>
            <h3>Apakah anda yakin?</h3>
            <hr>
            <div class="">
                Jika anda keluar input yang anda masukkan tidak akan tersimpan!
            </div>
            <div class="mt-3">
                <a href="{{ route('barang') }}" class="btn btn-danger">Keluar</a>
            </div>
        </div>
    </div>

    <hr>

    <div class="row">
        @for($i = 1; $i <= $items; $i++)

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 style="font-weight: bold;">Barang {{ $i }}</h5>
                    <div class="p-2" style="border: 1px solid navy; border-radius: 5px">
                        <form action="{{ route('create-items') }}" method="POST">
                            @csrf
                            <input type="hidden" name="count_data" value="{{ $items }}">
                            <div class="row" style="row-gap: 15px;">
                                <div class="col-md-6">
                                    <label for="{{ 'nama_barang'.$i }}">Nama Barang</label>
                                    <input required type="text" class="form-control" placeholder="Masukkan nama barang" name="{{ 'nama_barang'.$i }}" id="{{ 'nama_barang'.$i }}">
                                </div>

                                <div class="col-md-6">
                                    <label for="{{ 'supplier_id'.$i }}">Supplier</label>
                                    <select required name="{{ 'supplier_id'.$i }}" class="form-control" id="{{ 'supplier_id'.$i }}">
                                        <option value="">-Pilih Supplier-</option>
                                        @foreach ($suppliers as $item)
                                            <option @if(old('supplier_id'.$i) == $item->supplier_id) selected @endif value="{{ $item->supplier_id }}">{{ $item->nama_supplier }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="{{ 'tanggal_kedaluwarsa'.$i }}">Tanggal Kedaluwarsa</label>
                                    <input required value="{{ old('tanggal_kedaluwarsa'.$i) }}" type="date" class="form-control" name="{{ 'tanggal_kedaluwarsa'.$i }}" id="{{ 'tanggal_kedaluwarsa'.$i }}">
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="{{ 'tanggal_masuk'.$i }}">Tanggal Masuk</label>
                                    <input required value="{{ old('tanggal_masuk'.$i) }}" type="date" class="form-control" name="{{ 'tanggal_masuk'.$i }}" id="{{ 'tanggal_masuk'.$i }}">
                                </div>

                                <div class="col-md-6 justify-content-between d-flex">
                                    <div class="col-md-6">
                                        <label for="{{ 'jumlah'.$i }}">Jumlah</label>
                                        <input required value="{{ old('jumlah'.$i) }}" type="number" placeholder="Masukkan jumlah " class="form-control" name="{{ 'jumlah'.$i }}" id="{{ 'jumlah'.$i }}">    
                                    </div>
                                    
                                    <div class="col-md-5">
                                        <label for="{{ 'satuan_id'.$i }}">Satuan</label>
                                        <select required name="{{ 'satuan_id'.$i }}" id="{{ 'satuan_id'.$i }}" class="form-control">
                                            <option value="">-Pilih Satuan-</option>
                                            @foreach ($satuan as $item)
                                                <option @if(old('satuan_id'.$i) == $item->satuan_id) selected @endif value="{{ $item->satuan_id }}">{{ $item->satuan_barang }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-6 justify-content-between d-flex">
                                    <div class="col-md-6">
                                        <label for="{{ 'isi'.$i }}">Isi/Stok</label>
                                        <input required value="{{ old('isi'.$i) }}" type="number" placeholder="Masukkan isi/stok" class="form-control" name="{{ 'isi'.$i }}" id="{{ 'isi'.$i }}">    
                                    </div>
                                    
                                    <div class="col-md-5">
                                        <label for="{{ 'bentuk_id'.$i }}">Bentuk sediaan</label>
                                        <select required name="{{ 'bentuk_id'.$i }}" id="{{ 'bentuk_id'.$i }}" class="form-control">
                                            <option value="">-Pilih Bentuk sediaan-</option>
                                            @foreach ($bentuk as $item)
                                                <option @if(old('bentuk_id'.$i) == $item->bentuk_id) selected @endif value="{{ $item->bentuk_id }}">{{ $item->bentuk_barang }}</option>
                                            @endforeach
                                        </select>
                                    </div>                                    
                                </div>

                                <div class="col-md-6">
                                    <label for="{{ 'harga_beli'.$i }}">Harga Beli</label>
                                    <input required value="{{ old('harga_beli'.$i) }}" type="number" placeholder="Masukkan harga beli" class="form-control" name="{{ 'harga_beli'.$i }}" id="{{ 'harga_beli'.$i }}">
                                </div>

                                <div class="col-md-6">
                                    <label for="{{ 'harga_jual'.$i }}">Harga Jual</label>
                                    <input required value="{{ old('harga_jual'.$i) }}" type="number" placeholder="Masukkan harga jual" class="form-control" name="{{ 'harga_jual'.$i }}" id="{{ 'harga_jual'.$i }}">
                                </div>

                                <div class="col-md-6">
                                    <label for="{{ 'minimal_stok'.$i }}">Minimal Stok</label>
                                    <input required value="{{ old('minimal_stok'.$i) }}" type="number" placeholder="Masukkan minimal stok" class="form-control" name="{{ 'minimal_stok'.$i }}" id="{{ 'minimal_stok'.$i }}">
                                </div>

                                <div class="col-md-6">
                                    <label for="{{ 'kategori_id'.$i }}">Kategori</label>
                                    <select required name="{{ 'kategori_id'.$i }}" id="{{ 'kategori_id'.$i }}" class="form-control">
                                        <option value="">Pilih Kategori</option>
                                        @foreach ($kategori as $item)
                                            <option @if(old('kategori_id'.$i) == $item->kategori_id) selected @endif value="{{ $item->kategori_id }}">{{ $item->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-12">
                                    <label for="{{ 'golongan_id'.$i }}">Golongan</label>
                                    <select required name="{{ 'golongan_id'.$i }}" class="form-control" id="{{ 'golongan_id'.$i }}">
                                        <option value="">Pilih Golongan</option>
                                        @foreach ($golongan as $item)
                                            <option @if(old('golongan_id'.$i) == $item->golongan_id) selected @endif value="{{ $item->golongan_id }}">{{ $item->jenis_golongan }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            @endfor
            
            <div class="">
                <button class="btn p-2 text-light" style="width: 100%; background: linear-gradient(to right, #000, navy)">
                    <strong>Simpan</strong>
                </button>
            </div>
        </form>
    </div>
@endsection