@extends('index')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/order.css') }}">
    <div class="content-container">
        <div class="head d-flex">
            <div class="title">Gia công</div>
            @if(\Illuminate\Support\Facades\Auth::check())
                <button type="button" class="add btn btn-primary" data-toggle="modal" data-target="#add">Thêm +</button>
            @endif
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
                            @if(\Illuminate\Support\Facades\Auth::check())
                                <div class="action-item">
                                <span class="material-symbols-outlined item-icon delete" data-id="{{ $item->id }}" data-name="{{ $item->name }}" style="color: red;">
                                    delete
                                </span>
                                </div>
                            @endif
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
            let login = '{{ \Illuminate\Support\Facades\Auth::check() }}'
            let modal = $('#add')
            modal.modal({
                backdrop: 'static',
                keyboard: false
            });
            $('.add').click(function () {
                modal.find('#modal-title').text('Thêm nhà in')
                $('#name').val('')
                $('#phone').val('')
                $('#address').val('')
                $('#url').val('{{ route('create_process') }}')
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
                    dataType: 'json',
                    success: function (data) {
                        location.reload()
                    },
                    error: function (error) {
                        let messages = error.responseJSON.messages
                        alert(messages.join(' \n'))
                    }
                })
            })
            $('.item-content').click(function (e) {
                e.preventDefault()
                let id = $(this).data('id')
                $('#url').val('{{ url('process') . '/' }}' + id)
                $.ajax({
                    type: "get",
                    url: '{{ url('process') . '/' }}' + id,
                    data: {
                        '_token': '{{ csrf_token() }}'
                    },
                    success: function (data) {
                        let item = data.data
                        modal.find('#name').val(item.name)
                        modal.find('#phone').val(item.phone)
                        if (!login) {
                            modal.find('input').attr('disabled', 'disabled')
                            modal.find('select').attr('disabled', 'disabled')
                            modal.find('.save').hide()
                        }
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
                $('#delete-text').text(`Chắn chắc xoá bên gia công ${name}?`)
                $('#delete').modal('show')
            })
            $('#confirm').click(function () {
                let id = $('#delete-id').val()
                $.ajax({
                    url: '{{ url('process') . '/' }}' + id,
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

