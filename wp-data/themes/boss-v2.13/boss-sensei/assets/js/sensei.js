(function($) {
    /* Courses */  
    var equalHeights = function(options) {
        var maxHeight = 0,
            $this = $('.course-flexible-area'),
            equalHeightsFn = function() {
                var height = $(this).innerHeight();
    
                if ( height > maxHeight ) { maxHeight = height; }
            };
        options = options || {};

        $this.each(equalHeightsFn);

        return $this.css('height', maxHeight);
    };
    
    // get viewport size        
    function viewport() {
        var e = window, a = 'inner';
        if (!('innerWidth' in window )) {
            a = 'client';
            e = document.documentElement || document.body;
        }
        return { width : e[ a+'Width' ] , height : e[ a+'Height' ] };
    }
       
    function equalProjects(){
        if(viewport().width > 550 && $('.course-flexible-area').length) {
            $('.course-flexible-area').css('height','auto');
            equalHeights();
        }
    }

//    imagesLoaded( '.course-flexible-area', function( instance ) {
        equalProjects();
//    });
    
    $('#my-courses ul li a').click(function(){
        $(window).trigger('resize');
    });

    /* throttle */
    $(window).resize(function(){
        clearTimeout($.data(this, 'resizeTimer'));
        $.data(this, 'resizeTimer', setTimeout(function() {
            equalProjects();
        }, 50));
    });
    
    $('#left-menu-toggle').click(function(){
        setTimeout(function() {
            equalProjects();
        }, 550);
    });

    $(window).trigger('resize');
    
    var video_frame = $("#course-video").find('iframe'),
        video_src = video_frame.attr('src');
    
    $('#show-video').click(function(e){
        e.preventDefault();
        $('.course-header').fadeOut(200, 
        function(){
            $("#course-video").fadeIn(200);
        });
        $(this).addClass('hide');
    });
    
    $('#hide-video').click(function(e){
        e.preventDefault();
        $('#course-video').fadeOut(200, 
        function(){
            video_frame.attr('src','');
            $(".course-header").fadeIn(200, function() {
                video_frame.attr('src',video_src);
            });
        });
        $('#show-video').removeClass('hide');
    });
    
//    console.log($("#header-menu > ul"));
//        delete $.fn.jRMenuMore;
//        delete $("#header-menu > ul").jRMenuMore;
//    $("#header-menu > ul").fn.jRMenuMore = null;
    
    
     /* Quiz */
    $('#sensei-quiz-list .answers > li').click(function(){
        $(this).find('input[type=radio], input[type=checkbox]').prop("checked", function(){
            return !($(this).prop("checked"));
        }).trigger("change");
    });
    
    $('#sensei-quiz-list input[type=radio], #sensei-quiz-list input[type=checkbox]').click(function(e){
        e.stopPropagation();
    });
    
    $('#sensei-quiz-list input[type=radio], #sensei-quiz-list input[type=checkbox]').each(function(){
        var $this = $(this);
        if($this.attr('checked') == 'checked') {
            $this.parents('li').addClass('selected');
        } else {
            $this.parents('li').removeClass('selected');
        }
    }); 
    
    $('#sensei-quiz-list input').change(function(){
        if($(this).attr('type') == 'radio') {
            $(this).parents('ul').find('li').each(function(){
                $(this).removeClass('selected');
            });
            $(this).parent('li').addClass('selected');
        } else if($(this).attr('type') == 'checkbox') {
            $(this).parent('li').toggleClass('selected');
        }
    });
    
    $('#sensei-quiz-list').find('.file-upload').find('input[type="file"]').each(function(){
        $this = $(this);
        $this.wrap("<div class='fake-wrap'></div>").before('<a href="#" class="fake-upload">Choose File</a>').before('<span class="fake-link">No file chosen</span>').change(function(){
            $this.prev().text($this.val().match(/([^(\\|\/)]*)\/*$/)[1]);
        });
    });
    
    $(".fake-upload").click(function(e){
        e.preventDefault();
        $(this).next().next().trigger('click');
    });
    
    // Hidding comments
    
    if($('#comments').find('#respond').length == 0) {
        $('#comments').hide();
    }
    
    $('.course-container').prev('p').remove();
	
	
	//Ajax for contact teacher widget
	$( '.boss-edu-send-message-widget' ).on( 'click', function ( e ) {

		e.preventDefault();

		$.post( ajaxurl, {
			action: 'boss_edu_contact_teacher_ajax',
			content: $('.boss-edu-teacher-message').val(),
			sender_id: $('.boss-edu-msg-sender-id').val(),
			reciever_id: $('.boss-edu-msg-receiver-id').val(),
			course_id: $('.boss-edu-msg-course-id').val()
		},
		function(response) {
			
			if ( response.length > 0 && response != 'Failed' ) {
				$('.widget_course_teacher h3').append('<div class="sensei-message tick">Your private message has been sent.</div>');
			}
		});


	} );
    
    $( "#author-tabs" ).tabs();
    
    $('.widget_course_progress section.entry, .widget_course_progress .lessons-list .other-lessons').has( ".current" ).addClass('open');
    
    $('.widget_course_progress .module header a, .widget_course_progress .lessons-list header h2 a').click(function(e){
        e.preventDefault();
    });
    
    $('.widget_course_progress .module header, .widget_course_progress .lessons-list header').click(function(e){
        $(this).next().slideToggle();
    });


    //Sensei course module expand/collapse
    jQuery(document).ready( function($) {

        /**************************************************************/
        /* Prepares the cv to be dynamically expandable/collapsible   */
        /**************************************************************/
        $(function prepareList() {
            //Initially assign all to be collapsed
            $('.expList2').closest('ul')
                .addClass('collapsed')
                .children('li').hide();

            // Toggle between collapsed/expanded per module
            $('.expList').unbind('click').click(function (event) {
                if (this == event.target) {
                    $(this).parents('.module').find('.expList2').toggleClass('collapsed expanded');
                    $(this).parents('.module').find('.expList2').children('li').toggle('medium');
                    $(this).parent().find('.tog-mod').toggleClass('fa-chevron-down fa-chevron-up');
                }
                return false;
            });

            //Hack to add links inside the cv
            $('.expList2 a').unbind('click').click(function () {
                window.open($(this).attr('href'), '_self');
                return false;
            });
            //Hack to add links inside the cv
            $('.expList a').unbind('click').click(function () {
                window.open($(this).attr('href'), '_self');
                return false;
            });

            //Create the expand/collapse all button funtionality
            $('.expandList')
                .unbind('click')
                .click(function () {
                    $('.collapsed').parents('.module').find('.tog-mod').addClass('fa-chevron-down').removeClass('fa-chevron-up');
                    $('.collapsed').addClass('expanded').removeClass('collapsed');
                    $('.expanded').children('li').show('medium');

                })
            $('.collapseList')
                .unbind('click')
                .click(function () {
                    $('.expanded').parents('.module').find('.tog-mod').addClass('fa-chevron-up').removeClass('fa-chevron-down');
                    $('.expanded').removeClass('expanded').addClass('collapsed');
                    $('.collapsed').children('li').hide('medium');

                })

        })


        /**************************************************************/
        /* Functions to execute on loading the document               */
        /**************************************************************/
        document.addEventListener('DOMContentLoaded', function () {
            prepareList();
        }, false);
    });


})(jQuery);