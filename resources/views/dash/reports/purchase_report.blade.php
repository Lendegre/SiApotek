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
                            @if($tanggalAwal && $tanggalAkhir)
                                <a type="button" href="{{ route('purchase-pdf', ['tanggalAwal' => $tanggalAwal, 'tanggalAkhir' => $tanggalAkhir]) }}" class="btn btn-primary" target="_blank">Cetak PDF</a>
                            @else
                                <button class="btn btn-primary" disabled>Cetak PDF</button>
                            @endif
                        </div>

                        <div class="table-responsive">
                            <table class="table" id="data">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No Faktur</th>
                                        <th>Tanggal</th>
                                        <th>Supplier</th>
                                        <th>Total</th>
                                        <th>Aksi</th>
                                        <!-- Tambahkan kolom-kolom lain sesuai kebutuhan -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($faktur as $bm)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $bm->no_faktur }}</td>
                                            <td>{{ $bm->tgl_trm }}</td>
                                            <td>{{ $bm->purchase->supplier->nama_supplier }}</td>
                                            <td>{{ $bm->total }}</td>
                                            <td>
                                                <a href="{{ route('detail-faktur', $bm->purchase_id) }}" class="btn btn-warning"><i data-feather="eye"></i></a>
                                            </td>
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
