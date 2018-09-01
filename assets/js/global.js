/*-------------------------------------------------------------------------------------------------------------------------------*/
/*This is main JS file that contains custom style rules used in this template*/
/*-------------------------------------------------------------------------------------------------------------------------------*/
/* Template Name: "IVY"*/
/* Version: 1.0 Initial Release*/
/* Build Date: xx-xx-2016*/
/* Author: UnionAgency*/
/* Copyright: (C) 2016 */
/*-------------------------------------------------------------------------------------------------------------------------------*/

/*--------------------------------------------------------*/
/* TABLE OF CONTENTS: */
/*--------------------------------------------------------*/
/* 01 - VARIABLES */
/* 02 - page calculations */
/* 03 - function on document ready */
/* 04 - function on page load */
/* 05 - function on page resize */
/* 06 - function on page scroll */
/* 07 - swiper sliders */
/* 08 - buttons, clicks, hovers */

var _functions = {};

jQuery(function($) {

	"use strict";

	/*================*/
	/* 01 - VARIABLES */
	/*================*/
	var swipers = [], winW, winH, winScr, _isphone, _istablet, _ismobile = navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i), _isFF = !!navigator.userAgent.match(/firefox/i);

	/*========================*/
	/* 02 - page calculations */
	/*========================*/
	_functions.pageCalculations = function(){
		winW = $(window).width();
		winH = $(window).height();
		_isphone = $('.phone-marker').is(':visible') ? true : false;
		_istablet = $('.tablet-marker').is(':visible') ? true : false;
		$('nav').css({'height':winH});
		var fullpageHeight = winH - $('header').not('.type-1').outerHeight() - $('footer').outerHeight();
		$('.full-screen-height').css({'height':(fullpageHeight<500)?500:fullpageHeight});
		$('html').css({'font-size':winW/70});
		$('.rotate').each(function(){
			$(this).width($(this).parent().height());
		});

	};

	_functions.initSelect = function(){
		if(!$('.SlectBox').length) return false;
		$('.SlectBox').SumoSelect({ csvDispCount: 3, search: true, searchText:'Search', noMatch:'No matches for "{0}"', floatWidth: 0 });
	};

	/*=================================*/
	/* 03 - function on document ready */
	/*=================================*/
	if(_ismobile) $('body').addClass('mobile');
	_functions.pageCalculations();
	_functions.initSelect();

	/*============================*/
	/* 04 - function on page load */
	/*============================*/
	$(window).on('load', function(){
		_functions.initSwiper();
        count_slide();
		$('body').addClass('loaded');
		$('#loader-wrapper').fadeOut();
	});

	/*==============================*/
	/* 05 - function on page resize */
	/*==============================*/
	_functions.resizeCall = function(){
		_functions.pageCalculations();
        // console.log(winH);
	};
	if(!_ismobile){
		$(window).on('resize', function(){
			_functions.resizeCall();
		});
	} else{
		window.addEventListener("orientationchange", function() {
			_functions.resizeCall();
		}, false);
	}

	/*==============================*/
	/* 06 - function on page scroll */
	/*==============================*/
	$(window).on('scroll', function(){
		_functions.scrollCall();
	});

	_functions.scrollCall = function(){
		winScr = $(window).scrollTop();
		if(winScr>70) $('header').addClass('scrolled');
		else $('header').removeClass('scrolled');
	};

	/*=====================*/
	/* 07 - swiper sliders */
	/*=====================*/
	var initIterator = 0;
	function setParams(swiper, dataValue, returnValue){
		return (swiper.is('[data-'+dataValue+']'))?parseInt(swiper.data(dataValue), 10):returnValue;
	}
	_functions.initSwiper = function(){
		$('.swiper-container').not('.initialized').each(function(){								  
			var $t = $(this);	

			var index = 'swiper-unique-id-'+initIterator;

			$t.addClass('swiper-'+index+' initialized').attr('id', index);
			$t.find('.swiper-pagination').addClass('swiper-pagination-'+index);
			$t.parent().find('.swiper-button-prev').addClass('swiper-button-prev-'+index);
			$t.parent().find('.swiper-button-next').addClass('swiper-button-next-'+index);

			var slidesPerViewVar = setParams($t,'slides-per-view',1);
			if(slidesPerViewVar!='auto') slidesPerViewVar = parseInt(slidesPerViewVar, 10);

			swipers['swiper-'+index] = new Swiper('.swiper-'+index,{
				pagination: '.swiper-pagination-'+index,
		        paginationClickable: true,
		        nextButton: '.swiper-button-next-'+index,
		        prevButton: '.swiper-button-prev-'+index,
		        slidesPerView: slidesPerViewVar,
		        autoHeight: setParams($t,'autoheight',0),
		        loop: setParams($t,'loop',0),
				autoplay: setParams($t,'autoplay',0),
				centeredSlides: setParams($t,'center',0),
		        breakpoints: ($t.is('[data-breakpoints]'))? { 767: { slidesPerView: parseInt($t.attr('data-xs-slides'), 10) }, 991: { slidesPerView: parseInt($t.attr('data-sm-slides'), 10) }, 1199: { slidesPerView: parseInt($t.attr('data-md-slides'), 10) }, 1370: { slidesPerView: parseInt($t.attr('data-lt-slides'), 10) } } : {},
		        initialSlide: setParams($t,'initialslide',0),
		        speed: setParams($t,'speed',500),
		        parallax: (_isFF)?0:setParams($t,'parallax',0),
		        slideToClickedSlide: setParams($t,'clickedslide',0),
		        mousewheelControl: setParams($t,'mousewheel',0),
		        direction: ($t.is('[data-direction]'))?$t.data('direction'):'horizontal',
		        spaceBetween: setParams($t,'space',0),
		        watchSlidesProgress: true,
		        keyboardControl: true,
		        mousewheelReleaseOnEdges: true,
		        preloadImages: false,
		        lazyLoading: true,
		        onTransitionEnd: function(swiper){
		        	var pageNum = (swiper.activeIndex+1<10)?('0'+(swiper.activeIndex+1)):(swiper.activeIndex+1);
		        	$t.find('.swiper-pager-current').text(pageNum);
		        },
			});
			swipers['swiper-'+index].update();
			initIterator++;
		});
		$('.swiper-container.swiper-control-top').each(function(){
			swipers['swiper-'+$(this).attr('id')].params.control = swipers['swiper-'+$(this).closest('.swipers-couple-wrapper').find('.swiper-control-bottom').attr('id')];
		});
		$('.swiper-container.swiper-control-bottom').each(function(){
			swipers['swiper-'+$(this).attr('id')].params.control = swipers['swiper-'+$(this).closest('.swipers-couple-wrapper').find('.swiper-control-top').attr('id')];
		});
	};

	$('.swiper-pager-arrow-prev').on('click', function(){
		swipers['swiper-'+$(this).closest('.swiper-container').attr('id')].slidePrev();
		return false;
	});

	$('.swiper-pager-arrow-next').on('click', function(){
		swipers['swiper-'+$(this).closest('.swiper-container').attr('id')].slideNext();
		return false;
	});


	/*==============================*/
	/* 08 - buttons, clicks, hovers */
	/*==============================*/

	//open and close popup
	_functions.openPopup = function(foo){
		$('.popup-content').removeClass('active');
		$('.popup-wrapper, .popup-content[data-rel="'+foo+'"]').addClass('active');
		$('html').addClass('overflow-hidden');
	};

	_functions.closePopup = function(){
		$('.popup-wrapper, .popup-content').removeClass('active');
		$('html').removeClass('overflow-hidden');
		$('.video-popup .popup-iframe').html('');
	};

	$(document).on('click', '.open-popup', function(e){
		_functions.openPopup($(this).data('rel'));
		return false;
	});

	$(document).on('click', '.popup-wrapper .button-close, .popup-wrapper .layer-close', function(e){
		_functions.closePopup();
		return false;
	});

	//video popup
	$('.open-video').on('click', function(e){
		$('.video-popup .popup-iframe').html('<iframe src="'+$(this).data('src')+'"></iframe>');
		$('.popup-wrapper').addClass('active');
		$('.video-popup').addClass('active');
		return false;
	});

	//open ajax product popup
	$(document).on('click', '.open-popup-ajax', function(e){
		e.preventDefault();
		$('html').addClass('overflow-hidden');
		$('.popup-content').removeClass('active');
		$('.popup-wrapper').addClass('active');
		$('.popuploader').fadeIn();

        var product_preview = $('.open-popup-ajax'),
        product_id = $(this).data('id');

		$.post(
			ajaxurl, {
                product_id: product_id,
                'action': 'ivy_details_product',
            })
			.done (function(response){
                $('.popuploader').fadeOut(0);
				var responseObject = $($.parseHTML(response));
				$('.ajax-popup .swiper-container').each(function(){
					swipers['swiper-'+$(this).attr('id')].destroy();
					delete swipers['swiper-'+$(this).attr('id')];
				});
				$('.ajax-popup').remove();
				$('.popup-wrapper').append(responseObject.addClass('ajax-popup'));
				_functions.initSwiper();
				responseObject.addClass('active');
				_functions.initSelect();
			});
		return false;
	});

    // add to cart variation_id
    $(document).on('change', 'table.variations select', function(e){
    	var variationId = $('.single_variation_wrap input.variation_id').val();
    	$('.add-to-cart-variable').attr('data-variation_id', variationId);

      // Value
      var selectVal = $(this).val();
      // console.log(selectVal);
      $('.add-to-cart-variable').attr('data-value', selectVal);
      //button enabled
      $('.add-to-cart-variable').removeClass('disabled');

      // price
      var variationPrice = $('.woocommerce-variation-price span.price').html();
      $('.variationPrice').html(variationPrice);

      if(selectVal == ""){
      	$('.add-to-cart-variable').addClass('disabled');
      	$('.variationPrice').html('');
      }

      // display variation price
      var data_product_variations_json = $(this).closest('form.variations_form').attr('data-product_variations');
      var data_product_variations =  JSON.parse(data_product_variations_json);
      // console.log(data_product_variations);

      for (var i = 0; i <= data_product_variations.length; i++) {
		  for(var attr in data_product_variations[i]['attributes']){
			  var val = data_product_variations[i]['attributes'][attr];
			  if(val == selectVal){
				var price_html = data_product_variations[i]['price_html'];
				var variation_id = data_product_variations[i]['variation_id'];
				$('.variationPrice').html(price_html);
				$('.add-to-cart-variable').attr('data-variation_id', variation_id);
			  }
		  }
      }
      
    });

    //add to cart product
    $(document).on('click', '.add-to-cart', function(e){
        e.preventDefault();

        var variation_title = $('.variations .label label').text();
        // console.log(variation_title);
        var button = $(this),
            product_id = button.attr('data-product_id'),
            variation_id = button.attr('data-variation_id'),
            variation_value = button.attr('data-value'),
            quantity = button.attr('data-quantity');
        	button.removeClass('added').addClass('loading disabled');

        	// console.log(variation_id);
        	// console.log(variation_value);
        	// console.log(quantity);
        	// console.log(variation_title);

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajaxurl,
            data: {
                'action' : 'prod_add_to_cart',
                'product_id' : product_id,
                'variation_id' : variation_id,
                'variation_title' : variation_title,
                'variation_value' : variation_value,
                'quantity' : quantity
            },
            complete: function(response){
            	// console.log(response);
                var data = response.responseJSON;
                if( data.result == 'true' ){
                    button.addClass('added');
                    $('span.cart-label').text(data.count);
                    $('.cart-title').html(data.price);
                }
                button.removeClass('loading disabled');
            }
        });

    return false;
    });


	//change quantity
    //quantity selector
    $(document).on('click', '.quantity-select .minus', function(){
        var newValue = parseInt($(this).parent().find('.number').text(), 10);
        $(this).parent().find('.number').text(newValue>1?(newValue-1):newValue);
        $(this).closest('.col-sm-6').find('.add-to-cart').attr('data-quantity', $(this).parent().find('.number').text() );
        return false;
    });

    $(document).on('click', '.quantity-select .plus', function(){
        var newValue = parseInt($(this).parent().find('.number').text(), 10);
        $(this).parent().find('.number').text(newValue+1);
        $(this).closest('.col-sm-6').find('.add-to-cart').attr('data-quantity', $(this).parent().find('.number').text() );
        return false;
    });



    // $('.qty.text').each(function () {
    //     var qtyValue = $(this).attr('value');
    //     $(this).closest('.product-quantity').find('.quantity-select.cart span.number').text(qtyValue);
    //     console.log(qtyValue);
    // });

	//quantity selector cart
    $(document).on('click', '.cart-quantity-select .cart-minus', function(){
        $( "input[name*='update_cart']" ).removeAttr("disabled");
        var newValue = parseInt($(this).parent().find('.cart-number').text(), 10);
        $(this).parent().find('.cart-number').text(newValue>1?(newValue-1):newValue);
		$(this).closest('.product-quantity').find('.qty.text').val(newValue>1?(newValue-1):newValue);
        return false;
    });

    $(document).on('click', '.cart-quantity-select .cart-plus', function(){
        $( "input[name*='update_cart']" ).removeAttr("disabled");
        var newValue = parseInt($(this).parent().find('.cart-number').text(), 10);
        $(this).parent().find('.cart-number').text(newValue+1);
        $(this).closest('.product-quantity').find('.qty.text').val(newValue+1);
        return false;
    });

	//hamburger menu
	$('.hamburger-icon').on('click', function(){
		$(this).toggleClass('active');
		$('header').toggleClass('active');
		return false;
	});

	//toggle submenu
	$(document).on('click','.toggle-menu', function(){
		$(this).toggleClass('active').next().slideToggle();
		return false;
	});

	//filtration
	$('.sorting-menu .title').on('click', function(){
		$(this).toggleClass('active').next('.toggle').slideToggle();
		return false;
	});

	$(window).on('load', function(){
		if($('.sorting-container').length){
			var $container = $('.sorting-container').isotope({
			    itemSelector: '.sorting-item',
			    masonry: {
			        columnWidth: '.grid-sizer'
			    }
			});

			$('.sorting-menu a').on('click', function() {
		        if($(this).hasClass('active')) return false;
		        $(this).parent().find('.active').removeClass('active');
		        $(this).addClass('active');
		        $(this).closest('.sorting-menu').find('.title').text($(this).find('.text').text());
		        if($(this).closest('.sorting-menu').find('.title').is(':visible')) $(this).closest('.sorting-menu').find('.toggle').slideUp();
		        var filterValue = $(this).attr('data-filter');
		        $container.isotope({ filter: filterValue });
		    });
		}
	});

	//categories list
	$('.categories-wrapper .toggle').on('click', function(){
		$(this).toggleClass('active').next().slideToggle();
		return false;
	});

	//product shortcode icon
	$('.product-shortcode .icons .entry').not('.open-popup-ajax').on('click', function(){
		$(this).toggleClass('active');
		return false;
	});

    //tabs
	var tabsFinish = 0;
	$(document).on('click', '.tabs-block .tab-menu', function() {
		if($(this).hasClass('active') || tabsFinish) return false;
		tabsFinish = 1;
        var tabsWrapper = $(this).closest('.tabs-block'),
        	tabsMenu = tabsWrapper.find('.tab-menu'),
        	tabsItem = tabsWrapper.find('.tab-entry'),
        	index = tabsMenu.index(this);
        tabsWrapper.find('.tabulation-title').text($(this).text());
        tabsItem.filter(':visible').fadeOut(function(){
        	tabsItem.eq(index).css({'display':'block', 'opacity':'0'});
        	tabsItem.eq(index).find('.swiper-container').each(function(){
        		swipers['swiper-'+$(this).attr('id')].update();
        	});
        	$(window).resize();
        	tabsItem.eq(index).animate({'opacity':'1'}, function(){
        		tabsFinish = 0;
        	});
        });
        tabsMenu.removeClass('active');
        return false;
    });

    $(document).on('click', '.tabulation-title', function(){
    	$(this).toggleClass('active');
    	return false;
    });

    //rating
    $(document).on('click', '.rate-wrapper.set .fa', function(){
    	$(this).parent().find('.fa-star').removeClass('fa-star').addClass('fa-star-o');
    	$(this).removeClass('fa-star-o').prevAll().removeClass('fa-star-o');
    	$(this).addClass('fa-star').prevAll().addClass('fa-star');
    	return false;
    });

    //checkout - toggle wrapper checkbox
	$('.checkbox-toggle-title input').on('change', function(){
		$('.checkbox-toggle-wrapper').slideToggle();
	});

	//product view modes
	var modeTimeout;
	$('.toggle-mode.mode-2').on('click', function(){
		$('.toggle-mode').removeClass('active');
		$(this).addClass('active');
		$('.product-shortcode-column').addClass('change-mode');
		$('.product-shortcode-column').addClass('shortcode-wide');
		clearTimeout(modeTimeout);
		modeTimeout = setTimeout(function(){$('.product-shortcode-column').removeClass('change-mode');},100);
		return false;
	});

	$('.toggle-mode.mode-1').on('click', function(){
		$('.toggle-mode').removeClass('active');
		$(this).addClass('active');
		$('.product-shortcode-column').addClass('change-mode');
		$('.product-shortcode-column').removeClass('shortcode-wide');
		clearTimeout(modeTimeout);
		modeTimeout = setTimeout(function(){$('.product-shortcode-column').removeClass('change-mode');},100);
		return false;
	});

	//lightbox
	if($('.lightbox').length){
		var lightbox = $('.lightbox').simpleLightbox({
		    disableScroll: false,
		    captionSelector: 'self',
		    closeText: '',
		    navText: ['',''],
		    alertErrorMessage: "No image found. Next image will be load.",
		    history: false,
		    showCounter: false
		});
	}


	function count_slide(slide_number) {
        var count_slide = $('.slider-1 .swiper-slide, .slider-2 .swiper-slide, .slider-5 .swiper-slide, .slider-6 .swiper-slide').length;
        if(count_slide){
            if (count_slide <= 10) {
                count_slide = "0" + count_slide;
                $('.slider-1 .swiper-pager-total, .slider-2 .swiper-pager-total, .slider-5 .swiper-pager-total, .slider-6 .swiper-pager-total').text(count_slide);
            } else {
                $('.slider-1 .swiper-pager-total, .slider-2 .swiper-pager-total, .slider-5 .swiper-pager-total, .slider-6 .swiper-pager-total').text(count_slide);
            }
        }
    }

    //add toggle menu
		$('<div class="toggle-menu"></div>').insertAfter( $('nav .menu li.menu-item-has-children > a'));

    if ($('.slice-slider-container').length) {
		$('.slice-slider-container').sliceSlider({
				speed: 1000
		});
    }

    $('.tab-menu.button.style-1').first().addClass('active');

    $('#customer_details .simple-input-wrapper').append('<span></span>');

    $('.price_slider_amount button[type="submit"]').addClass('style-2 button-filter-by-price');

    // subcategory
    $('<div class="toggle"></div>').insertAfter( $('.product-categories .cat-item.cat-parent > span') );

    //categories list
    $('.product-categories .toggle').on('click', function(){
        $(this).toggleClass('active').next().slideToggle();
        return false;
    });

	//comments textarea
	$('p.comment-form-comment').addClass('simple-input-wrapper');
	$('#comment').addClass('simple-input');
    $('p.comment-form-comment').append('<span></span>');
    $('p.comment-form-comment label').text('');
    $('#comment').attr("placeholder", "Type your text");

    //login
    $('form#login').on('submit', function(e){
        e.preventDefault();
        $('form#login p.status').css('color','#00872c').show().text( $('form#login input[name="status"]').val() );
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajaxurl,
            data: {
                'action'  : 'ajaxlogin',
                'username': $('form#login #username').val(),
                'password': $('form#login #password').val(),
                'security': $('form#login #security').val()
            },
            success: function(data){
                $('form#login p.status').text(data.message);
                if( data.loggedin == true ){ $('p.status').css('color','#00872c'); document.location.href = $('form#login input[name="redirect_to"]').val(); }
                else{ $('p.status').css('color','#ef4035'); }
            }
        });
    });

    //user register
    $('form.registration-form').on('submit', function(e){
        e.preventDefault();
        $('.indicator').css('color','#00872c').show();
        $('.result-message').hide();
        var reg_nonce       = $('#vb_new_user_nonce').val(),
            reg_pass        = $('#vb_pass').val(),
            reg_pass2       = $('#vb_pass2').val(),
            reg_name        = $('#vb_name').val(),
            reg_mail        = $('#vb_email').val(),
            reg_rules       = $('#vb_rules'),
            reg_rules1      = ( reg_rules.is(':checked') == true ? '1' : '0');
        if( reg_rules.is(':checked') ){ reg_rules.parent().removeClass('invalid'); }
        else{ reg_rules.parent().addClass('invalid'); }

        //--Data to send--//
        $.ajax({
            type: 'POST',
            url: ajaxurl,
            data: {
                action      : 'register_user',
                nonce       : reg_nonce,
                name        : reg_name,
                pass        : reg_pass,
                pass2       : reg_pass2,
                mail        : reg_mail,
                rules       : reg_rules1
            },
            dataType: 'json',
            complete: function(response) {
                var json_reg = response.responseJSON;
                if( json_reg ) {
                    $('.indicator').hide();
                    if( json_reg.status === '1' ) {
                        $('.result-message').css('color','#00872c').text( $('form.registration-form input[name="status"]').val() );
                        $('.result-message').removeClass('error');
                        $('.result-message').show();
                        document.location.href = json_reg.redirecturl;
                    } else {
                        if(json_reg.message_admin) console.log(json_reg.message_admin);
                        $('.result-message').html(json_reg.message);
                        $('.result-message').addClass('error');
                        $('.result-message').show();
                    }
                }
            }
        });
    });

	// View post per page 
    $(document).on('change', 'form#product_ppp', function (e) {
		$('#product_ppp').submit();
    });

    // filter by brands
    $('li.wc-layered-nav-term a').wrap('<label class="sc"></label>');
    $('li.wc-layered-nav-term .sc').append('<input type="checkbox"><span></span>');

	// default table
	$('table:not(.shop_table)').addClass('cart-table');

	// coupon input
	$('form.checkout_coupon p.form-row-first').addClass('simple-input-wrapper');
	$('form.checkout_coupon .simple-input-wrapper').append('<span></span>');

	// order notes
	$('#order_comments_field').addClass('simple-input-wrapper');
	$('#order_comments_field').append('<span></span>');

});