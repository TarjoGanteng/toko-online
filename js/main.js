(function ($) {
    "use strict";

    // ============================================================
    //  MOBILE NAV TOGGLE
    // ============================================================
    $('.menu-toggle > a').on('click', function (e) {
        e.preventDefault();
        $('#responsive-nav').toggleClass('active');
    });

    // ============================================================
    //  PREVENT CART DROPDOWN FROM CLOSING ON CLICK INSIDE
    // ============================================================
    $('.cart-dropdown').on('click', function (e) {
        e.stopPropagation();
    });

    // ============================================================
    //  PRODUCTS SLICK SLIDER
    // ============================================================
    $('.products-slick').each(function () {
        var $this = $(this);
        var $nav  = $this.attr('data-nav');

        $this.slick({
            slidesToShow:   4,
            slidesToScroll: 1,
            autoplay:       true,
            infinite:       true,
            speed:          400,
            dots:           false,
            arrows:         true,
            appendArrows:   $nav || false,
            responsive: [
                { breakpoint: 991, settings: { slidesToShow: 2, slidesToScroll: 1 } },
                { breakpoint: 480, settings: { slidesToShow: 1, slidesToScroll: 1 } }
            ]
        });
    });

    // ============================================================
    //  PRODUCTS WIDGET SLICK
    // ============================================================
    $('.products-widget-slick').each(function () {
        var $this = $(this);
        var $nav  = $this.attr('data-nav');

        $this.slick({
            infinite:     true,
            autoplay:     true,
            speed:        400,
            dots:         false,
            arrows:       true,
            appendArrows: $nav || false
        });
    });

    // ============================================================
    //  PRODUCT PAGE — MAIN IMAGE SLICK
    // ============================================================
    if ($('#product-main-img').length) {
        $('#product-main-img').slick({
            infinite: true,
            speed:    400,
            dots:     false,
            arrows:   true,
            fade:     true,
            asNavFor: '#product-imgs'
        });

        $('#product-imgs').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            arrows:         true,
            centerMode:     true,
            focusOnSelect:  true,
            centerPadding:  0,
            vertical:       true,
            asNavFor:       '#product-main-img',
            responsive: [
                {
                    breakpoint: 991,
                    settings: { vertical: false, arrows: false, dots: true }
                }
            ]
        });

        // Image zoom
        $('#product-main-img .product-preview').zoom();
    }

    // ============================================================
    //  INPUT NUMBER (qty)
    // ============================================================
    $('.input-number').each(function () {
        var $this  = $(this);
        var $input = $this.find('input[type="number"]');
        var up     = $this.find('.qty-up');
        var down   = $this.find('.qty-down');

        down.on('click', function () {
            var value = parseInt($input.val()) - 1;
            value = value < 1 ? 1 : value;
            $input.val(value).change();
            updatePriceSlider($this, value);
        });

        up.on('click', function () {
            var value = parseInt($input.val()) + 1;
            $input.val(value).change();
            updatePriceSlider($this, value);
        });
    });

    // ============================================================
    //  PRICE SLIDER
    // ============================================================
    var priceInputMax = document.getElementById('price-max');
    var priceInputMin = document.getElementById('price-min');
    var priceSlider   = document.getElementById('price-slider');

    if (priceInputMax) {
        priceInputMax.addEventListener('change', function () {
            updatePriceSlider($(this).parent(), this.value);
        });
    }
    if (priceInputMin) {
        priceInputMin.addEventListener('change', function () {
            updatePriceSlider($(this).parent(), this.value);
        });
    }

    if (priceSlider) {
        noUiSlider.create(priceSlider, {
            start: [1, 999],
            connect: true,
            step: 1,
            range: { 'min': 1, 'max': 999 }
        });

        priceSlider.noUiSlider.on('update', function (values, handle) {
            var value = values[handle];
            if (handle) {
                priceInputMax.value = value;
            } else {
                priceInputMin.value = value;
            }
        });
    }

    function updatePriceSlider(elem, value) {
        if (!priceSlider) return;
        if (elem.hasClass('price-min')) {
            priceSlider.noUiSlider.set([value, null]);
        } else if (elem.hasClass('price-max')) {
            priceSlider.noUiSlider.set([null, value]);
        }
    }

    // ============================================================
    //  HEADER SCROLL EFFECT — darken navbar on scroll
    // ============================================================
    $(window).on('scroll', function () {
        var scrollTop = $(this).scrollTop();
        var $header   = $('#header');
        if (scrollTop > 10) {
            $header.css({
                'box-shadow': '0 1px 12px rgba(0,0,0,0.08)',
                'background': 'rgba(255,255,255,0.95)'
            });
        } else {
            $header.css({
                'box-shadow': 'none',
                'background': 'rgba(255,255,255,0.85)'
            });
        }
    });

})(jQuery);
