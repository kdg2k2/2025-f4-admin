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
                                <h3>Cập nhật tài khoản admin</h3>
                                <div>
                                    <a href="{{ route('admins.index') }}" class="btn btn-primary">Danh sách</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form id="post-form">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">
                                                Họ tên
                                            </label>
                                            <input class="form-control" name="name" value="{{ $data->name }}" required>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">
                                                Email
                                            </label>
                                            <input type="email" class="form-control" name="email"
                                                value="{{ $data->email }}" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Địa chỉ</label>
                                            <input type="text" class="form-control" name="address"
                                                value="{{ $data->address }}">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">
                                                Đơn vị
                                            </label>
                                            <select required class="form-control" name="id_unit">
                                                @foreach ($units as $u)
                                                    <option value="{{ $u['id'] }}"
                                                        @if ($u['id'] == $data->id_unit) selected @endif>
                                                        {{ $u['name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">
                                                Mật khẩu
                                            </label>
                                            <input type="password" class="form-control" name="password" value="">
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Hình ảnh</label>
                                            <input type="file" class="form-control" name="path">
                                        </div>
                                    </div>

                                    <div class="form-footer text-right">
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
        const id = @json($data->id);
        const listUrl = @json(route('admins.index'));
        const updateUrl = @json(route('api.update')) + '?id=' + id;

        $(document).ready(function() {
            $("#post-form").on("submit", async function(e) {
                try {
                    e.preventDefault();
                    const formData = new FormData(this);

                    if (!formData.get("path")) formData.delete("path");
                    if (!formData.get("password")) formData.delete("password");

                    const {
                        message
                    } = await http.patch(updateUrl, formData);

                    alertSuccess(message);
                    setTimeout(() => (window.location.href = listUrl), 300);
                } catch (error) {
                    const {
                        message
                    } = error.responseJSON;
                    alertErr(message);
                }
            });
        });
    </script>
@endsection
