$(document).ready(function(){
    $(document).on('keyup','#reserveaccessories-count', function(){
        setTotal($(this).val(), $('#reserveaccessories-price').val());
    });

    $(document).on('keyup','#reserveaccessories-price', function(){
        setTotal($('#reserveaccessories-count').val(), $(this).val());
    });

    function setTotal(count, price){
        if(count != '' && price != '') {
            var total = multiply(count, price);
            $('#reserveaccessories-total').val(total);
        }
    }

    function multiply(count, price) {
        return parseFloat((count * price).toFixed(2));
    }
});