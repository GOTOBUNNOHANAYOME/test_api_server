@extends('index')

@section('content_header')
    <div class="col-md-6">
        <h3>IDトークン取得</h3>
    </div>
@endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('finance.get_id_token') }}">
                    <div class="col-md-6">
                        <label class="form-label">トークンの取得</label>
                        <input type="submit" class="btn btn-sm btn-primary">
                    </div>
                </form> 
            </div>
        </div>
    </div>

@endsection