@extends('layouts.app')

@section('content-app')

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
                    <div class="p-2" style="border: 1px solid black; border-radius: 5px">
                        <form action="{{ route('create-items') }}" method="POST">
                            @csrf
                            <input type="hidden" name="count_data" value="{{ $items }}">
                            <div class="row" style="row-gap: 15px;">
                                <div class="col-md-6">
                                    <label for="{{ 'nama_barang'.$i }}"><strong>Nama Barang</strong></label>
                                    <input required type="text" class="form-control" placeholder="Masukkan nama barang" name="{{ 'nama_barang'.$i }}" id="{{ 'nama_barang'.$i }}">
                                </div>

                                <div class="col-md-6">
                                    <label for="{{ 'golongan_id'.$i }}"><strong>Golongan</strong></label>
                                    <select required name="{{ 'golongan_id'.$i }}" class="form-control" id="{{ 'golongan_id'.$i }}">
                                        <option value="">Pilih Golongan</option>
                                        @foreach ($golongan as $item)
                                            <option @if(old('golongan_id'.$i) == $item->golongan_id) selected @endif value="{{ $item->golongan_id }}">{{ $item->jenis_golongan }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- <div class="col-md-6">
                                    <label for="{{ 'supplier_id'.$i }}"><strong>Supplier</strong></label>
                                    <select required name="{{ 'supplier_id'.$i }}" class="form-control" id="{{ 'supplier_id'.$i }}">
                                        <option value="">-Pilih Supplier-</option>
                                        @foreach ($suppliers as $item)
                                            <option @if(old('supplier_id'.$i) == $item->supplier_id) selected @endif value="{{ $item->supplier_id }}">{{ $item->nama_supplier }}</option>
                                        @endforeach
                                    </select>
                                </div> --}}
                                <div class="col-md-6">
                                    <label for="{{ 'tanggal_kedaluwarsa'.$i }}"><strong>Tanggal Kedaluwarsa</strong></label>
                                    <input required value="{{ old('tanggal_kedaluwarsa'.$i) }}" type="date" class="form-control" name="{{ 'tanggal_kedaluwarsa'.$i }}" id="{{ 'tanggal_kedaluwarsa'.$i }}">
                                </div>

                                <div class="col-md-6">
                                    <label for="{{ 'kategori_id'.$i }}"><strong>Kategori</strong></label>
                                    <select required name="{{ 'kategori_id'.$i }}" id="{{ 'kategori_id'.$i }}" class="form-control">
                                        <option value="">Pilih Kategori</option>
                                        @foreach ($kategori as $item)
                                            <option @if(old('kategori_id'.$i) == $item->kategori_id) selected @endif value="{{ $item->kategori_id }}">{{ $item->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                {{-- <div class="col-md-6">
                                    <label for="{{ 'tanggal_masuk'.$i }}"><strong>Tanggal Masuk</strong></label>
                                    <input required value="{{ old('tanggal_masuk'.$i) }}" type="date" class="form-control" name="{{ 'tanggal_masuk'.$i }}" id="{{ 'tanggal_masuk'.$i }}">
                                </div> --}}

                                <div class="col-md-6 justify-content-between d-flex">
                                    <div class="col-md-6">
                                        <label for="{{ 'jumlah'.$i }}"><strong>Jumlah Stok</strong></label>
                                        <input required value="{{ old('jumlah'.$i) }}" type="number" placeholder="Masukkan jumlah " class="form-control" name="{{ 'jumlah'.$i }}" id="{{ 'jumlah'.$i }}">    
                                    </div>
                                    
                                    <div class="col-md-5">
                                        <label for="{{ 'satuan_id'.$i }}"><strong>Satuan</strong></label>
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
                                        <label for="{{ 'isi'.$i }}"><strong>Isi dalam kemasan</strong></label>
                                        <input required value="{{ old('isi'.$i) }}" type="number" placeholder="Masukkan jumlah isi" class="form-control" name="{{ 'isi'.$i }}" id="{{ 'isi'.$i }}">    
                                    </div>
                                    
                                    <div class="col-md-5">
                                        <label for="{{ 'bentuk'.$i }}"><strong>Bentuk sediaan</strong></label>
                                        <input required value="{{ old('bentuk'.$i) }}" type="string" placeholder="Masukkan bentuk sediaan" class="form-control" name="{{ 'bentuk'.$i }}" id="{{ 'bentuk'.$i }}">  
                                    </div>                                    
                                </div>

                                <div class="col-md-6">
                                    <label for="{{ 'harga_beli'.$i }}"><strong>Harga Beli</strong></label>
                                    <input required value="{{ old('harga_beli'.$i) }}" type="number" placeholder="Masukkan harga beli" class="form-control" name="{{ 'harga_beli'.$i }}" id="{{ 'harga_beli'.$i }}">
                                </div>

                                <div class="col-md-6">
                                    <label for="{{ 'harga_jual'.$i }}"><strong>Harga Jual</strong></label>
                                    <input required value="{{ old('harga_jual'.$i) }}" type="number" placeholder="Masukkan harga jual" class="form-control" name="{{ 'harga_jual'.$i }}" id="{{ 'harga_jual'.$i }}">
                                </div>

                                <div class="col-md-6">
                                    <label for="{{ 'satuan_jual'.$i }}"><strong>Satuan Jual</strong></label>
                                    <input required value="{{ old('satuan_jual'.$i) }}" type="string" placeholder="Masukkan satuan jual" class="form-control" name="{{ 'satuan_jual'.$i }}" id="{{ 'satuan_jual'.$i }}">
                                </div>

                                <div class="col-md-6">
                                    <label for="{{ 'minimal_stok'.$i }}"><strong>Minimal Stok</strong></label>
                                    <input required value="{{ old('minimal_stok'.$i) }}" type="number" placeholder="Masukkan minimal stok" class="form-control" name="{{ 'minimal_stok'.$i }}" id="{{ 'minimal_stok'.$i }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            @endfor
            
            <div class="d-flex justify-content-between">
                <button class="btn btn-dark modal-open text-light" data-modal="confirm" data-feather="">
                    <strong>Kembali</strong>
                </button>
                <button class="btn btn-dark text-light" style="width: 15%; background: black">
                    <strong>Simpan</strong>
                </button>
            </div>
        </form>
    </div>
@endsection