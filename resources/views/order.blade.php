@extends('index')
@section('content')
    @php
        $year = request('year') ?? \Carbon\Carbon::now()->year;
        $yearSelect = \Carbon\Carbon::now()->year;
        $month = $year > 0 ? (request('month') ?? \Carbon\Carbon::now()->month) : 0;
        $days = $month > 0 ? cal_days_in_month( 0, $month, $year) : 0;
        $papers = array_values($select['papers']) ?? [];
        $design = array_values($select['designs']) ?? [];
        $print = array_values($select['prints']) ?? [];
        $machining = array_values($select['machining']) ?? [];
        $deliver = array_values($select['delivers']) ?? [];
        $mold = array_values($select['mold']) ?? [];
//        $child1 = $child2 = $child3 = $arr2 = $arr3 = $arr1 = $arr2Map = [];
//        foreach ($select['process_children'] as $children) {
//            $arr1[$children['name']] = $children['id'];
//            $child1[] = ['id' => $children['id'], 'name' => $children['name']];
//            foreach ($children['children'] as $child_2) {
//                $arr2Map[$child_2['name']] = $child_2['id'];
//                $arr2[$children['id']][] = $child_2['name'];
//                $child2[$children['id']][] = ['id' => $child_2['id'], 'name' => $child_2['name']];
//                foreach ($child_2['children'] as $child_3) {
//                    $child3[$child_2['id']][] = ['id' => $child_3['id'], 'name' => $child_3['name']];
//                    $arr3[$child_2['id']][] = $child_3['name'];
//                }
//            }
//        }
    @endphp
    <link rel="stylesheet" href="{{ asset('css/order.css') }}">
    <div class="content-container">
        <div class="head d-flex">
            <div class="search">
                <label for="search" class="d-none"></label>
                <input type="text" id="search" name="search" class="form-control" placeholder="Tìm kiếm" value="{{ request('search') }}">
                <span class="material-symbols-outlined search-button">
                search
            </span>
            </div>
            <div class="filter-item">
                <select name="year" id="year" class="form-select" aria-label="Default select example">
                    <option value="0" @if($year == 0) selected @endif></option>
                    @for($i = $yearSelect - 30; $i <= $yearSelect + 5; $i++)
                        <option value="{{ $i }}" @if($i == $year) selected @endif>{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="filter-item">
                <select name="month" id="month" class="form-select" aria-label="Default select example">
                    <option value="0" @if($month == 0) selected @endif></option>
                    @for($i = 1; $i < 13; $i++)
                        <option value="{{ $i }}" @if($i == $month) selected @endif>{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="filter-item">
                <select name="day" id="day" class="form-select" aria-label="Default select example">
                    <option value="0" @if(request('day') == 0) selected @endif></option>
                    @for($i = 1; $i <= $days; $i++)
                        <option value="{{ $i }}" @if($i == request('day')) selected @endif>{{ $i }}</option>
                    @endfor
                </select>
            </div>
            @if(\Illuminate\Support\Facades\Auth::check())
                <button type="button" class="add btn btn-primary" data-toggle="modal" data-target="#add">Thêm</button>
            @endif
        </div>
        <div class="content">
            <div class="item-container">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Tên hàng</th>
                        <th scope="col">Khách</th>
                        <th scope="col">Ngày giao</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $i => $item)
                        <tr>
                            <th scope="row">{{ (max([request('page') || 0, 1]) - 1)  * 10 + $i + 1 }}</th>
                            <td>{{ $item->code }}</td>
                            <td>{{ $item->customer }}</td>
                            <td>{{ $item->delivery_date }}</td>
                            <td><span style="color: {{ $item->done ? 'green' : 'red' }}; cursor: pointer" class="order-done" data-value="{{ $item->done ?? 0 }}" data-id="{{ $item->id }}">{{ $item->done ? 'Hoàn thành' : 'Chưa xong' }}</span></td>
                            <td>
                                    <div class="action-item">
                                        <span class="material-symbols-outlined item-icon edit" data-id="{{ $item->id }}">
                                            edit
                                        </span>
                                        @if(\Illuminate\Support\Facades\Auth::check())
                                            <span class="material-symbols-outlined item-icon delete" data-code="{{ $item->code }}" data-customer="{{ $item->customer }}" data-id="{{ $item->id }}" style="color: red;">
                                                delete
                                            </span>
                                        @endif
                                    </div>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
            {{ $data->withQueryString()->links() }}
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
                        <div class="d-flex form-group">
                            <label for="code" class="label-select">Tên hàng<span class="required">*</span></label>
                            <input type="text" class="form-control select-container" required id="code" aria-describedby="emailHelp" placeholder="Nhập tên hàng" name="code">
                        </div>
                        <div class="d-flex form-group">
                            <label for="customer" class="label-select">Tên khách hàng</label>
                            <input type="text" class="form-control select-container" id="customer" aria-describedby="emailHelp" name="customer">
                        </div>
                        <div class="d-flex form-group delivery-container">
                            <label for="delivery_date" class="label-select">Ngày giao hàng</label>
                            <input class="form-control select-container" id="delivery_date" name="delivery_date" readonly="readonly">
                            <span class="material-symbols-outlined close-date">
                                close
                            </span>
                        </div>
                        <div class="d-flex form-group">
                            <label for="price" class="label-select">Giá<span id="total-price"></span></label>
                            <input type="number" pattern="[0-9]*" class="form-control select-container" id="price" aria-describedby="emailHelp" name="price">
                        </div>
                        <div class="form-group d-flex">
                            <div class="form-check" style="margin-right: 15px">
                                <input class="form-check-input" type="radio" name="payment_type" checked id="not-charge" value="2">
                                <label class="form-check-label" for="not-charge">
                                    Không tạm ứng
                                </label>
                            </div>
                            <div class="form-check" style="margin-right: 15px">
                                <input class="form-check-input" type="radio" name="payment_type" id="pre-charge" value="1">
                                <label class="form-check-label" for="pre-charge">
                                    Tạm ứng<span id="pre-price"></span>
                                </label>
                            </div>
                            <div class="form-check" style="margin-right: 15px">
                                <input class="form-check-input" type="radio" name="payment_type" checked id="charge" value="3">
                                <label class="form-check-label" for="charge">
                                    Đã thanh toán
                                </label>
                            </div>
                        </div>
                        <div class="pre-charge-container d-none" style="margin-bottom: 10px; margin-top: -20px">
                            <label for="money"></label>
                            <input type="number" pattern="[0-9]*" class="form-control" id="money" name="pre_charge" placeholder="Nhập số tiền tạm ứng">
                        </div>
                        <div class="form-group d-flex">
                            <label class="label-select" for="design">Thiết kế</label>
                            <div class="d-flex select-container">
                                <select name="design" class="form-select" aria-label="Default select example">
                                    @foreach($select['designs'] as $id => $paper)
                                        <option value="{{ $paper }}">{{ $paper }}</option>
                                    @endforeach
                                        <option value="Khác">Khác</option>
                                </select>
                                <input name="design" class="form-select other-input" placeholder="Nhập lựa chọn khác..." disabled>
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
                                        <option value="Khác">Khác</option>
                                </select>
                                <input name="paper_supplier" class="form-select other-input" placeholder="Nhập lựa chọn khác..." disabled>
                                <input class="form-check-input check-done" type="checkbox" value="1" name="paper_done">
                            </div>
                        </div>
                        <div class="form-group d-flex">
                            <label class="label-select" for="paper_detail"></label>
                            <div class="select-container">
                                <textarea class="form-control" id="paper_detail" name="paper_detail" placeholder="Nhập chi tiết giấy" rows="2" style="width: 90%"></textarea>
                            </div>
                        </div>
{{--                        <div class="form-group d-flex">--}}
{{--                            <label class="label-select"></label>--}}
{{--                            <div class="d-flex select-container">--}}
{{--                                <div class="d-flex paper-container">--}}
{{--                                    <label for="paper_type" class="paper-child-label">Loại</label>--}}
{{--                                    <input type="text" class="form-control paper-input" id="paper_type" name="paper_type">--}}
{{--                                </div>--}}
{{--                                <div class="d-flex paper-container">--}}
{{--                                    <label for="paper_size" class="paper-child-label">Khổ</label>--}}
{{--                                    <input type="text" class="form-control paper-input" id="paper_size" name="paper_size">--}}
{{--                                </div>--}}
{{--                                <div class="d-flex paper-container">--}}
{{--                                    <label for="paper_quantity" class="paper-child-label">SL</label>--}}
{{--                                    <input type="text" class="form-control paper-input" id="paper_quantity" name="paper_quantity">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="form-group d-flex">
                            <label class="label-select" for="printed_by">In</label>
                            <div class="d-flex select-container">
                                <select name="printed_by" class="form-select" aria-label="Default select example">
                                    @foreach($select['prints'] as $id => $paper)
                                        <option value="{{ $paper }}">{{ $paper }}</option>
                                    @endforeach
                                        <option value="Khác">Khác</option>
                                </select>
                                <input name="printed_by" class="form-select other-input" placeholder="Nhập lựa chọn khác..." disabled>
                                <input class="form-check-input check-done" type="checkbox" value="1" name="print_done">
                            </div>
                        </div>
                        <div class="form-group d-flex">
                            <label class="label-select" for="print_detail"></label>
                            <div class="select-container">
                                <textarea class="form-control" id="print_detail" name="print_detail" placeholder="Nhập chi tiết in" rows="2" style="width: 90%"></textarea>
                            </div>
                        </div>
{{--                        <div class="form-group d-flex">--}}
{{--                            <label class="label-select"></label>--}}
{{--                            <div class="d-flex select-container">--}}
{{--                                <div class="d-flex print-container align-items-center">--}}
{{--                                    <label for="print_zn" class="paper-child-label" style="flex: 0 1 auto; white-space: nowrap;">Số kẽm</label>--}}
{{--                                    <input type="text" class="form-control paper-input" id="print_zn" name="print_zn" style="flex: 1 1 auto;">--}}
{{--                                </div>--}}
{{--                                <div class="d-flex print-container align-items-center">--}}
{{--                                    <label for="print_type" class="paper-child-label" style="flex: 0 1 auto; white-space: nowrap;">Quy cách</label>--}}
{{--                                    <input type="text" class="form-control paper-input" id="print_type" name="print_type" style="flex: 1 1 auto;">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="form-group d-flex">
                            <label class="label-select" for="machining">Gia công</label>
                            <div class="d-flex select-container">
                                <select name="machining" class="form-select" aria-label="Default select example">
                                    @foreach($select['machining'] as $id => $paper)
                                        <option value="{{ $paper }}">{{ $paper }}</option>
                                    @endforeach
                                        <option value="Khác">Khác</option>
                                </select>
                                <input name="machining" class="form-select other-input" placeholder="Nhập lựa chọn khác..." disabled>
                                <input class="form-check-input check-done" type="checkbox" value="1" name="machining_done">
                            </div>
                        </div>
                        <div class="form-group d-flex">
                            <label class="label-select" for="process_detail">Chi tiết</label>
                            <div class="select-container">
                                <textarea class="form-control" id="process_detail" name="process_detail" placeholder="Nhập chi tiết gia công" rows="2" style="width: 90%"></textarea>
                            </div>
                            {{--                            <div class="d-flex select-container">--}}
{{--                                <div class="d-flex paper-container">--}}
{{--                                    <select type="text" class="form-control paper-input" id="process_child_1" name="process_child_1">--}}
{{--                                        @foreach($child1 as $child)--}}
{{--                                            <option value="{{ $child['name'] }}" data-id="{{ $child['id'] }}">{{ $child['name'] }}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                                <div class="d-flex paper-container">--}}
{{--                                    <select type="text" class="form-control paper-input" id="process_child_2" name="process_child_2">--}}
{{--                                    </select>--}}
{{--                                    <input name="process_child_2" class="form-select other-input" placeholder="Nhập lựa chọn khác..." disabled>--}}
{{--                                </div>--}}
{{--                                <div class="d-flex paper-container">--}}
{{--                                    <select type="text" class="form-control paper-input" id="process_child_3" name="process_child_3">--}}
{{--                                    </select>--}}
{{--                                    <input name="process_child_3" class="form-select other-input" placeholder="Nhập lựa chọn khác..." disabled>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                        <div class="form-group d-flex">
                            <label class="label-select" for="mold">Khuôn bế</label>
                            <div class="d-flex select-container">
                                <select name="mold" class="form-select" aria-label="Default select example">
                                    @foreach($select['mold'] as $id => $paper)
                                        <option value="{{ $paper }}">{{ $paper }}</option>
                                    @endforeach
                                    <option value="Khác">Khác</option>
                                </select>
                                <input name="mold" class="form-select other-input" placeholder="Nhập lựa chọn khác..." disabled>
                                <input class="form-check-input check-done" type="checkbox" value="1" name="mold_done">
                            </div>
                        </div>
{{--                        <div class="form-group d-flex">--}}
{{--                            <label class="label-select" for="pack">Đóng gói</label>--}}
{{--                            <div class="d-flex select-container">--}}
{{--                                <select name="pack" class="form-select" aria-label="Default select example">--}}
{{--                                    @foreach($select['packs'] as $id => $paper)--}}
{{--                                        <option value="{{ $paper }}">{{ $paper }}</option>--}}
{{--                                    @endforeach--}}
{{--                                        <option value="Khác">Khác</option>--}}
{{--                                </select>--}}
{{--                                <input name="pack" class="form-select other-input" placeholder="Nhập lựa chọn khác...">--}}
{{--                                <input class="form-check-input check-done" type="checkbox" value="1" name="pack_done">--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="form-group d-flex">
                            <label class="label-select" for="deliver">Giao hàng</label>
                            <div class="d-flex select-container">
                                <select name="deliver" class="form-select" aria-label="Default select example">
                                    @foreach($select['delivers'] as $id => $paper)
                                        <option value="{{ $paper }}">{{ $paper }}</option>
                                    @endforeach
                                        <option value="Khác">Khác</option>
                                </select>
                                <input name="deliver" class="form-select other-input" placeholder="Nhập lựa chọn khác..." disabled>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script>
        $(document).ready(function () {
            var prints = <?php echo json_encode($print); ?>;
            var papers = <?php echo json_encode($papers); ?>;
            var designs = <?php echo json_encode($design); ?>;
            var machining = <?php echo json_encode($machining); ?>;
            var delivers = <?php echo json_encode($deliver); ?>;
            var mold = <?php echo json_encode($mold); ?>;
            {{--var childData1 = <?php echo json_encode($child1); ?>;--}}
            {{--var childData2 = <?php echo json_encode($child2); ?>;--}}
            {{--var childData3 = <?php echo json_encode($child3); ?>;--}}
            {{--var arr2 = <?php echo json_encode($arr2); ?>;--}}
            {{--var arr3 = <?php echo json_encode($arr3); ?>;--}}
            {{--var arr1 = <?php echo json_encode($arr1); ?>;--}}
            {{--var arr2Map = <?php echo json_encode($arr2Map); ?>;--}}
            $('select').on('change', function () {
                let el = $(this)
                if (el.val() === 'Khác') {
                    el.hide();
                    el.prop('disabled', 'disabled')
                    el.closest('.d-flex').find('.other-input').prop('disabled', false).show().focus();
                }
            })
            $('.other-input').on('blur', function() {
                if ($(this).val().trim() === '') {
                    // Nếu input trống, ẩn input và hiển thị lại select
                    $(this).hide();
                    $(this).prop('disabled', 'disabled')
                    $(this).closest('.d-flex').find('select').prop('disabled', false).val('').show();  // Reset lại select
                }
            });
            // $('#process_child_1').on('change', function () {
            //     setChild2($(this))
            // })
            // function setChild2 (dom) {
            //     let childEl2 = $('#process_child_2')
            //     childEl2.empty()
            //     $('#process_child_3').val('')
            //     let child1Id = dom.find('option:selected').data('id')
            //     let el = ''
            //     childData2[child1Id].forEach(function(item) {
            //         el += `<option value="${item['name']}" data-id="${item['id']}">${item['name']}</option>`
            //     })
            //     el += `<option value="Khác">Khác</option>`
            //     childEl2.append(el)
            //     childEl2.val('')
            // }
            // $('#process_child_2').on('change', function () {
            //     setChild3($(this))
            // })
            // function setChild3 (dom) {
            //     let childEl3 = $('#process_child_3')
            //     childEl3.empty()
            //     let child2Id = dom.find('option:selected').data('id')
            //     let el = ''
            //     if (childData3[child2Id]) {
            //         childData3[child2Id].forEach(function(item) {
            //             el += `<option value="${item['name']}" data-id="${item['id']}">${item['name']}</option>`
            //         })
            //         el += `<option value="Khác">Khác</option>`
            //         childEl3.append(el)
            //     }
            //     childEl3.val('')
            // }
            $.fn.datepicker.dates['vi'] = {
                days: ["CN", "Hai", "Ba", "Tư", "Năm", "Sáu", "Bảy"],
                daysShort: ["CN", "Hai", "Ba", "Tư", "Năm", "Sáu", "Bảy"],
                daysMin: ["CN", "Hai", "Ba", "Tư", "Năm", "Sáu", "Bảy"],
                months: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"],
                monthsShort: ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12"],
                today: "Hôm nay",
                clear: "Clear",
                format: "dd-mm-yyyy",
                titleFormat: "MM yyyy", /* Leverages same syntax as 'format' */
                weekStart: 0
            };
            $('#delivery_date').datepicker({
                autoclose: true,
                format: "dd-mm-yyyy",
                language: 'vi',
                todayHighlight: true,
                weekStart: 1,
                orientation: 'bottom right',
                forceParse: false
            })
            let login = '{{ \Illuminate\Support\Facades\Auth::check() }}'
            let modal = $('#add')
            modal.modal({
                backdrop: 'static',
                keyboard: false
            });
            let title = modal.find('#partial-title')
            $('.add').click(function () {
                title.text('Tạo đơn')
                modal.find('#customer').val('')
                modal.find('#code').val('')
                modal.find('#price').val('')
                modal.find('#paper_type').val('')
                modal.find('#paper_size').val('')
                modal.find('#paper_quantity').val('')
                modal.find('#print_zn').val('')
                modal.find('#print_type').val('')
                modal.find('#process_detail').val('')
                modal.find('#paper_detail').val('')
                modal.find('#print_detail').val('')
                modal.find('#delivery_date').datepicker('clearDates')
                modal.find(`input[name="payment_type"][value="2"]`).prop('checked', true)
                $('#money').text('')
                $('#total-price').text('')
                modal.find('#money').val('')
                modal.find('select[name="design"]').val('').prop('disabled', false).show()
                modal.find('input[name="design"]').val('').prop('disabled', true).hide()
                modal.find('select[name="paper_supplier"]').val('').prop('disabled', false).show()
                modal.find('input[name="paper_supplier"]').val('').prop('disabled', 'disabled').hide()
                modal.find('select[name="printed_by"]').val('').prop('disabled', false).show()
                modal.find('input[name="printed_by"]').val('').prop('disabled', 'disabled').hide()
                modal.find('select[name="machining"]').val('').prop('disabled', false).show()
                modal.find('input[name="machining"]').val('').prop('disabled', 'disabled').hide()
                modal.find('select[name="deliver"]').val('').prop('disabled', false).show()
                modal.find('input[name="deliver"]').val('').prop('disabled', 'disabled').hide()
                modal.find('select[name="mold"]').val('').prop('disabled', false).show()
                modal.find('input[name="mold"]').val('').prop('disabled', 'disabled').hide()
                // modal.find('select[name="process_child_1"]').val('').prop('disabled', false).show()
                // modal.find('select[name="process_child_2"]').val('').prop('disabled', false).show()
                // modal.find('input[name="process_child_2"]').val('').prop('disabled', 'disabled').hide()
                // modal.find('select[name="process_child_3"]').val('').prop('disabled', false).show()
                // modal.find('input[name="process_child_3"]').val('').prop('disabled', 'disabled').hide()
                modal.find('input[name="paper_done"]').prop('checked', false)
                modal.find('input[name="design_done"]').prop('checked', false)
                modal.find('input[name="print_done"]').prop('checked', false)
                modal.find('input[name="machining_done"]').prop('checked', false)
                modal.find('input[name="pack_done"]').prop('checked', false)
                modal.find('input[name="deliver_done"]').prop('checked', false)
                modal.find('input[name="mold_done"]').prop('checked', false)
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
            $('.order-done').click(function (e) {
                e.preventDefault()
                let id = $(this).data('id')
                $.ajax({
                    type: "post",
                    url: '{{ url('order-done') . '/' }}' + id,
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'done': $(this).data('value') ? 0 : 1
                    },
                    success: function (data) {
                        location.reload()
                    },
                    error: function (res) {
                        alert('Có lỗi hệ thống, vui lòng tải lại trang')
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
                        modal.find('#delivery_date').val(item.delivery_date)
                        modal.find('#paper_type').val(item.paper_type)
                        modal.find('#paper_size').val(item.paper_size)
                        modal.find('#paper_quantity').val(item.paper_quantity)
                        modal.find('#print_zn').val(item.print_zn)
                        modal.find('#print_type').val(item.print_type)
                        modal.find('#process_detail').val(item.process_detail)
                        modal.find('#paper_detail').val(item.paper_detail)
                        modal.find('#print_detail').val(item.print_detail)
                        $('#delivery_date').datepicker('setDate', item.delivery_date)
                        modal.find('#total-price').text(formatCurrency(item.price))
                        modal.find('#money').val(item.pre_charge == '0' ? '' : item.pre_charge)
                        modal.find(`input[name="payment_type"][value="${item.payment_type}"]`).prop('checked', true)
                        if (item.payment_type == "1") {
                            $('.pre-charge-container').removeClass('d-none')
                            modal.find('#pre-price').text(formatCurrency(item.pre_charge))
                        } else {
                            $('.pre-charge-container').addClass('d-none')
                        }
                        modal.find('#money').val(item.pre_charge)

                        swapInput(modal, 'design', item.design, designs)
                        swapInput(modal, 'paper_supplier', item.paper_supplier, papers)
                        swapInput(modal, 'printed_by', item.printed_by, prints)
                        swapInput(modal, 'machining', item.machining, machining)
                        swapInput(modal, 'deliver', item.deliver, delivers)
                        swapInput(modal, 'mold', item.mold, mold)
                        // modal.find('select[name="process_child_1"]').val(item.process_child_1)
                        // if (item.process_child_1) {
                        //     setChild2(modal.find('select[name="process_child_1"]'))
                        //     if ((arr2[arr1[item.process_child_1]] && arr2[arr1[item.process_child_1]].includes(item.process_child_2)) || !item.process_child_2) {
                        //         modal.find('select[name="process_child_2"]').val(item.process_child_2).prop('disabled', false).show()
                        //         modal.find('input[name="process_child_2"]').prop('disabled', 'disabled').hide()
                        //     } else {
                        //         modal.find('input[name="process_child_2"]').val(item.process_child_2).prop('disabled', false).show()
                        //         modal.find('select[name="process_child_2"]').prop('disabled', 'disabled').hide()
                        //     }
                        //     if ((arr2[arr1[item.process_child_1]] && arr2[arr1[item.process_child_1]].includes(item.process_child_2)) && item.process_child_2) {
                        //         if ((arr3[arr2Map[item.process_child_2]] && arr3[arr2Map[item.process_child_2]].includes(item.process_child_3)) || !item.process_child_3) {
                        //             setChild3(modal.find('select[name="process_child_2"]'))
                        //             modal.find('select[name="process_child_3"]').val(item.process_child_3).prop('disabled', false).show()
                        //             modal.find('input[name="process_child_3"]').prop('disabled', 'disabled').hide()
                        //         } else {
                        //             modal.find('input[name="process_child_3"]').val(item.process_child_3).prop('disabled', false).show()
                        //             modal.find('select[name="process_child_3"]').prop('disabled', 'disabled').hide()
                        //         }
                        //     }
                        // }
                        modal.find('input[name="design_done"]').prop('checked', item.design_done)
                        modal.find('input[name="paper_done"]').prop('checked', item.paper_done)
                        modal.find('input[name="print_done"]').prop('checked', item.print_done)
                        modal.find('input[name="machining_done"]').prop('checked', item.machining_done)
                        modal.find('input[name="pack_done"]').prop('checked', item.pack_done)
                        modal.find('input[name="deliver_done"]').prop('checked', item.deliver_done)
                        modal.find('input[name="mold_done"]').prop('checked', item.mold_done)
                        if (!login) {
                            modal.find('input').attr('disabled', 'disabled')
                            modal.find('select').attr('disabled', 'disabled')
                            modal.find('textarea').attr('disabled', 'disabled')
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
                    $('.pre-charge-container').removeClass('d-none')
                    prePrice.text(formatCurrency($('#money').val()))
                } else {
                    $('.pre-charge-container').addClass('d-none')
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

                window.location.href = location.protocol + "//" + location.host + location.pathname + queryString();
            })
            function queryString() {
                let string = '?'
                string += 'search=' + $('#search').val()
                string += '&year=' + $('#year').val()
                string += '&month=' + $('#month').val()
                string += '&day=' + $('#day').val()
                return string
            }
            $('.filter-item .form-select').change(function() {
                window.location.href = location.protocol + "//" + location.host + location.pathname + queryString();
            })
            $('.close-date').click(function () {
                $('#delivery_date').datepicker('clearDates')
            })
            function swapInput(modal, name, value, arr) {
                let use = arr.includes(value) || !value ? 'select' : 'input'
                let notUse = use === 'select' ? 'input' : 'select'
                modal.find(`${use}[name="${name}"]`).val(value)
                modal.find(`${use}[name="${name}"]`).prop('disabled', false).show()
                modal.find(`${notUse}[name="${name}"]`).prop('disabled', 'disabled').hide()
            }
        })
    </script>
@endsection
