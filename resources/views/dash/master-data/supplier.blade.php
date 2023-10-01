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
                            <h2>Ini adalah Modal 1</h2>
                            <p>Isi Modal 1 akan ditampilkan di sini.</p>
                        </div>
                    </div>
                </div>
                
                <div class="table-responsive"> 
                    <table class="table table-striped">
                        <thead>
                            <tr style="white-space: nowrap">
                                <th>No.</th>
                                <th>Nama Supplier</th>
                                <th>Nama Sales</th>
                                <th>No. Telp</th>
                                <th>Alamat</th>
                                <th class="text-center">Action</th>
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
                                <td class="text-center">
                                    <button class="btn btn-info modal-open" data-modal="edit"><i data-feather="edit"></i></button>
                                    <button class="btn btn-danger modal-open" data-modal="delete"><i data-feather="trash-2"></i></button>
                                    
                                    {{-- edit modal --}}
                                    <div id="edit" class="modal">
                                        <div class="modal-content">
                                            <span class="close" data-modal="edit">&times;</span>
                                            <h2>Ini adalah Modal 2</h2>
                                            <p>Isi Modal 2 akan ditampilkan di sini.</p>
                                        </div>
                                    </div>
                                    
                                    {{-- delete modal --}}
                                    <div id="delete" class="modal">
                                        <div class="modal-content">
                                            <span class="close" data-modal="delete">&times;</span>
                                            <h2>Ini adalah Modal 3</h2>
                                            <p>Isi Modal 3 akan ditampilkan di sini.</p>
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