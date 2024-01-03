@extends('layouts.app')

@section('content-app')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-success ">
                    {{-- <h4 class="text-light mb-0" style="font-weight: bold">Total Pendapatan <br> Rp. {{ number_format($income, 0, ',', '.') }}</h4> --}}
                    <h3 class="text-light">
                        <strong>Pendapatan : Rp. {{ isset($income['harga']) ? number_format($income['harga'], 2) : 'N/A' }}</strong>
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ Route('cari') }}" method="get">
                        @csrf
                        <div class="form-row d-flex mb-5">
                            <div class="form-group col-md-3 mb-3 mx-3">
                                <label for="tanggalAwal">Tanggal Awal:</label>
                                <div>
                                    <input type="date" class="form-control" name="tanggalAwal" id="tanggalAwal"  value="{{ old('tanggalAwal', $tanggalAwal) }}" required>
                                </div>
                            </div>
                            
                            <div class="form-group col-md-3 mb-3 mx-3">
                                <label for="tanggalAkhir">Tanggal Akhir:</label>
                                <div>
                                    <input type="date" class="form-control" name="tanggalAkhir" id="tanggalAkhir" value="{{ old('tanggalAkhir', $tanggalAkhir) }}" required>
                                </div>
                            </div>
                            <div class="col-md-3 mt-4 mx-3">
                                <button type="submit" class="btn btn-primary btn-sm rounded-3">Cari</button>
                            </div>
                        </div>
                    </form>

                    <div class="d-flex justify-content-end mb-3">
                        <a href="{{ route('sales-pdf', ['tanggalAwal' => $tanggalAwal, 'tanggalAkhir' => $tanggalAkhir]) }}" class="btn btn-primary" target="_blank">Cetak PDF</a>
                    </div>

                    <div class="table-responsive">
                        <table class="table" id="data">
                            <thead>
                                <tr style="white-space: nowrap">
                                    <th>No.</th>
                                    <th>Tanggal</th>
                                    <th>Nama Barang</th>
                                    <th>Jenis Obat</th>
                                    <th>Jumlah</th>
                                    <th>Stok</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ( $sales_report as $item)
                                    <tr style="white-space: nowrap">
                                        <td>{{ $loop->iteration . '.' }}</td>
                                        <td>{{ $item->tanggal }}</td>
                                        <td>{{ $item->barang->nama_barang }}</td>
                                        <td>{{ $item->customer->jenis_obat }}</td>
                                        <td>{{ $item->isi }}</td>
                                        <td>{{ $item->barang->isi }}</td>
                                        <td>
                                            @if ($item->customer->status == 'Pending')
                                                <span class="rounded px-3 bg-warning text-light">Pending</span>           
                                            @elseif($item->customer->status == 'Dibayar') 
                                                <span class="rounded px-3 bg-success text-light">Selesai</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->status != 'Dibayar')
                                                <a href="{{ route('order-product', $item->customer_id) }}" class="btn btn-primary"><i data-feather="grid"></i></a>
                                                <button class="btn btn-danger modal-open" data-modal="{{ 'delete'.$item->customer_id }}"><i data-feather="trash"></i></button>
                                        
                                                <div id="{{ 'delete'.$item->customer_id }}" class="modal">
                                                    <div class="modal-content">
                                                        <span class="close" data-modal="{{ 'delete'.$item->customer_id }}">&times;</span>
                                                        <h3>Apakah anda yakin?</h3>
                                                        <hr>
                                                        <form action="{{ route('delete-report-sales', $item->customer_id) }}" method="POST">
                                                            @csrf
                                                            <p>Yakin untuk menghapus laporan?</strong></p>
                                                            <div class="mt-3">
                                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            @endif
                                            <a href="{{ route('detail-order', $item->customer_id) }}" class="btn btn-warning"><i data-feather="eye"></i></a>
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