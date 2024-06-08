@extends('index')

@section('content_header')
    <div class="col-md-6">
        <h3>リフレッシュトークン取得</h3>
    </div>
@endsection

@section('content')
    <div class="col-12">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        @if(!is_null($quants_method))
                        <span class="small text-danger">すでに登録済みです。</span>
                        @endif
                        <form action="{{ route('finance.store_config') }}">
                            <div class="form-group">
                                <label for="" class="form-label small">Email</label>
                                <input type="text" name="email" class="form-control" value="{{ !is_null($quants_method) ? $quants_method->email : '' }}">
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label small">パスワード</label>
                                <input type="text" name="password" class="form-control">
                            </div>
                            <div class="from-group">
                                <input type="submit" class="float-right btn btn-sm btn-primary" value="リフレッシュトークン取得">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection