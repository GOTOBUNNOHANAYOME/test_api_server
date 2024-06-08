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
                        @if(!is_null($finance_user))
                        <span class="small text-danger">すでに登録済みです。</span>
                        @endif
                        <form action="{{ route('finance.get_refresh_token') }}">
                            <div class="form-group">
                                <label for="" class="form-label small">Email</label>
                                <input type="text" class="form-control" value="{{ !is_null($finance_user) ? $finance_user->email : '' }}">
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label small">パスワード</label>
                                <input type="text" class="form-control">
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