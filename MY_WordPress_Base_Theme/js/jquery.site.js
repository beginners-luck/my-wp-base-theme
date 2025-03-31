$(function(){
	// TODO  - This might lead to animation issues for the loader if the loader disappears before the animation effects on the body are enabled
	//Hide any transitions from appearing before the page completely loads.
	$(window).on("load", function() {
	  $("body").removeAttr('id');
	});



	// TODO  - Remove animisition js file if not using it as the loader
	//Page animations
	// $(".animsition").animsition({
	// 	inClass: 'fade-in',
	// 	outClass: 'fade-out',
	// 	inDuration: 1400,
	// 	outDuration: 1000,
	// 	linkElement: '.animsition-link',
	// 	// e.g. linkElement: 'a:not([target="_blank"]):not([href^="#"])'
	// 	loading: true,
	// 	loadingParentElement: 'html', //animsition wrapper element
	// 	loadingClass: 'animsition-loading',
	// 	loadingInner: '<img src="' + window.location.protocol + "//" + window.location.host + '/wp-content/themes/MY_WordPress_Base_Theme/images/loading.svg" />', // e.g '<img src="loading.svg" />'
	// 	timeout: false,
	// 	timeoutCountdown: 5000,
	// 	onLoadEvent: true,
	// 	browser: [ 'animation-duration', '-webkit-animation-duration'],
	// 	overlay : false,
	// 	overlayClass : 'animsition-overlay-slide',
	// 	overlayParentElement : 'body',
	// 	transition: function(url){ window.location.href = url; }
	// });

	//Lazy load image setup...
	lazyLoad = new LazyLoad({
		elements_selector: '.lazy'
	});

	// Initialize jQuery Selectric
	$('select').selectric();

	// Selectric remains styled when user submits form
	$(document).on('gform_page_loaded', function(event, form_id, current_page){
		$('select').selectric({disableOnMobile: false});
	});

	// Mobile menu togglable dropdowns
	$('.sub-menu-dropdown-toggle').on('click', function(element) {
		if (window.innerWidth < 1230) {
			element.preventDefault();

			// If element being clicked does not have .opened-nav-dropdown then close other dropdown
			if ( ! $(this).parent().parent().hasClass('opened-nav-dropdown') && $('.opened-nav-dropdown').length) {
				// Toggle old element
				$('.opened-nav-dropdown .sub-menu').slideToggle('500');
				$('.opened-nav-dropdown').toggleClass('opened-nav-dropdown');

				// Toggle newly selected element
				$(this).parent().next().delay(500).slideToggle('500');
			} else {
				// Toggle Same element / New element
				$(this).parent().next().slideToggle('500');
			}
			$(this).parent().parent().toggleClass('opened-nav-dropdown');
		}
	});

	// Toggling mobile menu
	$('#mobile-menu-toggle').on('click', function(element) {
		element.preventDefault();

		$(this).toggleClass('opened');
		$('#mobile-navigation-menu').toggleClass('opened');
		$('body').toggleClass('nav-menu-open');

		// Closing currently opened mobile dropdown
		var dropdown = $('.opened-nav-dropdown');
		if (dropdown) {
			dropdown.find('.sub-menu').slideToggle('500');
			dropdown.toggleClass('opened-nav-dropdown');
		}
	});

	// Toggle mobile menu when screen nav goes back into desktop mode
	window.addEventListener('resize', function() {
		if (window.innerWidth > 1230 && $('#mobile-navigation-menu').hasClass('opened')) {
			$('#mobile-menu-toggle').toggleClass('opened');
			$('#mobile-navigation-menu').toggleClass('opened');
			$('body').toggleClass('nav-menu-open');

			// Closing currently opened mobile dropdown
			var dropdown = $('.opened-nav-dropdown');
			if (dropdown) {
				dropdown.find('.sub-menu').slideToggle('500');
				dropdown.toggleClass('opened-nav-dropdown');
			}
		}
	});

	// Making main-menu keyboard accessible
	$('.sub-menu-dropdown-toggle').on('click', function(e) {
		if ($(this).parent().parent().find('.sub-menu').hasClass('opened')) { // closing current element
			$(this).parent().parent().find('.sub-menu').toggleClass('opened');
		} else { // opening other element
			$('.sub-menu.opened').toggleClass('opened');
			$(this).parent().parent().find('.sub-menu').toggleClass('opened');
		}
		e.preventDefault();
	});


	// Focus on confirmation after submission
	$(document).on('gform_confirmation_loaded', function(event, formId){
		const focusableEl = document.querySelector('.gform_confirmation_wrapper');
		if (focusableEl) {
			// elements with tabindex="-1" are not focusable by default, but can be focused programmatically
			// focusableEl.setAttribute( 'tabindex', '-1' );
			// focusableEl.focus();

			focusableEl.scrollIntoView({'behavior':'smooth', 'block':'center'}); // for safari
		}
	});

	// Accordion functionality
	$('.accordion-toggle').on('click', function(element) {
		element.preventDefault();

		// If element being clicked does not have .opened-accordion then close other accordion
		if ( ! $(this).parent().hasClass('opened-accordion') && $('.opened-accordion').length) {
			// Toggle old element
			$('.opened-accordion .content').slideToggle('500');
			$('.opened-accordion').toggleClass('opened-accordion');

			// Toggle newly selected element
			$(this).next().delay(500).slideToggle('500');
		} else {
			// Toggle Same element / New element
			$(this).next().slideToggle('500');
		}
		$(this).parent().toggleClass('opened-accordion');
	});


	// Popup gallery funciton  TODO
	$('#gallery-toggle').on('click', function(e) {
		e.preventDefault();
		var topval = document.documentElement.scrollTop || document.body.scrollTop;
		$('body').css({overflow: 'hidden'});
		$('#project-gallery').toggleClass('gallery-visible');
	});

	$('#gallery-close').on('click', function(e) {
		e.preventDefault();
		$('body').css({overflow: 'visible'});
		$('#project-gallery').toggleClass('gallery-visible');
	});

	// TODO  Focus on confirmation after submission
	$(document).on('gform_confirmation_loaded', function(event, formId){
		const focusableEl = document.querySelector('.gform_confirmation_wrapper');
		if (focusableEl) {
			// elements with tabindex="-1" are not focusable by default, but can be focused programmatically
			// focusableEl.setAttribute( 'tabindex', '-1' );
			// focusableEl.focus();

			focusableEl.scrollIntoView({'behavior':'smooth', 'block':'center'}); // for safari
		}
	});

	// Sliders  TODO
	var carouselSwiper = new Swiper(".carouselSwiper", {
		loop: true,
		pagination: {
		  el: ".swiper-pagination",
		  type: "progressbar",
		},
		navigation: {
		  nextEl: ".swiper-button-next",
		  prevEl: ".swiper-button-prev",
		},
	  });
});