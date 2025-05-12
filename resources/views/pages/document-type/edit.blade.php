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
                                <h3>Cập nhật loại tài liệu</h3>
                                <div>
                                    <a href="{{ route('document.type.index') }}" class="btn btn-primary">Danh sách</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('document.type.update', ['id' => $data['id']]) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <label for="name" class="form-label">
                                                Tên loại tài liệu
                                            </label>
                                            <input required type="text" class="form-control" name="name"
                                                value="{{ $data['name'] }}">
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <label for="field_id" class="form-label">
                                                Loại lĩnh vực
                                            </label>
                                            <select name="field_id" required>
                                                <option value="">[Chọn]</option>
                                                @foreach ($fields as $item)
                                                    <option value="{{ $item['id'] }}"
                                                        @if ($item['id'] == $data['field_id']) selected @endif>
                                                        {{ $item['name'] }}</option>
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

@section('script')
    <!-- Removed inline JavaScript code -->
@endsection
