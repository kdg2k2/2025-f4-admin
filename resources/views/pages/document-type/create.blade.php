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
                                <h3>Thêm mới loại tài liệu</h3>
                                <div>
                                    <a href="{{ route('document.type.index') }}" class="btn btn-primary">Danh sách</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('document.type.store') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <label for="name" class="form-label">
                                                Tên loại tài liệu
                                            </label>
                                            <input required type="text" class="form-control" name="name">
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <label for="field_id" class="form-label">
                                                Loại lĩnh vực
                                            </label>
                                            <select name="field_id" required>
                                                <option value="">[Chọn]</option>
                                                @foreach ($fields as $item)
                                                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-footer text-center mt-3">
                                        <button type="submit" class="btn btn-primary btn-block">Thực hiện</button>
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
