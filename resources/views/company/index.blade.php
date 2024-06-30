@extends('index')

@section('content_header')
    <div class="col-md-6">
        <h3>企業一覧</h3>
    </div>
@endsection

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
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
                            <th class="small text-nowrap text-center font-weight-bold">上場日</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($companies as $campany)
                        <tr>
                            <td class="small align-middle">{{ $campany->id }}</td>
                            <td class="small align-middle">{{ $campany->code }}</td>
                            <td class="small align-middle">{{ $campany->name }}</td>
                            <td class="small align-middle">{{ $campany->english_name }}</td>
                            <td class="small align-middle">{{ \App\Enums\Sector17::getDescription((string)$campany->sector_17_code) }}</td>
                            <td class="small align-middle">{{ \App\Enums\Sector33::getDescription((string)$campany->sector_33_code) }}</td>
                            <td class="small align-middle">{{ $campany->scale_category }}</td>
                            <td class="small align-middle">{{ \App\Enums\Market::getDescription($campany->market_code) }}</td>
                            <td class="small align-middle">{{ $campany->listed_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection