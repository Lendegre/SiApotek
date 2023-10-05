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
                                                $models = ['Supplier', 'Kategori', 'Bentuk Sediaan', 'Satuan', 'Golongan']
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
                    @endif
                    
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