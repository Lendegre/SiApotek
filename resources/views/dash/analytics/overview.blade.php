@extends('layouts.app')

@section('content-app')
<div class="row">
    <div class="col-xl-12 col-xxl-5 d-flex">
        <div class="w-100">
            <div class="row">
                <div class="col-xl-4 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col mt-0">
                                    <h5 class="card-title">Suppliers</h5>
                                </div>
                                
                                <div class="col-auto">
                                    <div class="stat text-primary">
                                        <i class="align-middle" data-feather="truck"></i>
                                    </div>
                                </div>
                            </div>
                            <h1 class="mt-1 mb-3">{{ $count_supplier }}</h1>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-4 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col mt-0">
                                    <h5 class="card-title">Users</h5>
                                </div>
                                
                                <div class="col-auto">
                                    <div class="stat text-primary">
                                        <i class="align-middle" data-feather="users"></i>
                                    </div>
                                </div>
                            </div>
                            <h1 class="mt-1 mb-3">{{ $count_user }}</h1>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-4 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col mt-0">
                                    <h5 class="card-title">Products</h5>
                                </div>
                                
                                <div class="col-auto">
                                    <div class="stat text-primary">
                                        <i class="align-middle" data-feather="box"></i>
                                    </div>
                                </div>
                            </div>
                            <h1 class="mt-1 mb-3">{{ $count_product }}</h1>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <canvas style="width: 100%; object-fit: cover" id="myChart"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h3 class="mb-4"><strong>Data Barang</strong></h3>
                <div class="table-responsive"> 
                    <table class="table table-striped" id="data">
                        <thead>
                            <tr style="white-space: nowrap">
                                <th>No.</th>
                                <th>Nama Barang</th>
                                <th>Supplier</th>
                                <th>Tanggal Masuk</th>
                                <th>Kedaluwarsa</th>
                                <th>Jumlah</th>
                                <th>Stok</th>
                                <th>Harga Beli</th>
                                <th>Harga Jual</th>
                                <th>Kategori</th>
                                <th>Golongan</th>
                                <th>Minimal Stok</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            @foreach ($barang as $item)
                            <tr style="white-space: nowrap">
                                
                                <td>{{ $loop->iteration . '.' }}</td>
                                
                                <td>{{ $item->nama_barang }}</td>
                                <td>{{ $item->supplier->nama_supplier }}</td>
                                <td>{{ $item->tanggal_masuk }}</td>
                                <td>{{ $item->tanggal_kedaluwarsa }}</td>
                                <td>{{ $item->jumlah . ' '}} {{ $item->satuan->satuan_barang }}</td>
                                <td>{{ $item->isi . ' '}} {{ $item->bentuk->bentuk_barang }}</td>
                                <td>Rp. {{ number_format($item->harga_beli, 0, ',', '.') }}</td>
                                <td>Rp. {{ number_format($item->harga_jual, 0, ',', '.') }} <strong>/ isi</strong></td>
                                <td>{{ $item->kategori->nama_kategori }}</td>
                                <td>{{ $item->golongan->jenis_golongan }}</td>
                                <td>{{ $item->minimal_stok }}</td>
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

@push('chart-script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('myChart');
    
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Product Report'],
            datasets: [
            {
                label: 'Total Product',
                data: [{{ $totalProduct }}],
                backgroundColor: ['rgba(0, 150, 64, 0.2)',],
                borderColor: ['rgb(255, 99, 132)',],
                borderWidth: 1
            },
            {
                label: 'Low Stock',
                data: [{{ $lowStock }}],
                backgroundColor: ['rgba(255, 159, 64, 0.2)',],
                borderColor: ['rgb(255, 99, 132)',],
                borderWidth: 1
            },
            {
                label: 'Almost Expired',
                data: [{{ $almostExp }}],
                backgroundColor: ['rgba(255, 16, 64, 0.2)',],
                borderColor: ['rgb(255, 99, 132)',],
                borderWidth: 1
            },
        ]
            
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endpush