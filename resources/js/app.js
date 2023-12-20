import './bootstrap';


$('.select_purchase_id').change(function () {
    var purchase_id = $(this).val();

    $.ajax({
        url: "/get-single-purchase-details/" + purchase_id,
        success: function (response) {
            var htmlData = '';
            var grand_total = 0;
            for (let x = 0; x < response.length; x++) {
                htmlData += '<tr>\n' +
                    '                                                    <td class="text-center">' + x + '</td>\n' +
                    '                                                    <td>' + response[x]['code'] + '</td>\n' +
                    '                                                    <td>' + response[x]['product_name'] + '</td>\n' +
                    '                                                    <td>' + response[x]['qty'] + '</td>\n' +
                    '                                                    <td>' + response[x]['price'] + '</td>\n' +
                    '                                                    <td>' + response[x]['total'] + '</td>\n' +
                    '                                                </tr>';

                grand_total += parseInt(response[x]['total']);

            }
            $('.tableFixHead tbody').html('');
            $('.tableFixHead tbody').append(htmlData);
            $('.grand_total').html(grand_total);
            $(".paid_amount").attr({"max": grand_total});
        }
    });
});


$('.select_sale_id').change(function () {
    var sale_id = $(this).val();

    $.ajax({
        url: "/get-single-sale-details/" + sale_id,
        success: function (response) {
            var htmlData = '';
            var grand_total = 0;
            for (let x = 0; x < response.length; x++) {
                htmlData += '<tr>\n' +
                    '                                                    <td class="text-center">' + x + '</td>\n' +
                    '                                                    <td>' + response[x]['code'] + '</td>\n' +
                    '                                                    <td>' + response[x]['product_name'] + '</td>\n' +
                    '                                                    <td>' + response[x]['qty'] + '</td>\n' +
                    '                                                    <td>' + response[x]['price'] + '</td>\n' +
                    '                                                    <td>' + response[x]['total'] + '</td>\n' +
                    '                                                </tr>';

                grand_total += parseInt(response[x]['total']);

            }
            $('.tableFixHead tbody').html('');
            $('.tableFixHead tbody').append(htmlData);
            $('.grand_total').html(grand_total);
            $(".paid_amount").attr({"max": grand_total});
        }
    });
});

$('.select_product').change(function () {
    var product_id = $(this).val();

    $.ajax({
        url: "/get-single-product/" + product_id,
        success: function (html) {
            let data = '<tr>\n' +
                '                                                    <td class="text-center">1</td>\n' +
                '                                                    <td>' + html.code + '</td>\n' +
                '                                                    <td>' + html.name + '</td>\n' +
                '                                                    <td>\n' +
                '                                                        <input type="number" name="qty[]" required onkeyup="calculateTotalPrice(this)" class="form-control qty text-center">\n' +
                '                                                        <input type="hidden" name="product_id[]" value="' + html.id + '">\n' +
                '                                                    </td>\n' +
                '                                                    <td>\n' +
                '                                                        <input type="number" name="unit_price[]" required onkeyup="calculateTotalPrice(this)" class="form-control price text-center">\n' +
                '                                                    </td>\n' +
                '                                                    <td class="text-center">\n' +
                '                                                        <b class="total"></b>\n' +
                '                                                    </td>\n' +
                '                                                    <td class="text-center">\n' +
                '                                                        <a href="javascript:void(0);" class="remove_btn" onclick="remove_table_column(this)">Delete</a>\n' +
                '                                                    </td>\n' +
                '                                                </tr>';

            $('.tableFixHead tbody').append(data);
        }
    });
});

window.remove_table_column = function (e) {
    $(e).closest('tr').remove();
}

window.calculateTotalPrice = function (e) {
    var qty = $(e).closest('tr').find('.qty').val();
    var price = $(e).closest('tr').find('.price').val();
    var total_amount = parseInt(qty) * parseInt(price);
    $(e).closest('tr').find('.total').html(total_amount);

    var sum = 0;
    $('.total').each(function () {
        sum += parseFloat($(this).html());
    });

    $('.grand_total').html(sum);
}
window.PaidAmount = function (e) {
    var total_amount = $('.grand_total').html();
    var paid_amount = $('.paid_amount').val() || 0;
    var discount_amount = $('.discount_amount').val() || 0;

    $('.due_amount').html(parseInt(total_amount) - parseInt(discount_amount) - parseInt(paid_amount));
}
