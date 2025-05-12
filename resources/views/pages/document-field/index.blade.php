@extends('layout.index')
@section('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
@endsection
@section('content')
    <div class="page-body">
        <div class="container-fluid pt-4">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                            <h3>Danh sách lĩnh vực</h3>
                            <div>
                                <a href="{{ route('document.field.create') }}" class="btn btn-outline-primary rounded-pill"
                                    data-bs-toggle="tooltip" data-placement="top" title="Thêm mới">
                                    <i class="fal fa-plus-circle"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="datatable">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Tên lĩnh vực</th>
                                            <th>Bg-class</th>
                                            <th>Tx-class</th>
                                            <th>Icon</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $item)
                                            <tr>
                                                <td style="width: 50px;" class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $item['name'] }}</td>
                                                <td>{{ $item['bg_class'] }}</td>
                                                <td>{{ $item['tx_class'] }}</td>
                                                <td class="text-center"><i style="font-size: 18px;" class="{{ $item['icon_class'] }}"></i></td>
                                                <td style="width: 100px;" class="text-center">
                                                    <div class="text-center">
                                                        <a href="{{ route('document.field.edit', ['id' => $item['id']]) }}"
                                                            title="Cập nhật"
                                                            class="btn btn-sm btn-outline-warning rounded-pill mb-1"
                                                            data-bs-toggle="tooltip" data-placement="top">
                                                            <i class="fal fa-edit"></i>
                                                        </a>
                                                        <a title="Xóa" data-toggle="tooltip" data-placement="top"
                                                            data-href="{{ route('document.field.destroy', ['id' => $item['id']]) }}"
                                                            data-onsuccess="main" data-bs-toggle="modal"
                                                            data-bs-target="#confirm-delete"
                                                            class="btn btn-sm btn-outline-danger rounded-pill mb-1"
                                                            data-bs-toggle="tooltip" data-placement="top">
                                                            <i class="fal fa-trash-alt"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
        const $datatable = $('#datatable');
        $(document).ready(() => {
            // Initialize datatable
            initDataTable($datatable);
            refreshSumoSelect()
        })
    </script>
@endsection