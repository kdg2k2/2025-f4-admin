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
                            <h3>Danh sách</h3>
                            <div>
                                <a href="{{ route('admins.create') }}" class="btn btn-primary">Thêm mới</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="datatable">
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
        const listUrl = @json(route('api.list'));
        const editUrl = @json(route('admins.edit'));
        const deleteUrl = @json(route('api.delete'));

        const initDataTable = () => {
            destroyDataTable(datatable);

            createDataTableServerSide(datatable, listUrl, [{
                    data: 'path',
                    title: 'Ảnh đại diện',
                }, {
                    data: 'name',
                    title: 'Họ tên',
                },
                {
                    data: 'email',
                    title: 'Email',
                },
                {
                    data: 'address',
                    title: 'Địa chỉ',
                },
                {
                    data: 'unit',
                    title: 'Đơn vị',
                },
                {
                    data: 'actions',
                    title: 'Hành động',
                },
            ], (item) => ({
                path: item.path ?
                    `<div class="text-center"><img style="width:100px; max-height: 120px;" src="${item.path}" alt="user"></div>` :
                    '',
                name: item.name ?? '',
                email: item.email ?? '',
                address: item.address ?? '',
                unit: item.unit?.name ?? '',
                actions: `
                    <div class="text-center">
                        <a href="${editUrl}?id=${item.id}" title="Cập nhật"
                            class="btn btn-sm btn-outline-warning rounded-pill mb-1" data-bs-toggle="tooltip"
                            data-placement="top">
                            <i class="fal fa-edit"></i>
                        </a>
                        <a title="Xóa" data-href="${deleteUrl}?id=${item.id}" data-onsuccess="main" data-bs-toggle="modal" data-bs-target="#confirm-delete" title="Xóa" class="btn btn-sm btn-outline-danger rounded-pill mb-1" data-bs-toggle="tooltip" data-placement="top">
                            <i class="fal fa-trash-alt"></i>
                        </a>
                    </div>
                `
            }), {
                paginate: 1
            });
        }

        window.main = () => {
            initDataTable();
        };

        $(document).ready(function() {
            main();
        });
    </script>
@endsection
