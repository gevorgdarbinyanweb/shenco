$(document).ready(function(){
    $(document).on('click','.shopping-cart', function(){
        var id = $(this).data('order-id');
        $.ajax({
            url: App.base_path + "ajax/sell",
            type: "POST",
            data: {
                id: id
            },
            success:function(data){
                alert('Done');
            }
        });
    });
});