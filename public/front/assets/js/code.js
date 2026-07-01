$(document).ready(function(){

   $("#getPrice").change(function () {
        var size = $(this).val();
        var product_id = $(this).attr("product-id");
        // alert(size);
      //   alert(product_id);

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
                // alert(resp['final_price']);
              if (resp['discount'] > 0) {
                 $(".get_attribute_price").html("<div class='product-price primary-color float-left'><span class='current-price text-brand'>Gh" + " " + resp['final_price'].toFixed(2) + "</span><span><span class='save-price font-md color3 ml-15'>" + " " + resp['discount_percent'] + "% Off</span><span class='old-price font-md ml-15'>Gh" + " " + resp['selling_price'].toFixed(2) + "</span></span></div>");
              } else {
                 $(".get_attribute_price").html("<div class='product-price primary-color float-left'><span class='current-price text-brand'>Gh" + " " + resp['selling_price'].toFixed(2) + "</span></div>");
              }

              $(".qty-stock").html("<h4 class='heading-2 text-center'><button type='button' class='btn btn-primary position-relative' style='padding: 5px 10px; font-weight:200'>in stock<span class='position-absolute top-0 start-100 translate-middle badge rounded-pill bg-secondary' style='background-color: #351313 !important;font-size: .95em;'>" + "" + resp['product_stock'] + "</span></button></h4>");

              // Update qty input max with per-size stock
              var sizeStock = parseInt(resp['product_stock'], 10);
              $('#dqty').attr('max', sizeStock).attr('data-stock', sizeStock);
              var currentQty = parseInt($('#dqty').val(), 10) || 1;
              if (currentQty > sizeStock) {
                 $('#dqty').val(sizeStock > 0 ? sizeStock : 1);
              }
           },
           error: function () {
              alert('Error');
           }
        });
   });

   $("#getPrice_modal").change(function () {
      var size = $(this).val();
      var product_id = $("#product_id").val();
      // alert(size);
      // alert(product_id);

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
            // alert(resp['final_price']);
            if (resp['discount'] > 0) {
               $(".get_attribute_price_modal").html("<div class='product-price primary-color float-left'><span class='current-price text-brand'>Gh&nbsp;</span><span class='current-price text-brand' id='pprice'>" + " " + resp['final_price'].toFixed(2) + "</span><span class='old-price font-md ml-20' id='hide_curreny'></span><span class='old-price font-md ml-5' id='oldprice'>Gh"+" "+resp['selling_price'].toFixed(2)+"</span></div>");
            } else {
               $(".get_attribute_price_modal").html("<div class='product-price primary-color float-left'><span class='current-price text-brand'>Gh&nbsp;</span><span class='current-price text-brand' id='pprice'>" + " " + resp['selling_price'].toFixed(2) + "</span></div>");
            }

            $("#modal-qty-stock").html("<h4 class='heading-2 text-center'><button type='button' class='btn btn-primary position-relative' style='padding: 5px 10px; font-weight:200'>in stock<span class='position-absolute top-0 start-100 translate-middle badge rounded-pill bg-secondary' style='background-color: #351313 !important;font-size: .95em;'>" + "" + resp['product_stock'] + "</span></button></h4>");

         },
         error: function () {
            alert('Error');
         }
      });
   });

});
