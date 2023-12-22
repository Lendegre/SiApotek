@extends('layouts.app')

@section('content-app')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {{-- Data Table Faktur --}}
                    <div class="mt-2 table-responsive">
                        <table class="table table-striped" id="data">
                            <thead>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    Tambah Faktur
                                </button>
                                <tr class="border text-center">
                                    <th class="border">No</th>
                                    <th class="border">No Faktur</th>
                                    <th class="border">Supplier</th>
                                    <th class="border">Tanggal Terima</th>
                                    <th class="border">Tanggal Jatuh Tempo</th>
                                    <th class="border">Status Bayar</th>
                                    <th class="border">Grand Total</th>
                                    <th class="border">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                {{-- @php
                                $models = ['Supplier', 'Kategori', 'Bentuk Sediaan', 'Satuan', 'Golongan']
                                @endphp --}}

                                @foreach ($barangmasuk->unique('no_faktur') as $bm)
                                    <tr class="border text-center">
                                        <td class="border">{{ $loop->iteration }}</td>
                                        <td class="border">{{ $bm->no_faktur }}</td>
                                        <td class="border">{{ $bm->purchase->supplier->nama_supplier }}</td>
                                        <td class="border">{{ $bm->tgl_trm }}</td>
                                        <td class="border">{{ $bm->tgl_tempo }}</td>
                                        <td class="border">{{ $bm->sbayar }}</td>
                                        <td class="border">Rp. {{ $bm->g_total }}</td>
                                        <td class="border">
                                            <button class="btn btn-info modal-open" data-modal="{{ 'edit'.$bm->purchase_id }}"><i data-feather="edit"></i></button>
                                            <a href="{{ route('detail-faktur', $bm->purchase_id) }}" class="btn btn-warning"><i data-feather="eye"></i></a>
                                            <button class="btn btn-danger modal-open" data-modal="{{ 'delete'.$bm->purchase_id }}"><i data-feather="trash-2"></i></button>

                                            {{-- edit modal --}}
                                            <div id="{{ 'edit'.$bm->purchase_id }}" class="modal">
                                                <div class="modal-content">
                                                    <span class="close" data-modal="{{ 'edit'.$bm->purchase_id }}">&times;</span>
                                                    <h2>Edit Data Faktur</h2>
                                                    <hr>
                                                    <form action="{{ route('update-faktur-product', $bm->purchase_id) }}" method="post" id="multiplicationForm">
                                                        @csrf
                                                        <div class="row justify-content-around mt-2">
                                
                                                            <input type="hidden" name="purchase_id" value="{{ $bm->purchase_id }}">
                                                            {{-- <input type="hidden" name="purchase_product_id" value="{{ $faktur->purchase_product->purchase_product_id }}"> --}}
                                
                                                            <div class="col-md-4">
                                                                <div class="mb-3">
                                                                    <label for="no_faktur" class="form-label">No. Faktur</label>
                                                                    <input type="string" class="form-control @error('no_faktur') is-invalid @enderror" value="{{ $bm->no_faktur }}" id="no_faktur" name="no_faktur">
                                                                    @error('no_faktur')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                        @enderror
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="sbayar" class="form-label">Status Pembayaran</label>
                                                                    <select required class="form-control" name="sbayar" id="sbayar">
                                                                        <option value="">-Pilih Status Pembayaran-</option>
                                                                        <option value="COD" {{ old('sbayar') == 'COD' ? 'selected' : '' }}>COD</option>
                                                                        <option value="Kredit" {{ old('sbayar') == 'Kredit' ? 'selected' : '' }}>Kredit</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="mb-3">
                                                                    <label for="tgl_trm" class="form-label">Tanggal Terima</label>
                                                                    <input type="date" class="form-control" value="{{ $bm->tgl_trm }}" id="tgl_trm" name="tgl_trm">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="tgl_tempo" class="form-label">Tanggal Pelunasan</label>
                                                                    <input type="date" class="form-control" value="{{ $bm->tgl_tempo }}" id="tgl_tempo" name="tgl_tempo">
                                                                </div>
                                                            </div>  
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </form>
                                                </div>
                                            </div>

                                            {{-- delete modal --}}
                                            <div id="{{ 'delete'.$bm->purchase_id }}" class="modal">
                                                <div class="modal-content">
                                                    <span class="close" data-modal="{{ 'delete'.$bm->purchase_id }}">&times;</span>
                                                    <h2>Hapus Nomor Faktur</h2>
                                                    <hr>
                                                    <form action="{{ route('delete-faktur', $bm->purchase_id) }}" method="POST">
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

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">
                                        <h2>Form Tambah Faktur</h2>
                                    </h5>
                                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('create_faktur') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="mb-3">
                                                <label for="purchase_id" class="form-label">Nomor Surat</label>
                                                <select class="form-select @error('purchase_id') is-invalid @enderror" id="purchase_id" name="purchase_id">
                                                    <option value="">-Pilih Nomor Surat-</option>
                                                    @foreach ($no_surat as $surat)
                                                        <option value="{{ $surat->purchase_id }}" {{ old('purchase_id') == $surat->purchase_id ? 'selected' : '' }}>{{ $surat->no_surat }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('purchase_id')
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="justify-content-between">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="my-3 btn btn-primary">Lanjut</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
