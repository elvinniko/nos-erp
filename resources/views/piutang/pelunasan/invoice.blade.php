@extends('index')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h1>Pelunasan Piutang</h1><br>
                    <span>Keterangan warna</span><br>
                    <span>*hijau : sudah lunas</span><br>
                    <span>*kuning : belum lunas</span><br>
                    <span>*merah : belum lunas dan lewat jatuh tempo</span><br>
                </div>
                <div class="x_body">
                    <table class="table table-light" id="table">
                        <thead class="thead-light">
                            <tr>
                                <th>No Tagihan</th>
                                <th>No SJ</th>
                                <th>Tanggal</th>
                                <th>Jatuh Tempo</th>
                                <th>Total</th>
                                <th>Total Bayar</th>
                                <th>Selisih</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invoice as $inv)
                            @if($inv->Subtotal <= 0) @continue @elseif ($inv->Subtotal <= $inv->bayar)
                                    <tr class="success">
                                        <td>{{ $inv->KodeInvoicePiutangShow}}</td>
                                        <td>{{ $inv->KodeSuratJalan}}</td>
                                        <td>{{ \Carbon\Carbon::parse($inv->Tanggal)->format('d-m-Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($inv->Tanggal)->addDays($inv->Term)->format('d-m-Y') }}</td>
                                        <td>Rp. {{ number_format($inv->Subtotal, 0, ',', '.') }},-</td>
                                        <td>Rp. {{ number_format($inv->bayar, 0, ',', '.') }},-</td>
                                        <td>Rp. {{ number_format($inv->Subtotal - $inv->bayar, 0, ',', '.')}},-</td>
                                        <td><a href="{{url('pelunasanpiutang/payment/'.$inv->KodeInvoicePiutang)}}" class="btn-sm btn-primary">
                                                <i class="fa fa-eye" aria-hidden="true"></i> Lihat
                                            </a>
                                        </td>
                                    </tr>
                                    @elseif(\Carbon\Carbon::parse($inv->Tanggal)->addDays($inv->Term) > \Carbon\Carbon::now())
                                    <tr class="warning">
                                        <td>{{ $inv->KodeInvoicePiutangShow}}</td>
                                        <td>{{ $inv->KodeSuratJalan}}</td>
                                        <td>{{ \Carbon\Carbon::parse($inv->Tanggal)->format('d-m-Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($inv->Tanggal)->addDays($inv->Term)->format('d-m-Y') }}</td>
                                        <td>Rp. {{ number_format($inv->Subtotal, 0, ',', '.') }},-</td>
                                        <td>Rp. {{ number_format($inv->bayar, 0, ',', '.') }},-</td>
                                        <td>Rp. {{ number_format($inv->Subtotal - $inv->bayar, 0, ',', '.')}},-</td>
                                        <td><a href="{{url('pelunasanpiutang/payment/'.$inv->KodeInvoicePiutang)}}" class="btn-sm btn-primary">
                                                <i class="fa fa-eye" aria-hidden="true"></i> Lihat
                                            </a>
                                        </td>
                                    </tr>
                                    @else
                                    <tr class="danger">
                                        <td>{{ $inv->KodeInvoicePiutangShow}}</td>
                                        <td>{{ $inv->KodeSuratJalan}}</td>
                                        <td>{{ \Carbon\Carbon::parse($inv->Tanggal)->format('d-m-Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($inv->Tanggal)->addDays($inv->Term)->format('d-m-Y') }}</td>
                                        <td>Rp. {{ number_format($inv->Subtotal, 0, ',', '.') }},-</td>
                                        <td>Rp. {{ number_format($inv->bayar, 0, ',', '.') }},-</td>
                                        <td>Rp. {{ number_format($inv->Subtotal - $inv->bayar, 0, ',', '.')}},-</td>
                                        <td><a href="{{url('pelunasanpiutang/payment/'.$inv->KodeInvoicePiutang)}}" class="btn-sm btn-primary">
                                                <i class="fa fa-eye" aria-hidden="true"></i> Lihat
                                            </a>
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    $('#table').DataTable({
        "order": [
            [0, "desc"]
        ]
    });
</script>
@endpush