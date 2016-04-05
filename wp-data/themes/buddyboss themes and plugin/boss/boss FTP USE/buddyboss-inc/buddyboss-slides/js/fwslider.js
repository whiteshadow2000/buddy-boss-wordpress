function fws2() {

    "use strict";

    var glob = {
        instance: "",
        cs: 0,
        pause: 6000,
        duration: 750
    };

    this.init = function(params) {
        glob.instance = "#" + params.unique;
        
        /* Append css to header */
        jQuery("#fws-style-"+params.unique).children().appendTo("head");
        jQuery("#fws-style-"+params.unique).remove();
        
        glob.pause      = parseInt(params.pause,10);
        glob.duration   = parseInt(params.duration,10);
        glob.hoverpause = parseInt(params.hoverpause,10);
        glob.bullets    = parseInt(params.bullets,10);
        glob.arrows     = parseInt(params.arrows,10);
        
        /* Init */
        content.init();
        display.bindControls();
        controls.bindControls();
    };

    var display = {
        /* Resize function */
        resizeOnMenuOpen: function() {
            var w = jQuery(glob.instance).width(),
                h = jQuery(glob.instance).height(),
                ratio = w/h,
                new_w;
            
            if(jQuery('body').hasClass('left-menu-open')) {
                new_w = w + 175;
                jQuery(glob.instance).animate({height: new_w/ratio},500,'easeInQuad');
            } else {
                new_w = w - 175;
                jQuery(glob.instance).animate({height: new_w/ratio},500,'easeOutQuad');
            }
 
        },
        resizeOnDemo: function() {
            $('#fwslider').height($('#fwslider .slide_content').height());
        },
        resize: function() {
            jQuery(glob.instance).css({height: jQuery(glob.instance).find(".slide:first").height()});
        },
        /* Bind resize listener */
        bindControls: function() {
            jQuery("#left-menu-toggle").click(function() {
                display.resizeOnMenuOpen();
            })
            jQuery("ul.icon-links li a").click(function() {
                display.resizeOnDemo();
            })
            jQuery(window).resize(function() {
                display.resize();
            });
        }
    };

    var controls = {
        /* Bind button controls */
        bindControls: function() {

            /* Hover effect */
            jQuery(glob.instance + " .slidePrev," + glob.instance + " .slideNext").on("mouseover", function() {
                jQuery(this).animate({
                    opacity: 1
                }, {
                    queue: false,
                    duration: 1000,
                    easing: "easeOutCubic"
                });
            });

            /* Hover effect - mouseout */
            jQuery(glob.instance + " .slidePrev," + glob.instance + " .slideNext").on("mouseout", function() {
                jQuery(this).animate({
                    opacity: 0.5
                }, {
                    queue: false,
                    duration: 1000,
                    easing: "easeOutCubic"
                });
            });
            
            /* Arrow Key Bind */
            jQuery(document).on("keyup", function(e) {
                if (e.which === 39) {
                    jQuery(glob.instance + " .slideNext").trigger("click");
                }
                if (e.which === 37) {
                    jQuery(glob.instance + " .slidePrev").trigger("click");
                }
            });

            /* Next Button */
            jQuery(glob.instance + " .slideNext").on("click", function() {
                if (jQuery(glob.instance + " .slide").is(":animated")) return;

                if (jQuery(glob.instance + " .slide:eq(" + (glob.cs + 1) + ")").length <= 0) {
                    glob.cs = 0;

                    jQuery(glob.instance + " .timers .timer .progress").stop();

                    jQuery(glob.instance + " .timers .timer:last .progress").animate({
                        width: "100%"
                    }, {
                        queue: false,
                        duration: glob.duration,
                        easing: "easeOutCubic",
                        complete: function() {
                            jQuery(glob.instance + " .timers .timer .progress").css({
                                width: "0%"
                            });
                        }
                    });
                } else {
                    glob.cs++;

                    jQuery(glob.instance + " .timers .timer .progress").stop();
                    jQuery(glob.instance + " .timers .timer:lt(" + glob.cs + ") .progress").animate({
                        width: "100%"
                    }, {
                        queue: false,
                        duration: glob.duration,
                        easing: "easeOutCubic"
                    });

                }
                content.show();
            });

            /* Previous Button */
            jQuery(glob.instance + " .slidePrev").on("click", function() {
                if (jQuery(glob.instance + " .slide").is(":animated"))
                    return;

                if (glob.cs <= 0) {
                    glob.cs = jQuery(glob.instance + " .slide:last").index();

                    jQuery(glob.instance + " .timers .timer .progress").stop();
                    jQuery(glob.instance + " .timers .timer .progress").css({
                        width: "100%"
                    });
                    jQuery(glob.instance + " .timers .timer:last .progress").animate({
                        width: "0%"
                    }, {
                        queue: false,
                        duration: glob.duration,
                        easing: "easeOutCubic"
                    });

                } else {
                    glob.cs--;

                    jQuery(glob.instance + " .timers .timer .progress").stop();
                    jQuery(glob.instance + " .timers .timer:gt(" + glob.cs + ") .progress").css({
                        width: "0%"
                    });
                    jQuery(glob.instance + " .timers .timer:eq(" + glob.cs + ") .progress").animate({
                        width: "0%"
                    }, {
                        queue: false,
                        duration: glob.duration,
                        easing: "easeOutCubic"
                    });
                }
                content.show();
            });
            
            jQuery(document).on("click", glob.instance + " .bullets .bullet", function(){
                if (jQuery(glob.instance + " .slide").is(":animated")) return;
                
                glob.cs = jQuery(this).index();
                
                jQuery(glob.instance + " .timers .timer .progress").stop();
                
                jQuery(glob.instance + " .timers .timer:gt(" + glob.cs + ") .progress").css({
                    width: "0%"
                });
                
                jQuery(glob.instance + " .timers .timer:lt(" + glob.cs + ") .progress").css({
                    width: "100%"
                });
                
                jQuery(glob.instance + " .timers .timer:eq(" + glob.cs + ") .progress").animate({
                    width: "0%"
                }, {
                    queue: false,
                    duration: glob.duration,
                    easing: "easeOutCubic"
                });
                
                content.show();
            });
        }
    };

    var content = {
        init: function() {
            /* First run content adjustment */
            
            if (glob.bullets == "0") {
                 jQuery(glob.instance + " .bullets").hide();
            }
            
            if (glob.arrows == "0") {
                 jQuery(glob.instance + " .slidePrev, " + glob.instance + " .slideNext").hide();
            }
            
            jQuery(glob.instance + " .slide img").imagesLoaded(function() {
                
                for (var i = 0; i < jQuery(glob.instance + " .slide").length; i++) {
                    jQuery('<div class="timer"><div class="progress"></div></div>').appendTo(glob.instance + " .timers");
                    jQuery('<div class="bullet"><i class="fa fa-circle"></i></div>').appendTo(glob.instance + " .bullets");
                }
                
                jQuery(glob.instance + " .bullets .bullet:eq(" + glob.cs + ")").addClass("active");
                
                jQuery(glob.instance + " .timers").css({
                    width: (jQuery(glob.instance + " .timers .timer").length + 1) * jQuery(glob.instance + " .timers .timer").width() + 5
                });

                jQuery(glob.instance + " .slide:eq(" + glob.cs + ")").fadeIn({
                    duration: 1500,
                    easing: "swing"
                });
                
                
                jQuery(glob.instance).animate({
                    height: jQuery(glob.instance + " .slide:first img").height()
                }, {
                    duration: 750,
                    easing: "easeInOutExpo",
                    complete: function() {
                        jQuery(glob.instance + " .slidePrev").animate({
                            left: 0
                        }, {
                            duration: 1500,
                            easing: "easeInOutExpo"
                        });

                        jQuery(glob.instance + " .slideNext").animate({
                            right: 0
                        }, {
                            duration: 1500,
                            easing: "easeInOutExpo"
                        });

                        jQuery(glob.instance + " .bullets").animate({
                            bottom: 15
                        }, {
                            duration: 1500,
                            easing: "easeInOutExpo"
                        });
                        
                        

                        content.showText();
                        display.resize();
                        auto.run();
                        auto.focus();
                    }
                });
                
            });
        },
        show: function() {
            /* Show slide */

            content.hideText();
            
            jQuery(glob.instance + " .bullets .bullet").removeClass("active");
            jQuery(glob.instance + " .bullets .bullet:eq(" + glob.cs + ")").addClass("active");
            
            jQuery(glob.instance + " .slide:eq(" + glob.cs + ")").css({
                opacity: 0,
                zIndex: 2
            }).show().animate({
                opacity: 1
            }, {
                queue: false,
                duration: glob.duration,
                easing: "swing",
                complete: function() {
                    jQuery(glob.instance + " .slide:lt(" + glob.cs + ")," + glob.instance + " .slide:gt(" + glob.cs + ")").css({
                        zIndex: 0
                    }).hide();

                    jQuery(glob.instance + " .slide:eq(" + glob.cs + ")").css({
                        zIndex: 1
                    });
                    content.showText();
                    auto.run();
                }
            });
        },
        showText: function() {
            /* Show slide text */
            
            jQuery(glob.instance + " .slide:eq(" + glob.cs + ") .title").fadeTo(300, 1);

            setTimeout(function() {
                jQuery(glob.instance + " .slide:eq(" + glob.cs + ") .description").fadeTo(300, 1);
            }, 150);

            setTimeout(function() {
                jQuery(glob.instance + " .slide:eq(" + glob.cs + ") .readmore").fadeTo(300, 1);
            }, 300);
        },
        hideText: function() {
            /* Hide slide text */

            jQuery(glob.instance + " .slide .title").fadeTo(300, 0);

            setTimeout(function() {
                jQuery(glob.instance + " .slide .description").fadeTo(300, 0);
            }, 150);

            setTimeout(function() {
                jQuery(glob.instance + " .slide .readmore").fadeTo(300, 0);
            }, 300);
        }
    };

    var auto = {
        /* Run timer */
        run: function() {
            
            if (glob.pause === 0) return;
            
            jQuery(glob.instance + " .timer:eq(" + glob.cs + ") .progress").animate({
                width: "100%"
            }, {
                queue: false,
                duration: (glob.pause - (glob.pause / 100) * (((jQuery(glob.instance + " .timer:eq(" + glob.cs + ") .progress").width() / jQuery(glob.instance + " .timer:eq(" + glob.cs + ")").width()) * 100))),
                easing: "linear",
                complete: function() {
                    jQuery(glob.instance + " .slideNext").trigger("click");
                }
            });
        },
        /* Stop on focus */
        focus: function() {
            
            if (glob.hoverpause === 1) {
                jQuery(glob.instance + " .slide_content").on("mouseover", function() {
                    if (jQuery(glob.instance + " .slide").is(":animated"))
                        return;
                    jQuery(glob.instance + " .timer .progress").stop();
                });

                jQuery(glob.instance + " .slide_content").on("mouseleave", function() {
                    if (jQuery(glob.instance + " .slide").is(":animated"))
                        return;
                    auto.run();
                });
            }
        }
    };
}