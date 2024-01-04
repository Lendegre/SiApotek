@extends('layouts.app')

@section('content-app')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="mb-4">
                    
                    @if (in_array(0, $count_model))
                    <div class="bg-warning rounded p-3 " role="alert">
                        <span class="text-light">Pastikan data supplier, kategori, bentuk sediaan, satuan dan golongan memiliki minimal 1 data sebelum melakukan penambahan barang masuk. </span>
                        <a class="text-decoration modal-open" data-modal="detail" style="cursor: pointer">Lihat Detail</a>
                        <div id="detail" class="modal">
                            <div class="modal-content">
                                <span class="close" data-modal="detail">&times;</span>
                                <h2>Detail data yang diperlukan</h2>
                                <p>Berikut masing-masing jumlah data dari setiap data yang diminta.</p>
                                
                                <div class="mt-2 table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Jenis Data</th>
                                                <th>Jumlah Data</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            @php
                                            $models = ['Kategori', 'Bentuk Sediaan', 'Satuan', 'Golongan']
                                            @endphp
                                            
                                            @foreach ($models as $idx => $model)
                                            <tr class="@if($count_model[$idx] > 0) table-success @else table-danger @endif">
                                                <td>{{ $loop->iteration . '.' }}</td>
                                                <td>{{ $model }}</td>
                                                <td>{{ $count_model[$idx] }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    @else
                    <button class="btn text-light modal-open" data-modal="create" style="background: #222e5c"><i data-feather="plus"></i> 
                        Add Data
                    </button>
                    
                    
                    <div id="create" class="modal">
                        <div class="modal-content">
                            <span class="close" data-modal="create">&times;</span>
                            <h2>Jumlah Barang</h2>
                            <p>Tentukan berapa jumlah barang yang akan ditambahkan.</p>
                            
                            <div class="mt-2">
                                <form action="{{ route('count-amount-request') }}" method="POST">
                                    @csrf
                                    <label for="amount">Jumlah Barang</label>
                                    <input class="form-control" type="number" placeholder="cth: 5" name="amount" required id="amount">
                                    
                                    <button type="submit" class="mt-3 btn btn-success">Selanjutnya</button>
                                </form>
                                
                            </div>
                        </div>
                    </div>
                    @endif
                    <a href="{{ route('stock-report') }}" class="btn btn-dark"><i data-feather="file-text"></i> Laporan Stok</a>
                </div>
                
                <div class="table-responsive"> 
                    <table class="table table-striped" id="data">
                        <thead>
                            <tr style="white-space: nowrap">
                                <th>No.</th>
                                <th class="text-center">Aksi</th>
                                <th>Nama Barang</th>
                                <th>Kedaluwarsa</th>
                                <th>Jumlah Stok</th>
                                <th>Isi dalam kemasan</th>
                                <th>Bentuk Sediaan</th>
                                <th>Harga Beli</th>
                                <th>Harga Jual</th>
                                <th>Satuan Jual</th>
                                <th>Kategori</th>
                                <th>Golongan</th>
                                <th>Minimal Stok</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            @foreach ($items as $barang)
                            <tr style="white-space: nowrap">
                                
                                <td>{{ $loop->iteration . '.' }}</td>
                                <td>
                                    <button class="btn btn-info modal-open" data-modal="{{ 'update'.$barang->barang_id }}"><i data-feather="edit"></i></button>
                                    <button class="btn btn-danger modal-open" data-modal="{{ 'delete'.$barang->barang_id }}"><i data-feather="trash"></i></button>
                                    
                                    <div id="{{ 'delete'.$barang->barang_id }}" class="modal">
                                        <div class="modal-content">
                                            <span class="close" data-modal="{{ 'delete'.$barang->barang_id }}">&times;</span>
                                            <h3>Apakah anda yakin?</h3>
                                            <hr>
                                            <form action="{{ route('delete-item', $barang->barang_id) }}" method="POST">
                                                @csrf
                                                <p>Yakin untuk menghapus barang <strong>{{ $barang->nama_barang }}</strong></p>
                                                <div class="mt-3">
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    
                                    <div id="{{ 'update'.$barang->barang_id }}" class="modal">
                                        <div class="modal-content">
                                            <span class="close" data-modal="{{ 'update'.$barang->barang_id }}">&times;</span>
                                            <h3>Update Barang</h3>
                                            <hr>
                                            <form action="{{ route('update-item', $barang->barang_id) }}" method="POST">
                                                @csrf
                                                <div class="row" style="row-gap: 15px;">
                                                    <div class="col-md-6">
                                                        <label for="{{ 'nama_barang' }}">Nama Barang</label>
                                                        <input type="text" required value="{{ $barang->nama_barang }}" class="form-control" placeholder="Masukkan nama barang" name="{{ 'nama_barang' }}" id="{{ 'nama_barang' }}">
                                                    </div>
                                                    
                                                    {{-- <div class="col-md-6">
                                                        <label for="{{ 'supplier_id' }}">Supplier</label>
                                                        <select required name="{{ 'supplier_id' }}" class="form-control" id="{{ 'supplier_id' }}">
                                                            <option value="{{ $barang->supplier_id }}">{{ $barang->supplier->nama_supplier }}</option>
                                                            @foreach ($suppliers as $item)
                                                                <option value="{{ $item->supplier_id }}">{{ $item->nama_supplier }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6"> --}}
                                                        <label for="{{ 'tanggal_kedaluwarsa' }}">Tanggal Kedaluwarsa</label>
                                                        <input required value="{{ $barang->tanggal_kedaluwarsa }}" type="date" class="form-control" name="{{ 'tanggal_kedaluwarsa' }}" id="{{ 'tanggal_kedaluwarsa' }}">
                                                    </div>
                                                    
                                                    {{-- <div class="col-md-6">
                                                        <label for="{{ 'tanggal_masuk' }}">Tanggal Masuk</label>
                                                        <input required value="{{ $barang->tanggal_masuk }}" type="date" class="form-control" name="{{ 'tanggal_masuk' }}" id="{{ 'tanggal_masuk' }}">
                                                    </div> --}}
                                                    
                                                    <div class="col-md-6 justify-content-between d-flex">
                                                        <div class="col-md-6">
                                                            <label for="{{ 'jumlah' }}">Jumlah Stok</label>
                                                            <input required value="{{ $barang->jumlah }}" type="number" placeholder="Masukkan jumlah " class="form-control" name="{{ 'jumlah' }}" id="{{ 'jumlah' }}">    
                                                        </div>
                                                        
                                                        <div class="col-md-5">
                                                            <label for="{{ 'satuan_id' }}">Satuan</label>
                                                            <select required name="{{ 'satuan_id' }}" id="{{ 'satuan_id' }}" class="form-control">
                                                                <option value="{{ $barang->satuan_id }}">{{ $barang->satuan->satuan_barang }}</option>
                                                                @foreach ($satuan as $item)
                                                                    <option value="{{ $item->satuan_id }}">{{ $item->satuan_barang }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-6 justify-content-between d-flex">
                                                        <div class="col-md-6">
                                                            <label for="{{ 'isi' }}">Isi dalam kemasan</label>
                                                            <input required value="{{ $barang->isi }}" type="number" placeholder="Masukkan isi dalam kemasan" class="form-control" name="{{ 'isi' }}" id="{{ 'isi' }}">    
                                                        </div>
                                                        
                                                        <div class="col-md-5">
                                                            <label for="{{ 'bentuk' }}">Bentuk sediaan</label>
                                                            <input required value="{{ $barang->bentuk }}" type="string" placeholder="Masukkan bentuk sediaan" class="form-control" name="{{ 'bentuk' }}" id="{{ 'bentuk' }}">  
                                                        </div>                                    
                                                    </div>
                                                    
                                                    <div class="col-md-6">
                                                        <label for="{{ 'harga_beli' }}">Harga Beli</label>
                                                        <input required value="{{ $barang->harga_beli }}" type="number" placeholder="Masukkan harga beli" class="form-control" name="{{ 'harga_beli' }}" id="{{ 'harga_beli' }}">
                                                    </div>
                                                    
                                                    <div class="col-md-6">
                                                        <label for="{{ 'harga_jual' }}">Harga Jual</label>
                                                        <input required value="{{ $barang->harga_jual }}" type="number" placeholder="Masukkan harga jual" class="form-control" name="{{ 'harga_jual' }}" id="{{ 'harga_jual' }}">
                                                    </div>
                                                    
                                                    <div class="col-md-6">
                                                        <label for="{{ 'satuan_jual' }}">Satuan Jual</label>
                                                        <input required value="{{ $barang->satuan_jual }}" type="string" placeholder="Masukkan satuan jual" class="form-control" name="{{ 'satuan_jual' }}" id="{{ 'satuan_jual'}}">
                                                    </div>
                                                    
                                                    <div class="col-md-6">
                                                        <label for="{{ 'minimal_stok' }}">Minimal Stok</label>
                                                        <input required value="{{ $barang->minimal_stok }}" type="number" placeholder="Masukkan minimal stok" class="form-control" name="{{ 'minimal_stok' }}" id="{{ 'minimal_stok' }}">
                                                    </div>
                                                    
                                                    <div class="col-md-6">
                                                        <label for="{{ 'kategori_id' }}">Kategori</label>
                                                        <select required name="{{ 'kategori_id' }}" id="{{ 'kategori_id' }}" class="form-control">
                                                            <option value="{{ $barang->kategori_id }}">{{ $barang->kategori->nama_kategori }}</option>
                                                            @foreach ($kategori as $item)
                                                                <option value="{{ $item->kategori_id }}">{{ $item->nama_kategori }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    
                                                    <div class="col-md-6">
                                                        <label for="{{ 'golongan_id' }}">Golongan</label>
                                                        <select required name="{{ 'golongan_id' }}" class="form-control" id="{{ 'golongan_id' }}">
                                                            <option value="{{ $barang->golongan_id }}">{{ $barang->golongan->jenis_golongan }}</option>
                                                            @foreach ($golongan as $item)
                                                                <option value="{{ $item->golongan_id }}">{{ $item->jenis_golongan }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    
                                                    <div class="">
                                                        <button class="btn p-2 text-light" style="width: 100%; background: linear-gradient(to right, #000, navy)">
                                                            <strong>Simpan</strong>
                                                        </button>
                                                    </div>  
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $barang->nama_barang }}</td>
                                    <td>{{ $barang->tanggal_kedaluwarsa }}</td>
                                    <td>{{ $barang->jumlah . ' '}} {{ $barang->satuan->satuan_barang }}</td>
                                    <td>{{ $barang->isi . ' '}} {{ $barang->satuan_jual }}</td>
                                    <td>{{ $barang->bentuk}}</td>
                                    <td>Rp. {{ number_format($barang->harga_beli, 0, ',', '.') }}/{{ $barang->satuan->satuan_barang }}</td>
                                    <td>Rp. {{ number_format($barang->harga_jual, 0, ',', '.') }} <strong>/{{ $barang->satuan_jual }}</strong></td>
                                    <td>{{ $barang->satuan_jual }}</td>
                                    <td>{{ $barang->kategori->nama_kategori }}</td>
                                    <td>{{ $barang->golongan->jenis_golongan }}</td>
                                    <td>{{ $barang->minimal_stok }} {{ $barang->satuan_jual }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection