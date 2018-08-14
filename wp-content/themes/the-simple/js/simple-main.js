    var $ = jQuery.noConflict();
    var $window_width = $(window).width();
    var stickyNavTop = $('header#header').offset().top;
    var simpleSlider, msnry_blog, msnry_portfolio;
    $(document).ready(function() {
        "use strict";

        /* ToolTip Activate */

        if ($('[rel=tooltip]').length > 0) {

            loadDependencies([s_gb.theme_js + 'tooltip.js'], function() {

                $('[rel=tooltip]').tooltip();
            });
        }

        /* PlaceHolder fix for IE */
        if ($('input').attr('placeholder') || $('textarea').attr('placeholder')) {

            loadDependencies([s_gb.theme_js + 'jquery.placeholder.min.js'], function() {

                $('input, textarea').placeholder();

            });

        }



        $('#mc_mv_EMAIL').attr('placeholder', 'Type your email address');


        /*Button with icon padding*/
        $('.btn-bt.default:has(i)').css('padding-right', '50px');
        $('.btn-bt.business:has(i)').css('padding-right', '16px');



        if ($('.animsition').length > 0) {
            //loadDependencies([s_gb.theme_js + 'jquery.animsition.min.js'], function(){
            simplePageTransition();


        }

        /* Page Header */
        pageHeader();

        fixWooCommercebtn();

        /* Set Icon for list elements. (1 icon for all list) */
        simpleSetIconList();



        /* Styling VC section */
        simpleSectionStyle();



        /* Initialize Navigation JS Part */
        //if(!$('body').hasClass('header_5'))
        simpleNavigation();

        /* Fullwidth Google Map */
        simpleFullwidthMap();

        /* IFRAME height in grid blog */
        simpleIFrameHeight();

        /* Search Button in Header */
        simpleSearchButton();

        /* Scroll Up Binding */
        scrollUpBinding();

        /* Accordion Toggle Binding */
        accordionBinding();

        /* Top Navigation Widget */
        simpleTopNavWidget();

        /* LightBox */
        simpleLightBoxInit();

        /* $("audio,video").mediaelementplayer(); */


        if ($('.services_medium').length > 0)
            loadDependencies([s_gb.theme_js + 'pathformer.js']);

        simpleSVGServices();

        /* Twitter Footer Carousel */
        if ($('#tweet_footer').length > 0) {
            loadDependencies([s_gb.theme_js + 'jquery.carouFredSel-6.1.0-packed.js'], function() {

                twitterFooterCarousel();
            });
        }

        /* Clients Carousel Init */
        if ($('.clients_caro').length > 0) {
            loadDependencies([s_gb.theme_js + 'jquery.carouFredSel-6.1.0-packed.js'], function() {
                clientsCarousel();
            });
        }



        simpleCountDown();

        /* Testimonials Carousel Init */
        //if($('.testimonial_carousel').length > 0)
        //testimonialsCarousel();

        /* Testimonial Cycle */
        if ($('.testimonial_cycle').length > 0) {
            loadDependencies([s_gb.theme_js + 'jquery.carouFredSel-6.1.0-packed.js'], function() {
                testimonialsCycle();
            });
        }


        /* Flexslider Init */
        if ($('.flexslider').length > 0)
            flexsliderInit();

        /* Portfolio Page Isotope Filter */
        if ($('#portfolio-preview-items').length > 0) {

            loadDependencies([s_gb.theme_js + 'jquery.mixitup.js'], function() {
                loadDependencies([s_gb.theme_js + 'masonry.min.js'], function() {
                    simplePortfolioPageIsotope();

                });
            })

        }

        /* FAQ filter */
        simpleFaqFilter();

        /* Staff Carousel */
        simpleStaffCarousel();

        /* Portfolio Carousel */
        if ($('.portfolio_slider').length > 0) {
            loadDependencies([s_gb.theme_js + 'idangerous.swiper.min.js'], function() {
                simplePortfolioCarousel();

            });

        }

        /* Blog Latest Post */
        simpleLatestBlogCarousel();

        /* Simple Slider Init */
        if ($('.simple_slider').length > 0) {
            loadDependencies([s_gb.theme_js + 'idangerous.swiper.min.js'], function() {
                $('.simple_slider').simpleSliderInit();
            });
        }


        /* Left Navigation */
        simpleLeftNavtion();

        /* Smoothscroll */
        if ($("body").hasClass('nicescroll'))
            simple_smoothScroll();

        if ($('#blogmasonry').length > 0)
            loadDependencies([s_gb.theme_js + 'masonry.min.js'], function() {
                simple_blogmasonry();
            });

        if ($('#fullpage').length > 0) {
            loadDependencies([s_gb.theme_js + 'jquery.appear.js'], function() {
                loadDependencies([s_gb.theme_js + 'jquery.fullPage.js'], function() {
                    simple_fullscreen_section();
                });
            });
        }

        simple_backgroundcheck();

        if ($('.fixed_sidebar').length > 0)
            simple_single_portfolio_floating();

        simpleExtraNav();

        if ($('.woocommerce-ordering .orderby').length > 0) {
            loadDependencies([s_gb.theme_js + 'select2.min.js'], function() {
                simpleCustomSelect();
            });
        }

        simpleTabsactive();

        simpleMobileMenu();

        simpleOverallButton();

        if ($('body').hasClass('header_5'))
            simpleMenuOverlay();

        simpleLayoutChanges();

        simpleOnlineFunctions();

        if ($('body').hasClass('one_page'))
            simpleOnePage();

        if ($('body').hasClass('sticky_active') && $window_width >= 980)
            simpleStickyNav();

        if ($('.simple_gallery_carousel').length > 0) {
            loadDependencies([s_gb.theme_js + 'idangerous.swiper.min.js'], function() {
                simpleGalleryCarouselInit();
            });

        }

        simplePostShares();

        if ($('.infinite_scroll_pag').length > 0 && $('#posts_container').length > 0) {
            loadDependencies([s_gb.theme_js + 'jquery.infinitescroll.min.js'], function() {
                simpleBlogInfiniteScroll();

            });
        }

        if ($('.infinite_scroll_pag').length > 0 && $('#portfolio-preview-items').length > 0) {
            loadDependencies([s_gb.theme_js + 'jquery.infinitescroll.min.js'], function() {

                simplePortfolioInfiniteScroll();
            });
        }




        if ($('.top_nav_transparency').length > 0)
            $('.header_wrapper').height('auto');

        /* Disable map zoon on scroll */
        simpleDisableMapZoom();
        /*Side menu on responsive */
        //simpleSideMenu();

        simpleProjectBar();

        simpleScrollToTop();
        simple_headingWithLine();
        simpleSearchOverlay();

        simpleTestimonialCarousel();


    });
    $(window).focus(function() {
        simpleProjectBar();
    });


    $(window).load(function() {
        simpleInitParallax();
        /*Side menu on responsive */
        //simpleSideMenu();
        simplePortfolioInGrid();
        simpleProjectBar();
        simple404();
        simpleOverallButton();

    });



    $(window).scroll(function() {
        "use strict";


    });



    $(window).resize(function() {
        "use strict";
        /*var width = 1100;
        if($('.swiper_slider').length > 0){
        	var slide_per_view = $('.swiper_slider').data('slidenr');

        	if ($(".container").css("max-width") == "940px" ){
        		slide_per_view = 4;
        	}else if ($(".container").css("max-width") == "420px" ){
        		slide_per_view = 1;
        	}else if ($(".container").css("width") == "724px" ){
        		slide_per_view = 2;
        	}else if ($(".container").css("max-width") == "300px" ){
        		slide_per_view = 1;
        	}
        	var swiperParent = new Swiper('.swiper_slider',{
        	    slidesPerView: slide_per_view,
        	    paginationClickable: true,
        	    pagination: '.pagination'
        	});
        	
        }	*/
        //simplePortfolioPageIsotope();


        simple_single_portfolio_floating();
        simpleLayoutChanges();
        testimonialsCycle();
        simpleInitParallax();
        /*Side menu on responsive */
        //simpleSideMenu();
        simpleProjectBar();
        simple404();
        simple_headingWithLine();
    });




    /*-------------------------------------------------------------------------------------------------------------*/
    /*------------------------------------------ FUNCTIONS   --------------------------------------------------*/
    /*-------------------------------------------------------------------------------------------------------------*/

    /*------------------------------ Page Header ------------------------- */

    function missing_img() {
        "use strict";
        $('img').each(function() {

            if ((!this.complete || typeof this.naturalWidth == "undefined" || this.naturalWidth == 0) && $(this).closest('#logo').length == 0) {
                this.src = 'http://thesimple.ellethemes.com/dummy_data/set_image.png';
            }
        });
    }

    function pageHeader() {
        "use strict";
        var self = $('.header_page.centered,.header_page.left');
        if (self.length == 0)
            return false;
        var height = self.height();
        self.height(0);

        setTimeout(function() {
            self.animate({
                opacity: 1,
                height: height + 'px'
            }, 800);
        }, 600);

        var top = self.offset().top;
        var bottom = self.offset().top + height;
        var op_test = 1;

        $(window).scroll(function() {
            var scrollTop = $(window).scrollTop();

            if ($('.fixed_header').length > 0)
                scrollTop += $('.fixed_header').height();
            if (jQuery('#wpadminbar').length > 0)
                scrollTop += 32;
            if ($(window).scrollTop() == 0)
                scrollTop = 0;
            var opacity1 = 1 - (scrollTop / bottom);
            op_test = opacity1;
            var new_height = height;
            if (scrollTop > top) {
                new_height = bottom - scrollTop;
            }
            //self.css({opacity: opacity1});
            if (!self.hasClass('with_subtitle'))
                self.find('h1').css('line-height', new_height + 'px').css('height', new_height + 'px').css('padding-top', (height - new_height) + 'px').css('opacity', opacity1);
            else {
                self.find('.titles').css('opacity', opacity1).css('padding-top', (height - new_height) + 'px');
            }

        });


    }

    var _loadedDependencies = [],
        _inQueue = {};

    function loadDependencies(dependencies, callback) {
        "use strict";
        var _callback = callback || function() {};
        if (!dependencies)
            return void _callback();

        var newDeps = dependencies.map(function(dep) {
            return -1 === _loadedDependencies.indexOf(dep) ? "undefined" == typeof _inQueue[dep] ? dep : (_inQueue[dep].push(_callback), !0) : !1
        });

        if (newDeps[0] !== !0) {
            if (newDeps[0] === !1)
                return void _callback();
            var queue = newDeps.map(function(script) {
                _inQueue[script] = [_callback];
                return $.getCachedScript(script);
            });

            var onLoad = function() {
                newDeps.map(function(loaded) {
                    _inQueue[loaded].forEach(function(callback) {
                        callback()
                    });
                    delete _inQueue[loaded];
                    _loadedDependencies.push(loaded)
                });
            };

            $.when.apply(null, queue).done(onLoad)
        }


    }

    $.getCachedScript = function(url) {
        "use strict";
        var options = {
            dataType: "script",
            cache: false,
            url: url
        };
        return $.ajax(options)
    };


    /*------------------------------ Lists ----------------------------- */

    function simpleSetIconList() {
        "use strict";
        if ($('.list').length > 0) {
            $('.list').each(function() {
                var icon = $(this).find('ul').data('icon');
                var bg_color = $(this).find('ul').data('color');

                if (typeof bg_color !== 'undefined' && bg_color.length > 0)
                    $('i', $(this)).css('background-color', bg_color);

                $('i', $(this)).addClass(icon);
            });
        }
    }

    /* Parallax Init */

    function simpleInitParallax() {
        "use strict";
        if ($('.parallax_section').length > 0) {
            loadDependencies([s_gb.theme_js + 'jquery.parallax.js'], function() {
                if ($('.section-style.parallax_section').length || $(".header_page:not('.no_parallax')").length) {
                    $(".section-style.parallax_section, .header_page:not('.no_parallax')").each(function() {
                        var self = $(this);

                        $(this).parallax("50%", 0.4);

                    });
                }
            });
        }
    }

    function simpleCountDown() {
        "use strict";
        if ($('#countdowndiv').length > 0) {

            loadDependencies([s_gb.theme_js + 'jquery.countdown.min.js'], function() {

                $('#countdowndiv').each(function() {
                    var $this = $(this);
                    var year = $(this).data('year');
                    var month = $(this).data('month');
                    var day = $(this).data('day');

                    $(this).countdown({ until: new Date(year, month - 1, day) })

                });
            })
        }
    }

    /*------------------------------ Sections ----------------------------- */
    function simpleSectionStyle() {
        "use strict";
        $('.section-style').each(function() {
            if ($(this).prev().hasClass('section-style')) {
                $(this).css('margin-top', '0px');
                $(this).prev().css('margin-bottom', '0px');
            }

            if ($(this).is(':last-child') && ($(this).parent().hasClass('composer_content') || $(this).parent().hasClass('content_portfolio'))) {
                $(this).parent().css('padding-bottom', '0px');
            }
            if ($(this).is(':first-child') && ($(this).parent().hasClass('composer_content') || $(this).parent().hasClass('content_portfolio'))) {
                var style = $(this).parent().attr('style');
                if (typeof style == "undefined")
                    style = '';
                $(this).parent().attr('style', style + 'padding-top:0px !important');
            }
        });

        $('.transparency_section').each(function() {
            var height = $(this).outerHeight();
            $(this).css('margin-top', '-' + height + 'px');
        });



        if ($window_width > 979) {
            $('.full-width-content.section-style ').each(function() {
                var max_height = 0;
                var full_width_section = $(this);
                if ($('.wpb_column .vc_column-inner:not(.wpb_column .wpb_column)', full_width_section).length > 1) {
                    $('.wpb_column .vc_column-inner:not(.wpb_column .wpb_column)', full_width_section).each(function() {
                        var this_ = $(this);
                        if (this_.innerHeight() > max_height)
                            max_height = this_.innerHeight();
                    });
                    $('.wpb_column .vc_column-inner:not(.wpb_column .wpb_column):not(.vc_column-inner .vc_column-inner)', full_width_section).innerHeight(max_height + 'px');
                }

            });
        } else {
            $('.full-width-content.section-style .wpb_column .vc_column-inner:not(.wpb_column .wpb_column):not(.vc_column-inner .vc_column-inner)').height('auto');
        }

        $('.section-style').each(function() {
            var self = $(this);
            if (self.css('padding-bottom') == '0px') {
                var pad = $('.wpb_column', self).last().css('padding-bottom');
                if ($window_width < 768) {
                    $('.wpb_column', self).last().css('padding-bottom', '0px');
                } else {
                    $('.wpb_column', self).last().css('padding-bottom', pad);
                }
            }
        });

        if ($('.slider_on_top').length > 0) {
            var pd = parseInt($('#content').css('padding-top'));
            var mn = $('.header_wrapper').height();
            $('#content').css('padding-top', (pd + mn) + 'px');
        }

        $(window).resize(function() {
            $window_width = $(this).width();
            $('.full-width-content.section-style .wpb_column .vc_column-inner:not(.wpb_column .wpb_column)').height('auto');
            if ($window_width > 979) {
                $('.full-width-content.section-style ').each(function() {
                    var max_height = 0;
                    var full_width_section = $(this);
                    if ($('.wpb_column .vc_column-inner:not(.wpb_column .wpb_column)', full_width_section).length > 1) {
                        $('.wpb_column .vc_column-inner:not(.wpb_column .wpb_column)', full_width_section).each(function() {
                            var this_ = $(this);
                            if (this_.innerHeight() > max_height)
                                max_height = this_.innerHeight();
                        });
                        $('.wpb_column .vc_column-inner:not(.wpb_column .wpb_column):not(.vc_column-inner .vc_column-inner)', full_width_section).innerHeight(max_height + 'px');
                    }

                });
            } else {
                $('.full-width-content.section-style .wpb_column .vc_column-inner:not(.wpb_column .wpb_column):not(.vc_column-inner .vc_column-inner)').height('auto');
            }

            $('.section-style').each(function() {
                var self = $(this);
                if (self.css('padding-bottom') == '0px') {
                    var pad = $('.wpb_column', self).last().css('padding-bottom');

                    if ($window_width < 768) {
                        $('.wpb_column', self).last().css('padding-bottom', '0px');
                    } else {
                        $('.wpb_column', self).last().css('padding-bottom', pad);
                    }
                }
            });

        });


    }

    /*------------------------------ Navigation -------------------------- */
    function simpleNavigation() {
        "use strict";
        if (!($('nav').parent().hasClass('header_5_fullwrapper'))) {

            $('nav .menu li').each(function() {
                var self = $(this);
                if ($('.simple_mega4', self).length > 0) {
                    self.css('position', 'static');
                }

                if ($('.simple_mega5', self).length > 0) {
                    self.css('position', 'static');
                }
            });

            $('nav .menu li .sub-menu').each(function() {
                $(this).parent().first().addClass('hasSubMenu');
            });

            $('nav .menu, .sticky_menu .menu').mouseleave(function(event) {
                $(this).find('.sub-menu').not('.simple_custom_menu_mega_menu .sub-menu').stop().fadeOut(400).css('display', 'none');
                $(this).find('.simple_custom_menu_mega_menu').stop().fadeOut(400).css('display', 'none');
            });

            $('nav .menu li ul .hasSubMenu, .sticky_menu .menu li ul .hasSubMenu').mouseleave(function(event) {
                $(this).find('.sub-menu').not('.simple_custom_menu_mega_menu .sub-menu').stop().fadeOut(400).css('display', 'none');
                $(this).find('.simple_custom_menu_mega_menu').stop().fadeOut(400).css('display', 'none');
            });

            $('nav .menu > li, .sticky_menu .menu > li').mouseenter(function() {

                $(this).parent().find('.sub-menu').not('.simple_custom_menu_mega_menu .sub-menu').stop().fadeOut(400).css('display', 'none');
                $('header#header .cart .content').stop().fadeOut(400).css('display', 'none');

                $(this).find('.sub-menu').not('.simple_custom_menu_mega_menu .sub-menu').first().stop().fadeIn(400).css('display', 'block');

                $(this).parent().find('.simple_custom_menu_mega_menu').stop().fadeOut(400).css('display', 'none');
                $(this).find('.simple_custom_menu_mega_menu').first().stop().fadeIn(400).css('display', 'block');
            });

            $('nav .menu > li ul > li, .sticky_menu .menu > li ul > li').mouseenter(function() {

                $(this).find('.sub-menu').not('.simple_custom_menu_mega_menu .sub-menu').first().stop().fadeIn(400).css('display', 'block');

                $(this).parent().find('.simple_custom_menu_mega_menu').stop().fadeOut(400).css('display', 'none');
                $(this).find('.simple_custom_menu_mega_menu').first().stop().fadeIn(400).css('display', 'block');
            });

            $('.simple_custom_menu_mega_menu').each(function() {
                var bg = $(this).parent('li').data('bg');
                $(this).css('background-image', 'url(' + bg + ')');
            });

            $('header#header .container').live('mouseleave', function(event) {
                $(this).find('.cart .content').stop().fadeOut(400).css('display', 'none');
            });
            $(' .header_tools .cart .content').live('mouseleave', function(event) {
                $(this).stop().fadeOut(400).css('display', 'none');
            });

            $('header#header .cart_icon').live('mouseenter', function() {
                $(this).parents('header#header').first().find('.sub-menu').not('.simple_custom_menu_mega_menu .sub-menu').stop().fadeOut(400).css('display', 'none');
                $(this).parent().find('.content').first().stop().fadeIn(400).css('display', 'block');
            });

            $('header#header .vert_mid > a').live('mouseenter', function() {
                $(this).parent().find('.cart .content').first().stop().fadeOut(400).css('display', 'none');
            });


            if ($('.header_10').length > 0) {
                var container_left = $('.full_nav_menu').offset().left;
                var nav = $('.full_nav_menu nav').offset().left;
                $('.simple_custom_menu_mega_menu').each(function() {
                    var minus = nav - container_left;
                    $(this).css('left', '-' + minus + 'px');
                });
            }

            $(window).resize(function() {
                if ($('.header_10').length > 0) {
                    var container_left = $('.full_nav_menu').offset().left;
                    var nav = $('.full_nav_menu nav').offset().left;
                    $('.simple_custom_menu_mega_menu').each(function() {
                        var minus = nav - container_left;
                        $(this).css('left', '-' + minus + 'px');
                    });
                }
            });

        } else { //fullscreen header

            $('nav .menu li .sub-menu').each(function() {
                $(this).parent().first().addClass('hasSubMenu');
            });

            $('nav .menu').mouseleave(function(event) {
                $(this).find('.sub-menu').not('.simple_custom_menu_mega_menu .sub-menu').stop().fadeOut(400).css('display', 'none');
                $(this).find('.simple_custom_menu_mega_menu').stop().fadeOut(400).css('display', 'none');
            });
            $('nav .menu li ul .hasSubMenu').mouseleave(function(event) {
                console.log('mouseleave');
                $(this).find('.sub-menu').not('.simple_custom_menu_mega_menu .sub-menu').stop().fadeOut(400).css('display', 'none');
                $(this).find('.simple_custom_menu_mega_menu').stop().fadeOut(400).css('display', 'none');
            });
            $('nav .menu > li').mouseenter(function() {
                console.log('mouseenter');
                $(this).parent().find('.sub-menu').not('.simple_custom_menu_mega_menu .sub-menu').stop().fadeOut(400).css('display', 'none');
                $(this).find('.sub-menu').not('.simple_custom_menu_mega_menu .sub-menu').first().stop().fadeIn(400).css('display', 'block');

                $(this).parent().find('.simple_custom_menu_mega_menu').stop().fadeOut(400).css('display', 'none');
                $(this).find('.simple_custom_menu_mega_menu').first().stop().fadeIn(400).css('display', 'block');
            });
            $('nav .menu > li ul > li').mouseenter(function() {

                $(this).find('.sub-menu').not('.simple_custom_menu_mega_menu .sub-menu').first().stop().fadeIn(400).css('display', 'block');
                console.log('this');
                $(this).parent().find('.simple_custom_menu_mega_menu').stop().fadeOut(400).css('display', 'none');
                $(this).find('.simple_custom_menu_mega_menu').first().stop().fadeIn(400).css('display', 'block');
            });
            $('.simple_custom_menu_mega_menu').each(function() {
                var bg = $(this).parent('li').data('bg');
                $(this).css('background-image', 'url(' + bg + ')');
            });


        }
    }


    /*------------------------------ Fullwidth Google MAP ----------------------------- */

    function simpleFullwidthMap() {
        "use strict";
        if ($('.googlemap.fullwidth_map').length > 0) {
            $('.googlemap.fullwidth_map').each(function() {
                var $parent = $(this).parents('.row-dynamic-el').first();
                if ($parent.next().hasClass('section-style'))
                    $parent.css('margin-bottom', '0px');
            });
            $('.row-google-map').each(function() {
                if ($('.fullwidth_map', $(this)).length > 0) {
                    var $parent = $(this).parents('.row-dynamic-el').first();
                    $parent.css('margin-top', '0px');
                }

            });
        }
    }


    /*------------------------------ Change IFRAME GRID height -------------------------- */

    function simpleIFrameHeight() {
        "use strict";
        $('.blog-article.grid .media img').first().imagesLoaded(function() {
            var first_height = $('.blog-article.grid .media img').first().height();

            $('.blog-article.grid iframe').each(function() {
                $(this).css('height', first_height + 'px');
                $(this).parent('.media').css('height', first_height + 'px');
            });
        });
    }


    /*------------------------------ HEader Search Button ------------------------------ */

    function simpleSearchButton() {
        "use strict";
        $('.open_search_button').click(function() {
            if ($('body').hasClass('open_search')) {
                $('body').removeClass('open_search');
            } else
                $('body').addClass('open_search');

        });


        $(window).scroll(function() {
            if ($('body').hasClass('open_search')) {
                $('body').removeClass('open_search');
            }
        });


        $('html').click(function(e) {
            if ((e.target.id != 's')) {
                $('.right_search_container').hide();
            }
        });
    }

    /*------------------------------ Side navigation --------------------------- */

    function simpleExtraNav() {
        "use strict";
        $('.extra_navigation_button').click(function() {
            if ($('body').hasClass('open_extra_nav')) {
                $('body').removeClass('open_extra_nav');
            } else
                $('body').addClass('open_extra_nav');

        });

        $('.extra_navigation .close').click(function() {
            $('body').removeClass('open_extra_nav');
        });

        /*$(window).scroll(function() {
        	if($('body').hasClass('open_extra_nav')){
        		$('body').removeClass('open_extra_nav');
        	}
        });*/

    }


    /*------------------------------ Scroll Up binding ------------------------------ */

    function scrollUpBinding() {
        "use strict";
        $('.scrollup').click(function() {
            $("html, body").animate({ scrollTop: 0 }, 600);
            return false;
        });
    }


    /*------------------------------ Accordion Toggle Binding ------------------------------ */

    function accordionBinding() {
        "use strict";
        $(".accordion-group .accordion-toggle").live('click', function() {
            var $self = $(this).parent().parent();
            if ($self.find('.accordion-heading').hasClass('in_head')) {
                $self.parent().find('.accordion-heading').removeClass('in_head');
            } else {
                $self.parent().find('.accordion-heading').removeClass('in_head');
                $self.find('.accordion-heading').addClass('in_head');
            }
        });
    }

    /*------------------------------ Top Navtion Widget ------------------------------ */
    function simpleTopNavWidget() {
        "use strict";
        $('.small_widget a').not('.aaaa a').toggle(function(e) {
            $('.small_widget').removeClass('active');
            e.preventDefault();
            var box = $(this).data('box');
            $('.top_nav_sub').hide();
            $('.top_nav_sub.' + box).fadeIn("400");
            $(this).parent().addClass('active');

        }, function(e) {
            e.preventDefault();
            var box = $(this).data('box');
            $('.small_widget').removeClass('active');
            $('.top_nav_sub').fadeOut('400');
            $('.top_nav_sub.' + box).fadeOut('slow');


        });
    }


    /*------------------------------ LightBox -------------------------------------- */

    function simpleLightBoxInit() {
        "use strict";
        if ($(".lightbox-gallery").length > 0 || $('.show_review_form').length > 0 || $('.lightbox-media').length > 0) {

            loadDependencies([s_gb.theme_fancy + 'jquery.fancybox.js'], function() {
                loadDependencies([s_gb.theme_fancy + 'helpers/jquery.fancybox-media.js'], function() {
                    $(".lightbox-gallery").fancybox();
                    $('.show_review_form').fancybox();
                    $('.lightbox-media').fancybox({
                        openEffect: 'none',
                        closeEffect: 'none',
                        helpers: {
                            media: {}
                        }
                    });
                });
            });
        }
    }

    /*------------------------------ Tweeter Footer Carousel ------------------------ */

    function twitterFooterCarousel() {
        "use strict";
        $("#tweet_footer").each(function() {
            var $self = $(this);
            $self.carouFredSel({
                circular: true,
                infinite: true,
                auto: false,
                scroll: {
                    items: 1,
                    fx: "fade"
                },
                prev: {
                    button: $self.parent().parent().find('.back')
                },

                next: {
                    button: $self.parent().parent().find('.next')
                }

            });
        });
    }


    /*------------------------------ Blog Carousel ------------------------ */

    function simpleBlogCarousel() {
        "use strict";
        $(".carousel_blog").each(function() {
            var $self = $(this);
            if ($('li img', $self).size()) {
                $('li img', $self).one("load", function() {
                    $self.carouFredSel({
                        circular: true,
                        infinite: true,
                        auto: false,

                        scroll: {
                            items: 1
                        },

                        prev: {
                            button: $self.parents('.latest_blog').find('.prev')
                        },

                        next: {
                            button: $self.parents('.latest_blog').find('.next')
                        }

                    });
                }).each(function() {
                    if (this.complete) $(this).trigger("load");
                });
            } else {
                $self.carouFredSel({
                    circular: true,
                    infinite: true,
                    auto: false,

                    scroll: {
                        items: 1
                    },

                    prev: {
                        button: $self.parents('.latest_blog').find('.prev')
                    },

                    next: {
                        button: $self.parents('.latest_blog').find('.next')
                    }

                });
            }
        });
    }


    /*------------------------------ Clients Carousel ------------------------ */

    function clientsCarousel() {
        "use strict";

        $('.clients_caro').each(function() {
            var $self = $(this);
            if ($self.length) {
                $self.css('display', 'none');
                $self.imagesLoaded(function() {
                    $self.css('display', 'block');
                    $self.carouFredSel({
                        items: 4,
                        auto: false,
                        scroll: { items: 1 },
                        prev: {
                            button: $self.parents('.clients_el').first().find('.prev')
                        },

                        next: {
                            button: $self.parents('.clients_el').first().find('.next')
                        }
                    });
                })
            }
        });


    }


    /*------------------------------ Testimonials Carousel ------------------------ */

    function testimonialsCarousel() {
        "use strict";
        if ($('.testimonial_carousel').length > 0) {
            loadDependencies([s_gb.theme_js + 'owl.carousel.min.js'], function() {

                $('.testimonial_carousel').each(function() {
                    var $self = $(this);


                    var slide_per_view = $('.testimonial_carousel').data('slidenr');


                    $(".testimonial_carousel.owl-carousel").owlCarousel({

                        nav: true,
                        animateIn: 'slideInRight',
                        items: slide_per_view,
                        navText: ['<i class="lnr lnr-chevron-left"></i>', '<i class="lnr lnr-chevron-right"></i>'],
                        pagination: true,
                        itemsDesktop: [1199, 3],
                        itemsDesktopSmall: [979, 3],
                        autoplay: true,
                        autoplayTimeout: 2500,
                        autoplayHoverPause: true,
                        loop: true

                    });



                    var max_height = 0;
                    $($self + ' .item').each(function() {
                        if ($(this).height() > max_height)
                            max_height = $(this).height();
                    });
                    console.log(max_height);
                    $self.parents('.testimonial_carousel').first().height(max_height + 'px');

                });

                $('.testimonial_carousel').parents('.vc_column-inner').css("padding", "0");


            });
        }
        /*
    		$(this).carouFredSel({
    						
    			auto: true,
    			scroll: { items : 1, fx: 'fade' },
    			prev : {
    				button : $self.parent('.testimonial_carousel_element').find('.prev')
    			},

    			next : {
    				button : $self.parent('.testimonial_carousel_element').find('.next')
    			},
    			pagination: {

    				container: $self.parent('.testimonial_carousel_element').find('.pages_el')
    			}

    		});
    		var max_height = 0;
    		$('.item', $self).each(function(){
    			if($(this).height() > max_height)
    				max_height = $(this).height();
    		});

    		$self.parents('.testimonial_carousel_element').first().height(max_height+'px');

    	});

    */
    }

    /* ---------------------------- Testimonial Cycle ----------------------------- */

    function testimonialsCycle() {
        "use strict";

        $('.testimonial_cycle').each(function() {
            var $self = $(this);
            var container_width = $self.parents('.wpb_wrapper').first().width();
            $('.item', $self).width(container_width + 'px');

            $self.carouFredSel({

                auto: true,
                scroll: { items: 1, fx: 'fade' },

            });

        });
    }


    /*------------------------------ Flexslider Init ------------------------ */
    function flexsliderInit() {
        "use strict";
        $('.flexslider').each(function() {
            var $s = $(this);
            loadDependencies([s_gb.theme_js + 'jquery.flexslider-min.js'], function() {
                $s.flexslider({
                    slideshowSpeed: 6000,
                    animationSpeed: 800,

                    controlNav: true,
                    pauseOnAction: true,
                    pauseOnHover: false,
                    start: function(slider) {

                        $s.find(" .slides > li .flex-caption").each(function() {
                            var effect_in = $(this).attr("data-effect-in");
                            var effect_out = $(this).attr("data-effect-out");
                            $(this).addClass("animated " + effect_in);


                        });
                    },
                    before: function(slider) {
                        var current_slide = $s.find(".slides > li").eq(slider.currentSlide);
                        $s.find(".slides > li .flex-caption").removeClass('animated');
                        $(".flex-caption", current_slide).each(function() {
                            var effect_in = $(this).attr("data-effect-in");
                            var effect_out = $(this).attr("data-effect-out");

                            $(this).removeClass("animated " + effect_in).addClass("animated " + effect_out);
                        });
                    },
                    after: function(slider) {
                        var current_slide = $s.find(".slides > li").eq(slider.currentSlide);
                        $s.find(".slides > li .flex-caption").removeClass('animated');
                        $(".flex-caption", current_slide).each(function() {
                            var effect_in = $(this).attr("data-effect-in");
                            var effect_out = $(this).attr("data-effect-out");

                            $(this).removeClass("animated " + effect_out).addClass("animated " + effect_in);
                        });
                    }
                });
            });

        });
    }


    /*------------------------------ Portfolio Page Isotope filter ------------------------ */

    function simplePortfolioPageIsotope() {
        "use strict";
        if ($('#portfolio-preview-items .filterable').length > 0) {
            var $container = $('#portfolio-preview-items .filterable');

            $container.imagesLoaded(function() {
                var state = $container.mixItUp();
                simpleProjectBar();


            });
        }

        if ($('.masonry').length > 0) {
            $container = $('.masonry');
            imagesLoaded($container, function() {

                msnry_portfolio = new Masonry('.masonry', {
                    "columnWidth": ".grid-size",
                    itemSelector: '.portfolio-item'
                });

                $('#portfolio-filter li a').click(function() {
                    var filter = $(this).data('filter');
                    if (filter != 'all') {

                        msnry_portfolio.destroy();

                        $container.mixItUp();
                        $container.removeClass('masonry').addClass('filterable');

                        $container.mixItUp('filter', filter);

                    } else {
                        $container.removeClass('filterable').addClass('masonry');
                        $container.mixItUp('destroy', false);
                        $('#portfolio-filter li').removeClass('active');
                        $('#portfolio-filter li a').removeClass('active');
                        $(this).addClass('active');
                        $(this).parent().addClass('active');
                        msnry_portfolio = new Masonry('.masonry', {
                            "columnWidth": ".grid-size",
                            itemSelector: '.portfolio-item'
                        });
                    }

                });


            });

        }
    }


    /*------------------------------ FAQ Isotope filter ------------------------ */

    function simpleFaqFilter() {
        "use strict";
        $('nav#faq-filter li a').click(function(e) {
            e.preventDefault();

            var selector = $(this).attr('data-filter');

            $('.faq .accordion-group').fadeOut();
            $('.faq .accordion-group' + selector).fadeIn();

            $(this).parents('ul').find('li').removeClass('active');
            $(this).parent().addClass('active');
        });
    }



    /*------------------------------ Portfolio Carousel ------------------------------ */

    function simplePortfolioCarousel() {
        "use strict";
        if ($('.portfolio_slider').length > 0) {

            var slide_per_view = $('.portfolio_slider').data('slidenr');

            if ($(".container").css("max-width") == "940px") {
                slide_per_view = 4;
            } else if ($(".container").css("max-width") == "420px") {
                slide_per_view = 1;
            } else if ($(".container").css("width") == "724px") {
                slide_per_view = 2;
            } else if ($(".container").css("max-width") == "300px") {
                slide_per_view = 1;
            }

            var portfolio_slider = new Swiper('.portfolio_slider', {
                slidesPerView: slide_per_view,
                paginationAsRange: false,
            });
            var $pag_wrapper = $('.recent_portfolio .portfolio_slider').parents('.wpb_row');
            $pag_wrapper.addClass('kyrow');
            if ($('.portfolio_slider').length > 0) {
                $pag_wrapper.find('.wpb_wrapper .block_title').append('<div class="swiper_pagination nav-fillpath">' + $('.recent_portfolio .swiper_pagination').html() + '</div>');
                $('.recent_portfolio .swiper_pagination').remove();


                if ($('.recent_portfolio .portfolio-item img').size()) {

                    $('.recent_portfolio .portfolio-item img').on("load", function() {
                        var height = $(this).parents('.portfolio-item').first().innerHeight();

                        $('.portfolio_slider .swiper-wrapper').css({ height: height + 'px' });

                        $('.recent_portfolio .portfolio_slider').css({ height: height + 'px' });
                    });
                }





            }


            $('.swiper_pagination .next', $pag_wrapper).live('click', function(e) {
                e.preventDefault();
                portfolio_slider.swipeNext();
            });

            $('.swiper_pagination .prev', $pag_wrapper).live('click', function(e) {
                e.preventDefault();
                portfolio_slider.swipePrev();
            });

        }
    }


    /*------------------------------ Portfolio Carousel ------------------------------ */

    function simpleLatestBlogCarousel() {
        "use strict";
        if ($('.blog_slider').length > 0) {

            var slide_per_view = $('.blog_slider').data('slidenr');

            loadDependencies([s_gb.theme_js + 'owl.carousel.min.js'], function() {
                $(".blog_slider.owl-carousel").owlCarousel({

                    navigation: false,
                    navigationText: false,
                    pagination: true,

                    items: slide_per_view,
                    responsive: {
                        // breakpoint from 0 up
                        0: {
                            items: 1,
                        },
                        // breakpoint from 480 up
                        480: {
                            items: 2,
                        },
                        // breakpoint from 768 up
                        768: {
                            items: slide_per_view,
                        }
                    }

                });
            });


        }

    }

    /*------------------------------ Testimonial Carousel ------------------------------ */

    function simpleStaffCarousel() {
        "use strict";

        if ($('.staff_carousel').length > 0) {
            var $self = $(".staff_carousel");
            var slide_per_view = $('.staff_carousel').data('slidenr');
            var slider_pagination = $('.staff_carousel').data('carousel');

            loadDependencies([s_gb.theme_js + 'owl.carousel.min.js'], function() {
                $(".staff_carousel.owl-carousel").owlCarousel({

                    navigation: false,
                    navigationText: false,
                    pagination: slider_pagination,

                    items: slide_per_view,
                    itemsDesktop: [1199, 3],
                    itemsDesktopSmall: [979, 3]

                });
            });

        }


    }
    /*------------------------------ Testimonial Carousel ------------------------------ */

    function simpleTestimonialCarousel() {
        "use strict";

        if ($('.testimonial_carousel').length > 0) {
            loadDependencies([s_gb.theme_js + 'owl.carousel.min.js'], function() {
                var $self = $(".testimonial_carousel");
                var slide_per_view = $('.testimonial_carousel').data('slidenr');


                $(".testimonial_carousel.owl-carousel").owlCarousel({

                    navigation: true,
                    navigationText: false,
                    pagination: true,
                    autoWidth: true,
                    autoHeight: true,
                    items: slide_per_view,
                    itemsDesktop: [1199, 3],
                    itemsDesktopSmall: [979, 3]

                });



                var max_height = 0;
                $('.item', $self).each(function() {
                    if ($(this).height() > max_height)
                        max_height = $(this).height();
                });
                $self.parents('.testimonial_carousel_element').first().height(max_height + 'px');

            });

            $('.testimonial_carousel_element').parents('.vc_column-inner').css("padding", "0");


        }


    }

    /*------------------------------ Simple Slider ------------------------------ */

    $.fn.simpleSliderInit = function() {
        "use strict";
        var slider = this;
        var parent = this.parents('.simple_slider_swiper').first();
        var slide_per_view = slider.data('slidenumber');
        var height = slider.data('height');

        if (height == 'fullscreen')
            height = $(window).height();

        if ($('body').hasClass('outter_padding'))
            height -= 40;

        var $loading = $('.loading', parent);

        if ($('body').hasClass('header_7') && $(window).width() > 970 && $('.simple_slider_wrapper', parent).css('position') == 'fixed') {
            var pad = $('.header_wrapper').innerWidth();
            var pos = 'left'
            if ($('.pos--right').length > 0)
                pos = 'right'
            if (!($('body').hasClass('transparent_padding'))) {
                $('.simple_slider_wrapper', parent).css('padding-' + pos, pad + 'px');
                $('.simple_slider_wrapper', parent).width($('#slider-fullwidth').width() + 'px');
            }
        }

        if ($('body').hasClass('outter_padding')) {
            $('.simple_slider_wrapper', parent).width($('#slider-fullwidth').width() + 'px');
        }

        parent.height(height + 'px');
        slider.height(height + 'px');
        $('.simple_slider_wrapper', parent).css('min-height', height + 'px');
        parent.css('min-height', height + 'px');


        if ($(window).width() < 767) {
            var window_width = $(window).width();
            var new_height = (window_width * height) / 767;
            $('.simple_slider_wrapper', parent).css('min-height', new_height + 'px');
            parent.css('min-height', new_height + 'px');

            parent.height(new_height + 'px');
            slider.height(new_height + 'px');
        }

        $('.simple_slider').imagesLoaded(function() {
            $loading.css('display', 'none');
            var c_speed = $('.simple_slider').data('speed');
            if (c_speed == 'undefined')
                c_speed = 10000;
            simpleSlider = new Swiper('.simple_slider', {
                slidesPerView: slide_per_view,
                paginationAsRange: false,
                loop: false,
                touchRatio: 0.7,
                autoplay: c_speed,
                speed: 800,
                noSwiping: true,
                updateOnImagesReady: true,
                onSwiperCreated: function(swiper) {
                    var $h1 = $(swiper.activeSlide()).find('h1');
                    var $p = $(swiper.activeSlide()).find('p');
                    var $buttons = $(swiper.activeSlide()).find('.buttons');
                    var slide_color = $(swiper.activeSlide()).data('color');
                    $h1.removeClass('with_animation').addClass($h1.data('animation'));
                    $p.removeClass('with_animation').addClass($p.data('animation'));
                    $buttons.removeClass('with_animation').addClass($buttons.data('animation'));
                    if (($('body').hasClass('header_transparency')) && !$('.header_wrapper').hasClass('open'))
                        $('.header_wrapper').removeClass('background--light').removeClass('background--dark').addClass('background--' + slide_color);
                },
                onSlideChangeEnd: function(swiper) {
                    var $h1 = $(swiper.activeSlide()).find('h1');
                    var $p = $(swiper.activeSlide()).find('p');
                    var $buttons = $(swiper.activeSlide()).find('.buttons');
                    var slide_color = $(swiper.activeSlide()).data('color');
                    $h1.removeClass('with_animation').addClass($h1.data('animation'));
                    $p.removeClass('with_animation').addClass($p.data('animation'));
                    $buttons.removeClass('with_animation').addClass($buttons.data('animation'));


                    $h1 = $(swiper.activeSlide()).next().find('h1');
                    $p = $(swiper.activeSlide()).next().find('p');
                    $buttons = $(swiper.activeSlide()).next().find('.buttons');
                    $h1.addClass('with_animation').removeClass($h1.data('animation'));
                    $p.addClass('with_animation').removeClass($p.data('animation'));
                    $buttons.addClass('with_animation').removeClass($buttons.data('animation'));

                    $h1 = $(swiper.activeSlide()).prev().find('h1');
                    $p = $(swiper.activeSlide()).prev().find('p');
                    $buttons = $(swiper.activeSlide()).prev().find('.buttons');
                    $h1.addClass('with_animation').removeClass($h1.data('animation'));
                    $p.addClass('with_animation').removeClass($p.data('animation'));
                    $buttons.addClass('with_animation').removeClass($buttons.data('animation'));
                    if (($('body').hasClass('header_transparency')) && !$('.header_wrapper').hasClass('open'))
                        $('.header_wrapper').removeClass('background--light').removeClass('background--dark').addClass('background--' + slide_color);
                },
                onSlideChangeStart: function(swiper) {
                    var $h1 = $(swiper.activeSlide()).find('h1');
                    var $p = $(swiper.activeSlide()).find('p');
                    var $buttons = $(swiper.activeSlide()).find('.buttons');
                    var slide_color = $(swiper.activeSlide()).data('color');
                    $h1.addClass('with_animation').removeClass($h1.data('animation'));
                    $p.addClass('with_animation').removeClass($p.data('animation'));
                    $buttons.addClass('with_animation').removeClass($buttons.data('animation'));
                    if (($('body').hasClass('header_transparency')) && !$('.header_wrapper').hasClass('open'))
                        $('.header_wrapper').removeClass('background--light').removeClass('background--dark').addClass('background--' + slide_color);
                }
            });

            $('.nav-slider .next', parent).live('click', function(e) {
                e.preventDefault();
                simpleSlider.swipeNext();
            });

            $('.nav-slider .prev', parent).live('click', function(e) {
                e.preventDefault();
                simpleSlider.swipePrev();
            });
        });



        if (parent.hasClass('parallax_slider') && $('.container').width() > 420 && $window_width != 1024) {

            loadDependencies([s_gb.theme_js + 'skrollr.min.js'], function() {

                var skrollr_slider = skrollr.init({
                    edgeStrategy: 'set',
                    smoothScrolling: true,
                    forceHeight: false
                });
                skrollr_slider.refresh()
            });
        }

        var skrollr_slider;
        if (parent.hasClass('parallax_slider') && $('.container').width() > 680 && $window_width != 1024) {
            loadDependencies([s_gb.theme_js + 'skrollr.min.js'], function() {
                skrollr_slider = skrollr.init({
                    edgeStrategy: 'set',
                    smoothScrolling: true,
                    forceHeight: false
                });
                skrollr_slider.refresh()
            });
        }



        if ($('.swiper-slide', slider).length == 1)
            $('.nav-slider', parent).hide();

        $(window).resize(function() {
            if ($('body').hasClass('header_7') && $(window).width() > 970) {
                var pad = $('.header_wrapper').innerWidth();
                var pos = 'left'
                if ($('.pos--right').length > 0)
                    pos = 'right'
                if (!($('body').hasClass('transparent_padding'))) {
                    $('.simple_slider_wrapper', parent).css('padding-' + pos, pad + 'px');
                    $('.simple_slider_wrapper', parent).width($('#slider-fullwidth').width() + 'px');
                }
            } else {
                var pos = 'left'
                if ($('.pos--right').length > 0)
                    pos = 'right'
                if (!($('body').hasClass('transparent_padding'))) {
                    $('.simple_slider_wrapper', parent).css('padding-' + pos, 0 + 'px');
                    $('.simple_slider_wrapper', parent).width($('#slider-fullwidth').width() + 'px');
                }
            }

            height = slider.data('height');

            if (height == 'fullscreen') {
                height = $(window).height();
                $('.simple_slider_wrapper', parent).css('min-height', height + 'px');
                parent.css('min-height', height + 'px');
            }
            parent.height(height + 'px');
            slider.height(height + 'px');

            if ($(window).width() < 767) {
                var window_width = $(window).width();
                var new_height = (window_width * height) / 767;
                $('.simple_slider_wrapper', parent).css('min-height', new_height + 'px');
                parent.css('min-height', new_height + 'px');

                parent.height(new_height + 'px');
                slider.height(new_height + 'px');
            }

            if (parent.hasClass('parallax_slider') && $('.container').width() > 680 && $window_width != 1024) {
                loadDependencies([s_gb.theme_js + 'skrollr.min.js'], function() {
                    $('.simple_slider_wrapper', parent).addClass('skrollable');
                    skrollr_slider = skrollr.init({
                        edgeStrategy: 'set',
                        smoothScrolling: true,
                        forceHeight: false
                    });
                    skrollr_slider.refresh();
                });


            } else {
                $('.simple_slider_wrapper', parent).removeClass('skrollable');
            }

        });


    };


    /*------------------------------ Woocommerce Functions ------------------------------ */

    function simpleWoocommerceInit() {
        "use strict";
        if ($('.add_to_cart_button').length > 0) {

            $('body').on('adding_to_cart', function(event, param1, param2) {
                var $thisbutton = param1;
                var $product = $thisbutton.parents('.product').first();
                var $load = $product.find('.loading_ef');
                $load.css('opacity', 1);
                $('body').on('added_to_cart', function(event, param1, param2) {

                    $load.css('opacity', 0);

                    setTimeout(function() {
                        $load.html('<i class="moon-checkmark"></i>');
                        $load.css('opacity', 1);
                    }, 500);
                    setTimeout(function() { $load.css('opacity', 1); }, 400);
                    setTimeout(function() { $load.css('opacity', 0); }, 2000);
                    $product.addClass('product_added_to_cart');
                });
            });
        }
    }


    /*------------------------------ Left Navigation ------------------------------ */

    function simpleLeftNavtion() {
        "use strict";
        $(".page_item_has_children").each(function() {
            $(this).click(function() {
                $(this).find('.children').toggle(400);
                $(this).toggleClass('open-child');

            });
        });

        $('li.current_page_item').parents('.children').css({ display: 'block' });
        $('.current_page_ancestor').addClass('open-child');
    }


    /*------------------------------ Mobile Menu ---------------------------- */

    function simpleMobileMenu() {
        "use strict";
        var height = $('header#header .row-fluid:first-child .span12, .header_wrapper').height();
        var padding = $('.top_wrapper').css('padding-top');

        $('.mobile_small_menu').click(function() {

            if ($(this).hasClass('open')) {
                $('.header_wrapper').height('auto');
                $('header#header .row-fluid:first-child .span12').css('position', 'relative');

                $('header#header .row-fluid:first-child .span12').height(height);
                $('.menu-small').slideDown(400);
                if (!$('body').hasClass('header_3'))
                    $('.top_wrapper').css('float', 'none').css('width', 'inherit').css('display', 'block');

                if ($('body').hasClass('header_4'))
                    $('.top_wrapper').css('padding-top', '0');
                $('.tparrows').hide();

                $(this).removeClass('open').addClass('close');
            } else if ($(this).hasClass('close')) {

                $('.menu-small').slideUp(400);
                $('.tparrows').show();
                if (!$('body').hasClass('header_3'))
                    $('.top_wrapper').css('float', 'none').css('width', 'inherit').css('display', 'block');

                if ($('body').hasClass('header_4'))
                    $('.top_wrapper').css('padding-top', padding);
                $(this).removeClass('close').addClass('open');
                $('.header_wrapper').height('auto');
            }
        });

        $('#mobile-menu li').each(function() {
            var id = $(this).attr('id');
            $(this).attr('id', 'responsive-' + id);
        });

        $(window).resize(function() {
            var height = $('header#header .row-fluid:first-child .span12, .header_wrapper').height();
            var padding = $('.top_wrapper').css('padding-top');
            if ($(window).width() > 980) {
                $('.header_7 .header_wrapper').height('100%');
                $('.menu-small').slideUp(400);
                $('.tparrows').show();
                if (!$('body').hasClass('header_3'))
                    $('.top_wrapper').css('float', 'none').css('width', 'inherit').css('display', 'block');

                if ($('body').hasClass('header_4'))
                    $('.top_wrapper').css('padding-top', padding);
                $('.mobile_small_menu').removeClass('close').addClass('open');
                $('.header_wrapper').height('auto');
            }
        });
        if ($(window).width() > 980) {
            $('.header_7 .header_wrapper.transparent_padding').height('auto');
        }
        if ($(window).width() < 980) {
            $('.header_7 .header_wrapper').removeClass('transparent_padding');
        }
    }




    /*-------------------------------------------------------------------------------------------------------------*/
    /*------------------------------------------ FUNCTIONS END ----------------------------------------------------*/
    /*-------------------------------------------------------------------------------------------------------------*/





    /*------------------------------ Switcher Toggle Button ------------------------ */

    function simpleSwitcherToggle() {
        "use strict";
        $("#switcher-head .button").toggle(function() {
            $("#style-switcher").animate({
                left: 0
            }, 500);
        }, function() {
            $("#style-switcher").animate({
                left: -263
            }, 500);
        });
    }


    /* ----------------------------- SmoothScroll ---------------------------- */

    function simple_smoothScroll() {
        "use strict";
        try {
            $.browserSelector();
            if ($("html").hasClass("chrome")) {
                $.smoothScroll();
            }
        } catch (err) {

        }
    }

    /* ----------------------------- End SmoothScroll ------------------------ */


    /* ----------------------------- BLOG Masonry ---------------------------- */

    function simple_blogmasonry() {
        "use strict";
        var container = $('#blogmasonry .filterable');
        container.imagesLoaded(function() {

            msnry_blog = new Masonry('#blogmasonry .filterable', {
                "columnWidth": ".grid-size",
                itemSelector: '.blog-article'
            });

        });
    }

    /* ----------------------------- End BLOG Masonry ------------------------ */


    /* ----------------------------- Simple Post Share --------------------- */
    function simplePostShares() {
        "use strict";
        $('.blog-article .share_link').each(function() {
            var link = $(this);
            link.live('mouseover', function() {

                var cont = $(this).parents('.blog-article').find('.shares');
                var parent = $(this).parents('.blog-article').parent();
                if (link.hasClass('opened')) {
                    cont.css('opacity', 0).css('visibility', 'hidden');
                    link.removeClass('opened');
                } else {
                    parent.find('.share_link').removeClass('opened');
                    parent.find('.shares').css('opacity', 0).css('visibility', 'hidden');
                    link.addClass('opened');
                    cont.css('visibility', 'visible').css('opacity', 1);

                }
            });
            $(' .blog-article .shares_container').delegate(link, 'mouseleave', function() {
                var cont = $(this).parents('.blog-article').find('.shares');
                var parent = $(this).parents('.blog-article').parent();
                if (link.hasClass('opened')) {
                    cont.css('opacity', 0).css('visibility', 'hidden');
                    link.removeClass('opened');

                }
            });


        });





    }
    /* ----------------------------- End Simple Post Share ----------------- */


    /* ----------------------------- Background Check ------------------------ */

    function simple_backgroundcheck() {
        "use strict";
        if ($('.header_1').length > 0 || $('.header_4').length > 0) {
            if ($('.page_header_centered').length > 0 && $('.auto_color_check').length > 0) {
                $('.header_wrapper').addClass('background--dark');
                BackgroundCheck.init({
                    targets: '.header_wrapper',
                    images: '.header_page',
                    classes: { dark: 'background--dark', light: 'background--light', complex: 'background--dark' }
                });
                setTimeout(function() { BackgroundCheck.refresh(); }, 400);
            }

            if ($('#fullpage').length > 0 && $('.auto_color_check').length > 0) {
                $('.header_wrapper').addClass('background--dark');
                BackgroundCheck.init({
                    targets: '.header_wrapper',
                    images: '.section'
                });
                setTimeout(function() {
                    if ($('.header_wrapper').hasClass('background--light'))
                        $('.section:first-child .content').addClass('background--light');
                    else if ($('.header_wrapper').hasClass('background--dark'))
                        $('.section:first-child .content').addClass('background--dark');
                }, 800);
            }

            if ($('.fullscreen-single').length > 0 && $('.auto_color_check').length > 0) {
                $('.header_wrapper').addClass('background--dark');
                var ca = Array.prototype.slice.call(document.querySelectorAll(".header_wrapper")).concat(Array.prototype.slice.call(document.querySelectorAll(".fullscreen-single")));
                BackgroundCheck.init({
                    targets: ca,
                    images: '.header_fullscreen_single img',
                    windowEvents: false
                });
            }


        }
    }

    /* ----------------------------- End Background Check -------------------- */

    /* ----------------------------- Fullscreen Section ---------------------- */

    function simple_fullscreen_section() {
        if ($(window).width() > 960) {
            "use strict";
            if ($('.fullscreen-blog-article').length > 0) {
                $('#fullpage .section .content').each(function() {
                    var height = $(this).height();
                    $(this).css('margin-top', '-' + (height / 2) + 'px');
                });
            }
            $('#fullpage').fullpage({
                verticalCentered: false,
                navigation: true,
                navigationPosition: 'right',
                resize: false,

                afterLoad: function(anchorLink, index) {
                    if ($('.auto_color_check').length > 0) {
                        BackgroundCheck.refresh();
                        if ($('.header_wrapper').hasClass('background--light'))
                            $('.section:nth-child(' + index + ') .content').addClass('background--light');
                        else if ($('.header_wrapper').hasClass('background--dark'))
                            $('.section:nth-child(' + index + ') .content').addClass('background--dark');
                    }
                    $('#fullpage .section .with_animation').animate_on_appear();



                },
                afterRender: function() {
                    $('#fullpage .section .with_animation').animate_on_appear();
                }
                /*onLeave: function(index, nextIndex){
                    var current = $('#fullpage .section:nth-child('+index+') .content') ;
                    var next = $('#fullpage .section:nth-child('+nextIndex+') .content');
                    current.removeClass('with_animation').removeClass(current.data('animation'));
                    next.addClass('with_animation').delay(current.data('delay')).queue( function() {
                    	$(this).addClass(current.data('animation'));
                    });
                }*/

            });

        } //endif
    }

    /* ----------------------------- End Fullscreen Section ------------------- */

    /* ----------------------------- SINGLE PORTFOLIO FLOATING----------------- */

    function simple_single_portfolio_floating() {
        "use strict";
        var $sidebar = $(".fixed_sidebar"),
            $window = $(window),
            offset = $sidebar.offset(),
            topPadding = 15;

        if ($('.container').width() > 420 && $sidebar.length > 0) {
            $window.scroll(function() {
                if ($window.scrollTop() > offset.top) {
                    $sidebar.stop().animate({
                        marginTop: $window.scrollTop() - offset.top + topPadding
                    });
                } else {
                    $sidebar.stop().animate({
                        marginTop: 0
                    });
                }
            });
        } else {
            $(window).unbind('scroll');
        }
    }


    /* ----------------------------- END SINGLE PORTFOLIO FLOATING------------ */

    /* ----------------------------- Custom Select --------------------------- */

    function simpleCustomSelect() {
        "use strict";
        $('.woocommerce-ordering .orderby').select2();

    }

    /* ----------------------------- End Custom Select ----------------------- */

    /* ----------------------------- Simple gallery carousel --------------- */

    function simpleGalleryCarouselInit() {
        "use strict";
        var gallery = $('.simple_gallery_carousel');

        var slider = gallery.find('.simple_swiper_gallery');
        slider.hide();
        if (gallery.length > 0) {

            var height = gallery.data('height');

            if (height == 'fullscreen')
                height = $(window).height();

            var $loading = $('.loading', gallery);

            gallery.height(height + 'px');
            slider.height(height + 'px');

            $('.simple_swiper_gallery').imagesLoaded(function() {
                $loading.css('display', 'none');
                var centered = false;
                var VslidesPerView = 'auto';
                if ($('.simple_gallery_carousel').hasClass('the-simple'))
                    centered = false;
                else {
                    centered = true;
                }

                if ($(window).width() > 979) {
                    simpleSlider = new Swiper('.simple_swiper_gallery', {
                        slidesPerView: 'auto',
                        paginationAsRange: false,
                        loop: centered,
                        initialSlide: -1,
                        centeredSlides: centered,
                        touchRatio: 0.7,
                        autoplay: 5000,
                        speed: 800,
                        noSwiping: true,
                        updateOnImagesReady: true
                    });


                } else {

                    simpleSlider = new Swiper('.simple_swiper_gallery', {
                        slidesPerView: 1,
                        paginationAsRange: false,
                        touchRatio: 0.7,
                        autoplay: 5000,
                        speed: 800,
                        noSwiping: true,
                        updateOnImagesReady: true
                    });

                    gallery.addClass('mobile_gallery');

                }

                slider.fadeIn('slow');
                $('.nav-slider .next', gallery).live('click', function(e) {
                    e.preventDefault();
                    simpleSlider.swipeNext();
                });

                $('.nav-slider .prev', gallery).live('click', function(e) {
                    e.preventDefault();
                    simpleSlider.swipePrev();
                });
                simpleSlider.resizeFix();


            });

            if ($('.swiper-slide', slider).length == 1)
                $('.nav-slider', gallery).hide();

            $(window).resize(function() {

                if ($('body').hasClass('header_7') && $(window).width() > 970) {
                    var pad = $('.header_wrapper').innerWidth();
                    var pos = 'left'
                    if ($('.pos--right').length > 0)
                        pos = 'right'
                    $('.simple_slider_wrapper', gallery).css('padding-' + pos, pad + 'px');
                    $('.simple_slider_wrapper', gallery).width($('#slider-fullwidth').width() + 'px');
                } else {
                    var pos = 'left'
                    if ($('.pos--right').length > 0)
                        pos = 'right'
                    $('.simple_slider_wrapper', gallery).css('padding-' + pos, 0 + 'px');
                    $('.simple_slider_wrapper', gallery).width($('#slider-fullwidth').width() + 'px');

                }

                if ($(window).width() < 970) {
                    simpleSlider = new Swiper('.simple_swiper_gallery', {
                        slidesPerView: 1,
                        paginationAsRange: false,
                        touchRatio: 0.7,
                        autoplay: 5000,
                        speed: 800,
                        noSwiping: true,
                        updateOnImagesReady: true
                    });

                    gallery.addClass('mobile_gallery');
                }
            });



        }
    }

    /* ----------------------------- End Simple gallery carousel ----------- */



    /* ----------------------------- Tabs ------------------------------------ */

    function simpleTabsactive() {
        "use strict";
        if ($('.tabbable').length > 0) {
            $('.tabbable').each(function() {
                var id = $(this).find('.nav-tabs li.active a').attr('href');
                $(this).find(id).addClass('active');
            });
        }
    }

    /* ----------------------------- End Tabs -------------------------------- */

    /* ----------------------------- Buttons Style --------------------------- */

    function simpleOverallButton() {
        "use strict";
        var extra = simple_global.button_style;

        if ($('.wpcf7-form p input[type="submit"]').length > 0) {
            $('.wpcf7-form p input[type="submit"]').addClass('btn-bt').addClass(extra);
        }
        if ($('#respond input[type="submit"]').length > 0) {
            $('#respond input[type="submit"]').addClass('btn-bt').addClass(extra);
        }

        if ($('.woocommerce .button, #woocommerce .button').length > 0) {
            $('.woocommerce .button, #woocommerce .button').not('.wpb_content_element.button').addClass('btn-bt').addClass(extra);
        }

        if ($('.not_found .search_field').length > 0) {
            $('.not_found .search_field button').addClass('btn-bt').addClass(extra);
        }

        if ($('.post-password-form input[type="submit"]').length > 0) {
            $('.post-password-form input[type="submit"]').addClass('btn-bt').addClass(extra);
        }

        if ($('.mc_signup_submit input').length > 0) {
            $('.mc_signup_submit input').addClass('btn-bt').addClass(extra);
        }

        if ($('.mc4wp-form input[type="submit"]').length > 0) {
            $('.mc4wp-form input[type="submit"]').addClass('btn-bt').addClass(extra);
        }

        $("body").bind("added_to_cart", function() {
            $('.added_to_cart').addClass('btn-bt').addClass(extra);
        });
        if ($('#place_order.button').length > 0) {
            $('#place_order.button').addClass('btn-bt').addClass(extra);
        }
    }

    /* ----------------------------- End Buttons Style ----------------------- */

    /* ----------------------------- Header5 Overlay ------------------------- */

    function simpleMenuOverlay() {

        var triggerBttn = document.getElementById('trigger-overlay1'),
            overlay = document.querySelector('div.overlay_menu'),
            closeBttn = overlay.querySelector('button.overlay-close');
        transEndEventNames = {
                'WebkitTransition': 'webkitTransitionEnd',
                'MozTransition': 'transitionend',
                'OTransition': 'oTransitionEnd',
                'msTransition': 'MSTransitionEnd',
                'transition': 'transitionend'
            },
            transEndEventName = transEndEventNames[Modernizr.prefixed('transition')],
            support = { transitions: Modernizr.csstransitions };

        triggerBttn.addEventListener('click', toggleOverlay);
        closeBttn.addEventListener('click', toggleOverlay);

        function toggleOverlay() {
            if (classie.has(overlay, 'open')) {
                classie.remove(overlay, 'open');
                classie.add(overlay, 'close');

                var onEndTransitionFn = function(ev) {
                    if (support.transitions) {
                        if (ev.propertyName !== 'visibility') return;
                        this.removeEventListener(transEndEventName, onEndTransitionFn);
                    }
                    classie.remove(overlay, 'close');
                };
                if (support.transitions) {
                    overlay.addEventListener(transEndEventName, onEndTransitionFn);
                } else {
                    onEndTransitionFn();
                }
            } else if (!classie.has(overlay, 'close')) {
                classie.add(overlay, 'open');
            }
        }


        $('.overlay_menu .menu-item-has-children').hover(function() {

            var height = $(this).find('.sub-menu li').height();
            height *= $(this).find('.sub-menu li').length;
            //$(this).find('.sub-menu').height(height+'px');

        }, function() {
            //$(this).find('.sub-menu').height(0);
        });

    }


    /* ----------------------------- End Header 5 Overlay -------------------- */

    /* ----------------------------- Search overlay ------------------------- */

    function simpleSearchOverlay() {

        if ($('.open_search_button').length > 0) {
            var triggerBttn = document.getElementById('trigger-overlay'),
                overlay = document.querySelector('div.search_bar'),
                closeBttn = overlay.querySelector('div.overlay-close');
            transEndEventNames = {
                    'WebkitTransition': 'webkitTransitionEnd',
                    'MozTransition': 'transitionend',
                    'OTransition': 'oTransitionEnd',
                    'msTransition': 'MSTransitionEnd',
                    'transition': 'transitionend'
                },
                transEndEventName = transEndEventNames[Modernizr.prefixed('transition')],
                support = { transitions: Modernizr.csstransitions };

            triggerBttn.addEventListener('click', toggleOverlay);
            closeBttn.addEventListener('click', toggleOverlay);

            function toggleOverlay() {

                if (classie.has(overlay, 'open')) {
                    classie.remove(overlay, 'open');
                    classie.add(overlay, 'close');

                    var onEndTransitionFn = function(ev) {
                        if (support.transitions) {
                            if (ev.propertyName !== 'visibility') return;
                            this.removeEventListener(transEndEventName, onEndTransitionFn);
                        }
                        classie.remove(overlay, 'close');
                    };
                    if (support.transitions) {
                        overlay.addEventListener(transEndEventName, onEndTransitionFn);
                    } else {
                        onEndTransitionFn();
                    }
                } else if (!classie.has(overlay, 'close')) {
                    classie.add(overlay, 'open');
                }
            }



        }

    }


    /* ----------------------------- End Search overlay -------------------- */

    /* ----------------------------- Layout Changes -------------------------- */

    function simpleLayoutChanges() {
        "use strict";
        var container = $('.container').width();
        $('.testimonial_carousel .item').each(function() {

            var self = $(this);
            var wpb_column = self.parents('.wpb_column').first().width();
            self.innerWidth(wpb_column + 'px');
            self.height(self.height() + 'px');
            self.parents('.caroufredsel_wrapper').first().height(self.height() + 'px');
            self.parents('.testimonial_carousel').first().height(self.height() + 'px');

        });

        $('.clients_caro .item').each(function() {
            var self = $(this);
            var wpb_column = self.parents('.vc_column-inner').width();

            if (container > 420 && container <= 724) {
                self.innerWidth((wpb_column / 3) + 'px');
            }
            if (container > 724 && container < 940) {
                self.innerWidth((wpb_column / 4) + 'px');
            }
            if (container > 940) {
                self.innerWidth((wpb_column / 6) + 'px');
            }
        });

        clientsCarousel();
    }

    /* ----------------------------- End Layout Changes ---------------------- */


    /* ----------------------------- One Page -------------------------------- */

    function simpleOnePage() {
        "use strict";
        $('nav .menu').onePageNav({
            currentClass: 'current-menu-item',
            changeHash: false,
            scrollSpeed: 750,
            scrollThreshold: 0.5,
        });
    }

    /* ----------------------------- End One Page ---------------------------- */


    function fixWooCommercebtn() {

        jQuery(document.body).on('updated_cart_totals', function() {
            var extra = simple_global.button_style;

            if ($('.woocommerce .button, #woocommerce .button').length > 0) {
                $('.woocommerce .button, #woocommerce .button').addClass('btn-bt').addClass(extra);

            }

        })
    }

    /* ----------------------------- Sticky Nav ------------------------------ */

    function simpleStickyNav() {
        "use strict";
        var opened = false;
        var position = $('.header_wrapper').css('position');
        var bool_test = false;
        $('.logo_only_sticky .header_wrapper #logo').css('opacity', 0).css('visibility', 'hidden');
        $(window).scroll(function() {
            var top = $(this).scrollTop();

            if (top > stickyNavTop + 300 && !opened) {

                $('body').addClass('sticky_header');

                setTimeout(function() {
                    if ($('.header_wrapper').hasClass('background--dark')) {
                        $('.header_wrapper').removeClass('background--dark');
                        bool_test = true;
                    }
                    $('.header_wrapper').css('position', 'fixed').css('visibility', 'visible').addClass('open');
                    opened = true;

                }, 200);

                $('.logo_only_sticky .header_wrapper #logo').css('visibility', 'visible').css('opacity', 1);

            } else if (top == 0) {
                if (($('body').hasClass('header_transparency')) && bool_test) {
                    $('.header_wrapper').addClass('background--dark');
                }



                $('body').removeClass('sticky_header');
                $('.header_wrapper').removeClass('open').css('position', position);

                if (simpleSlider) {
                    var slide_color = simpleSlider.activeSlide().data('color');
                    if (($('.header_wrapper').hasClass('header_1') || $('.header_wrapper').hasClass('header_11')) && !$('.header_wrapper').hasClass('open'))
                        $('.header_wrapper').removeClass('background--light').removeClass('background--dark').addClass('background--' + slide_color);
                }
                opened = false;
                $('.logo_only_sticky .header_wrapper #logo').css('opacity', 0).css('visibility', 'hidden');

            }




        });

        $(window).resize(function() {
            $window_width = $(this).width();
            if ($window_width < 980) {
                $('body').removeClass('sticky_header');
                $('.header_wrapper').removeClass('open').css('position', position);
                opened = false;
            }
        });
    }

    /* ----------------------------- End Sticky Nav -------------------------- */



    /* ----------------------------- Blog Infinite Scroll -------------------- */
    function simpleBlogInfiniteScroll() {
        "use strict";
        var container = '#posts_container';
        var behavior = '';
        if ($('#blogmasonry').length > 0) {
            container = '#blogmasonry .filterable';
            behavior = 'masonry_blog';
        } else
            container = '#posts_container';

        $(container).infinitescroll({

            navSelector: "div.p_pagination",
            // selector for the paged navigation (it will be hidden)
            nextSelector: "div.p_pagination a.next_link",
            // selector for the NEXT link (to page 2)
            itemSelector: "#posts_container article.post",
            // selector for all items you'll retrieve
            animate: true,

            loading: {
                img: '',
                msgText: ''
            },

            behavior: behavior
        });

        simple_blogmasonry();


    }
    /* ----------------------------- End Blog Infinite Scroll ---------------- */

    /* ----------------------------- Portfolio Infinite Scroll -------------------- */
    function simplePortfolioInfiniteScroll() {
        "use strict";
        var container = '.masonry';
        var behavior = '';


        $(container).infinitescroll({

                navSelector: "div.p_pagination",
                // selector for the paged navigation (it will be hidden)
                nextSelector: "div.p_pagination a.next_link",
                // selector for the NEXT link (to page 2)
                itemSelector: "#portfolio-preview-items .portfolio-item",
                // selector for all items you'll retrieve
                animate: true,

                loading: {
                    img: '',
                    msgText: ''
                },

                behavior: behavior
            },

            function(arrayOfNewElems) {
                simplePortfolioInGrid();

            }

        );
        simplePortfolioPageIsotope();

        //s();


    }
    /* ----------------------------- End Portfolio Infinite Scroll ---------------- */

    /* ----------------------------- Page transition --------------------------*/
    function simplePageTransition() {
        "use strict";

        $(".animsition").animsition({
            inClass: $(this).data('animsition-in-class'),
            outClass: $(this).data('animsition-out-class'),
            inDuration: $(this).data('animsition-in-duration'),
            outDuration: $(this).data('animsition-out-duration'),
            linkElement: 'a:not([target="_blank"]):not([href^="#"]):not(.lightbox-gallery):not(.zoom)'



        });
    }
    /*------------------------------ Side menu Responsive Init ------------------------ */
    $(window).on('load resize ready', function() {
        "use strict";
        $window_width = $(window).width();
        if ($window_width <= 1024) {
            $("#snapcontent").addClass('snap-content');
        }
        if ($window_width > 1024) {
            $("#snapcontent").removeClass('snap-content');
        }


        if ($(window).width() <= 1024) {

            loadDependencies([s_gb.theme_js + 'snap.min.js'], function() {
                var snapper = new Snap({
                    element: document.getElementById('snapcontent'),
                    disable: 'right',
                    maxPosition: 240,
                });

                var myToggleButton = document.getElementById('open-left');
                myToggleButton.addEventListener('click', function() {

                    if (snapper.state().state == "left") {
                        snapper.close();
                    } else {
                        snapper.open('left');
                    }
                });
                $(".close-sidebar").on('click', function() {
                    if (snapper.state().state == "left")
                        snapper.close();
                });
            });
        }
        $('.snap_left_content .menu-small ul li:not(.menu-item-has-children), .snap_left_content .menu-small ul li ul li').on('click', function() {
            return true;
        });

        $('.snap_left_content .menu-small > ul > li.menu-item-has-children > a').on('click', function() {

            $('.snap_left_content .menu-small > ul > li.menu-item-has-children > a').not($(this)).parent().find(".sub-menu").removeClass('open');
            //$('.snap_left_content .menu-small ul li.menu-item-has-children').not(this).removeClass('open');
            $(this).parent().find('.sub-menu').toggleClass('open');

            return false;
        });

    });

    /*------------------------------ Online Functions ------------------------ */
    function simpleOnlineFunctions() {
        "use strict";

        if ($('.sidebar_right #blogmasonry').hasClass('cols3'))
            $('.sidebar_right #blogmasonry').removeClass('cols3').addClass('cols2');

        if ($window_width <= 768) {

            $('.wpb_column.vc_col-sm-12').each(function() {
                var classList = $(this).attr('class').split(/\s+/);
                $(this).removeClass(classList[classList.length - 1]);
            });

        }
    }


    function simpleSVGServices() {
        if ($('.services_medium .icon-svg').length > 0) {
            $('.services_medium .icon-svg').each(function() {
                var $this = $(this);

                loadDependencies([s_gb.theme_js + 'vivus.js'], function() {
                    var link = $this.data('link');
                    var color = $this.data('color')
                    var id = $this.attr('id');

                    new Vivus(id, {
                        duration: 50,
                        file: link,
                        onReady: function(mySVG) {
                            mySVG.el.setAttribute('stroke', color);
                        }
                    });
                });
            });
        }

    }

    /*-----------------------Google map disable zoom on scroll----------------------*/
    function simpleDisableMapZoom() {
        "use strict";
        // Disable scroll zooming and bind back the click event
        var onMapMouseleaveHandler = function(event) {
            var that = $(this);

            that.on('click', onMapClickHandler);
            that.off('mouseleave', onMapMouseleaveHandler);
            that.find('iframe.googlemap').css("pointer-events", "none");
        }

        var onMapClickHandler = function(event) {
            var that = $(this);

            // Disable the click handler until the user leaves the map area
            that.off('click', onMapClickHandler);

            // Enable scrolling zoom
            that.find('iframe.googlemap').css("pointer-events", "auto");

            // Handle the mouse leave event
            that.on('mouseleave', onMapMouseleaveHandler);
        }

        // Enable map zooming with mouse scroll when the user clicks the map
        $('.row-google-map').on('click', onMapClickHandler);
    }

    /*------------------------------ In Grid portfolio filter ------------------------ */


    function simplePortfolioInGrid() {
        "use strict";
        //$('#portfolio-preview-items .portfolio-item  img').on("load", function(){
        if ($('.page-template-portfolio .portfolio-item .filter-row').hasClass('in_grid')) {
            var height_filter = $('.portfolio-item:nth-child(2)').innerHeight();
            $('.filter-row.in_grid').css('height', height_filter + 'px');
        }
        //});


    }

    /* ----------------------------- Portfolio Project Bar -------------------------- */

    function simpleProjectBar() {
        "use strict";
        setTimeout(function() {


            $('.content_portfolio .normal .grayscale, .content_portfolio .no_space .grayscale, .recent_portfolio .grayscale').find('.project').each(function() {

                var box_width = parseFloat($(this).prev().innerWidth());
                var project_box = box_width - 20;
                $(this).css('width', parseInt(project_box));
            });
        }, 500);

    }

    function simpleScrollToTop() {
        "use strict";
        $(window).scroll(function() {
            var top = $(this).scrollTop();
            if (top > 600) {
                $('.scrollup').css('display', 'block');
            } else {
                $('.scrollup').css('display', 'none');
            }
        });
    }

    function simple404() {
        "use strict";
        var height = $(window).height();
        $('.error404 section').css('height', height + 'px');

    }

    /* ----------------------------- SINGLE PORTFOLIO FLOATING----------------- */

    function simple_headingWithLine() {
        "use strict";
        var $heading = $(".block_title.section_title.inner-square, .block_title.column_title.inner-inline_border_circle"),
            $window = $(window),
            offset = $heading.offset();
        var topPadding = 150;


        $heading.each(function() {
            var $thisheading = $(this);

            var offset = $thisheading.offset();
            $window.scroll(function() {
                if ($window.scrollTop() + 450 > offset.top) {
                    $thisheading.find('.divider .line').addClass('appeared');
                }

            });

        });
    }
    /*--------------------Simple Hoverex -------------------------------------*/

    /*
     *	jQuery HoverEx Script
     *	by hkeyjun
     *   http://codecanyon.net/user/hkeyjun	
     */
    ;
    (function($) {
        var HoverEx = {
            fn: {
                moveZoom: function(obj, e) {
                    var h = obj.height(),
                        w = obj.width(),
                        t = e.pageY - obj.offset().top,
                        l = e.pageX - obj.offset().left;
                    var $largeImg = obj.find("img");
                    var dataZoom = obj.data("zoom");
                    if (dataZoom && dataZoom != "auto") {
                        var zoomNum = parseFloat(dataZoom);
                        $largeImg.css({ "width": w * zoomNum + "px", "height": h * zoomNum + "px", "top": -t * (zoomNum - 1) + "px", "left": -l * (zoomNum - 1) + "px" });
                    } else {
                        var zoomNum = $largeImg.width() / w;
                        $largeImg.css({ "top": -t * (zoomNum - 1) + "px", "left": -l * (zoomNum - 1) + "px" });
                    }
                },
                changeZoom: function(obj, e, delta, deltaX, deltaY) {
                    var $largeImg = obj.find("img");
                    var currentZoom = obj.data("zoom");
                    currentZoom = currentZoom == "auto" ? $largeImg.width() / obj.width() : parseFloat(currentZoom);
                    var zoomStep = obj.data("zoomstep");
                    zoomStep = zoomStep ? parseFloat(zoomStep) : 0.5;
                    var zoomRange = obj.data("zoomrange");
                    zoomRange = zoomRange ? zoomRange.split(",") : "1,4";
                    var zoomMin = parseFloat(zoomRange[0]),
                        zoomMax = parseFloat(zoomRange[1]) > currentZoom ? parseFloat(zoomRange[1]) : currentZoom;
                    var op = deltaY > 0 ? 1 : -1;
                    var nextZoom = Math.round((currentZoom + zoomStep * op) * 10) / 10.0;
                    if (nextZoom >= zoomMin && nextZoom <= zoomMax) {
                        obj.data("zoom", nextZoom);
                        HoverEx.fn.showZoomState(obj, nextZoom);
                        HoverEx.fn.moveZoom(obj, e);
                    }

                },
                showZoomState: function(obj, state) {
                    var $zoomState = obj.find(".he-zoomstate");
                    if ($zoomState.length == 0) {
                        $zoomState = $('<span class="he-zoomstate">' + state + 'X</span>').appendTo(obj);
                    }
                    $zoomState.text(state + "X").stop(true, true).fadeIn(300).delay(200).fadeOut(300);
                },
                switchImg: function(slider, type) {
                    var animation = slider.data("animate");
                    animation = animation ? animation : "random";
                    if (animation == "random") {
                        var animations = ["fadeIn", "fadeInLeft", "fadeInRight", "fadeInUp", "fadeInDown", "rotateIn", "rotateInLeft", "rotateInRight", "rotateInUp", "rotateInDown", "bounce", "bounceInLeft", "bounceInRight", "bounceInUp", "bounceInDown", "elasticInLeft", "elasticInRight", "elasticInUp", "elasticInDown", "zoomIn", "zoomInLeft", "zoomInRight", "zoomInUp", "zoomInDown", "jellyInLeft", "jellyInRight", "jellyInDown", "jellyInUp", "flipInLeft", "flipInRight", "flipInUp", "flipInDown", "flipInV", "flipInH"];
                        animation = animations[Math.floor(Math.random() * animations.length)];
                    }
                    var $imgs = slider.find("img");
                    if ($imgs.length > 1) {
                        if (type > 0) {
                            $imgs.eq(0).attr("class", "a0").appendTo(slider);
                            $imgs.eq(1).attr("class", "a0 " + animation);
                        } else {
                            $imgs.eq($imgs.length - 1).attr("class", "a0 " + animation).prependTo(slider);
                            $imgs.eq(0).attr("class", "a0");
                        }
                    }
                }
            }
        };

        $(function() {
            $(".he-wrap").live({
                mouseenter: function() {
                    var $view = $(this).find(".he-view").addClass("he-view-show");
                    $("[data-animate]", $view).each(function() {
                        var animate = $(this).data("animate");
                        $(this).addClass(animate);
                    });
                    $(this).find(".he-zoom").addClass("he-view-show");
                },
                mouseleave: function() {
                    var $view = $(this).find(".he-view").removeClass("he-view-show");
                    $("[data-animate]", $view).each(function() {
                        var animate = $(this).data("animate");
                        $(this).removeClass(animate);
                    });
                    $(this).find(".he-zoom").removeClass("he-view-show");
                },
                mousewheel: function(e, delta, deltaX, deltaY) {
                    if ($(this).find(".he-sliders").length == 1) {
                        var $slider = $(this).find(".he-sliders");
                        var op = deltaY > 0 ? 1 : -1;
                        HoverEx.fn.switchImg($slider, op);
                        e.preventDefault();
                    } else if ($(this).find(".he-zoom").length == 1) {
                        var $zoom = $(this).find(".he-zoom");
                        HoverEx.fn.changeZoom($zoom, e, delta, deltaX, deltaY);
                        e.preventDefault();
                    }
                }
            });
            $(".he-zoom").live({
                mousemove: function(e) {
                    HoverEx.fn.moveZoom($(this), e);
                }
            });
            $(".he-pre").live("click", function() {
                var $slider = $(this).parents(".he-wrap").find(".he-sliders");
                HoverEx.fn.switchImg($slider, -1);
            });
            $(".he-next").live("click", function() {
                var $slider = $(this).parents(".he-wrap").find(".he-sliders");
                HoverEx.fn.switchImg($slider, 1);
            });

        });
    })(jQuery);

    /*! Copyright (c) 2011 Brandon Aaron (http://brandonaaron.net)
     * Licensed under the MIT License (LICENSE.txt).
     *
     * Thanks to: http://adomas.org/javascript-mouse-wheel/ for some pointers.
     * Thanks to: Mathias Bank(http://www.mathias-bank.de) for a scope bug fix.
     * Thanks to: Seamus Leahy for adding deltaX and deltaY
     *
     * Version: 3.0.6
     * 
     * Requires: 1.2.2+
     */

    (function($) {

        var types = ['DOMMouseScroll'];

        if ($.event.fixHooks) {
            for (var i = types.length; i;) {
                $.event.fixHooks[types[--i]] = $.event.mouseHooks;
            }
        }

        $.event.special.mousewheel = {
            setup: function() {
                if (this.addEventListener) {
                    for (var i = types.length; i;) {
                        this.addEventListener(types[--i], handler, false);
                    }
                } else {
                    this.onmousewheel = handler;
                }
            },

            teardown: function() {
                if (this.removeEventListener) {
                    for (var i = types.length; i;) {
                        this.removeEventListener(types[--i], handler, false);
                    }
                } else {
                    this.onmousewheel = null;
                }
            }
        };

        $.fn.extend({
            mousewheel: function(fn) {
                return fn ? this.bind("mousewheel", fn) : this.trigger("mousewheel");
            },

            unmousewheel: function(fn) {
                return this.unbind("mousewheel", fn);
            }
        });


        function handler(event) {
            var orgEvent = event || window.event,
                args = [].slice.call(arguments, 1),
                delta = 0,
                returnValue = true,
                deltaX = 0,
                deltaY = 0;
            event = $.event.fix(orgEvent);
            event.type = "mousewheel";

            // Old school scrollwheel delta
            if (orgEvent.wheelDelta) { delta = orgEvent.wheelDelta / 120; }
            if (orgEvent.detail) { delta = -orgEvent.detail / 3; }

            // New school multidimensional scroll (touchpads) deltas
            deltaY = delta;

            // Gecko
            if (orgEvent.axis !== undefined && orgEvent.axis === orgEvent.HORIZONTAL_AXIS) {
                deltaY = 0;
                deltaX = -1 * delta;
            }

            // Webkit
            if (orgEvent.wheelDeltaY !== undefined) { deltaY = orgEvent.wheelDeltaY / 120; }
            if (orgEvent.wheelDeltaX !== undefined) { deltaX = -1 * orgEvent.wheelDeltaX / 120; }

            // Add event and delta to the front of the arguments
            args.unshift(event, delta, deltaX, deltaY);

            return ($.event.dispatch || $.event.handle).apply(this, args);
        }

    })(jQuery);

    /*--------------------------------------------------------------------------------------------------------------------------*/