@extends('layout.index')
@section('content')
    <div class="page-body">
        <div class="container-fluid pt-4">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <form action="{{ route('document.index') }}" method="GET">
                            <div class="card-body row">
                                <div class="col-lg-3 col-md-6">
                                    <label for="field_id">
                                        Lĩnh vực
                                    </label>
                                    <select id="field_id" name="field_id">
                                        <option value="">[Chọn]</option>
                                        @foreach ($fields as $item)
                                            <option value="{{ $item['id'] }}" {{ request('field_id') == $item['id'] ? 'selected' : '' }}>
                                                {{ $item['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <label for="type_id">
                                        Loại tài liệu
                                    </label>
                                    <select id="type_id" name="type_id">
                                        <option value="">[Chọn]</option>
                                        @if(request('field_id'))
                                            @php
                                                $field = collect($fields)->firstWhere('id', request('field_id'));
                                            @endphp
                                            @if($field && isset($field['types']))
                                                @foreach($field['types'] as $type)
                                                    <option value="{{ $type['id'] }}" {{ request('type_id') == $type['id'] ? 'selected' : '' }}>
                                                        {{ $type['name'] }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        @endif
                                    </select>
                                </div>
                                <div class="col-lg-3 col-md-6 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fal fa-filter me-1"></i> Lọc
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                            <h3>Danh sách tài liệu</h3>
                            <div>
                                <a href="{{ route('document.create') }}" class="btn btn-outline-primary rounded-pill"
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
                                            <th>Tên tài liệu</th>
                                            <th>Loại lĩnh vực</th>
                                            <th>Loại tài liệu</th>
                                            <th>Giá</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $item)
                                        <tr>
                                            <td style="width: 50px;" class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $item['title'] }}</td>
                                            <td>{{ $item['type']['field']['name'] ?? '' }}</td>
                                            <td>{{ $item['type']['name'] ?? '' }}</td>
                                            <td>{{ number_format($item['price']) }}</td>
                                            <td style="width: 150px;" class="text-center">
                                                <div class="text-center">
                                                    <a target="_blank" href="{{ $item['path'] }}" title="Xem"
                                                        class="btn btn-sm btn-outline-success rounded-pill mb-1" data-bs-toggle="tooltip"
                                                        data-placement="top">
                                                        <i class="fal fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('document.edit', ['id' => $item['id']]) }}" title="Cập nhật"
                                                        class="btn btn-sm btn-outline-warning rounded-pill mb-1" data-bs-toggle="tooltip"
                                                        data-placement="top">
                                                        <i class="fal fa-edit"></i>
                                                    </a>
                                                    <a title="Xóa" data-toggle="tooltip" data-placement="top" 
                                                        data-href="{{ route('document.destroy', ['id' => $item['id']]) }}" 
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
        const fields = @json($fields);

        $('#field_id').on('change', function() {
            const val = $(this).val();
            const field = fields.find(f => f.id == val);
            
            // Update type select options
            let options = '<option value="">[Chọn]</option>';
            if (field && field.types) {
                options += field.types.map(type => 
                    `<option value="${type.id}">${type.name}</option>`
                ).join('');
            }
            $('#type_id').html(options);
            refreshSumoSelect();
        });

        $(document).ready(() => {
            refreshSumoSelect();
            initDataTable($datatable);
        });
    </script>
@endsection
