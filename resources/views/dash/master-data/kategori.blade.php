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
                            <h2>Create Kategori</h2>
                            <hr>
                            <form action="{{ route('create-kategori') }}" method="POST">
                                @csrf
                                <div class="">
                                    <label for="nama_kategori">Nama Kategori<span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" placeholder="Masukkan nama kategori" required name="nama_kategori" id="nama_kategori">
                                </div>
                                
                                <div class="mt-2">
                                    <button class="btn btn-success">Simpan</button>
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
                                <th>Nama kategori</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            @foreach ($kategori as $item)
                            <tr>
                                <td>{{ $loop->iteration . '.' }}</td>
                                <td>{{ $item->nama_kategori }}</td>
                                <td>
                                    <button class="btn btn-info modal-open" data-modal="{{ 'edit' . $item->kategori_id }}"><i data-feather="edit"></i></button>
                                    <button class="btn btn-danger modal-open" data-modal="{{ 'delete' . $item->kategori_id }}"><i data-feather="trash-2"></i></button>
                                    
                                    {{-- edit modal --}}
                                    <div id="{{ 'edit'.$item->kategori_id }}" class="modal">
                                        <div class="modal-content">
                                            <span class="close" data-modal="{{ 'edit'.$item->kategori_id }}">&times;</span>
                                            <h2>Update kategori</h2>
                                            <hr>
                                            <form action="{{ route('update-kategori', $item->kategori_id) }}" method="POST">
                                                @csrf
                                                <div class="">
                                                    <label for="nama_kategori">Nama kategori<span class="text-danger">*</span></label>
                                                    <input class="form-control" value="{{ $item->nama_kategori }}" type="text" placeholder="Masukkan nama kategori" required name="nama_kategori" id="nama_kategori">
                                                </div>
                                                
                                                <div class="mt-3">
                                                    <button type="submit" class="btn btn-info">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                     {{-- delete modal --}}
                                     <div id="{{ 'delete'.$item->kategori_id }}" class="modal">
                                        <div class="modal-content">
                                            <span class="close" data-modal="{{ 'delete'.$item->kategori_id }}">&times;</span>
                                            <h3>Delete Kategori</h3>
                                            <hr>
                                            <div class="">
                                                <form action="{{ route('delete-kategori', $item->kategori_id) }}" method="POST">
                                                    @csrf
                                                    <p>Yakin untuk menghapus <strong>{{ $item->nama_kategori }}</strong></p>
                                                    
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