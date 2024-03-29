@extends('layouts.app')

@section('content-app')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="data">
                            <thead>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th class="text-center">Nomor Surat</th>
                                    <th class="text-center">Supplier</th>
                                    <th class="text-center">Golongan</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Keterangan</th>
                                    <th class="text-center">Tanggal Pengajuan</th>
                                    <th class="text-center">Aksi</th>
                                    <th class="text-center">Faktur</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($purchase_reports as $item)
                                    <tr>
                                        <td>{{ $loop->iteration . '.' }}</td>
                                        <td>{{ $item->no_surat }}</td>
                                        <td>{{ $item->supplier->nama_supplier }}</td>
                                        <td>{{ $item->golongan->jenis_golongan }}</td>
                                        <td>
                                            @if ($item->status == 'Pending')
                                                <span class="rounded px-3 bg-warning text-light">{{ $item->status }}</span>
                                            @elseif($item->status == 'Ditolak')
                                                <span class="rounded px-3 bg-danger text-light">{{ $item->status }}</span>
                                            @else
                                                <span class="rounded px-3 bg-success text-light">{{ $item->status }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $item->keterangan }}</td>
                                        <td>{{ $item->tgl_pengajuan }}</td>
                                        <td style="white-space: nowrap;">
                                            @if ($item->status != 'Diterima')
                                                <a href="{{ route('purchase-product', $item->no_surat) }}"
                                                    class="btn btn-primary"><i data-feather="grid"></i></a>
                                            @elseif($item->status == 'Diterima')
                                                <form action="{{ route('surat-pesanan', $item->purchase_id) }}"
                                                    method="POST" style="display: inline">
                                                    @csrf
                                                    <button formtarget="_blank" class="btn btn-info"><i
                                                            data-feather="download"></i></button>
                                                </form>
                                            @endif
                                            <a href="{{ route('detail-purchase', $item->purchase_id) }}" class="btn btn-warning"><i data-feather="eye"></i></a>
                                            <button class="btn btn-danger modal-open" data-modal="{{ 'delete' . $item->purchase_id }}"><i data-feather="trash"></i></button>
                                            <div id="{{ 'delete' . $item->purchase_id }}" class="modal">
                                                <div class="modal-content">
                                                    <span class="close"
                                                        data-modal="{{ 'delete' . $item->purchase_id }}">&times;</span>
                                                    <h3>Apakah anda yakin?</h3>
                                                    <hr>
                                                    <form
                                                        action="{{ route('delete-report-purchase', $item->purchase_id) }}"
                                                        method="POST">
                                                        @csrf
                                                        <p>Yakin untuk menghapus laporan dengan nomor surat
                                                            <strong>{{ $item->no_surat }}</strong></p>
                                                        <div class="mt-3">
                                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="col-md-2 text-center">
                                                @if ($item->status === 'Diterima')
                                                <a href="{{ route('faktur-product', $item->purchase_id) }}" class="btn btn-primary btn btn-sm"><i data-feather="plus"></i> Faktur</a>
                                                @endif
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
