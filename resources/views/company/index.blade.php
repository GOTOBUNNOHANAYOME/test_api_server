@extends('index')

@section('content_header')
    <div class="col-md-6">
        <h3>企業一覧</h3>
    </div>
@endsection

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            検索フォーム
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-xs fa-fw fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <form>
                <div class="row">
                    <div class="col-md-3">
                        <label for="code" class="small">ティッカーコード</label>
                        <input type="text" name="code" class=" form-control" value="{{ request()->query('code') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="name" class="small">企業名</label>
                        <input type="text" name="name" class=" form-control" value="{{ request()->query('name') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="sector17" class="small">17業種</label>
                        <select name="sector_17_code" id="" class="select2_form form-control">
                            <option value="" selected>全て</option>
                            @foreach (\App\Enums\Sector17::asSelectArray() as $index => $value)
                                <option value="{{ $index }}" @selected(request()->sector_17_code === (string)$index)>{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="sector33" class="small">33業種</label>
                        <select name="sector_33_code" id="" class="select2_form form-control">
                            <option value="" selected>全て</option>
                            @foreach (\App\Enums\Sector33::asSelectArray() as $index => $value)
                                <option value="{{ $index }}" @selected(request()->sector_33_code === (string)$index)>{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="market" class="small">マーケット</label>
                        <select name="market_code" id="" class="select2_form form-control">
                            <option value="" selected>全て</option>
                            @foreach (\App\Enums\Market::asSelectArray() as $index => $value)
                                <option value="{{ $index }}" @selected(request()->market_code === (string)$index)>{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">                       
                        <button type="submit" class="btn btn-sm btn-primary mx-auto px-4 d-block">
                            <i class="fas fa-search fa-fw"></i>検索
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            上場企業一覧
        </div>
        <div class="card-body">
            <div class="table-responsive">
                {{ $companies->withQueryString()->links() }}
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th class="small text-nowrap text-center font-weight-bold">ID</th>
                            <th class="small text-nowrap text-center font-weight-bold">ティッカー</th>
                            <th class="small text-nowrap text-center font-weight-bold">企業名</th>
                            <th class="small text-nowrap text-center font-weight-bold">英名</th>
                            <th class="small text-nowrap text-center font-weight-bold">17業種</th>
                            <th class="small text-nowrap text-center font-weight-bold">33業種</th>
                            <th class="small text-nowrap text-center font-weight-bold">カテゴリー</th>
                            <th class="small text-nowrap text-center font-weight-bold">マーケットコード</th>
                            <th class="small text-nowrap text-center font-weight-bold">情報適用日</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($companies as $campany)
                        <tr>
                            <td class="small align-middle text-right">{{ $campany->id }}</td>
                            <td class="small align-middle text-right">{{ $campany->code }}</td>
                            <td class="small align-middle text-center">{{ $campany->name }}</td>
                            <td class="small align-middle text-center">{{ $campany->english_name }}</td>
                            <td class="small align-middle text-center">{{ \App\Enums\Sector17::getDescription((string)$campany->sector_17_code) }}</td>
                            <td class="small align-middle text-center">{{ \App\Enums\Sector33::getDescription((string)$campany->sector_33_code) }}</td>
                            <td class="small align-middle text-center">{{ $campany->scale_category }}</td>
                            <td class="small align-middle text-center">{{ \App\Enums\Market::getDescription($campany->market_code) }}</td>
                            <td class="small align-middle text-center">{{ \Carbon\Carbon::parse($campany->listed_at)->format('Y年m月d日') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $companies->withQueryString()->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    $(document).ready(function() {
        $('.select2_form').select2({
            theme: 'bootstrap4',
            width: 'style'
        });
    });
</script>
@endpush