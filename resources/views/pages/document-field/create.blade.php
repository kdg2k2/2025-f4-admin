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
                                <h3>Thêm mới lĩnh vực</h3>
                                <div>
                                    <a href="{{ route('document.field.index') }}" class="btn btn-primary">Danh sách</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form id="post-form">
                                    <div class="row">
                                        <div class="col-12">
                                            <label for="name" class="form-label">
                                                Tên lĩnh vực
                                            </label>
                                            <input required type="text" class="form-control" name="name">
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
        const listUrl = @json(route('document.field.index'));
        const storeUrl = @json(route('document.field.store'));

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

                    setTimeout(() => (window.location.href = listUrl), 1000);
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
