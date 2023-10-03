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
                            <h3>Create User</h3>
                            <p>Default password dari akun yang baru dibuat adalah <strong>arfafarma23</strong>.</p>
                            <hr>
                            <form action="{{ route('create-user') }}" method="POST">
                                @csrf
                                <label for="username">Username<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" required name="username" placeholder="Masukkan username" id="username">
                                
                                
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Account</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="d-flex align-items-center">
                                <img src="{{ asset('img/profil.jpeg') }}" width="40" alt="">
                                <div class="ms-2 d-flex flex-column">
                                    <span>
                                        <strong>{{ $item->username }}</strong>
                                    </span>
                                    <span>Admin</span>
                                </div>
                            </td>
                            <td>             
                                {{-- update --}}
                                <button class="btn btn-info modal-open" data-modal="{{ 'update'.$item->user_id }}">
                                    <i data-feather="edit"></i>
                                </button>

                                <div id="{{ 'update'.$item->user_id }}" class="modal">
                                    <div class="modal-content">
                                        <span class="close" data-modal="{{ 'update'.$item->user_id }}">&times;</span>
                                        <h3>Update User</h3>
                                        <hr>
                                        <form action="{{ route('update-user', $item->user_id) }}" method="POST">
                                            @csrf
                                            <div class="">
                                                <label for="username">Username<span class="text-danger">*</span></label>
                                                <input type="text" placeholder="Masukkan username" value="{{ $item->username }}" required class="form-control" name="username" id="username">
                                            </div>
                                            <div class="mt-4">
                                                <button type="submit" class="btn btn-info">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                
                                {{-- delete --}}
                                <button class="btn btn-danger modal-open" data-modal="{{ 'delete'.$item->user_id }}">
                                    <i data-feather="trash"></i>
                                </button>

                                <div id="{{ 'delete'.$item->user_id }}" class="modal">
                                    <div class="modal-content">
                                        <span class="close" data-modal="{{ 'delete'.$item->user_id }}">&times;</span>
                                        <h3>Delete User</h3>
                                        <hr>
                                        <form action="{{ route('delete-user', $item->user_id) }}" method="POST">
                                            @csrf
                                            <div class="">
                                                <p>Apakah anda yakin untuk menghapus <strong>{{ $item->username }}</strong>?</p>
                                            </div>
                                            <div class="mt-4">
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
@endsection