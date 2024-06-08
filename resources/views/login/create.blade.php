<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login - Basic</title>
    <script src="https://kit.fontawesome.com/96aa7a02df.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <div class="col-sm-offset-2 col-sm-8 mx-auto">
            <div class="card border rounded">
                <div class="card-header py-2">
                    ログイン画面
                </div>
                <div class="card-body">
                    <form action="{{ route('login_history.store') }}" method="POST">
                        @csrf
                        <div class="mt-0 mx-0">
                            <div class="panel-body">
                                <label for="email" class="col-form-label font-weight-bold">Eメールアドレス</label>
                                <div class="form-group col-md-12 px-0">
                                    <input type="text" name="email" class="form-control" id="email">
                                </div>
                                <label for="password" class="col-form-label font-weight-bold">パスワード</label>
                                <div class="form-group col-md-12 px-0">
                                    <input type="password" name="password" class="form-control" id="password">
                                </div>
                                <div class="form-group">
                                    <div class="rounded text-right">
                                        <button class="btn border">
                                            <i class="fa-solid fa-right-to-bracket"></i> ログイン
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>  
        </div>
    </div>
</body>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</html>