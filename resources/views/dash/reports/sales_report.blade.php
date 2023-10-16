@extends('layouts.app')

@section('content-app')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-success">
                    <h4 class="text-light mb-0" style="font-weight: bold">Total Income <br> Rp. {{ number_format($income, 0, ',', '.') }}</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="data">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Konsumen</th>
                                    <th>Jenis Obat</th>
                                    <th>Harga</th>
                                    <th>Usia</th>
                                    <th>Alamat</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sales_report as $item)
                                    <tr>
                                        <td>{{ $loop->iteration . '.' }}</td>
                                        <td>{{ $item->nama_customer }}</td>
                                        <td>{{ $item->jenis_obat }}</td>
                                        <td>Rp. {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                                        <td>{{ $item->usia }}</td>
                                        <td>{{ $item->alamat }}</td>
                                        <td>
                                            @if ($item->status == 'Pending')
                                                <span class="rounded px-3 bg-warning text-light">Pending</span>           
                                            @elseif($item->status == 'Dibayar') 
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