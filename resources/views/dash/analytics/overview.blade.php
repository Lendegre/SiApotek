@extends('layouts.app')

@section('content-app')
<div class="row">
    <div class="d-flex">
        <div class="w-100">
            <div class="row">
                <div class="col-xl-4 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col mt-0">
                                    <h5 class="card-title">Supplier</h5>
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
                                    <h5 class="card-title">Pengguna</h5>
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
                                    <h5 class="card-title">Barang</h5>
                                </div>                       
                                <div class="col-auto">
                                    <div class="stat text-primary">
                                        <i class="align-middle" data-feather="package"></i>
                                    </div>
                                </div>
                            </div>
                            <h1 class="mt-1 mb-3">{{ $count_product }}</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col mt-0">
                                    <h5 class="card-title">Kedaluwarsa</h5>
                                </div>
                                <div class="col-auto">
                                    <div class="stat text-primary">
                                        <i class="align-middle" data-feather="alert-circle"></i>
                                    </div>
                                </div>
                            </div>
                            <h1 class="mt-1 mb-3">{{ $almostExp }}</h1>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col mt-0">
                                    <h5 class="card-title">Stok</h5>
                                </div>
                                <div class="col-auto">
                                    <div class="stat text-primary">
                                        <i class="align-middle" data-feather="box"></i>
                                    </div>
                                </div>
                            </div>
                            <h1 class="mt-1 mb-3">{{ $totalStok }}</h1>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col mt-0">
                                    <h5 class="card-title">Habis</h5>
                                </div>
                                <div class="col-auto">
                                    <div class="stat text-primary">
                                        <i class="align-middle display-7" data-feather="slash"></i>
                                    </div>
                                </div>
                            </div>
                            <h1 class="mt-1 mb-3">{{ $lowStock }}</h1>
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
            <div class="card-header">Grafik Penjualan</div>
            <div class="card-body">
                <div id="grafik"></div>
            </div>
        </div>
    </div>
</div>

{{-- <div class="row">
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
                                <th>Kedaluwarsa</th>
                                <th>Stok</th>
                                <th>Isi dalam kemasan</th>
                                <th>Bentuk Sediaan</th>
                                <th>Harga Beli</th>
                                <th>Harga Jual</th>
                                <th>Satuan Jual</th>
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
                                <td>{{ $item->tanggal_kedaluwarsa }}</td>
                                <td>{{ $item->stok . ' '}} {{ $item->satuan_jual }} <strong>/ {{ $item->satuan->satuan_barang }}</strong></td>
                                <td>{{ $item->isi . ' '}} {{ $item->satuan_jual }}</td>
                                <td>{{ $item->bentuk }}</td>
                                <td>Rp. {{ number_format($item->harga_beli, 0, ',', '.') }}/ {{ $item->satuan->satuan_barang}}</td>
                                <td>Rp. {{ number_format($item->harga_jual, 0, ',', '.') }} <strong>/{{ $item->satuan_jual }}</strong></td>
                                <td>{{ $item->satuan_jual }}</td>
                                <td>{{ $item->kategori->nama_kategori }}</td>
                                <td>{{ $item->golongan->jenis_golongan }}</td>
                                <td>{{ $item->minimal_stok }} {{ $item->satuan_jual }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<script src="https://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript">
    var pendapatan = <?php echo json_encode($harga) ?>;
    var bulan = <?php echo json_encode($bulan) ?>;
    Highcharts.chart('grafik', {
        title : {
            text: 'Grafik Pendapatan Bulanan'
        },
        xAxis : {
            categories : bulan
        },
        yAxis : {
            title: {
                text : 'Nominal Pendapatan Bulanan'
            }
        },
        plotOptions: {
                series: {
                    allowPointSelect: true
                }
            },
        series: [
        {
            name: 'Nominal Pendapatan',
            data: pendapatan
        }
        ]
        
    });
</script>
@endsection
