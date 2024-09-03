@extends('index')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/order.css') }}">
    <div class="content-container">
        <div class="head d-flex">
            <div class="title">Đơn hàng</div>
            @if(\Illuminate\Support\Facades\Auth::check())
                <button type="button" class="add btn btn-primary" data-toggle="modal" data-target="#add">Thêm +</button>
            @endif
        </div>
        <div class="search">
            <label for="search" class="d-none"></label>
            <input type="text" id="search" name="search" class="form-control" placeholder="Tìm kiếm" value="{{ request('search') }}">
            <span class="material-symbols-outlined search-button">
                search
            </span>
        </div>
        <div class="content">
            <div class="item-container">
                @foreach($data as $item)
                    <div class="item d-flex item-item">
                        <div class="item-content" data-id="{{ $item->id }}">
                            <div class="item-head">Mã đơn: {{ $item->code }}</div>
                            <div>Khách: {{ $item->customer }}</div>
{{--                            <div>Giá: {{ format_price($item->price) }}</div>--}}
{{--                            <div>Đã thanh toán: {{ format_price($item->pre_charge) }}</div>--}}
{{--                            <div class="d-flex item-info">--}}
{{--                                <div class="info-1">Thiết kế: {{ $item->design }}</div>--}}
{{--                                <div class="info-2 {{ $item->design_done ? 'item-green' : 'item-red' }}">{{ $item->design_done ? 'Đã xong' : 'Chưa xong' }}</div>--}}
{{--                            </div>--}}
{{--                            <div class="d-flex item-info">--}}
{{--                                <div class="info-1">Giấy: {{ $item->paper_supplier }}</div>--}}
{{--                                <div class="info-2 {{ $item->paper_done ? 'item-green' : 'item-red' }}">{{ $item->paper_done ? 'Đã xong' : 'Chưa xong' }}</div>--}}
{{--                            </div>--}}
{{--                            <div class="d-flex item-info">--}}
{{--                                <div class="info-1">In: {{ $item->printed_by }}</div>--}}
{{--                                <div class="info-2 {{ $item->print_done ? 'item-green' : 'item-red' }}">{{ $item->print_done ? 'Đã xong' : 'Chưa xong' }}</div>--}}
{{--                            </div>--}}
{{--                            <div class="d-flex item-info">--}}
{{--                                <div class="info-1">Gia công: {{ $item->machining }}</div>--}}
{{--                                <div class="info-2 {{ $item->machining_done ? 'item-green' : 'item-red' }}">{{ $item->machining_done ? 'Đã xong' : 'Chưa xong' }}</div>--}}
{{--                            </div>--}}
{{--                            <div class="d-flex item-info">--}}
{{--                                <div class="info-1">Đóng gói: {{ $item->pack }}</div>--}}
{{--                                <div class="info-2 {{ $item->pack_done ? 'item-green' : 'item-red' }}">{{ $item->pack_done ? 'Đã xong' : 'Chưa xong' }}</div>--}}
{{--                            </div>--}}
{{--                            <div class="d-flex item-info">--}}
{{--                                <div class="info-1">Vận chuyển: {{ $item->deliver }}</div>--}}
{{--                                <div class="info-2 {{ $item->deliver_done ? 'item-green' : 'item-red' }}">{{ $item->deliver_done ? 'Đã xong' : 'Chưa xong' }}</div>--}}
{{--                            </div>--}}
                        </div>
                        <div class="action d-flex">
{{--                            <div class="action-item">--}}
{{--                                <span class="material-symbols-outlined item-icon edit" data-id="{{ $item->id }}">--}}
{{--                                    edit--}}
{{--                                </span>--}}
{{--                            </div>--}}
                            <div class="action-item">
                                <span class="material-symbols-outlined item-icon delete" data-code="{{ $item->code }}" data-customer="{{ $item->customer }}" data-id="{{ $item->id }}" style="color: red;">
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
                    <span class="material-symbols-outlined close">
                        close
                    </span>
                </div>
                <div class="modal-body">
                    <form id="order-form">
                        @csrf
                        <div class="form-group">
                            <label for="code">Mã đơn<span class="required">*</span></label>
                            <input type="text" class="form-control" required id="code" aria-describedby="emailHelp" placeholder="Nhập mã đơn" name="code">
                        </div>
                        <div class="form-group">
                            <label for="customer">Tên khách hàng</label>
                            <input type="text" class="form-control" id="customer" aria-describedby="emailHelp" name="customer">
                        </div>
                        <div class="form-group">
                            <label for="price">Giá<span id="total-price"></span></label>
                            <input type="number" pattern="[0-9]*" class="form-control" id="price" aria-describedby="emailHelp" name="price">
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_type" checked id="not-charge" value="2">
                                <label class="form-check-label" for="not-charge">
                                    Không tạm ứng
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_type" id="pre-charge" value="1">
                                <label class="form-check-label" for="pre-charge">
                                    Tạm ứng<span id="pre-price"></span>
                                </label>
                            </div>
                            <label class="d-none" for="money"></label>
                            <input type="number" pattern="[0-9]*" class="form-control d-none" id="money" name="pre_charge" placeholder="Nhập số tiền tạm ứng">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_type" checked id="charge" value="3">
                                <label class="form-check-label" for="charge">
                                    Đã thanh toán
                                </label>
                            </div>
                        </div>
                        <div class="form-group d-flex">
                            <label class="label-select" for="design">Thiết kế</label>
                            <div class="d-flex select-container">
                                <select name="design" class="form-select" aria-label="Default select example">
                                    @foreach($select['designs'] as $id => $paper)
                                        <option value="{{ $paper }}">{{ $paper }}</option>
                                    @endforeach
                                </select>
                                <input class="form-check-input check-done" type="checkbox" value="1" name="design_done">
                            </div>
                        </div>
                        <div class="form-group d-flex">
                            <label class="label-select" for="paper_supplier">Giấy</label>
                            <div class="d-flex select-container">
                                <select name="paper_supplier" class="form-select" aria-label="Default select example">
                                    @foreach($select['papers'] as $id => $paper)
                                        <option value="{{ $paper }}">{{ $paper }}</option>
                                    @endforeach
                                </select>
                                <input class="form-check-input check-done" type="checkbox" value="1" name="paper_done">
                            </div>
                        </div>
                        <div class="form-group d-flex">
                            <label class="label-select" for="printed_by">In</label>
                            <div class="d-flex select-container">
                                <select name="printed_by" class="form-select" aria-label="Default select example">
                                    @foreach($select['prints'] as $id => $paper)
                                        <option value="{{ $paper }}">{{ $paper }}</option>
                                    @endforeach
                                </select>
                                <input class="form-check-input check-done" type="checkbox" value="1" name="print_done">
                            </div>
                        </div>
                        <div class="form-group d-flex">
                            <label class="label-select" for="machining">Gia công</label>
                            <div class="d-flex select-container">
                                <select name="machining" class="form-select" aria-label="Default select example">
                                    @foreach($select['machining'] as $id => $paper)
                                        <option value="{{ $paper }}">{{ $paper }}</option>
                                    @endforeach
                                </select>
                                <input class="form-check-input check-done" type="checkbox" value="1" name="machining_done">
                            </div>
                        </div>
                        <div class="form-group d-flex">
                            <label class="label-select" for="pack">Đóng gói</label>
                            <div class="d-flex select-container">
                                <select name="pack" class="form-select" aria-label="Default select example">
                                    @foreach($select['packs'] as $id => $paper)
                                        <option value="{{ $paper }}">{{ $paper }}</option>
                                    @endforeach
                                </select>
                                <input class="form-check-input check-done" type="checkbox" value="1" name="pack_done">
                            </div>
                        </div>
                        <div class="form-group d-flex">
                            <label class="label-select" for="deliver">Giao hàng</label>
                            <div class="d-flex select-container">
                                <select name="deliver" class="form-select" aria-label="Default select example">
                                    @foreach($select['delivers'] as $id => $paper)
                                        <option value="{{ $paper }}">{{ $paper }}</option>
                                    @endforeach
                                </select>
                                <input class="form-check-input check-done" type="checkbox" value="1" name="deliver_done">
                            </div>
                        </div>
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
                    <h5 class="modal-title" id="exampleModalLongTitle">Xoá</h5>
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
            let title = modal.find('#partial-title')
            $('.add').click(function () {
                title.text('Tạo đơn')
                modal.find('#customer').val('')
                modal.find('#code').val('')
                modal.find('#price').val('')
                modal.find(`input[name="payment_type"][value="2"]`).prop('checked', true)
                $('#money').addClass('d-none')
                $('#money').text('')
                $('#total-price').text('')
                modal.find('#money').val('')
                modal.find('select[name="design"]').val('')
                modal.find('select[name="paper_supplier"]').val('')
                modal.find('select[name="printed_by"]').val('')
                modal.find('select[name="machining"]').val('')
                modal.find('select[name="deliver"]').val('')
                modal.find('select[name="pack"]').val('')
                modal.find('input[name="paper_done"]').prop('checked', false)
                modal.find('input[name="design_done"]').prop('checked', false)
                modal.find('input[name="print_done"]').prop('checked', false)
                modal.find('input[name="machining_done"]').prop('checked', false)
                modal.find('input[name="pack_done"]').prop('checked', false)
                modal.find('input[name="deliver_done"]').prop('checked', false)
                $('#url').val('{{ route('create_order') }}')
                modal.modal('show')
            })
            $('.close').click(function () {
                $(this).closest('.partial').modal('hide')
            })
            $('.save').click(function (e) {
                e.preventDefault()
                let formData = new FormData($('#order-form')[0])
                $.ajax({
                    type: "post",
                    url: $('#url').val(),
                    data: formData,
                    dataType: 'json',
                    cache : false,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        location.reload()
                    },
                    error: function (error) {
                        let messages = error.responseJSON.messages
                        alert(messages.join(' \n'))
                    }
                })
            })
            $('.edit, .item-content').click(function (e) {
                e.preventDefault()
                let id = $(this).data('id')
                $('#url').val('{{ url('order') . '/' }}' + id)
                $.ajax({
                    type: "get",
                    url: '{{ url('order') . '/' }}' + id,
                    data: {
                        '_token': '{{ csrf_token() }}'
                    },
                    success: function (data) {
                        let item = data.data
                        title.text(item.code)
                        modal.find('#customer').val(item.customer)
                        modal.find('#code').val(item.code)
                        modal.find('#price').val(item.price)
                        modal.find('#total-price').text(formatCurrency(item.price))
                        modal.find('#money').val(item.pre_charge == '0' ? '' : item.pre_charge)
                        modal.find(`input[name="payment_type"][value="${item.payment_type}"]`).prop('checked', true)
                        if (item.payment_type == "1") {
                            $('#money').removeClass('d-none')
                            modal.find('#pre-price').text(formatCurrency(item.pre_charge))
                        } else {
                            $('#money').addClass('d-none')
                        }
                        modal.find('#money').val(item.pre_charge)
                        modal.find('select[name="design"]').val(item.design)
                        modal.find('select[name="paper_supplier"]').val(item.paper_supplier)
                        modal.find('select[name="printed_by"]').val(item.printed_by)
                        modal.find('select[name="machining"]').val(item.machining)
                        modal.find('select[name="deliver"]').val(item.deliver)
                        modal.find('select[name="pack"]').val(item.pack)
                        modal.find('input[name="design_done"]').prop('checked', item.design_done)
                        modal.find('input[name="paper_done"]').prop('checked', item.paper_done)
                        modal.find('input[name="print_done"]').prop('checked', item.print_done)
                        modal.find('input[name="machining_done"]').prop('checked', item.machining_done)
                        modal.find('input[name="pack_done"]').prop('checked', item.pack_done)
                        modal.find('input[name="deliver_done"]').prop('checked', item.deliver_done)
                        if (!login) {
                            modal.find('input').attr('disabled', 'disabled')
                            modal.find('select').attr('disabled', 'disabled')
                            modal.find('.save').hide()
                        }
                        modal.modal('show')
                    },
                    error: function () {
                        alert('Có lỗi hệ thống, vui lòng tải lại trang')
                    }
                })
            })
            $('input[name="payment_type"]').click(function () {
                if ($(this).val() == '1') {
                    let prePrice = $('#pre-price')
                    $('#money').removeClass('d-none')
                    prePrice.text(formatCurrency($('#money').val()))
                    prePrice.removeClass('d-none')
                } else {
                    $('#money').addClass('d-none')
                    $('#pre-price').addClass('d-none')
                }
            })
            $('.delete').click(function () {
                let code = $(this).data('code')
                let customer = $(this).data('customer')
                let id = $(this).data('id')
                $('#delete-id').val(id)
                $('#delete-text').text(`Chắn chắc xoá đơn ${code} - ${customer}?`)
                $('#delete').modal('show')
            })
            $('#confirm').click(function () {
                let id = $('#delete-id').val()
                $.ajax({
                    url: '{{ url('order') . '/' }}' + id,
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

            $('input[type="number"]').on('input', function () {
                    let result = formatCurrency($(this).val())
                    if ($(this).attr('id') == 'money') {
                        $('#pre-price').text(result)
                    } else {
                        $('#total-price').text(result)
                    }
            })
            $('.search-button').click(function (e) {
                window.location.href = location.protocol + "//" + location.host + location.pathname + '?search=' + $('#search').val();
            })
        })
    </script>
@endsection
