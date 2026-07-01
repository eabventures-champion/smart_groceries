function updateTotalPrice($input) {
    var qty = parseInt($input.val(), 10) || 1;
    var isModal = $input.attr('id') === 'qty';
    var priceEl, oldPriceEl;
    
    if (isModal) {
        priceEl = $('#pprice');
        oldPriceEl = $('#oldprice');
    } else {
        priceEl = $('.get_attribute_price .current-price');
        oldPriceEl = $('.get_attribute_price .old-price');
        if (!priceEl.length) {
            priceEl = $('#detail-current-price');
        }
        if (!oldPriceEl.length) {
            oldPriceEl = $('#detail-old-price');
        }
    }
    
    var basePrice = parseFloat(priceEl.attr('data-base-price'));
    if (isNaN(basePrice)) {
        var priceText = priceEl.text().replace(/[^\d.]/g, '');
        basePrice = parseFloat(priceText) || 0;
        priceEl.attr('data-base-price', basePrice);
    }
    
    if (basePrice > 0) {
        var total = basePrice * qty;
        if (isModal) {
            priceEl.text(total.toFixed(2));
        } else {
            priceEl.text('Gh ' + total.toFixed(2));
        }
    }
    
    if (oldPriceEl.length) {
        var baseOldPrice = parseFloat(oldPriceEl.attr('data-base-price'));
        if (isNaN(baseOldPrice)) {
            var oldPriceText = oldPriceEl.text().replace(/[^\d.]/g, '');
            baseOldPrice = parseFloat(oldPriceText) || 0;
            oldPriceEl.attr('data-base-price', baseOldPrice);
        }
        if (baseOldPrice > 0) {
            var totalOld = baseOldPrice * qty;
            if (isModal) {
                oldPriceEl.text(totalOld.toFixed(2));
            } else {
                oldPriceEl.text('Gh ' + totalOld.toFixed(2));
            }
        }
    }
}

$(document).ready(function(){

   $(document).on('change input', '.qty-val', function() {
       updateTotalPrice($(this));
   });

   $("#getPrice").change(function () {
        var size = $(this).val();
        var product_id = $(this).attr("product-id");

        $.ajax({
           headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
           type: 'post',
           url: '/get-product-price',
           data: {
              size: size,
              product_id: product_id
           },
           success: function (resp) {
              if (resp['discount'] > 0) {
                 $(".get_attribute_price").html("<div class='product-price primary-color float-left'><span class='current-price text-brand' id='detail-current-price' data-base-price='" + resp['final_price'] + "'>Gh " + resp['final_price'].toFixed(2) + "</span><span><span class='save-price font-md color3 ml-15'>" + " " + resp['discount_percent'] + "% Off</span><span class='old-price font-md ml-15' id='detail-old-price' data-base-price='" + resp['selling_price'] + "'>Gh " + resp['selling_price'].toFixed(2) + "</span></span></div>");
              } else {
                 $(".get_attribute_price").html("<div class='product-price primary-color float-left'><span class='current-price text-brand' id='detail-current-price' data-base-price='" + resp['selling_price'] + "'>Gh " + resp['selling_price'].toFixed(2) + "</span></div>");
              }

              $(".qty-stock").html("<h4 class='heading-2 text-center'><button type='button' class='btn btn-primary position-relative' style='padding: 5px 10px; font-weight:200'>in stock<span class='position-absolute top-0 start-100 translate-middle badge rounded-pill bg-secondary' style='background-color: #351313 !important;font-size: .95em;'>" + "" + resp['product_stock'] + "</span></button></h4>");

              var sizeStock = parseInt(resp['product_stock'], 10);
              $('#dqty').attr('max', sizeStock).attr('data-stock', sizeStock);
              var currentQty = parseInt($('#dqty').val(), 10) || 1;
              if (currentQty > sizeStock) {
                 $('#dqty').val(sizeStock > 0 ? sizeStock : 1);
              }
              
              // Trigger price update after HTML replacement
              updateTotalPrice($('#dqty'));
           },
           error: function () {
              alert('Error');
           }
        });
   });

   $("#getPrice_modal").change(function () {
      var size = $(this).val();
      var product_id = $("#product_id").val();

      $.ajax({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         type: 'post',
         url: '/get-product-price',
         data: {
            size: size,
            product_id: product_id
         },
         success: function (resp) {
            if (resp['discount'] > 0) {
               $(".get_attribute_price_modal").html("<div class='product-price primary-color float-left'><span class='current-price text-brand'>Gh&nbsp;</span><span class='current-price text-brand' id='pprice' data-base-price='" + resp['final_price'] + "'>" + " " + resp['final_price'].toFixed(2) + "</span><span class='old-price font-md ml-20' id='hide_curreny'></span><span class='old-price font-md ml-5' id='oldprice' data-base-price='" + resp['selling_price'] + "'>Gh " + resp['selling_price'].toFixed(2) + "</span></div>");
            } else {
               $(".get_attribute_price_modal").html("<div class='product-price primary-color float-left'><span class='current-price text-brand'>Gh&nbsp;</span><span class='current-price text-brand' id='pprice' data-base-price='" + resp['selling_price'] + "'>" + " " + resp['selling_price'].toFixed(2) + "</span></div>");
            }

            $("#modal-qty-stock").html("<h4 class='heading-2 text-center'><button type='button' class='btn btn-primary position-relative' style='padding: 5px 10px; font-weight:200'>in stock<span class='position-absolute top-0 start-100 translate-middle badge rounded-pill bg-secondary' style='background-color: #351313 !important;font-size: .95em;'>" + "" + resp['product_stock'] + "</span></button></h4>");

            // Trigger price update after HTML replacement
            updateTotalPrice($('#qty'));
         },
         error: function () {
            alert('Error');
         }
      });
   });

});
