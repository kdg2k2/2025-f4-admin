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
                                <h3>Thêm mới tài liệu</h3>
                                <div>
                                    <a href="{{ route('document.index') }}" class="btn btn-primary">Danh sách</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form id="post-form">
                                    <div class="row">
                                        <div class="col-md-6 col-12 mb-3">
                                            <label for="title" class="form-label">
                                                Tên tài liệu
                                            </label>
                                            <input required type="text" class="form-control" name="title">
                                        </div>
                                        <div class="col-md-6 col-12 mb-3">
                                            <label for="type_id" class="form-label">
                                                Loại tài liệu
                                            </label>
                                            <select name="type_id" required>
                                                <option value="">[Chọn]</option>
                                                @foreach ($types as $item)
                                                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 col-12 mb-3">
                                            <label for="price" class="form-label">
                                                Giá
                                            </label>
                                            <input required type="text" class="form-control" name="price"
                                                onkeypress="return /[0-9]/i.test(event.key)" placeholder="Giá tài liệu">
                                        </div>
                                        <div class="col-md-6 col-12 mb-3">
                                            <label for="path" class="form-label">
                                                Chọn tệp (.pdf)
                                            </label>
                                            <input required type="file" class="form-control" name="path"
                                                accept=".pdf">
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
        const listUrl = @json(route('document.index'));
        const storeUrl = @json(route('document.store'));

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
