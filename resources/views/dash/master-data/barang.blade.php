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
                    <button class="btn text-light modal-open" data-modal="import" style="background: #222e5c"><i data-feather="upload"></i> 
                        Import Data
                    </button>
                    
                    <div id="create" class="modal">
                        <div class="modal-content">
                            <span class="close" data-modal="create">&times;</span>
                            <h2>Ini adalah Modal 1</h2>
                            <p>Isi Modal 1 akan ditampilkan di sini.</p>
                        </div>
                    </div>
                    <div id="import" class="modal">
                        <div class="modal-content">
                            <span class="close" data-modal="import">&times;</span>
                            <h2>Ini adalah Modal Import</h2>
                            <p>Isi Modal Import akan ditampilkan di sini.</p>
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

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection