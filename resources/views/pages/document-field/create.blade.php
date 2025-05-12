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
                                <form action="{{ route('document.field.store') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-6 mb-3">
                                            <label for="name" class="form-label">
                                                Tên lĩnh vực
                                            </label>
                                            <input required type="text" class="form-control" name="name">
                                        </div>
                                        <div class="col-6 mb-3">
                                            <label for="bg_class" class="form-label">
                                                Màu nền
                                            </label>
                                            <select name="bg_class" class="form-select">
                                                @foreach ($bgs as $bg)
                                                    <option value="{{$bg['value']}}">
                                                        <p class="{{$bg['value']}}">{{$bg['text']}}</p>
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <label for="tx_class" class="form-label">
                                                Màu chữ
                                            </label>
                                            <select name="tx_class" class="form-select">
                                                @foreach ($txs as $tx)
                                                    <option value="{{$tx['value']}}">
                                                        <p class="{{$tx['text']}}">{{$tx['value']}}</p>
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <label for="icon_class" class="form-label">
                                                Icon
                                            </label>
                                            <input type="text" class="form-control" name="icon_class"
                                                placeholder="fa-solid fa-file">
                                        </div>
                                    </div>
                                    <p>
                                        <span class="text-danger fw-bold">Chú ý:</span> Các bạn có thể tham khảo các icon tại đây: <a href="https://icons.getbootstrap.com/">https://icons.getbootstrap.com/</a>, <span class="text-danger">chỉ lấy tên class thôi.</span>
                                    </p>
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

