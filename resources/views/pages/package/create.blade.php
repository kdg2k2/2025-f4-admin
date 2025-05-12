@extends('layout.index')
@section('content')
    <div class="page-body" id="main-content">
        <div class="container-fluid">
            <div class="page-title">
            </div>
        </div>
        <div class="container-fluid">
            <div class="edit-profile">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                                <h3>Thêm mới gói dịch vụ</h3>
                                <div>
                                    <a href="{{ route('package.index') }}" class="btn btn-primary">Danh sách</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('package.store') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 col-12 mb-3">
                                            <label for="name" class="form-label">
                                                Tên gói dịch vụ
                                            </label>
                                            <input required type="text" class="form-control" name="name">
                                        </div>
                                        <div class="col-md-6 col-12 mb-3">
                                            <label for="download_document_limit" class="form-label">
                                                Giới hạn lượt tải
                                            </label>
                                            <input required type="text" class="form-control"
                                                name="download_document_limit" onkeypress="return /[0-9]/i.test(event.key)">
                                        </div>
                                        <div class="col-md-6 col-12 mb-3">
                                            <label for="price" class="form-label">
                                                Giá tiền
                                            </label>
                                            <input required type="text" class="form-control" name="price"
                                                onkeypress="return /[0-9]/i.test(event.key)">
                                        </div>
                                        <div class="col-md-6 col-12 mb-3">
                                            <label for="duration_days" class="form-label">
                                                Số ngày hiệu lực
                                            </label>
                                            <input type="text" class="form-control" name="duration_days"
                                                onkeypress="return /[0-9]/i.test(event.key)">
                                        </div>
                                    </div>
                                    <div class="form-footer text-center mt-3">
                                        <button class="btn btn-primary btn-block">Thực hiện</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
