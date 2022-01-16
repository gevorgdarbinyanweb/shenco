$(document).ready(function(){
    $(document).on('click','.add-order-type', function(){
        var lastNumber = Number($('#order-type-container .card:last').attr('rel'));
        var k = (lastNumber > 0) ? (lastNumber + 1) : 1;

        var orderTypeHtml = $('#hidden-order-type-container .card').clone();
        $('#order-type-container').append(orderTypeHtml);

        $('#order-type-container .card:last').attr('rel', k);
        $('#order-type-container .card:last').find('.belongs-to-class').val(k);
    });

    $(document).on('click','.remove-order-type', function(){
        $(this).closest('.card').remove();
    });

    $(document).on('change','.reserve-type-id-class', function(){
        var me = $(this);
        var reserveTypeID = me.val();
        var belongsTo = $(this).closest('.card').attr('rel');

        $.ajax({
            url: App.base_path + "ajax/get-reserve-type-materials",
            type: "POST",
            data: {
                reserve_type_id: reserveTypeID
            },
            success:function(data){
                console.log(data);
                if(data.success == true){
                    var html = '<tr>';
                            html += '<td colspan="9">';
                            html += '<input type="text" class="form-control search-reserve-type-material-input" />';
                            html += '</td>';
                        html += '</tr>';
                        html += '<tr>';
                        html += '<th>';
                            html += '#';
                        html += '</th>';
                        html += '<th>';
                            html += 'Կոդ';
                        html += '</th>';
                        html += '<th>';
                            html += 'Անվանում';
                        html += '</th>';
                        html += '<th>';
                            html += 'Միավոր';
                        html += '</th>';
                        html += '<th>';
                            html += 'Քանակ';
                        html += '</th>';
                        html += '<th>';
                            html += 'Գին';
                        html += '</th>';
                        html += '<th>';
                            html += 'Արժեք';
                        html += '</th>';
                        html += '<th>';
                            html += 'Անհրաժեշտ քանակ';
                        html += '</th>';
                        html += '<th>';
                            html += 'Ստացված Գին';
                        html += '</th>';
                    html += '</tr>';
                    var content = data.result.map(function(item){
                        str = '<tr>';
                            str += '<td>';
                                str += '<input type="checkbox" class="check-material-class" data-price="'+item.price+'" data-function="'+item.function+'" data-prop="'+item.prop+'">';
                            str += '</td>';
                            str += '<td>';
                                str += item.code;
                            str += '</td>';
                            str += '<td>';
                                str += item.name;
                            str += '</td>';
                            str += '<td>';
                                str += item.unit;
                            str += '</td>';
                            str += '<td>';
                                str += item.count;
                            str += '</td>';
                            str += '<td>';
                                str += item.price;
                            str += '</td>';
                            str += '<td>';
                                str += item.total;
                            str += '</td>';
                            str += '<td>';
                                str += '<input name="OrderTypeRelMaterials[count][]" type="text" class="form-control material-count-class" disabled="disabled">';
                            str += '</td>';
                            str += '<td>';
                                str += '<input name="OrderTypeRelMaterials[id][]" type="hidden" class="material-id-class" disabled="disabled">';
                                str += '<input name="OrderTypeRelMaterials[price][]" type="text" class="form-control material-price-class" value="0" disabled="disabled">';
                                str += '<input name="OrderTypeRelMaterials[reserve_type_material_id][]" type="hidden" class="reserve-material-id-class" value="'+item.id+'" disabled="disabled">';
                                str += '<input name="OrderTypeRelMaterials[belongs_to][]" type="hidden" class="material-belongs_to-class" value="'+belongsTo+'" disabled="disabled">';
                            str += '</td>';
                        str += '</tr>';
                        return str;
                    });
                    var tableContent = html + content;
                    me.closest('.main-container').next().find('table').html(tableContent);
                    me.closest('.main-container').next().css({'height':'300px','overflow-y':'scroll'});
                }
            }
        });
    });

    $(document).on('change','.has-metal-class', function(){
        var me = $(this);
        var belongsTo = $(this).closest('.card').attr('rel');
        if(me.is(':checked')){
            $.ajax({
                url: App.base_path + "ajax/get-reserve-metals",
                type: "POST",
                data: {},
                success:function(data){
                    console.log(data);
                    if(data.success == true){
                        var html = '<tr>';
                            html += '<td colspan="8">';
                            html += '<input type="text" class="form-control search-reserve-metal-input" />';
                            html += '</td>';
                        html += '</tr>';
                        html += '<tr>';
                            html += '<th>';
                                html += '#';
                            html += '</th>';
                            html += '<th>';
                                html += 'Կոդ';
                            html += '</th>';
                            html += '<th>';
                                html += 'Անվանում';
                            html += '</th>';
                            html += '<th>';
                                html += 'Միավոր';
                            html += '</th>';
                            html += '<th>';
                                html += 'Քանակ';
                            html += '</th>';
                            html += '<th>';
                                html += 'Գին';
                            html += '</th>';
                            html += '<th>';
                                html += 'Արժեք';
                            html += '</th>';
                            html += '<th>';
                                html += 'Անհրաժեշտ քանակ';
                            html += '</th>';
                            html += '<th>';
                                html += 'Ստացված Գին';
                            html += '</th>';
                        html += '</tr>';
                        var content = data.result.map(function(item){
                            str = '<tr>';
                                str += '<td>';
                                    str += '<input type="checkbox" class="check-metal-class" data-price="'+item.price+'" data-function="'+item.function+'" data-prop="'+item.prop+'">';
                                str += '</td>';
                                str += '<td>';
                                    str += item.code;
                                str += '</td>';
                                str += '<td>';
                                    str += item.name;
                                str += '</td>';
                                str += '<td>';
                                    str += item.unit;
                                str += '</td>';
                                str += '<td>';
                                    str += item.count;
                                str += '</td>';
                                str += '<td>';
                                    str += item.price;
                                str += '</td>';
                                str += '<td>';
                                    str += item.total;
                                str += '</td>';
                                str += '<td>';
                                    str += '<input name="OrderTypeRelMetals[count][]" type="text" class="form-control metal-count-class" disabled="disabled">';
                                str += '</td>';
                                str += '<td>';
                                    str += '<input name="OrderTypeRelMetals[id][]" type="hidden" class="metal-id-class" disabled="disabled">';
                                    str += '<input name="OrderTypeRelMetals[price][]" type="text" class="form-control metal-price-class" disabled="disabled">';
                                    str += '<input name="OrderTypeRelMetals[reserve_metal_id][]" type="hidden" class="reserve-metal-id-class" value="'+item.id+'" disabled="disabled">';
                                    str += '<input name="OrderTypeRelMetals[belongs_to][]" type="hidden" class="metal-belongs_to-class" value="'+belongsTo+'" disabled="disabled">';
                                str += '</td>';
                            str += '</tr>';
                            return str;
                        });
                        var tableContent = html + content;
                        me.closest('.main-metal-container').next().find('table').html(tableContent);
                        me.closest('.main-metal-container').next().css({'height':'300px','overflow-y':'scroll'});
                    }
                }
            });
        }else{
            me.closest('.main-metal-container').next().find('table').html('');
            me.closest('.main-metal-container').next().removeAttr('style');
        }
    });

    $(document).on('change','.has-accessories-class', function(){
        var me = $(this);
        var belongsTo = $(this).closest('.card').attr('rel');
        if(me.is(':checked')){
            $.ajax({
                url: App.base_path + "ajax/get-reserve-accessories",
                type: "POST",
                data: {},
                success:function(data){
                    console.log(data);
                    if(data.success == true){
                        var html = '<tr>';
                            html += '<td colspan="8">';
                                html += '<input type="text" class="form-control search-reserve-accessories-input" />';
                            html += '</td>';
                        html += '</tr>';
                        html += '<tr>';
                            html += '<th>';
                                html += '#';
                            html += '</th>';
                            html += '<th>';
                                html += 'Կոդ';
                            html += '</th>';
                            html += '<th>';
                                html += 'Անվանում';
                            html += '</th>';
                            html += '<th>';
                                html += 'Միավոր';
                            html += '</th>';
                            html += '<th>';
                                html += 'Քանակ';
                            html += '</th>';
                            html += '<th>';
                                html += 'Գին';
                            html += '</th>';
                            html += '<th>';
                                html += 'Արժեք';
                            html += '</th>';
                            html += '<th>';
                                html += 'Անհրաժեշտ քանակ';
                            html += '</th>';
                            html += '<th>';
                                html += 'Ստացված Գին';
                            html += '</th>';
                        html += '</tr>';
                        var content = data.result.map(function(item){
                            str = '<tr>';
                                str += '<td>';
                                    str += '<input type="checkbox" class="check-accessory-class">';
                                str += '</td>';
                                str += '<td>';
                                    str += item.code;
                                str += '</td>';
                                str += '<td>';
                                    str += item.name;
                                str += '</td>';
                                str += '<td>';
                                    str += item.unit;
                                str += '</td>';
                                str += '<td>';
                                    str += item.count;
                                str += '</td>';
                                str += '<td>';
                                    str += item.price;
                                str += '</td>';
                                str += '<td>';
                                    str += item.total;
                                str += '</td>';
                                str += '<td>';
                                    str += '<input name="OrderTypeRelAccessories[count][]" type="text" class="form-control accessory-count-class" disabled="disabled">';
                                str += '</td>';
                                str += '<td>';
                                    str += '<input name="OrderTypeRelAccessories[price][]" type="hidden" class="accessory-price-class" value="0" disabled="disabled">';
                                    str += '<input name="OrderTypeRelAccessories[reserve_accessory_id][]" type="hidden" class="reserve-accessory-id-class" value="'+item.id+'" disabled="disabled">';
                                    str += '<input name="OrderTypeRelAccessories[belongs_to][]" type="hidden" class="accessory-belongs_to-class" value="'+belongsTo+'" disabled="disabled">';
                                str += '</td>';
                            str += '</tr>';
                            return str;
                        });
                        var tableContent = html + content;
                        me.closest('.main-accessories-container').next().find('table').html(tableContent);
                        me.closest('.main-accessories-container').next().css({'height':'300px','overflow-y':'scroll'});
                    }
                }
            });
        }else{
            me.closest('.main-accessories-container').next().find('table').html('');
            me.closest('.main-accessories-container').next().removeAttr('style');
        }
    });

    $(document).on('keyup', '.search-reserve-type-material-input', function(){
        var me = $(this);
        var value = me.val().toLowerCase();
        console.log(value);
        me.closest('table').find('tr').not(':nth-child(1)').not(':nth-child(2)').filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    $(document).on('keyup', '.search-reserve-metal-input', function(){
        var me = $(this);
        var value = me.val().toLowerCase();
        console.log(value);
        me.closest('table').find('tr').not(':nth-child(1)').not(':nth-child(2)').filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    $(document).on('keyup', '.search-reserve-accessories-input', function(){
        var me = $(this);
        var value = me.val().toLowerCase();
        console.log(value);
        me.closest('table').find('tr').not(':nth-child(1)').not(':nth-child(2)').filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    $(document).on('change', '.check-material-class', function(){
        var me = $(this);
        var price = Number(me.data('price'));
        var func = String(me.data('function'));
        var prop = String(me.data('prop'));
        var width = me.closest('.card').find('.width-class').val();
        var height = me.closest('.card').find('.height-class').val();
        var leafCount = me.closest('.card').find('.leaf-count-class').val();
        console.log(price);
        console.log(func);
        console.log(width);
        console.log(height);
        console.log(leafCount);
        if(height == '' || width == ''){
            alert('Խնդրում ենք լրացնել լայնությունը և բարձրությունը');
            return false;
        }
        if(me.is(':checked')){
            if(func != '' && prop != ''){
                calculateMaterial(me, width, height, leafCount, price, func, prop);
            }else{
                me.closest('tr').find('.material-count-class,.material-id-class,.material-price-class,.reserve-material-id-class,.material-belongs_to-class').removeAttr('disabled');
            }
        }else{
            me.closest('tr').find('.material-count-class,.material-id-class,.material-price-class,.reserve-material-id-class,.material-belongs_to-class').attr('disabled','disabled');
        }
        
    });

    $(document).on('change', '.check-metal-class', function(){
        var me = $(this);
        var price = Number(me.data('price'));
        var func = String(me.data('function'));
        var prop = String(me.data('prop'));
        var width = me.closest('.card').find('.width-class').val();
        var height = me.closest('.card').find('.height-class').val();
        var leafCount = me.closest('.card').find('.leaf-count-class').val();
        console.log(price);
        console.log(func);
        console.log(width);
        console.log(height);
        console.log(leafCount);
        if(height == '' || width == ''){
            alert('Խնդրում ենք լրացնել լայնությունը և բարձրությունը');
            return false;
        }
        if(me.is(':checked')){
            if(func != '' && prop != ''){
                calculateMetal(me, width, height, leafCount, price, func, prop);
            }else{
                me.closest('tr').find('.metal-count-class,.metal-id-class,.metal-price-class,.reserve-metal-id-class,.metal-belongs_to-class').removeAttr('disabled');
            }
        }else{
            me.closest('tr').find('.metal-count-class,.metal-id-class,.metal-price-class,.reserve-metal-id-class,.metal-belongs_to-class').attr('disabled','disabled');
        }
    });

    $(document).on('change', '.check-accessory-class', function(){
        var me = $(this);
        if(me.is(':checked')){
            me.closest('tr').find('.accessory-count-class,.accessory-price-class,.reserve-accessory-id-class,.accessory-belongs_to-class').removeAttr('disabled');
        }else{
            me.closest('tr').find('.accessory-count-class,.accessory-price-class,.reserve-accessory-id-class,.accessory-belongs_to-class').attr('disabled','disabled');
        }
    });

    $(document).on('keyup','.width-class', function(){
        var width = Number($(this).val());
        var height = Number($(this).closest('.card').find('.height-class').val());
        console.log(width);
        console.log(height);
        if(width > 0 && height > 0){
            calculate($(this), width, height);
        }
    });

    $(document).on('keyup','.height-class', function(){
        var width = Number($(this).closest('.card').find('.width-class').val());
        var height = Number($(this).val());
        console.log(width);
        console.log(height);
        if(width > 0 && height > 0){
            calculate($(this), width, height);
        }
    });

    function calculate(scope, width, height){
        $.ajax({
            url: App.base_path + "ajax/calculate",
            type: "POST",
            data: {
                width: width,
                height: height
            },
            dataType: 'json',
            success:function(data){
                console.log(data);
                if(data.success){
                    var $card = scope.closest('.card');
                    $card.find('.area-class').val(data.result.area);
                    $card.find('.working-area-class').val(data.result.working_area);
                    $card.find('.other-expenses-class').val(data.result.other_expenses);
                    calculateOrderArea();
                }
            }
        });
    }

    function calculateMaterial(scope, width, height, leafCount, price, func, prop){
        $.ajax({
            url: App.base_path + "ajax/calculate-materials",
            type: "POST",
            data: {
                width: width,
                height: height,
                leaf_count: leafCount,
                price: price,
                func: func,
                prop, prop
            },
            dataType: 'json',
            success:function(data){
                console.log(data);
                if(data.success){
                    var tr = scope.closest('tr');
                    tr.find('.material-count-class').val(data.result.count);
                    tr.find('.material-price-class').val(data.result.total);

                    tr.find('.material-count-class,.material-id-class,.material-price-class,.reserve-material-id-class,.material-belongs_to-class').removeAttr('disabled');
                    var total = 0;
                    var materialPrices = tr.closest('.table').find('.material-price-class');
                    materialPrices.each(function(index, item){
                        if($(item).closest('tr').find('.check-material-class').is(':checked')){
                            total += Number($(item).val());
                        }
                    });
                    console.log(total);

                    var metalPrices = scope.find('.card').find('.reserve-metal-table').find('.metal-price-class');
                    metalPrices.each(function(index, item){
                        if($(item).closest('tr').find('.check-metal-class').is(':checked')){
                            total += Number($(item).val());
                        }
                    });

                    console.log(total);
                    calculateLocalRealPrice(scope, total);
                    calculateRealPrice();
                    calculateSellPrice();
                }
            }
        });
    }

    function calculateMetal(scope, width, height, leafCount, price, func, prop){
        $.ajax({
            url: App.base_path + "ajax/calculate-materials",
            type: "POST",
            data: {
                width: width,
                height: height,
                leaf_count: leafCount,
                price: price,
                func: func,
                prop, prop
            },
            dataType: 'json',
            success:function(data){
                if(data.success){
                    var tr = scope.closest('tr');
                    tr.find('.metal-count-class').val(data.result.count);
                    tr.find('.metal-price-class').val(data.result.total);

                    tr.find('.metal-count-class,.metal-id-class,.metal-price-class,.reserve-metal-id-class,.metal-belongs_to-class').removeAttr('disabled');
                    var total1 = 0;
                    var metalPrices = tr.closest('.table').find('.metal-price-class');
                    metalPrices.each(function(index, item){
                        if($(item).closest('tr').find('.check-metal-class').is(':checked')){
                            // console.log($(item).val());
                            total1 += Number($(item).val());
                        }
                    });
                    console.log("total1="+total1);

                    var total2 = 0;
                    var materialPrices = scope.closest('.card').find('.reserve-type-materials-table').find('.material-price-class');
                    materialPrices.each(function(index, item){
                        if($(item).closest('tr').find('.check-material-class').is(':checked')){
                            console.log($(item).val());
                            total2 += Number($(item).val());
                        }
                    });
                    console.log("total2="+total2);
                    var total = total1 + total2;
                    console.log(total);
                    calculateLocalRealPrice(scope, total);
                    calculateRealPrice();
                    calculateSellPrice();
                }
            }
        });
    }

    function calculateLocalRealPrice(scope, total){
        //TODO calculate all prices
        scope.closest('.card').find('.order-type-real-price-class').val(total);
    }

    function calculateRealPrice(){
        //TODO calculate all prices
        var total = 0;
        var materialPrices = $('#order-type-container .card').find('.table').find('.material-price-class');
        materialPrices.each(function(index, item){
            if($(item).closest('tr').find('.check-material-class').is(':checked')){
                total += Number($(item).val());
            }
        });
        console.log(total);
        console.log("metal prices");
        var metalPrices = $('#order-type-container .card').find('.table').find('.metal-price-class');
        metalPrices.each(function(index, item){
            if($(item).closest('tr').find('.check-metal-class').is(':checked')){
                console.log($(item).val());
                total += Number($(item).val());
                console.log(total);
            }
        });
        console.log(total);
        $('#order-real_price').val(total);
    }

    function calculateSellPrice(){
        var realPrice = Number($('#order-real_price').val());
        var sellPrice = realPrice + realPrice * 30 / 100;
        console.log(sellPrice);
        $('#order-sell_price').val(sellPrice.toFixed(2));
    }

    function calculateOrderArea(){
        var $area = $('#order-type-container .card').find('.area-class');
        var total = 0;
        $area.each(function(index, item) {
            total += Number($(item).val());
        });
        console.log(total);
        $('#order-area').val(total);
    }
});