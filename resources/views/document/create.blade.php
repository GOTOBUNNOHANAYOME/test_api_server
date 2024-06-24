@extends('index')

@section('content_header')
    <div class="col-md-6">
        <h3>財務諸表取得</h3>
    </div>
@endsection

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('document.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <label for="" class="small">ティッカーコード or 企業</label>
                            <input type="text" name="code" class="form-control">
                            <button type="submit" class="btn btn-sm btn-primary float-right mt-3">取得</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection