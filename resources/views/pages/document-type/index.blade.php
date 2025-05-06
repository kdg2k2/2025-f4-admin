@extends('layout.index')
@section('content')
    <div class="page-body">
        <div class="container-fluid pt-4">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                            <h3>Danh sách loại tài liệu</h3>
                            <div>
                                <a href="{{ route('document.type.create') }}" class="btn btn-outline-primary rounded-pill"
                                    data-bs-toggle="tooltip" data-placement="top" title="Thêm mới">
                                    <i class="fal fa-plus-circle"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="datatable"></table>
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
        const listUrl = @json(route('document.type.list'));
        const editUrl = @json(route('document.type.edit'));
        const destroyUrl = @json(route('document.type.destroy'));

        const renderTable = (param) => {
            destroyDataTable(datatable);
            const dataTable = createDataTableServerSide(datatable, listUrl, [{
                    data: 'name',
                    title: 'Tên lĩnh vực',
                },
                {
                    data: 'field',
                    title: 'Lĩnh vực',
                },
                {
                    data: 'actions',
                    title: 'Hành động',
                },
            ], (item) => ({
                name: item.name ?? '',
                field: item.field?.name ?? '',
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
            }), param);
        }

        window.main = () => {
            renderTable({
                paginate: 1
            });
        }

        $(document).ready(() => {
            refreshSumoSelect()
            main();
        })
    </script>
@endsection
