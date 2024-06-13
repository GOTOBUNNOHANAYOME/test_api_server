@extends('index')

@section('content_header')
    <div class="col-md-6">
        <h3>企業情報取得</h3>
    </div>
@endsection

@section('content')
    <div class="col-12">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('company.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="" class="form-label small">企業コード</label>
                                <span class="text-danger small">*必須ではない</span>
                                <input type="text" name="email" class="form-control" value="">
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label small">日付</label>
                                <span class="text-danger small">*必須ではない</span>
                                <input type="text" name="password" class="form-control">
                            </div>
                            <div class="from-group">
                                <input type="submit" class="float-right btn btn-sm btn-primary" value="企業情報取得取得">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection