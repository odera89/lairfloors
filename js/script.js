jQuery(function() {
	var $ = jQuery;
	
	
	$('.faq li h3').click(function() {
		var p = $(this).closest('li');
		if(!$(p).hasClass('active')) {
			$('.faq li.active').removeClass('active');
			$(p).addClass('active');
		} else {
			$(p).removeClass('active');
		}
	});

	$('.nav-menu-toggle').on('click', function(e) {
		e.preventDefault();
		$('.header-right').toggle();
	});

	$('.lair-gallery-list').on('click', '.lair-gallery-item a', function(e) {
		e.preventDefault();

		$('#' + $(this).attr('href').substr(1)).click();
	});

	// CUSTOM GALLERY // BUILT FOR PORTFOLIO
	var customGallery = {

		init: function() {

			var wrap = '.lair-gallery';
			var items = '.lair-gallery-item';
			var main_pic = '#gallery-main-pic';

			$(items+' a').click(function(e){
				var cod_a = $(this);
				e.preventDefault();
				new_pic = $(this).attr('href');
				if ($(main_pic+' .project-desc').length) {
					$(main_pic+' .project-desc').fadeOut(50, function(){
						$(this).remove();
					})
					 
				} // endif

				$(main_pic+' img').fadeOut(500, function(){
					
					// remove the current image
					$(this).remove();
					// load the new one
					$(main_pic).append('<img src="'+new_pic+'" alt="" style="opacity: 0">');
					//fade in the new pic
					$(main_pic+' img').animate({'opacity':'1'});


					// fade in new desc
					if (cod_a.attr('title') != '' && cod_a.attr('title') != undefined) {
						
						$(main_pic).append('<div class="project-desc" style="opacity:0">'+cod_a.attr('title')+'</div>');
						$(main_pic+' .project-desc').animate({'opacity':'1'});
					} // endif
					$('html, body').animate({scrollTop: (parseInt($(main_pic).offset().top) - parseInt($('.site-header').css('height')) - 50)});

				});

				// update the list description and set active
				$('.lair-gallery-list li').removeClass('lair-gallery-item-current');
				$('.lair-gallery-list a[href="#'+$(this).attr('id')+'"').parent().addClass('lair-gallery-item-current');
			});

			$('.lair-gallery-list a').click(function(e){
				$('.lair-gallery-list li').removeClass('lair-gallery-item-current');
				$(this).parent().addClass('lair-gallery-item-current'); 
			});
		}

	};

	customGallery.init();


	// ROLL OVER FOR BALLET BARRE
	var customRollOver = {

		init: function() {

			var wrap = '.ballet-barre-colors';
			var link = '.barel_color';

			// show up on first loading the second color
			var a = $(wrap+' '+link+':eq(1)');
			var big_img = $(wrap+' '+link+':eq(1)').attr('href');
			big_img = big_img.replace("#","");
			// a.addClass('current');
			
			// var default_img = "<img src='"+big_img+"' alt=''  /><span class='cod_image_caption "+a.data('class')+"'>"+a.data('name')+"</span>";
			var default_img = "<img src='"+big_img+"' alt=''  />";
			$('.bbc-top').html(default_img);

			// roll over
			$(link).hover(function(){
				var a = $(this);
				var big_img = $(this).attr('href');
				big_img = big_img.replace("#","");
			
				// $('.bbc-right').html("<img src='"+big_img+"' alt='' /><span class='cod_image_caption "+a.data('class')+"'>"+a.data('name')+"</span>");
				$('.bbc-top').html("<img src='"+big_img+"' alt='' />");
			}, function() {
				$('.bbc-top').html(default_img);
			});
		}

	};

	if($('.ballet-barre-colors').length > 0) {
		customRollOver.init();
	}

});

jQuery(function() {
	var progress = jQuery('.slider-progress .completed'),
	slideshow = jQuery('.slider');

	slideshow.on('cycle-initialized cycle-before', function(e, opts) {
		progress.stop(true).css('width', 0);
	});

	slideshow.on('cycle-initialized cycle-after', function(e, opts) {
	if (!slideshow.is('.cycle-paused'))
		progress.animate({ width: '100%' }, opts.timeout, 'linear');
	});

	slideshow.on('cycle-paused', function(e, opts) {
		progress.stop();
	});

	slideshow.on('cycle-resumed', function(e, opts, timeoutRemaining) {
		progress.animate({ width: '100%' }, timeoutRemaining, 'linear');
	});
	// codernize
	slideshow.on('cycle-before', function(event, optionHash, outgoingSlideEl, incomingSlideEl, forwardFlag) {
		// console.log(optionHash);
		// console.log(outgoingSlideEl);
		// console.log(incomingSlideEl);
		// console.log(forwardFlag);

		// optionHash.nextSlide
		// $('.slider .slider-prev , .slider .slider-next').attr('data-slide',1);
		jQuery('.slider').find('.slider-prev , .slider-next').attr('data-slide',optionHash.nextSlide);
	});

	jQuery('.slider').cycle({
		slides: '> .slide',
		autoHeight: false,

		speed: 400,
		timeout: 6000,
		pauseOnHover: false,
		// pager: '.slider .slider-pager',
		prev: '.slider .slider-prev',
		next: '.slider .slider-next'
		// pagerTemplate: '<a href="#"></a>'
	});

	jQuery('.video-container').vidbacking({
	    'masked': true
	});

	jQuery("#video-slideshow > li:gt(0)").hide();

	setInterval(function() { 
	  jQuery('#video-slideshow > li:first')
	    .fadeOut(1000)
	    .next()
	    .fadeIn(1000)
	    .end()
	    .appendTo('#video-slideshow');
		},  8250);
});