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
                                <h3>Thêm mới quản trị viên</h3>
                                <div>
                                    <a href="{{ route('admin.index') }}" class="btn btn-primary">Danh sách</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form id="post-form">
                                    <div class="row">
                                        <div class="col-md-6 col-12 mb-3">
                                            <label for="name" class="form-label">
                                                Tên quản trị viên
                                            </label>
                                            <input required type="text" class="form-control" name="name">
                                        </div>
                                        <div class="col-md-6 col-12 mb-3">
                                            <label for="email" class="form-label">
                                                Email
                                            </label>
                                            <input required type="text" class="form-control" name="email">
                                        </div>
                                        <div class="col-md-6 col-12 mb-3">
                                            <label for="password" class="form-label">
                                                Mật khẩu
                                            </label>
                                            <input required type="password" class="form-control" name="password">
                                        </div>
                                        <div class="col-md-6 col-12 mb-3">
                                            <label for="path" class="form-label">
                                                Chọn ảnh đại diện
                                            </label>
                                            <input required type="file" class="form-control" name="path"
                                                accept=".png,.jpg,.jpeg">
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
    <script>
        const listUrl = @json(route('admin.index'));
        const storeUrl = @json(route('admin.store'));

        $(document).ready(function() {
            $("#post-form").on("submit", async function(e) {
                try {
                    e.preventDefault();
                    const formData = new FormData(this);

                    const {
                        message
                    } = await http.post(storeUrl, formData, @json(csrf_token()));

                    alertSuccess(message);

                    this.reset();
                    refreshSumoSelect()

                    setTimeout(() => (window.location.href = listUrl), 1000);
                } catch (error) {
                    let {
                        message
                    } = error.responseJSON;

                    alertErr(message);
                }
            });
        });
    </script>
@endsection
