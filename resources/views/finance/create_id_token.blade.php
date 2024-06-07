@extends('index')

@section('content_header')
    <div class="col-md-6">
        <h3>IDトークン取得</h3>
    </div>
@endsection

@section('content')
    <div class="col-12">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('finance.get_id_token') }}">
                            <div class="col-md-12">
                                <label class="form-label small">トークンの取得</label>
                            </div>
                            <div class="col-md-12">
                                <input type="submit" class="btn btn-sm btn-primary float-right" value="トークンを取得する">
                            </div>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection