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
                            <p>Default password dari akun yang baru dibuat adalah username akun.</p>
                            
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
                                <button class="btn btn-info">
                                    <i data-feather="edit"></i>
                                </button>
                                
                                <button class="btn btn-danger">
                                    <i data-feather="trash"></i>
                                </button>
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