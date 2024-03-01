@extends('layouts.app')

@section('content-app')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {{-- Data Table Faktur --}}
                    <div class="mt-2 table-responsive">
                        <table class="table table-striped " id="data">
                            <thead>
                                <tr class="border text-center">
                                    <th class="border border-dark text-center">No</th>
                                    <th class="border border-dark text-center">No Faktur</th>
                                    <th class="border border-dark text-center">Supplier</th>
                                    <th class="border border-dark text-center">Tanggal Terima</th>
                                    <th class="border border-dark text-center">Tanggal Jatuh Tempo</th>
                                    <th class="border border-dark text-center">Status Bayar</th>
                                    <th class="border border-dark text-center">Grand Total</th>
                                    <th class="border border-dark text-center">Foto</th>
                                    <th class="border border-dark text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                {{-- @php
                                $models = ['Supplier', 'Kategori', 'Bentuk Sediaan', 'Satuan', 'Golongan']
                                @endphp --}}

                                @foreach ($faktur as $bm)
                                    <tr class="text-center">
                                        <td class="border border-dark">{{ $loop->iteration }}</td>
                                        <td class="border border-dark">{{ $bm->no_faktur }}</td>
                                        <td class="border border-dark">{{ $bm->purchase->supplier->nama_supplier }}</td>
                                        <td class="border border-dark">{{ $bm->tgl_trm }}</td>
                                        <td class="border border-dark">{{ $bm->tgl_tempo }}</td>
                                        <td class="border border-dark">{{ $bm->sbayar }}</td>
                                        <td class="border border-dark">Rp. {{ $bm->g_total }}</td>
                                        <td class="border border-dark">
                                            <img style="max-width: 50px; max-height:50px;" src="{{ url('faktur_upload').'/'.$bm->image }}" alt="image">
                                        </td>
                                        <td class="border border-dark col-md-2">
                                            <a href="{{ route('edit-faktur', $bm->no_faktur) }}" class="btn btn-info modal-open"><i data-feather="edit"></i></a>
                                            <a href="{{ route('detail-faktur', $bm->purchase_id) }}" class="btn btn-warning"><i data-feather="eye"></i></a>
                                            {{-- <a href="{{ route('delete-faktur', $bm->no_faktur) }}" class="btn btn-danger"><i data-feather="trash"></i></a> --}}
                                            <button class="btn btn-danger modal-open" data-modal="{{ 'delete'.$bm->no_faktur }}"><i data-feather="trash-2"></i></button>

                                            {{-- delete modal --}}
                                            <div id="{{ 'delete'.$bm->no_faktur }}" class="modal">
                                                <div class="modal-content">
                                                    <span class="close" data-modal="{{ 'delete'.$bm->no_faktur }}">&times;</span>
                                                    <h2>Hapus Nomor Faktur</h2>
                                                    <hr>
                                                    <form action="{{ route('delete-faktur', $bm->no_faktur) }}" method="POST">
                                                        @csrf
                                                        <p>Yakin untuk menghapus Nomor Faktur <strong>{{ $bm->no_faktur }}</strong></p>

                                                        <div class="mt-2">
                                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- End Table Data faktur --}}
                </div>
            </div>
        </div>
    </div>
    @endsection
