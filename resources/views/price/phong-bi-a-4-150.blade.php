<div class="modal fade price-17" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="price-title">PHONG BÌ A 4 OF 150</h5>
                <span class="material-symbols-outlined close">
                        close
                    </span>
            </div>
            <div class="modal-body">
                <div class="d-flex paper line">
                    <div class="line-item">
                        <label for="quantity">Số lượng</label>
                        <input id="quantity" pattern="[0-9]*" type="number"/>
                    </div>
                    <div class="line-item">
                        <label for="paper_plus">Tổng giấy*</label>
                        <input id="paper_plus" type="number" value="100"/>
                    </div>

                    <div class="line-item">
                        <label for="paper_total">Tổng giấy</label>
                        <input id="paper_total" disabled/>
                    </div>
                </div>
                <div class="d-flex tt_3 line">
                    <div class="line-item">
                        <label for="length">Dài</label>
                        <input id="length" pattern="[0-9]*" type="number" value="0.54"/>
                    </div>

                    <div class="line-item">
                        <label for="width">Rộng</label>
                        <input id="width" pattern="[0-9]*" type="number" value="0.39"/>
                    </div>
                </div>
                <div class="d-flex zn line">
                    <div class="line-item">
                        <label for="tt_giay_1">TT Giấy*</label>
                        <input id="tt_giay_1" pattern="[0-9]*" type="number" value="150"/>
                    </div>
                    <div class="line-item">
                        <label for="tt_giay_2">TT Giấy**</label>
                        <input id="tt_giay_2" pattern="[0-9]*" type="number" value="28"/>
                    </div>
                    <div class="line-item">
                        <label for="tt_giay">TR Giấy</label>
                        <input id="tt_giay" disabled/>
                    </div>
                </div>
                <div class="d-flex zn line">
                    <div class="line-item">
                        <label for="print_quantity">Lượt in</label>
                        <input id="print_quantity" pattern="[0-9]*" type="number"/>
                    </div>
                    <div class="line-item">
                        <label for="print_tt">TT Lượt in*</label>
                        <input id="print_tt" pattern="[0-9]*" type="number" value="30"/>
                    </div>
                    <div class="line-item">
                        <label for="tt_print">TT Lượt in</label>
                        <input id="tt_print" disabled/>
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
                <div class="d-flex tt_3 line">
                    <div class="line-item">
                        <label for="mold">Khuôn</label>
                        <input id="mold" type="number" pattern="[0-9]*"/>
                    </div>
                    <div class="line-item">
                        <label for="other">Khác</label>
                        <input id="other" type="number" pattern="[0-9]*"/>
                    </div>
                </div>
                <div class="d-flex tt_3 line">
                    <div class="line-item">
                        <label for="tt_paste_1">TT Bế, dán*</label>
                        <input id="tt_paste_1" type="number" pattern="[0-9]*" value="160"/>
                    </div>
                    <div class="line-item">
                        <label for="tt_paste">TT Bế, dán</label>
                        <input id="tt_paste" disabled/>
                    </div>
                </div>
                <div class="d-flex tt_3 line">
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

            let quantity = parseFloat($('#quantity').val()) || 0;
            let paper_plus = parseFloat($('#paper_plus').val()) || 0;
            let length = parseFloat($('#length').val()) || 0;
            let width = parseFloat($('#width').val()) || 0;
            let tt_giay_1 = parseFloat($('#tt_giay_1').val()) || 0;
            let tt_giay_2 = parseFloat($('#tt_giay_2').val()) || 0;

            let printQuantity = parseFloat($('#print_quantity').val()) || 0;
            let printTT = parseFloat($('#print_tt').val()) || 0;

            let znPrice = parseFloat($('#zn-price').val()) || 0;
            let znQuantity = parseFloat($('#zn-quantity').val()) || 0;

            let ttPaste1 = parseFloat($('#tt_paste_1').val()) || 0;
            let prodQuantity = parseFloat($('#prod_quantity').val()) || 0;

            let mold = parseFloat($('#mold').val()) || 0;
            let other = parseFloat($('#other').val()) || 0;
            let interest = parseFloat($('#interest').val()) || 0;

            // Tính toán
            let paper_total = quantity + paper_plus;
            let tt_giay = length * width * tt_giay_1 * tt_giay_2 * paper_total
            let ttPrint = printQuantity * printTT;
            let printTotal = znPrice * znQuantity + ttPrint;
            let ttPaste = quantity * ttPaste1;
            let tt_total = tt_giay + printTotal + mold + + ttPaste
            if (other) {
                tt_total += other;
            }
            let prodPrice = tt_total / quantity;
            let interestAmount = prodPrice * interest;
            let prodsPrice = prodPrice + interestAmount;

            // Cập nhật giá trị vào các trường input
            $('#paper_total').val(paper_total);
            $('#tt_giay').val(formatCurrency(tt_giay));
            $('#tt_print').val(formatCurrency(ttPrint));
            $('#print_total').val(formatCurrency(printTotal));
            $('#tt_paste').val(formatCurrency(ttPaste));
            $('#tt_total').val(formatCurrency(tt_total));
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

