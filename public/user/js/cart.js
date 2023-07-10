$('.btn-number').click(function(e){
    e.preventDefault();
    
    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $("input[name='"+fieldName+"']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if(type == 'minus') {
            
            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            } 
            if(parseInt(input.val()) == input.attr('min')) {
                $(this).attr('disabled', true);
            }

        } else if(type == 'plus') {

            if(currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
            }
            if(parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
            }

        }
    } else {
        input.val(0);
    }
});
$('.input-number').focusin(function(){
   $(this).data('oldValue', $(this).val());
});
$('.input-number').change(function() {
    
    minValue =  parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());
    
    name = $(this).attr('name');
    if(valueCurrent >= minValue) {
        $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the minimum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
        $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the maximum value was reached');
        $(this).val($(this).data('oldValue'));
    }
});

$(".input-number").keydown(function (e) {
    // Allow: backspace, delete, tab, escape, enter and .
    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
         // Allow: Ctrl+A
        (e.keyCode == 65 && e.ctrlKey === true) || 
         // Allow: home, end, left, right
        (e.keyCode >= 35 && e.keyCode <= 39)) {
             // let it happen, don't do anything
             return;
    }
    // Ensure that it is a number and stop the keypress
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
        e.preventDefault();
    }
});

// $(document).ready(function(){
//     $("input[name='num-order']").change(function(){
//         alert("Sự kiện change() vừa mới xảy ra");
//     });
// });
// function inputChange(event){

//     alert("Sự kiện change() vừa mới xảy ra");


// }

// let text = document.getElementById('nametext');
// text.addEventListener('change', inputChange);

$('.num-order').change(function(){
    // var quantity = 
    // var product = document.querySelectorAll('.num-order')

    // var rowId = []
    // product.forEach(e=>{
    //      rowId.push(e.dataset.rowid)
    //     //console.log(rowId)
    //     //console.log(e.dataset.rowid)
    // })
    //var rowId = product.dataset.rowid
    //console.log(rowId)
    //alert(urlUpdate)
    //alert("Sự kiện change() vừa mới");
});
function updateProductCart() {
    alert('ok')
    var urlUpdate = $(".num-product-wp").data("url");

    $.ajax({
        url: urlUpdate,
        method: "GET",
        data: { rowId: rowId, qty: qty },
        dataType: "json",
        success: function (data) {
            if (data.code == 200) {
                $("#sub-total-" + rowId + "").text(data.subTotal + "đ");
                setInterval(function () {
                    $("#dropdown-cart-wp").load(
                        location.href + " #dropdown-cart-wp"
                    );
                }, 2000);
                $(".num-total").text(data.num);
                $(".total-cart").text(data.total + "đ");
            }
        },
    });
}
$('.num-order-cart').addEventListener("click", updateProductCart);

let text = document.getElementsByClassName('.num-order-cart');
 text.addEventListener('click', updateProductCart);