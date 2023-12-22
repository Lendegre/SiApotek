@extends('layouts.app')

@section('content-app')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="mb-4">
                    <button class="btn text-light modal-open" data-modal="create" style="background: #222e5c"><i data-feather="plus"></i> 
                        Add Data
                    </button>
                    
                    <div id="create" class="modal">
                        <div class="modal-content">
                            <span class="close" data-modal="create">&times;</span>
                            <h2>Tambah Supplier</h2>
                            <hr>
                            <form action="{{ route('create-supplier') }}" method="POST">
                                @csrf
                                <div class="">
                                    <label for="nama_supplier">Nama Supplier<span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" placeholder="Masukkan nama supplier" required name="nama_supplier" id="nama_supplier">
                                </div>
                                <div class="mt-3">
                                    <label for="nama_sales">Nama Sales<span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" placeholder="Masukkan nama sales" required name="nama_sales" id="nama_sales">
                                </div>
                                <div class="mt-3">
                                    <label for="no_telp">No. Telpon<span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" placeholder="Masukkan nomor telepon" required name="no_telp" id="no_telp">
                                </div>
                                <div class="mt-3">
                                    <label for="alamat">Alamat<span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" placeholder="Masukkan alamat" required name="alamat" id="alamat">
                                </div>
                                
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="table-responsive"> 
                    <table class="table table-striped" id="data">
                        <thead>
                            <tr style="white-space: nowrap">
                                <th>No.</th>
                                <th>Nama Supplier</th>
                                <th>Nama Sales</th>
                                <th>No. Telp</th>
                                <th>Alamat</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            @foreach ($supplier as $item)
                            <tr>
                                <td>{{ $loop->iteration . '.' }}</td>
                                <td>{{ $item->nama_supplier }}</td>
                                <td>{{ $item->nama_sales }}</td>
                                <td>{{ $item->no_telp }}</td>
                                <td>{{ $item->alamat }}</td>
                                <td>
                                    <button class="btn btn-info modal-open" data-modal="{{ 'edit' . $item->supplier_id }}"><i data-feather="edit"></i></button>
                                    <button class="btn btn-danger modal-open" data-modal="{{ 'delete' . $item->supplier_id }}"><i data-feather="trash-2"></i></button>
                                    
                                    {{-- edit modal --}}
                                    <div id="{{ 'edit'.$item->supplier_id }}" class="modal">
                                        <div class="modal-content">
                                            <span class="close" data-modal="{{ 'edit'.$item->supplier_id }}">&times;</span>
                                            <h2>Update Supplier</h2>
                                            <hr>
                                            <form action="{{ route('update-supplier', $item->supplier_id) }}" method="POST">
                                                @csrf
                                                <div class="">
                                                    <label for="nama_supplier">Nama Supplier<span class="text-danger">*</span></label>
                                                    <input class="form-control" value="{{ $item->nama_supplier }}" type="text" placeholder="Masukkan nama supplier" required name="nama_supplier" id="nama_supplier">
                                                </div>
                                                <div class="mt-3">
                                                    <label for="nama_sales">Nama Sales<span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text" value="{{ $item->nama_sales }}" placeholder="Masukkan nama sales" required name="nama_sales" id="nama_sales">
                                                </div>
                                                <div class="mt-3">
                                                    <label for="no_telp">No. Telpon<span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text" value="{{ $item->no_telp }}" placeholder="Masukkan nomor telepon" required name="no_telp" id="no_telp">
                                                </div>
                                                <div class="mt-3">
                                                    <label for="alamat">Alamat<span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text" value="{{ $item->alamat }}" placeholder="Masukkan alamat" required name="alamat" id="alamat">
                                                </div>
                                                
                                                <div class="mt-3">
                                                    <button type="submit" class="btn btn-info">Perbarui</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    
                                    {{-- delete modal --}}
                                    <div id="{{ 'delete'.$item->supplier_id }}" class="modal">
                                        <div class="modal-content">
                                            <span class="close" data-modal="{{ 'delete'.$item->supplier_id }}">&times;</span>
                                            <h3>Delete Supplier</h3>
                                            <hr>
                                            <div class="">
                                                <form action="{{ route('delete-supplier', $item->supplier_id) }}" method="POST">
                                                    @csrf
                                                    <p>Yakin untuk menghapus <strong>{{ $item->nama_supplier }}</strong></p>
                                                    
                                                    <div class="mt-3">
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </div>
                                                </form>
                                            </div>
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
</div>
@endsection