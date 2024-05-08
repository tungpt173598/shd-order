@extends('index')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/order.css') }}">
    <div class="content-container">
        <div class="head d-flex">
            <div class="title">Nhà cung cấp giấy</div>
            <button type="button" class="add btn btn-primary" data-toggle="modal" data-target="#add">Thêm +</button>
        </div>
        <div class="content">
            <div class="item-container">
                @foreach($data as $item)
                    <div class="item d-flex item-item">
                        <div class="item-content" data-id="{{ $item->id }}">
                            <div class="item-head">Tên: {{ $item->name }}</div>
                            <div>SĐT: {{ $item->phone }}</div>
                        </div>
                        <div class="action d-flex">
{{--                            <div class="action-item">--}}
{{--                            <span class="material-symbols-outlined item-icon">--}}
{{--                                edit--}}
{{--                            </span>--}}
{{--                            </div>--}}
                            <div class="action-item">
                                <span class="material-symbols-outlined item-icon delete" data-id="{{ $item->id }}" data-name="{{ $item->name }}" style="color: red;">
                                    delete
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title"></h5>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="name">Tên</label>
                            <input type="text" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Nhập tên" name="name">
                        </div>
                        <div class="form-group">
                            <label for="phone">Số điện thoại</label>
                            <input type="text" class="form-control" id="phone" aria-describedby="emailHelp" placeholder="Nhập số điện thoại" name="phone">
                        </div>
{{--                        <div class="form-group">--}}
{{--                            <label for="address">Địa chỉ</label>--}}
{{--                            <input type="text" class="form-control" id="address" aria-describedby="emailHelp" placeholder="Nhập địa chỉ" name="address">--}}
{{--                        </div>--}}
                    </form>
                </div>
                <input type="hidden" id="url">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary save">Lưu</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Huỷ đơn</h5>
                </div>
                <div class="modal-body" id="delete-text">

                </div>
                <input type="hidden" id="delete-id">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close" data-dismiss="modal">Không xoá</button>
                    <button type="button" class="btn btn-primary" id="confirm">Xoá</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            let modal = $('#add')
            $('.add').click(function () {
                modal.find('#modal-title').text('Thêm nhà cung cấp giấy')
                $('#name').val('')
                $('#phone').val('')
                $('#address').val('')
                $('#url').val('{{ route('create_paper') }}')
                modal.modal('show')
            })
            $('.close').click(function () {
                $(this).closest('.modal').modal('hide')
            })
            $('.save').click(function (e) {
                e.preventDefault()
                $.ajax({
                    type: "post",
                    url: $('#url').val(),
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "name": $('#name').val(),
                        "phone": $('#phone').val(),
                        // "address": $('#address').val(),
                    },
                    success: function (data) {
                        console.log(data)
                        location.reload()
                    },
                    error: function (data) {
                        console.log(data)
                    }
                })
            })
            $('.item-content').click(function (e) {
                e.preventDefault()
                let id = $(this).data('id')
                $('#url').val('{{ url('paper') . '/' }}' + id)
                $.ajax({
                    type: "get",
                    url: '{{ url('paper') . '/' }}' + id,
                    data: {
                        '_token': '{{ csrf_token() }}'
                    },
                    success: function (data) {
                        let item = data.data
                        modal.find('#name').val(item.name)
                        modal.find('#phone').val(item.phone)
                        modal.modal('show')
                    },
                    error: function (error) {
                        alert('Có lỗi hệ thống, vui lòng tải lại trang')
                    }
                })
            })
            $('.delete').click(function () {
                let name = $(this).data('name')
                let id = $(this).data('id')
                $('#delete-id').val(id)
                $('#delete-text').text(`Chắn chắc xoá nhà cung cấp ${name}?`)
                $('#delete').modal('show')
            })
            $('#confirm').click(function () {
                let id = $('#delete-id').val()
                $.ajax({
                    url: '{{ url('paper') . '/' }}' + id,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function () {
                        location.reload()
                    },
                    error: function () {
                        alert('Có lỗi hệ thống, vui lòng tải lại trang')
                    }
                })
            })
        })
    </script>
@endsection

{{--            <table class="table-content">--}}
{{--                <thead>--}}
{{--                    <tr>--}}
{{--                        <th style="width: 10%" class="header">STT</th>--}}
{{--                        <th style="width: 20%" class="header">Tên</th>--}}
{{--                        <th style="width: 20%" class="header">Phone</th>--}}
{{--                        <th style="width: 30%" class="header">Địa chỉ</th>--}}
{{--                        <th style="width: 20%" class="header">Giá</th>--}}
{{--                    </tr>--}}
{{--                </thead>--}}
{{--                <tbody>--}}
{{--                    <tr>--}}
{{--                        <td class="">123</td>--}}
{{--                        <td>12314</td>--}}
{{--                        <td>2345345345</td>--}}
{{--                        <td>Bắc Cầu</td>--}}
{{--                        <td>10000</td>--}}
{{--                    </tr>--}}
{{--                </tbody>--}}
{{--            </table>--}}
