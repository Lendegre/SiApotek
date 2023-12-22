@extends('layouts.app')

@section('content-app')
<hr>
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <div class="">
                <a href="{{ route('stock-report') }}" class="btn @if($sub_page == 'stock1') btn-dark @endif">Semua Laporan</a>
                <a href="{{ route('stock-low') }}" class="btn @if($sub_page == 'stock2') btn-dark @endif">Barang Hampir Habis</a>
                <a href="{{ route('stock-exp') }}" class="btn @if($sub_page == 'stock3') btn-dark @endif">Kedaluwarsa</a>        
            </div>
            <div class="">
                <a href="{{ route('barang') }}" class="btn btn-primary">Data Barang</a>
            </div>
        </div>
        
    </div>
    
    <div class="col-12 mt-3">
        
        @if ($sub_page == 'stock2' || $sub_page == 'stock3')
        <div class="col-12 p-2 rounded my-2 text-light" style="@if($sub_page == 'stock2') background: orange; @else background: salmon; @endif">
            Terdapat <strong>{{ $info }}</strong> 
            
            @if ($sub_page == 'stock2')
                <span>barang yang mencapai minimum persediaan stok!</span>
            @else
                <span>barang yang hampir Kedaluwarsa!</span>
            @endif
        </div>
        @endif

        <div class="card">
            <div class="card-body">
                <table class="table" id="data">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Barang</th>
                            @if ($sub_page != 'stock3')
                            <th class="table-warning">Stok Saat Ini</th>
                            <th>Minimal Stok</th>
                            @endif

                            @if ($sub_page != 'stock2')                                
                            <th>Tanggal Masuk</th>
                            <th class="table-danger">Kedaluwarsa</th
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @if ($sub_page == 'stock1')
                            @foreach ($barang as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_barang }}</td>
                                    <td class="table-warning">{{ $item->isi . ' ' . $item->satuan_jual }}</td>
                                    <td>{{ $item->minimal_stok }} {{ $item->satuan_jual }}</td>
                                    <td>{{ $item->tanggal_masuk }}</td>
                                    <td class="table-danger">{{ $item->tanggal_kedaluwarsa }}</td>
                                </tr>
                            @endforeach
                        @endif
                       
                        @if ($sub_page == 'stock2')
                            @foreach ($barang as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_barang }}</td>
                                    <td class="table-warning">{{ $item->isi . ' ' . $item->satuan_jual }}</td>
                                    <td>{{ $item->minimal_stok }} {{ $item->satuan_jual }}</td>
                                </tr>
                            @endforeach
                        @endif

                        @if ($sub_page == 'stock3')
                            @foreach ($barang as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_barang }}</td>
                                    <td>{{ $item->tanggal_masuk }}</td>
                                    <td class="table-danger">{{ $item->tanggal_kedaluwarsa }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection