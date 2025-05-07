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
                                <h3>Cập nhật gói dịch vụ</h3>
                                <div>
                                    <a href="{{ route('package.index') }}" class="btn btn-primary">Danh sách</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form id="post-form">
                                    <div class="row">
                                        <div class="col-md-6 col-12 mb-3">
                                            <label for="name" class="form-label">
                                                Tên gói dịch vụ
                                            </label>
                                            <input required type="text" class="form-control" name="name"
                                                value="{{ $data['name'] }}">
                                        </div>
                                        <div class="col-md-6 col-12 mb-3">
                                            <label for="download_document_limit" class="form-label">
                                                Giới hạn lượt tải
                                            </label>
                                            <input required type="text" class="form-control"
                                                name="download_document_limit"
                                                value="{{ $data['download_document_limit'] }}"
                                                onkeypress="return /[0-9]/i.test(event.key)">
                                        </div>
                                        <div class="col-md-6 col-12 mb-3">
                                            <label for="price" class="form-label">
                                                Giá tiền
                                            </label>
                                            <input required type="text" class="form-control" name="price"
                                                value="{{ $data['price'] }}" onkeypress="return /[0-9]/i.test(event.key)">
                                        </div>
                                        <div class="col-md-6 col-12 mb-3">
                                            <label for="duration_days" class="form-label">
                                                Số ngày hiệu lực
                                            </label>
                                            <input type="text" class="form-control" name="duration_days"
                                                value="{{ $data['duration_days'] }}"
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
    <script>
        const listUrl = @json(route('package.index'));
        const updateUrl = @json(route('package.update'))+'?id='+@json($data['id']);

        $(document).ready(function() {
            $("#post-form").on("submit", async function(e) {
                try {
                    e.preventDefault();
                    const formData = new FormData(this);

                    const {
                        message
                    } = await http.patch(updateUrl, formData, @json(csrf_token()));

                    alertSuccess(message);

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
