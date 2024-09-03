<div class="modal fade price-2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="price-title">Hộp sóng E</h5>
                <span class="material-symbols-outlined close">
                        close
                    </span>
            </div>
            <div class="modal-body">
                @include('partial.square')
                <div class="d-flex paper line">
                    <div class="line-item">
                        <label for="dl">Đ L</label>
                        <input id="dl" pattern="[0-9]*" type="number"/>
                    </div>
                    <div class="line-item">
                        <label for="paper-in">TT Giấy*</label>
                        <input id="paper-in" type="number" value="16"/>
                    </div>

                    <div class="line-item">
                        <label for="paper-total">TT Giấy</label>
                        <input id="paper-total" disabled/>
                    </div>
                </div>
                <div class="d-flex paper line">
                    <div class="line-item">
                        <label for="paper-quantity">SL Giấy</label>
                        <input id="paper-quantity" pattern="[0-9]*" type="number"/>
                    </div>

                    <div class="line-item">
                        <label for="b-wave-star">Sóng E*</label>
                        <input id="b-wave-star" pattern="[0-9]*" type="number" value="6000"/>
                    </div>
                    <div class="line-item">
                        <label for="b-wave">Sóng E</label>
                        <input id="b-wave" disabled/>
                    </div>
                </div>
                <div class="d-flex tt_3 line">
                    <div class="line-item">
                        <label for="print_quantity">Lượt in</label>
                        <input id="print_quantity" pattern="[0-9]*" type="number"/>
                    </div>
{{--                    <div class="line-item">--}}
{{--                        <label for="print_tt">TT Lượt in*</label>--}}
{{--                        <input id="print_tt" pattern="[0-9]*" type="number" value="60"/>--}}
{{--                    </div>--}}
                    <div class="line-item">
                        <label for="tt_print">TT Lượt in</label>
                        <input id="tt_print" type="number" pattern="[0-9]*"/>
                    </div>
                </div>
                <div class="d-flex zn line">
                    <div class="line-item">
                        <label for="zn-quantity">SL Kẽm</label>
                        <input id="zn-quantity" pattern="[0-9]*" type="number"/>
                    </div>
                    <div class="line-item">
                        <label for="zn-price">Tiền kẽm</label>
                        <input id="zn-price" pattern="[0-9]*" type="number"/>
                    </div>

                    <div class="line-item">
                        <label for="print_total">TT Tiền in</label>
                        <input id="print_total" disabled/>
                    </div>
                </div>
                <div class="d-flex laminate line">
                    <div class="line-item">
                        <label for="tt_can_1">TT Cán*</label>
                        <input id="tt_can_1" value="24"/>
                    </div>
                    <div class="line-item">
                        <label for="tt_can_2">TT Cán**</label>
                        <input id="tt_can_2" pattern="[0-9]*" type="number" value="100"/>
                    </div>
                    <div class="line-item">
                        <label for="laminate_total">TT Cán</label>
                        <input id="laminate_total" disabled/>
                    </div>
                </div>
                <div class="d-flex other line">
                    <div class="line-item">
                        <label for="mold">Khuôn</label>
                        <input id="mold" type="number" pattern="[0-9]*"/>
                    </div>
                    <div class="line-item">
                        <label for="prod_quantity">SL T.Phẩm</label>
                        <input id="prod_quantity" pattern="[0-9]*" type="number"/>
                    </div>
                    <div class="line-item">
                        <label for="other">Khác</label>
                        <input id="other" type="number" pattern="[0-9]*"/>
                    </div>
                </div>
                <div class="d-flex tt_3 line">
                    <div class="line-item">
                        <label for="tt_paste_1">TT Bế, dán*</label>
                        <input id="tt_paste_1" type="number" pattern="[0-9]*" value="400"/>
                    </div>
                    <div class="line-item">
                        <label for="tt_paste">TT Bế, dán</label>
                        <input id="tt_paste" disabled/>
                    </div>
                </div>
                <div class="d-flex tt_3 line">
                    <div class="line-item">
                        <label for="tt_money">TT Tiền GC</label>
                        <input id="tt_money" disabled/>
                    </div>
                    <div class="line-item">
                        <label for="tt_total">Tổng Cộng</label>
                        <input id="tt_total" disabled/>
                    </div>
                </div>
                <div class="d-flex tt_3 line">
                    <div class="line-item">
                        <label for="interest">% Lãi suất</label>
                        <input id="interest" value="0.3"/>
                    </div>

                    <div class="line-item">
                        <label for="interest_amount">Lãi suất</label>
                        <input id="interest_amount" disabled/>
                    </div>

                </div>
                <div class="d-flex tt_3 line">
                    <div class="line-item">
                        <label for="prod_price">Giá SP</label>
                        <input id="prod_price" disabled/>
                    </div>
                    <div class="line-item">
                        <label for="prods_price">Giá bán</label>
                        <input id="prods_price" disabled/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('.close').click(function () {
            $(this).closest('.modal').modal('hide')
        })
        $('.line input').on('input', function () {
            // Lưu trữ giá trị input cần thiết
            let length = parseFloat($('#length').val()) || 0;
            let width = parseFloat($('#width').val()) || 0;
            let squareVal = length * width;

            let paperQuantity = parseFloat($('#paper-quantity').val()) || 0;
            let paperIn = parseFloat($('#paper-in').val()) || 0;
            let dl = parseFloat($('#dl').val()) || 0;

            let bWaveStar = parseFloat($('#b-wave-star').val()) || 0;
            let printQuantity = parseFloat($('#print_quantity').val()) || 0;
            let printTT = parseFloat($('#print_tt').val()) || 0;

            let znPrice = parseFloat($('#zn-price').val()) || 0;
            let znQuantity = parseFloat($('#zn-quantity').val()) || 0;

            let ttCan1 = parseFloat($('#tt_can_1').val()) || 0;
            let ttCan2 = parseFloat($('#tt_can_2').val()) || 0;

            let ttPaste1 = parseFloat($('#tt_paste_1').val()) || 0;
            let prodQuantity = parseFloat($('#prod_quantity').val()) || 0;

            let mold = parseFloat($('#mold').val()) || 0;
            let other = parseFloat($('#other').val()) || 0;
            let interest = parseFloat($('#interest').val()) || 0;
            let ttPrint = parseFloat($('#tt_print').val()) || 0;

            // Tính toán
            let square = squareVal;
            let paperTotal = square * dl * paperQuantity * paperIn;
            let bWave = square * bWaveStar * paperQuantity;
            let printTotal = znPrice * znQuantity + ttPrint;
            let laminateTotal = square * ttCan1 * ttCan2 * paperQuantity;
            let ttPaste = prodQuantity * ttPaste1;
            let ttMoney = laminateTotal + mold + ttPaste;

            if (other) {
                ttMoney += other;
            }

            let ttTotal = paperTotal + bWave + printTotal + ttMoney;
            let prodPrice = ttTotal / prodQuantity;
            let interestAmount = prodPrice * interest;
            let prodsPrice = prodPrice + interestAmount;

            // Cập nhật giá trị vào các trường input
            $('#square').val(square.toFixed(4));
            $('#paper-total').val(formatCurrency(paperTotal));
            $('#b-wave').val(formatCurrency(bWave));
            // $('#tt_print').val(ttPrint);
            $('#print_total').val(formatCurrency(printTotal));
            $('#laminate_total').val(formatCurrency(laminateTotal));
            $('#tt_paste').val(formatCurrency(ttPaste));
            $('#tt_money').val(formatCurrency(ttMoney));
            $('#tt_total').val(formatCurrency(ttTotal));
            $('#prod_price').val(formatCurrency(prodPrice));
            $('#interest_amount').val(formatCurrency(interestAmount));
            $('#prods_price').val(formatCurrency(prodsPrice));
        });
    })
</script>

<style>
    .line {
        width: 100%;
        justify-content: space-between;
        padding-bottom: 10px;
    }
    .square .line-item, .paper .line-item, .zn .line-item, .laminate .line-item, .other .line-item {
        width: 30%;
    }
    .tt_1 .line-item, .tt_2 .line-item {
        width: 23%;
    }
    .tt_3 .line-item {
        width: 45%;
    }
    .line-item input {
        width: 100%;
    }
</style>

