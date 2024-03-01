@extends('layouts.app')

@section('content-app')

<div class="row">
    <div class="d-flex">
        <div class="w-100">
            <div class="row">
                <div class="col-xl-4 col-12">
                    <div class="card bg bg-secondary">
                        <div class="card-body">
                            <div class="row">
                                <div class="col mt-0">
                                    <h5 class="card-title text-light">Persetujuan Surat</h5>
                                </div>
                                <div class="col-auto">
                                    <div class="stat text-light">
                                        <i class="align-middle size-18" data-feather="file-text"></i>
                                    </div>
                                </div>
                            </div>
                                <h1 class="mt-1 mb-3"><strong>{{ $count_pending }}</strong></h1>
                        </div>
                    </div>
                </div>       
                <div class="col-xl-4 col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col mt-0">
                                    <h5 class="card-title">Surat Pesanan Ditolak</h5>
                                </div>                            
                                <div class="col-auto">
                                    <div class="stat text-primary">
                                        <i class="align-middle" data-feather="slash"></i>
                                    </div>
                                </div>
                            </div>
                            <h1 class="mt-1 mb-3"><strong>{{ $count_tolak }}</strong></h1>
                        </div>
                    </div>
                </div>        
                <div class="col-xl-4 col-12">
                    <div class="card bg bg-primary">
                        <div class="card-body">
                            <div class="row">
                                <div class="col mt-0">
                                    <h5 class="card-title text-light">Barang</h5>
                                </div>                       
                                <div class="col-auto">
                                    <div class="stat text-primary">
                                        <i class="align-middle" data-feather="package"></i>
                                    </div>
                                </div>
                            </div>
                            <h1 class="mt-1 mb-3"><strong>{{ $count_product }}</strong></h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4 col-12">
                    <div class="card bg bg-danger">
                        <div class="card-body">
                            <div class="row">
                                <div class="col mt-0">
                                    <h5 class="card-title text-light">Kedaluwarsa</h5>
                                </div>
                                <div class="col-auto">
                                    <div class="stat text-primary">
                                        <i class="align-middle" data-feather="alert-circle"></i>
                                    </div>
                                </div>
                            </div>
                            <h1 class="mt-1 mb-3"><strong>{{ $almostExp }}</strong></h1>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-12">
                    <div class="card bg bg-success">
                        <div class="card-body">
                            <div class="row">
                                <div class="col mt-0">
                                    <h5 class="card-title text-light">Stok</h5>
                                </div>
                                <div class="col-auto">
                                    <div class="stat text-primary">
                                        <i class="align-middle" data-feather="box"></i>
                                    </div>
                                </div>
                            </div>
                            <h1 class="mt-1 mb-3"><Strong>{{ $totalStok }}</Strong></h1>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-12">
                    <div class="card bg bg-warning">
                        <div class="card-body">
                            <div class="row">
                                <div class="col mt-0">
                                    <h5 class="card-title text-light">Habis</h5>
                                </div>
                                <div class="col-auto">
                                    <div class="stat text-primary">
                                        <i class="align-middle display-7" data-feather="x-circle"></i>
                                    </div>
                                </div>
                            </div>
                            <h1 class="mt-1 mb-3"><strong>{{ $lowStock }}</strong></h1>
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
                <h3 class="mb-4"><strong>Data Barang</strong></h3>
                <div class="table-responsive"> 
                    <table class="table table-striped">
                        <div class="col-md-4 d-flex my-3">
                            <input type="text" class="form-control mx-2 " id="search" name="search" placeholder="Cari">
                        </div>
                        <thead>
                            <tr style="white-space: nowrap">
                                <th>No.</th>
                                <th>Nama Barang</th>
                                <th>Supplier</th>
                                <th>Kedaluwarsa</th>
                                <th>Stok</th>
                                <th>Isi dalam kemasan</th>
                                <th>Bentuk Sediaan</th>
                                <th>Harga Jual</th>
                                <th>Satuan Jual</th>
                                <th>Satuan Beli</th>
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
                                <td>{{ $item->tanggal_kedaluwarsa }}</td>
                                {{-- <td>{{ $barang->total_jumlah . ' '}} {{ $barang->satuan->satuan_barang }}</td> --}}
                                <td>{{ $item->stok}} {{ $item->satuan_jual }}</td>
                                <td>{{ $item->isi . ' '}} {{ $item->satuan_jual }} <strong>/ {{ $item->satuan->satuan_barang }}</strong></td>
                                <td>{{ $item->bentuk->nama_bentuk}}</td>
                                {{-- <td>Rp. {{ number_format($barang->harga_beli, 0, ',', '.') }}/{{ $barang->satuan->satuan_barang }}</td> --}}
                                <td>Rp. {{ number_format($item->harga_jual, 0, ',', '.') }} <strong>/{{ $item->satuan_jual }}</strong></td>
                                <td>{{ $item->satuan_jual }}</td>
                                <td>{{ $item->satuan->satuan_barang }}</td>
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
<script>
    document.getElementById('search').addEventListener('input', function() {
        let searchText = this.value.toLowerCase();
        let rows = document.querySelectorAll('tbody tr');
        rows.forEach(row => {
            let text = row.textContent.toLowerCase();
            if(text.includes(searchText)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>
@endsection
