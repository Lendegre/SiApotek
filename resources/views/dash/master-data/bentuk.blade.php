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
                            <h2>Tambah Data Bentuk Sediaan</h2>
                            <hr>
                            <form action="{{ route('create-bentuk') }}" method="POST">
                                @csrf
                                <div class="">
                                    <label for="nama_bentuk">Bentuk Sediaan Barang<span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" placeholder="Masukkan nama bentuk persediaan" required name="nama_bentuk" id="nama_bentuk">
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
                                <th>Bentuk Sediaan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            @foreach ($bentuk as $item)
                            <tr>
                                <td>{{ $loop->iteration . '.' }}</td>
                                <td>{{ $item->nama_bentuk }}</td>
                                <td>
                                    <button class="btn btn-info modal-open" data-modal="{{ 'edit'.$item->bentuk_id }}"><i data-feather="edit"></i></button>
                                    <button class="btn btn-danger modal-open" data-modal="{{ 'delete'.$item->bentuk_id }}"><i data-feather="trash-2"></i></button>
                                    
                                    {{-- edit modal --}}
                                    <div id="{{ 'edit'.$item->bentuk_id }}" class="modal">
                                        <div class="modal-content">
                                            <span class="close" data-modal="{{ 'edit'.$item->bentuk_id }}">&times;</span>
                                            <h2>Update Bentuk Sediaan</h2>
                                            <hr>
                                            <form action="{{ route('update-bentuk', $item->bentuk_id) }}" method="POST">
                                                @csrf
                                                <div class="">
                                                    <label for="nama_bentuk">Bentuk Sediaan<span class="text-danger">*</span></label>
                                                    <input class="form-control" value="{{ $item->nama_bentuk }}" type="text" placeholder="Masukkan nama bentuk persediaan" required name="nama_bentuk" id="Nama_bentuk">
                                                </div>

                                                <div class="mt-3">
                                                    <button class="btn btn-info" type="submit">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    
                                    {{-- delete modal --}}
                                    <div id="{{ 'delete'.$item->bentuk_id }}" class="modal">
                                        <div class="modal-content">
                                            <span class="close" data-modal="{{ 'delete'.$item->bentuk_id }}">&times;</span>
                                            <h2>Delete Bentuk Sediaan</h2>
                                            <hr>
                                            <form action="{{ route('delete-bentuk', $item->bentuk_id) }}" method="POST">
                                                @csrf
                                                <p>Yakin untuk menghapus <strong>{{ $item->bentuk_barang }}</strong></p>

                                                <div class="mt-2">
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
</div>
@endsection