/**
 * jquery.slideshow.js v1.0.1 - a responsive touch-friendly Slideshow based on jQuery
 * https://github.com/SaeidMohadjer/jquery.slideshow
 * Copyright 2014 Saeid Mohadjer
 * Released under the MIT license - http://opensource.org/licenses/MIT
 */

//https://gist.github.com/2375726
//http://blog.safaribooksonline.com/2012/04/18/mapping-mouse-events-and-touch-events-onto-a-single-event/
(function () {
    TouchMouseEvent = {DOWN: "touchmousedown", UP: "touchmouseup", MOVE: "touchmousemove"};
    var e = function (e) {
        var t;
        switch (e.type) {
            case"mousedown":
                t = TouchMouseEvent.DOWN;
                break;
                case"mouseup":
                t = TouchMouseEvent.UP;
                break;
                case"mousemove":
                t = TouchMouseEvent.MOVE;
                break;
                default:
                return
            }
        var r = n(t, e, e.pageX, e.pageY);
        $(e.target).trigger(r)
    };
    var t = function (e) {
        var t;
        switch (e.type) {
            case"touchstart":
                t = TouchMouseEvent.DOWN;
                break;
                case"touchend":
                t = TouchMouseEvent.UP;
                break;
                case"touchmove":
                t = TouchMouseEvent.MOVE;
                break;
                default:
                return
            }
        var r = e.originalEvent.touches[0];
        var i;
        if (t == TouchMouseEvent.UP)
            i = n(t, e, null, null);
        else
            i = n(t, e, r.pageX, r.pageY);
        $(e.target).trigger(i)
    };
    var n = function (e, t, n, r) {
        return $.Event(e, {pageX: n, pageY: r, originalEvent: t})
    };
    var r = $(document);
    if ("ontouchstart"in window) {
        r.on("touchstart", t);
        r.on("touchmove", t);
        r.on("touchend", t)
    } else {
        r.on("mousedown", e);
        r.on("mouseup", e);
        r.on("mousemove", e)
    }
})()

function Slideshow(slideshow_options) {
    //default settings
    var settings = {
        align: 'left',
        mode: 'default', //thumb_nails
        autoplay: false,
        autoplay_start_delay: 0,
        callback: null,
        displayTime: 3000,
        easing: 'swing',
        id: null,
        startingSlideNumber: 1,
        visibleSlidesCount: 1,
        slideTab_has_value: false,
        transition_delay: 500,
        preload_images: false,
        loop: false,
        variableHeight: false,
        variableWidth: true,
        role: '',
        loader_image: 'img/loader.gif',
        multiple_slides: false,
        slide_margin_right: 0, //percent only used when multiple slides are displayed and slideshow has variable width
        align_buttons: function () {
            //center align buttons
            var btn_h = $slideshow.find('.next').height();
            $slideshow.find('.prev, .next').css('top', (slideHeight() - btn_h) / 2);
        }
    };

    var options = $.extend(true, settings, slideshow_options);

    //private properties
    var slideshow = this,
            id = '#' + options.id,
            $slideshow = $(id),
            $prev = $slideshow.find('.prev'),
            $next = $slideshow.find('.next'),
            $slides = $slideshow.find('.slides'),
            slideNum = options.startingSlideNumber,
            slideTimer, autoplay_timeout,
            previousSlidenum = 0,
            slide = {},
            slides_width = 0,
            tallest_slide_height = 0;

    //public properties and methods
    slideshow.isInitialized = false;
    this.width = 0;
    this.slideNumber = function (num) {
        if (num) {
            slideNum = parseInt(num);
            update();
            moveToSlide(slideNum - 1);
        } else {
            return slideNum;
        }
    };
    this.getSlideCount = function () {
        return slide.count;
    };

    //preload images
    (function () {
        $slideshow.addClass('loading');
        if (options.preload_images && $slides.find('img').length) {
            if (typeof jQuery.fn.imagesLoaded !== 'function') {
                init();
                return;
            }
            $slides.imagesLoaded(init);
        } else {
            init();
        }
    })();

    function init() {
        //check if css is loaded
        if ($slides.css('position') !== 'relative') {
            console.warn('slideshow styles are not loaded!');
            return;
        }

        console.log(typeof window.MutationObserver);

        if (window.MutationObserver && !$slideshow.is(":visible")) {
            console.log('mo1');
            var observer = new MutationObserver(function (mutations) {
                mutations.forEach(function (mutation) {
                    if ($slideshow.is(":visible")) {
                        observer.disconnect();
                        initSlideshow();
                    }
                });
            });

            var config = {attributes: true, subtree: true};
            observer.observe($('body').get(0), config);
        } else {
            initSlideshow();
        }

    }

    function initSlideshow() {
        $slideshow.removeClass('loading');
        if (options.autoplay)
            enable_autoplay();

        if (options.loop) {
            adjust_dom_for_looping();
        }

        setClickHandlersForSlideshowButtons();

        slide.div = $slides.find('.slide');
        slide.count = slide.div.length; //takes fake slides into account

        if ($slideshow.has('.slideTabs')) {
            create_slideTabs();
        }

        add_drag_handlers();

        $(window).on('resize.slideshow', windowResizeHandler);

        windowResizeHandler();

        slideshow.isInitialized = true;
    }

    function enable_autoplay() {
        options.loop = true;
        autoplay_timeout = window.setTimeout(function () {
            slideTimer = window.setInterval(function () {
                navigate('next');
            }, options.displayTime);
        }, options.autoplay_start_delay);
    }

    function disable_autoplay() {
        if (options.autoplay) {
            options.autoplay = false;
            window.clearInterval(slideTimer);
            window.clearTimeout(autoplay_timeout);
        }
    }

    function create_slideTabs() {
        var $tabs = $slideshow.find('.slideTabs');

        //generate tab labels if markup is empty
        if ($tabs.children().length === 0) {
            var count = options.loop ? slide.count - 2 : slide.count / options.visibleSlidesCount;
            for (var i = 0; i < count; i++) {
                $tabs.append('<a href="#"></a>');
            }
        }

        $tabs.on('click', 'a', function (e) {
            e.preventDefault();
            disable_autoplay();

            if (options.visibleSlidesCount > 1) {
                slideNum = $(this).index() * options.visibleSlidesCount + 1;
            } else {
                slideNum = $(this).index() + 1;
            }

            moveToSlide(options.loop ? slideNum : slideNum - 1);
        });
    }

    function windowResizeHandler(e) {
        if (window.MutationObserver && !$slideshow.is(":visible")) {
            $(window).off('resize.slideshow');

            var observer = new MutationObserver(function (mutations) {
                mutations.forEach(function (mutation) {
                    console.log(mutation);
                    if ($slideshow.is(":visible")) {
                        observer.disconnect();
                        $(window).on('resize.slideshow', windowResizeHandler);
                        resizeSlideshow();
                    }
                });
            });

            var config = {attributes: true, subtree: true};
            observer.observe($('body').get(0), config);
        } else {
            resizeSlideshow();
        }
    }

    function resizeSlideshow() {
        slideshow.width = $slideshow.find('.wrapper').width();

        if (options.multiple_slides) {
            if (options.visibleSlidesCount > 1) { //so it doesn't kick in thumbnail sample. bad code!
                slide.div.width(setSlideSize());
            }
        } else {
            slide.div.width(slideshow.width);
        }

        positionSlides();
        moveToSlide(options.loop ? slideNum : slideNum - 1, 0);

        if (options.variableHeight) {
            setSlideHeight();
        }
    }

    function setSlideSize() {
        var count = options.visibleSlidesCount;
        var total_width = $slideshow.find('.wrapper').width();
        var total_margins = (count - 1) * options.slide_margin_right;
        var slide_width = (100 - total_margins) / count;
        var slide_width_pixel = parseInt(total_width * slide_width / 100);
        var marginRight = parseInt(total_width * options.slide_margin_right / 100);

        $slideshow.find('.slide').width(slide_width_pixel).css('margin-right', marginRight);
        return slide_width_pixel;
    }

    function setClickHandlersForSlideshowButtons() {
        $slideshow.on('click', '.prev, .next', function (e) {
            e.preventDefault();
            if ($(this).hasClass('disabled'))
                return;

            disable_autoplay();
            var direction = $(this).hasClass('next') ? 'next' : 'previous';
            navigate(direction);
        });
    }

    function adjust_dom_for_looping() {
        //we insert a clone of first slide after the last slide and a clone of last
        //slide before the first. These fake slides are required for endless looping.
        var clone1 = $slides.find('.slide').first().clone().addClass('fake post_last');
        var clone2 = $slides.find('.slide').last().clone().addClass('fake pre_first');
        $slides.append(clone1).prepend(clone2);
    }

    function navigate(direction) {
        var VScount = options.visibleSlidesCount;

        if (direction == 'next') {
            if (options.loop) {
                if (slideNum < slide.count - 1) {
                    slideNum++;
                } else {
                    //jump to first slide which is same as last (current) slide
                    $slides.css({
                        'left': -slide.div.eq(1).position().left
                    });
                    slideNum = 2;
                }
            } else {
                if (slideNum < slide.count) {
                    //slideNum++
                    slideNum = slideNum + VScount;
                }
            }
        } else {
            if (options.loop) {
                if (slideNum > 0) {
                    slideNum--;
                } else {
                    //jump to last slide which is same as first (current) slide
                    $slides.css({
                        'left': -slide.div.eq(slide.count - 2).position().left
                    });
                    slideNum = slide.count - 3;
                }
            } else {
                if (slideNum > VScount) {
                    slideNum = slideNum - VScount;
                }
            }
        }

        moveToSlide(options.loop ? slideNum : slideNum - 1);
    }

    function positionSlides() {
        var left = 0;
        var marginRight = parseInt(slide.div.css('margin-right')) || 0;

        //we set width of div.slides to a very large value so that content of div.slide will not wrap due to slideshows fixed width value. This is important when slide divs's width is not
        //fixed and is calculated on the fly by javascript. After all slides are positioned we update width of div.slides to the correct value (even though there is no need for that).
        //remove this hack later when you find a better solution to avoid wrapping of div.slide content.
        $slides.width(50000);

        for (var i = 0; i < slide.count; i++) {
            //slide.div.eq(i).css('left', left+'px');
            left = left + slide.div.eq(i).outerWidth() + marginRight;
            //+ ( (i != slide.count-1) ? marginRight : 0 );
            slides_width = left;
        }

        $slides.width(slides_width);
    }

    function moveToSlide(num, delay) {
        var _delay = (delay === undefined) ? options.transition_delay : delay;
        var currentSlide = slide.div.eq(num);
        var slide_left = currentSlide.position().left;
        var slide_center = currentSlide.position().left + currentSlide.width() / 2;
        var slideshow_center = slideshow.width / 2;


        if (options.multiple_slides && options.align === 'center') {
            if (slide_center > slideshow_center) {
                if (slide_center < slides_width - slideshow_center) {
                    slide_left = slide_left - (slideshow.width - currentSlide.width()) / 2;
                } else {
                    slide_left = slides_width - slideshow.width;
                }
            } else {
                slide_left = 0;
            }
        }

        updateUI();
        previousSlidenum = num - 1;

        slide.div.removeClass('currentSlide');
        currentSlide.addClass('currentSlide');

        //stop()'s jumpToEnd should be false else loop animation will be buggy when next/prev btns are clicked fast
        $slides
                .stop(true, false)
                .animate({'left': -slide_left}, _delay, options.easing, function () {
                    if (options.variableHeight) {
                        //addImageErrorLoadHandlers();
                        if (tallest_slide_height == 0) {
                            setSlideHeight();
                        }
                    }
                    if (options.callback)
                        options.callback(slideshow);
                });
    }

    function add_drag_handlers() {
        var startX, endX;
        var slides = slide.div;

        slides.bind(TouchMouseEvent.DOWN, function (e) {
            e.preventDefault();
            startX = e.pageX;
            endX = startX;
        });

        slides.bind(TouchMouseEvent.MOVE, function (e) {
            e.preventDefault();
            endX = e.pageX;
        });

        slides.bind(TouchMouseEvent.UP, function (e) {
            e.preventDefault();
            var slideIndex = slides.index($(this));

            //disable autoplay when user clicks next/prev buttons
            if (options.autoplay) {
                disable_autoplay();
            }

            if (endX < startX) {
                if (!$next.hasClass('disabled'))
                    navigate('next');
            } else if (endX > startX) {
                if (!$prev.hasClass('disabled'))
                    navigate('previous');
            } else {
                if (options.mode === 'thumb_nails') {
                    if (slideIndex != slideNum) {
                        //user clicked a side slide
                        slideNum = slideIndex;
                        positionSlides();
                    }
                }
            }
        });
    }

    function setSlideHeight() {
        $(id + ' .wrapper').css('height', slideHeight());

        options.align_buttons();

        //we trigger resize because if slideshow has caused browser scrollbar
        //to appear when slideshow's parent has no fixed width then slides will
        //be almost 17px (width of scrollbar) wider than parent element causing
        //layout issues...
        //if (options.variableWidth) update_width();
    }

    function slideHeight() {
        var index = options.loop ? slideNum : slideNum - 1;

        var temp;
        if (options.visibleSlidesCount === 1) {
            temp = $(id + ' .slide').eq(index).outerHeight();
        } else {
            temp = (function () { //find highest slide's height
                var h = 0;
                $slideshow.find('.slide').each(function () {
                    var temp = $(this).outerHeight();
                    if (temp > h)
                        h = temp;
                });
                tallest_slide_height = h;
                return h;
            })();
        }

        return temp;
    }

    //replace code with one from below:
    // http://stackoverflow.com/questions/4857896/jquery-callback-after-all-images-in-dom-are-loaded
    function addImageErrorLoadHandlers() {
        var images = $(id + ' .slide:eq(' + (slideNum) + ') img');
        for (var i = 0; i < images.length; i++) {
            images[i].onload = function (evt) {
                setSlideHeight();
            }
            images[i].onerror = function (evt) {
                this.src = "images/image_not_found.jpg";
            }
        }
    }

    function update() {
        slide.div = $(id + ' .slide');
        slide.count = slide.div.length;
        positionSlides();
        if ((slideNum > slide.count) && (slide.count != 0)) {
            slideNum = slide.count;
            moveToSlide(slideNum);
        }
        updateUI();
    }

    function updateUI() {
        //var count = slide.count - options.visibleSlidesCount + 1;
        if (slide.count == 0)
            slideNum = 0;

        //update slide number
        if (slideNum == slide.count - 1 && options.loop) {
            $(id + ' .slideNumber').text('1');
        } else if (slideNum == 0 && options.loop) {
            $(id + ' .slideNumber').text(slide.count - 2);
        } else {
            $(id + ' .slideNumber').text(slideNum);
        }

        if ($slideshow.has('.slideTabs'))
            update_tab_state();
        if (!options.loop)
            update_nav_state();

        //update total sildes
        $(id + ' .slidesCount').text(options.loop ? slide.count - 2 : slide.count);
    }

    function update_tab_state() {
        var tabs = $(id + ' .slideTabs a');
        tabs.removeClass('selected');

        if (options.loop) {
            if (slideNum == slide.count - 1) {
                tabs.eq(0).addClass('selected');
            } else if (slideNum == 0) {
                tabs.eq(slide.count - 3).addClass('selected');
            } else {
                tabs.eq(slideNum - 1).addClass('selected');
            }
        } else {
            tabs.eq(Math.ceil(slideNum / options.visibleSlidesCount) - 1).addClass('selected');
        }
    }

    function update_nav_state() {
        if (options.visibleSlidesCount == 1) {
            if ((slideNum == slide.count) && (slideNum == 1)) { //there is only one slide
                $prev.addClass('disabled');
                $next.addClass('disabled');
            } else if (slideNum == slide.count) { // last slide
                $prev.removeClass('disabled');
                $next.addClass('disabled');
            } else if (slideNum == 1) { // first slide
                $prev.addClass('disabled');
                $next.removeClass('disabled');
            } else { // other slides
                $prev.removeClass('disabled');
                $next.removeClass('disabled');
            }
        } else {
            if (slideNum > slide.count - options.visibleSlidesCount) {
                $prev.removeClass('disabled');
                $next.addClass('disabled');
            } else if (slideNum < options.visibleSlidesCount) {
                $prev.addClass('disabled');
                $next.removeClass('disabled');
            } else {
                $prev.removeClass('disabled');
                $next.removeClass('disabled');
            }
        }
    }

}
