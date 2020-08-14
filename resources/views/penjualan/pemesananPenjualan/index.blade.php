@extends('index')
@section('content')
<style type="text/css">
    #black {
        color: black;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <form action="{{ url('/sopenjualan')}}">
                        <button class="btn btn-default" data-toggle="collapse" data-target="#filter" type="button">
                            <h2>Filter</h2>
                        </button>
                        <button class="btn btn-default" type="submit">
                            <h2>Tampilkan semua</h2>
                        </button>
                    </form>
                </div>
                <div id="filter" class="collapse">
                    <form action="{{ url('/sopenjualan/cari')}}" method="get">
                        <div class="x_content">
                            <div class="col-md-8 col-sm-8">
                                <div class="form-group">
                                    <label>Cari:</label>
                                    <input type="text" class="form-control" name="name" value="{{Request::get('name')}}" placeholder="Kode SO / Nama Pelanggan" />
                                </div>
                            </div>
                            <div class="col-md-5 col-sm-5">
                                <div class="form-group">
                                    <label for="tanggalpo">Dari :</label>
                                    <div class="input-group date" id="tanggalpo">
                                        <input type="text" class="form-control" name="mulai" value="{{ Request::get('mulai')}}" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 col-sm-5">
                                <div class="form-group">
                                    <label for="tanggalposampai">Sampai :</label>
                                    <div class="input-group date" id="tanggalposampai">
                                        <input type="text" class="form-control" name="sampai" value="{{ Request::get('mulai')}}" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-2">
                                <div class="form-group">
                                    <label for=""> </label>
                                    <div class="input-group">
                                        <!-- <input type="submit" class="btn btn-md btn-block btn-success" value="Cari"> -->
                                        <button type="submit" class="btn btn-md btn-block btn-success">
                                            <i class="fa fa-search" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Alert -->
            @if(session()->get('created'))
            <div class="alert alert-success alert-dismissible fade-show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <b>{{ session()->get('created') }}</b>
            </div>

            @elseif(session()->get('edited'))
            <div class="alert alert-info alert-dismissible fade-show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <b>{{ session()->get('edited') }}</b>
            </div>

            @elseif(session()->get('deleted'))
            <div class="alert alert-danger alert-dismissible fade-show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <b>{{ session()->get('deleted') }}</b>
            </div>

            @elseif(session()->get('error'))
            <div class="alert alert-warning alert-dismissible fade-show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <b id="black">{{ session()->get('error') }}</b>
            </div>
            @endif

            <div class="x_panel">
                <div class="x_title">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <h3>Pemesanan Penjualan</h3>
                            <p>Sales Order<p>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <br><br>
                            <a href="{{ url('/sopenjualan/create')}}" class="btn btn-primary pull-right">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="x_content">
                    <table class="table table-light" id="table">
                        <thead class="thead-light">
                            <tr>
                                <th>Kode SO</th>
                                <th>Tanggal</th>
                                <th>Tanggal Kirim</th>
                                <th>Term</th>
                                <th>Pelanggan</th>
                                <th>Gudang</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        @foreach ($pemesananpenjualan as $p)
                        <tr>
                            <td>{{ $p->KodeSO}}</td>
                            <td>{{ \Carbon\Carbon::parse($p->Tanggal)->format('d-m-Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($p->tgl_kirim)->format('d-m-Y') }}</td>
                            <td>{{ $p->term }} hari</td>
                            <td>{{ $p->NamaPelanggan }}</td>
                            <td>{{ $p->NamaLokasi  }}</td>
                            <td>Rp. {{ number_format($p->Total, 0, ',', '.') }},-</td>
                            <td>
                                <a href="{{ url('/sopenjualan/confirm/'.$p->KodeSO)}}" class="btn-xs btn btn-info" onclick="return confirm('Konfirmasi data ini?')">
                                    <i class="fa fa-check" aria-hidden="true"></i>
                                </a>
                                <a href="{{ url('/sopenjualan/show/'. $p->KodeSO )}}" class="btn-xs btn btn-primary">
                                    <i class="fa fa-eye" aria-hidden="true"></i> Lihat
                                </a>
                                <a href="{{ url('/sopenjualan/edit/'. $p->KodeSO )}}" class="btn-xs btn btn-success">
                                    <i class="fa fa-pencil" aria-hidden="true"></i> Ubah
                                </a>
                                <a href="{{ url('/sopenjualan/destroy/'.$p->KodeSO)}}" class="btn-xs btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                    <i class="fa fa-trash" aria-hidden="true"></i> Hapus
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    $('#tanggalpo').datetimepicker({
        format: 'YYYY-MM-DD'
    });

    $('#tanggalposampai').datetimepicker({
        defaultDate: new Date(),
        format: 'YYYY-MM-DD'
    });

    $('#table').DataTable({
        "order": []
    });
</script>
@endpush