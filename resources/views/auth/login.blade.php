@extends('layout.master')
@section('main')
    <div class="container-fluid p-0">
        <div class="login-card login-dark">
            <div>
                <div>
                    <a class="logo" href="/">
                        <img width="300" class="img-fluid for-light m-auto" src="{{ env('APP_LOGO') }}" alt="looginpage" />
                        <img width="300" class="img-fluid for-dark" src="{{ env('APP_LOGO') }}" alt="logo" />
                    </a>
                </div>
                <div class="card border mb-0">
                    <div class="card-body p-sm-6">
                        <h3 class="mb-1">Đăng nhập</h3>
                        <p class="mb-4 tx-muted">Đăng nhập tài khoản để sử dụng dịch vụ.</p>
                        <form class="form-horizontal" action="{{ route('auth.post.login') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label class="mb-2 fw-500">Email</label>
                                        <input class="form-control ms-0" name="email" type="email"
                                            placeholder="Enter your Email" required>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label class="mb-2 fw-500">Mật khẩu</label>
                                        <div class="input-group">
                                            <input class="form-control ms-0 border-end-0" name="password" type="password"
                                                placeholder="Enter your Password" id="password" required>
                                            <a href="javascript:void(0)" class="input-group-text bg-transparent tx-muted">
                                                <i class="fa-light fa-eye" id="showPassword"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="d-flex mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember"
                                                id="flexCheckDefault">
                                            <label class="form-check-label tx-15" for="flexCheckDefault"> Ghi nhớ </label>
                                        </div>
                                    </div>
                                    <div class="d-grid mb-3">
                                        <button type="submit" class="btn btn-primary">Đăng nhập</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/show-password.js"></script>
@endsection
