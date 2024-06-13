@extends('index')

@section('content_header')
    <div class="col-md-6">
        <h3>リフレッシュトークン取得</h3>
    </div>
@endsection

@section('content')
    <div class="col-12">
        <div class="row">
            <div class="{{ is_null($quants_method) ? 'col-md-6' : 'col-md-10' }}">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('finance.store_config') }}">
                            <div class="form-group">
                                <label for="" class="form-label small">Email</label>
                                <input type="text" name="email" class="form-control" value="">
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
                @if(!is_null($quants_method))
                <div class="card">
                    <div class="card-body">
                        <dl class="row">
                            <dt class="col-md-2 small font-weight-bold">Email</dt>
                            <dd class="col-md-4 small">{{ $quants_method->email }}</dd>
                            <dt class="col-md-2 small font-weight-bold">パスワード</dt>
                            <dd class="col-md-4 small">{{ Str::limit($quants_method->password, 3, '***') }}</dd>
                            <dt class="col-md-2 small font-weight-bold">IDトークン</dt>
                            <dd class="col-md-4 small">{{ Str::limit($quants_method->id_token, 10, '***')}}</dd>
                            <dt class="col-md-2 small font-weight-bold">ステータス</dt>
                            <dd class="col-md-4 small">{{ \App\Enums\QuantsMethodStatus::getDescription($quants_method->status) }}</dd>
                            <dt class="col-md-2 small font-weight-bold">更新日時</dt>
                            <dd class="col-md-4 small">{{ $quants_method->updated_at }}</dd>
                        </dl>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection