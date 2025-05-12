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
                            <h3>Danh sách quản trị viên</h3>
                            <div>
                                <a href="{{ route('admin.create') }}" class="btn btn-primary">Thêm mới</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="datatable">
                                    <thead>
                                        <tr>
                                            <th>Ảnh đại diện</th>
                                            <th>Họ tên</th>
                                            <th>Email</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($admins as $admin)
                                        <tr>
                                            <td>
                                                @if($admin['path'])
                                                <div class="text-center">
                                                    <img style="width:100px; max-height: 120px;" src="{{ $admin['path'] }}" alt="user">
                                                </div>
                                                @endif
                                            </td>
                                            <td>{{ $admin['name'] ?? '' }}</td>
                                            <td>{{ $admin['email'] ?? '' }}</td>
                                            <td>
                                                <div class="text-center">
                                                    <a href="{{ route('admin.edit', ['id' => $admin['id']]) }}" title="Cập nhật"
                                                        class="btn btn-sm btn-outline-warning rounded-pill mb-1" data-bs-toggle="tooltip"
                                                        data-placement="top">
                                                        <i class="fal fa-edit"></i>
                                                    </a>
                                                    <a title="Xóa" data-toggle="tooltip" data-placement="top" 
                                                        data-href="{{ route('admin.destroy', ['id' => $admin['id']]) }}" 
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
            initDataTable(datatable);
        });
    </script>
@endsection
