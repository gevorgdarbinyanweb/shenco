$(document).ready(function(){
    $(document).on('keyup','#reservemetals-count', function(){
        setTotal($(this).val(), $('#reservemetals-price').val());
    });

    $(document).on('keyup','#reservemetals-price', function(){
        setTotal($('#reservemetals-count').val(), $(this).val());
    });

    function setTotal(count, price){
        if(count != '' && price != '') {
            var total = multiply(count, price);
            $('#reservemetals-total').val(total);
        }
    }

    function multiply(count, price) {
        return parseFloat((count * price).toFixed(2));
    }
});