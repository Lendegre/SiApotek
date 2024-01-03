@extends('layouts.app')

@section('content-app')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-head">
                    <div class="card-body">

                        <form action="{{ Route('filter-purchase') }}" method="get">
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
                            <a href="{{ route('purchase-pdf', ['tanggalAwal' => $tanggalAwal, 'tanggalAkhir' => $tanggalAkhir]) }}" class="btn btn-primary" target="_blank">Cetak PDF</a>
                        </div>

                        <div class="table-responsive">
                            <table class="table" id="data">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No Faktur</th>
                                        <th>Tanggal</th>
                                        <th>Supplier</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th>Total</th>
                                        <!-- Tambahkan kolom-kolom lain sesuai kebutuhan -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($barangmasuk as $bm)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $bm->no_faktur }}</td>
                                            <td>{{ $bm->tgl_trm }}</td>
                                            <td>{{ $bm->purchase->supplier->nama_supplier }}</td>
                                            <td>{{ $bm->nama_brg }}</td>
                                            <td>{{ $bm->jumlah_trm }}</td>
                                            <td>{{ $bm->h_beli }}</td>
                                            <td>{{ $bm->total }}</td>
                                            <!-- Tambahkan data kolom lain sesuai kebutuhan -->
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
