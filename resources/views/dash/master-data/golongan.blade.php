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
                            <h2>Create Golongan</h2>
                            <hr>
                            <form action="{{ route('create-golongan') }}" method="POST">
                                @csrf
                                <div class="">
                                    <label for="jenis_golongan">Jenis Golongan<span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" placeholder="Masukkan jenis golongan" required name="jenis_golongan" id="jenis_golongan">
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
                                <th>Nama Supplier</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            @foreach ($golongan as $item)
                            <tr>
                                <td>{{ $loop->iteration . '.' }}</td>
                                <td>{{ $item->jenis_golongan }}</td>
                                <td>
                                    <button class="btn btn-info modal-open" data-modal="{{ 'edit'.$item->golongan_id }}"><i data-feather="edit"></i></button>
                                    <button class="btn btn-danger modal-open" data-modal="{{ 'delete'.$item->golongan_id }}"><i data-feather="trash-2"></i></button>
                                    
                                    {{-- edit modal --}}
                                    <div id="{{ 'edit'.$item->golongan_id }}" class="modal">
                                        <div class="modal-content">
                                            <span class="close" data-modal="{{ 'edit'.$item->golongan_id }}">&times;</span>
                                            <h2>Update Golongan</h2>
                                            <hr>
                                            <form action="{{ route('update-golongan', $item->golongan_id) }}" method="POST">
                                                @csrf
                                                <div class="">
                                                    <label for="jenis_golongan">Nama kategori<span class="text-danger">*</span></label>
                                                    <input class="form-control" value="{{ $item->jenis_golongan }}" type="text" placeholder="Masukkan jenis golongan" required name="jenis_golongan" id="jenis_golongan">
                                                </div>
                                                
                                                <div class="mt-3">
                                                    <button type="submit" class="btn btn-info">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    
                                    {{-- delete modal --}}
                                    <div id="{{ 'delete'.$item->golongan_id }}" class="modal">
                                        <div class="modal-content">
                                            <span class="close" data-modal="{{ 'delete'.$item->golongan_id }}">&times;</span>
                                            <h2>Delete Golongan</h2>
                                            <hr>
                                            <form action="{{ route('delete-golongan', $item->golongan_id) }}" method="POST">
                                                @csrf
                                                <p>Yakin untuk menghapus <strong>{{ $item->jenis_golongan }}</strong></p>

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