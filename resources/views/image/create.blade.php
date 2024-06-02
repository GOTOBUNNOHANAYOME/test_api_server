@extends('index')

@section('content_header')
    <div class="col-md-6">
        <h3>画像</h3>
    </div>
@endsection

@section('content')
    <div class="col-12">
        <div class="card col-md-6">
            <div class="card-body">
                <form action="{{ route('image.store') }}" method="POST"  enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <label for="" class="form-label small">画像選択</label>
                            <input class="form-control" type="file" name="image_file" accept="image/png, image/jpeg, image/gif, image/webp">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <input type="submit" class="btn btn-primary float-right mt-3" value="送信">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection