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
        const listUrl = @json(route('package.list'));
        const editUrl = @json(route('package.edit'));
        const destroyUrl = @json(route('package.destroy'));

        const initDataTable = () => {
            destroyDataTable(datatable);

            createDataTableServerSide(datatable, listUrl, [{
                    data: 'name',
                    title: 'Tên gói',
                },
                {
                    data: 'download_document_limit',
                    title: 'Giới hạn tải',
                },
                {
                    data: 'price',
                    title: 'Giá tiền',
                },
                {
                    data: 'duration_days',
                    title: 'Số ngày hiệu lực',
                },
                {
                    data: 'actions',
                    title: 'Hành động',
                },
            ], (item) => ({
                name: item.name ?? '',
                download_document_limit: item.download_document_limit ?? '',
                price: item.price ?? '',
                duration_days: item.duration_days ?? '',
                actions: `
                    <div class="text-center">
                        <a href="${editUrl}?id=${item.id}" title="Cập nhật"
                            class="btn btn-sm btn-outline-warning rounded-pill mb-1" data-bs-toggle="tooltip"
                            data-placement="top">
                            <i class="fal fa-edit"></i>
                        </a>
                        <a title="Xóa" data-toggle="tooltip" data-placement="top" data-href="${destroyUrl}?id=${item.id}" data-onsuccess="main" data-bs-toggle="modal" data-bs-target="#confirm-delete" class="btn btn-sm btn-outline-danger rounded-pill mb-1">
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
