<div class="modal fade price-4" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="price-title">KẸP FILE A4 IN 1 CÁN 1</h5>
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
                        <label for="paper_quantity_1">Tổng giấy*</label>
                        <input id="paper_quantity_1" type="number" value="150"/>
                    </div>

                    <div class="line-item">
                        <label for="paper_quantity">Tổng giấy</label>
                        <input id="paper_quantity" disabled/>
                    </div>
                </div>
                <div class="d-flex tt_3 line">
                    <div class="line-item">
                        <label for="length">Dài</label>
                        <input id="length" pattern="[0-9]*" value="0.54"/>
                    </div>

                    <div class="line-item">
                        <label for="width">Rộng</label>
                        <input id="width" pattern="[0-9]*" value="0.39"/>
                    </div>
                </div>
                <div class="d-flex zn line">
                    <div class="line-item">
                        <label for="tt_paper_1">TT Giấy*</label>
                        <input id="tt_paper_1" pattern="[0-9]*" type="number" value="300"/>
                    </div>
                    <div class="line-item">
                        <label for="tt_paper_2">TT Giấy**</label>
                        <input id="tt_paper_2" pattern="[0-9]*" type="number" value="27"/>
                    </div>
                    <div class="line-item">
                        <label for="tt_paper">TT Giấy</label>
                        <input id="tt_paper" disabled/>
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
                        <label for="tt_can_1">TT Cán*</label>
                        <input id="tt_can_1" value="39"/>
                    </div>
                    <div class="line-item">
                        <label for="tt_can_2">TT Cán**</label>
                        <input id="tt_can_2" pattern="[0-9]*" value="54"/>
                    </div>
                </div>
                <div class="d-flex tt_3 line">
                    <div class="line-item">
                        <label for="tt_can_3">TT Cán*</label>
                        <input id="tt_can_3" value="0.26"/>
                    </div>
                    <div class="line-item">
                        <label for="laminate_total">TT Cán</label>
                        <input id="laminate_total" disabled/>
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
                        <input id="tt_paste_1" type="number" pattern="[0-9]*" value="200"/>
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
                    <div class="line-item">
                        <label for="prod_price">Giá SP</label>
                        <input id="prod_price" disabled/>
                    </div>

                </div>
                <div class="d-flex zn line">
                    <div class="line-item">
                        <label for="interest">% Lãi suất</label>
                        <input id="interest" value="0.3"/>
                    </div>
                    <div class="line-item">
                        <label for="interest_amount">Lãi suất</label>
                        <input id="interest_amount" disabled/>
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

            let quantity = parseFloat($('#quantity').val()) || 0;
            let paper_quantity_1 = parseFloat($('#paper_quantity_1').val()) || 0;
            let tt_paper_1 = parseFloat($('#tt_paper_1').val()) || 0;
            let tt_paper_2 = parseFloat($('#tt_paper_2').val()) || 0;

            let printQuantity = parseFloat($('#print_quantity').val()) || 0;
            let printTT = parseFloat($('#print_tt').val()) || 0;

            let znPrice = parseFloat($('#zn-price').val()) || 0;
            let znQuantity = parseFloat($('#zn-quantity').val()) || 0;

            let ttCan1 = parseFloat($('#tt_can_1').val()) || 0;
            let ttCan2 = parseFloat($('#tt_can_2').val()) || 0;
            let ttCan3 = parseFloat($('#tt_can_3').val()) || 0;

            let ttPaste1 = parseFloat($('#tt_paste_1').val()) || 0;

            let mold = parseFloat($('#mold').val()) || 0;
            let other = parseFloat($('#other').val()) || 0;
            let interest = parseFloat($('#interest').val()) || 0;

            // Tính toán
            let paper_quantity = quantity + paper_quantity_1;
            let tt_paper = length * width * tt_paper_1 * tt_paper_2 * paper_quantity
            let ttPrint = printQuantity * printTT;
            let printTotal = znPrice * znQuantity + ttPrint;
            let laminateTotal =  ttCan1 * ttCan2 * ttCan3 * paper_quantity;
            let ttPaste = quantity * ttPaste1;
            let ttTotal = tt_paper + + printTotal + laminateTotal + mold + ttPaste;

            if (other) {
                ttTotal += other;
            }

            let prodPrice = ttTotal / quantity;
            let interestAmount = prodPrice * interest;
            let prodsPrice = prodPrice + interestAmount;

            // Cập nhật giá trị vào các trường input
            $('#paper_quantity').val(paper_quantity)
            $('#tt_print').val(formatCurrency(ttPrint));
            $('#print_total').val(formatCurrency(printTotal));
            $('#laminate_total').val(formatCurrency(laminateTotal));
            $('#tt_paste').val(formatCurrency(ttPaste));
            $('#tt_paper').val(formatCurrency(tt_paper));
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

