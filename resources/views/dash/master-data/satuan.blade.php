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
                            <h2>Create Satuan Jumlah</h2>
                            <hr>
                            <form action="{{ route('create-satuan') }}" method="POST">
                                @csrf
                                <div class="">
                                    <label for="satuan_barang">Nama Satuan Barang<span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" placeholder="Satuan barang" required name="satuan_barang" id="satuan_barang">
                                </div>
                                
                                <div class="mt-2">
                                    <button class="btn btn-success">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="table-responsive"> 
                    <table class="table table-striped">
                        <thead>
                            <tr style="white-space: nowrap">
                                <th>No.</th>
                                <th>Satuan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            @foreach ($satuan as $item)
                            <tr>
                                <td>{{ $loop->iteration . '.' }}</td>
                                <td>{{ $item->satuan_barang }}</td>
                                <td>
                                    <button class="btn btn-info modal-open" data-modal="{{ 'edit'.$item->satuan_id }}"><i data-feather="edit"></i></button>
                                    <button class="btn btn-danger modal-open" data-modal="{{ 'delete'.$item->satuan_id }}"><i data-feather="trash-2"></i></button>
                                    
                                    {{-- edit modal --}}
                                    <div id="{{ 'edit'.$item->satuan_id }}" class="modal">
                                        <div class="modal-content">
                                            <span class="close" data-modal="{{ 'edit'.$item->satuan_id }}">&times;</span>
                                            <h2>Update Satuan</h2>
                                            <hr>
                                            <form action="{{ route('update-satuan', $item->satuan_id) }}" method="POST">
                                                @csrf
                                                <div class="">
                                                    <label for="satuan_barang">Nama Satuan Barang<span class="text-danger">*</span></label>
                                                    <input class="form-control" value="{{ $item->satuan_barang }}" type="text" placeholder="Masukkan nama kategori" required name="satuan_barang" id="satuan_barang">
                                                </div>
                                                
                                                <div class="mt-3">
                                                    <button type="submit" class="btn btn-info">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    
                                    {{-- delete modal --}}
                                    <div id="{{ 'delete'.$item->satuan_id }}" class="modal">
                                        <div class="modal-content">
                                            <span class="close" data-modal="{{ 'delete'.$item->satuan_id }}">&times;</span>
                                            <h3>Delete Satuan</h3>
                                            <hr>
                                            <div class="">
                                                <form action="{{ route('delete-satuan', $item->satuan_id) }}" method="POST">
                                                    @csrf
                                                    <p>Yakin untuk menghapus <strong>{{ $item->satuan_barang }}</strong></p>
                                                    
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