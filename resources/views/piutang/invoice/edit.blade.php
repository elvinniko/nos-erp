@extends('index')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h1>Invoice Piutang</h1>
                </div>
                <div class="x_content">
                    @foreach($invoice as $inv)
                    <form action="{{ url('invoicepiutang/update/'.$inv->KodeInvoicePiutangShow) }}" method="post" style="display:inline-block;">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="KodeInvoice" value="{{ $inv->KodeInvoicePiutangShow }}" class="form-control">
                        <div class="form-group">
                            <label>No Faktur: </label>
                            <input type="text" name="NoFaktur" value="{{ $inv->NoFaktur }}" placeholder="No Faktur" class="form-control">
                        </div>
                        <br>
                        <button class="btn btn-success" style="width:120px;">Simpan</button>
                    </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection