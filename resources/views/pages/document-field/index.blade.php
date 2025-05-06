@extends('layout.index')
@section('content')
    <div class="page-body">
        <div class="container-fluid pt-4">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                            <h3>Danh sách</h3>
                            <div>
                                <a href="{{ route('document.field.create') }}" class="btn btn-outline-primary rounded-pill"
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
        const listUrl = @json(route('document.field.list'));
        const editUrl = @json(route('document.field.edit'));
        const destroyUrl = @json(route('document.field.destroy'));

        const renderTable = (param) => {
            destroyDataTable(datatable);
            const dataTable = createDataTableServerSide(datatable, listUrl, [{
                    data: 'name',
                    title: 'Tên lĩnh vực',
                },
                {
                    data: 'actions',
                    title: 'Hành động',
                },
            ], (item) => ({
                name: item.name ?? '',
                type: item.type?.name ?? '',
                price: formatNumber(item.price) ?? '',
                uploader: item.uploader?.name ?? '',
                actions: `
                        <div class="text-center">
                            <a href="${editUrl}?id=${item.id}" title="Cập nhật"
                                class="btn btn-sm btn-outline-warning rounded-pill mb-1" data-bs-toggle="tooltip"
                                data-placement="top">
                                <i class="fal fa-edit"></i>
                            </a>
                            <a title="Xóa" data-href="${destroyUrl}?id=${item.id}" data-onsuccess="main" data-bs-toggle="modal" data-bs-target="#confirm-delete" title="Xóa" class="btn btn-sm btn-outline-danger rounded-pill mb-1" data-bs-toggle="tooltip" data-placement="top">
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
