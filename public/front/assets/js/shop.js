(function ($) {
    'use strict';
    /*Product Details*/
    var productDetails = function () {
        $('.product-image-slider').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: false,
            infinite: false,
            asNavFor: '.slider-nav-thumbnails',
        });

        $('.slider-nav-thumbnails').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            asNavFor: '.product-image-slider',
            dots: false,
            focusOnSelect: true,
            infinite: false,
            prevArrow: '<button type="button" class="slick-prev"><i class="fi-rs-arrow-small-left"></i></button>',
            nextArrow: '<button type="button" class="slick-next"><i class="fi-rs-arrow-small-right"></i></button>',
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        infinite: false,
                        centerMode: false,
                        variableWidth: false
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        infinite: false,
                        centerMode: false,
                        variableWidth: false
                    }
                }
            ]
        });

        $('.product-image-slider').on('beforeChange', function (event, slick, currentSlide, nextSlide) {
            var img = $(slick.$slides[nextSlide]).find("img");
            $('.zoomWindowContainer,.zoomContainer').remove();
            $(img).elevateZoom({
                zoomType: "inner",
                cursor: "crosshair",
                zoomWindowFadeIn: 500,
                zoomWindowFadeOut: 750
            });
        });
        //Elevate Zoom
        if ( $(".product-image-slider").length ) {
            $('.product-image-slider .slick-active img').elevateZoom({
                zoomType: "inner",
                cursor: "crosshair",
                zoomWindowFadeIn: 500,
                zoomWindowFadeOut: 750
            });
        }
        //Filter color/Size
        $('.list-filter').each(function () {
            $(this).find('a').on('click', function (event) {
                event.preventDefault();
                $(this).parent().siblings().removeClass('active');
                $(this).parent().toggleClass('active');
                $(this).parents('.attr-detail').find('.current-size').text($(this).text());
                $(this).parents('.attr-detail').find('.current-color').text($(this).attr('data-color'));
            });
        });
        function validatePropertiesSelected($input) {
            if ($input.closest('.shopping-summery').length) {
                return true;
            }
            
            var $container = $input.closest('.detail-info, .product-info');
            if (!$container.length) {
                $container = $input.closest('.modal-content, .row');
            }
            
            var $sizeSelect = $container.find('select[name="size"], select#dsize, select#getPrice, select#getPrice_modal');
            if ($sizeSelect.length && $sizeSelect.is(':visible')) {
                var sizeVal = $sizeSelect.val();
                if (!sizeVal || sizeVal === '' || sizeVal.indexOf('--select') !== -1) {
                    toastr.error('Please select a size first');
                    return false;
                }
            }
            
            var $colorSelect = $container.find('select[name="color"], select#dcolor, select#color');
            if ($colorSelect.length && $colorSelect.is(':visible')) {
                var colorVal = $colorSelect.val();
                if (!colorVal || colorVal === '' || colorVal.indexOf('--select') !== -1) {
                    toastr.error('Please select a variant first');
                    return false;
                }
            }
            
            return true;
        }

        //Qty Up-Down
        $('.detail-qty').each(function () {
            var $this = $(this);
            var $input = $this.find(".qty-val");

            $this.find('.qty-up').on('click', function (event) {
                event.preventDefault();
                if (!validatePropertiesSelected($input)) {
                    return false;
                }
                var qtyval = parseInt($input.val(), 10) || 1;
                var maxStock = parseInt($input.attr('max'), 10) || 99999;
                qtyval = qtyval + 1;
                if (qtyval > maxStock) {
                    qtyval = maxStock;
                    toastr.warning('Maximum available stock is ' + maxStock);
                }
                $input.val(qtyval).trigger('change');
            });

            $this.find('.qty-down').on('click', function (event) {
                event.preventDefault();
                var qtyval = parseInt($input.val(), 10) || 1;
                qtyval = qtyval - 1;
                if (qtyval < 1) {
                    qtyval = 1;
                }
                $input.val(qtyval).trigger('change');
            });

            $input.on('change blur', function() {
                if (parseInt($(this).val(), 10) > 1 && !validatePropertiesSelected($input)) {
                    $(this).val(1).trigger('change');
                    return false;
                }
                var maxStock = parseInt($(this).attr('max'), 10) || 99999;
                var val = parseInt($(this).val(), 10) || 1;
                if (val > maxStock) {
                    $(this).val(maxStock);
                    toastr.warning('Maximum available stock is ' + maxStock);
                } else if (val < 1) {
                    $(this).val(1);
                }
            });
        });

        $('.dropdown-menu .cart_list').on('click', function (event) {
            event.stopPropagation();
        });
    };

    //Load functions
    $(document).ready(function () {
        productDetails();
    });

})(jQuery);