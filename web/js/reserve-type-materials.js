$(document).ready(function(){
    $(document).on('keyup','#reservetypematerials-count', function(){
        setTotal($(this).val(), $('#reservetypematerials-price').val());
    });

    $(document).on('keyup','#reservetypematerials-price', function(){
        setTotal($('#reservetypematerials-count').val(), $(this).val());
    });

    function setTotal(count, price){
        if(count != '' && price != '') {
            var total = multiply(count, price);
            $('#reservetypematerials-total').val(total);
        }
    }

    function multiply(count, price) {
        return parseFloat((count * price).toFixed(2));
    }
});