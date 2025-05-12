@extends('layout.index')
@section('header')
    <link rel="stylesheet" type="text/css" href="/template-admin/admin/css/vendors/datatables.css">
@endsection
@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                            <h3>Danh sách gói dịch vụ</h3>
                            <div>
                                <a href="{{ route('package.create') }}" class="btn btn-primary">Thêm mới</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="datatable">
                                    <thead>
                                        <tr>
                                            <th>Tên gói</th>
                                            <th>Giới hạn tải</th>
                                            <th>Giá tiền</th>
                                            <th>Số ngày hiệu lực</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($packages as $package)
                                        <tr>
                                            <td>{{ $package['name'] ?? '' }}</td>
                                            <td>{{ $package['download_document_limit'] ?? '' }}</td>
                                            <td>{{ number_format($package['price'] ?? 0, 0, ',', '.') }} VNĐ</td>
                                            <td>{{ $package['duration_days'] ?? '' }}</td>
                                            <td>
                                                <div class="text-center">
                                                    <a href="{{ route('package.edit', ['id' => $package['id']]) }}" title="Cập nhật"
                                                        class="btn btn-sm btn-outline-warning rounded-pill mb-1" data-bs-toggle="tooltip"
                                                        data-placement="top">
                                                        <i class="fal fa-edit"></i>
                                                    </a>
                                                    <a title="Xóa" data-toggle="tooltip" data-placement="top" 
                                                        data-href="{{ route('package.destroy', ['id' => $package['id']]) }}" 
                                                        data-onsuccess="main" data-bs-toggle="modal" 
                                                        data-bs-target="#confirm-delete" 
                                                        class="btn btn-sm btn-outline-danger rounded-pill mb-1">
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
       const datatable = $('#datatable');
        $(document).ready(function() {
            initDataTable(datatable)
        });
    </script>
@endsection
