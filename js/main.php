<script type="text/javascript">
  jQuery(document).ready(function($) {

    $(".scroll").click(function(event) {

        $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1000);
    });
    $("a[rel^='prettyPhoto']").prettyPhoto({theme: 'facebook', slideshow: 5000, autoplay_slideshow: false});


    $(".scroll").click(function(event) {
        event.preventDefault();
        $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1000);
    });

    /*
     var defaults = {
     containerID: 'toTop', // fading element id
     containerHoverID: 'toTopHover', // fading element hover id
     scrollSpeed: 1200,
     easingType: 'linear' 
     };
     */
    $().UItoTop({easingType: 'easeOutQuart'});

//for xs- view
    $('#skey').keyup(function() {

        ajaxLoaderImage = '<img src="includes/ajax-loader.gif" alt="">';
        $('#ajaxSearch').html(ajaxLoaderImage).fadeIn(400);

        setTimeout(function() {
            skey = $('#skey').val();
            if (skey != '')
            {
                $.post("includes/search_ajax.php", {key: skey}, function(data, status) {
                    if (status === 'success')
                    {
                        $('#ajaxSearch').html(data);
                    }
                    else
                        $('#ajaxSearch').fadeOut(400);
                });

            }
            else
            {
                $('#ajaxSearch').fadeOut(400);
            }
        }, 100);

    });

    $('#skey').change(function() {
        $('#ajaxSearch').fadeOut(400);
    });

//for large views

    $('#skey1').keyup(function() {

        ajaxLoaderImage = '<img src="includes/ajax-loader.gif" alt="">';
        $('#ajaxSearch1').html(ajaxLoaderImage).fadeIn(400);

        setTimeout(function() {
            skey = $('#skey1').val();
            if (skey != '')
            {
                $.post("includes/search_ajax.php", {key: skey}, function(data, status) {
                    if (status === 'success')
                    {
                        $('#ajaxSearch1').html(data);
                    }
                    else
                        $('#ajaxSearch1').fadeOut(400);
                });

            }
            else
            {
                $('#ajaxSearch1').fadeOut(400);
            }
        }, 100);

    });

    $('#skey1').change(function() {
        $('#ajaxSearch1').fadeOut(400);
    });


    
    var imageAvailable = '<?php echo $pageImage; ?>';
    var linkType = '<?php echo $pageLinkType; ?>'; 
    //scroll down
    var pathname = window.location.pathname;
    var uri = pathname.split("/");
    uri.reverse();

    var top = $("body").scrollTop();

    if (uri[0] !== 'home' && uri[0] !== 'index' && uri[0] !== '' && imageAvailable !== "" && (linkType == "Normal Group" || linkType == "Contents Page"))
    {
//    window.scrollTo(0, 0);
        $("body").animate({scrollTop: 600}, 1500);

    }


    // for the serarch div

    var searchState = true;
    $('.search-control').css('background', 'url(img/search.png) no-repeat center');
    $('#searchControl').on('click', function(evt) {
        evt.stopPropagation();
        if (searchState) {
            $('#searchDiv').slideDown(300);
            searchState = false;
            $(this).css('background', 'url(img/cross.png) no-repeat center');
            $(this).addClass('search-rotation');
            setTimeout(function() {
                $('#searchControl').removeClass('search-rotation');
            }, 1000);
        } else {
            $('#searchDiv').slideUp(300);
            searchState = true;
            $(this).css('background', 'url(img/search.png) no-repeat center');
            $(this).addClass('search-rotation2');
            setTimeout(function() {
                $('#searchControl').removeClass('search-rotation2');
            }, 1000);
        }
        //              $('body').on('click',function(){
        //                  $('#searchDiv').slideUp();
        //                  searchState = true;
        //              }); 
    });



});


// $(window).load(function(){
////     $(window).scrollTop(300);
//     $(window).on('scroll resize',function(){
//        var windowpos = $(window).scrollTop();
//        var navtop = $('#navigation').offset().top;
//        console.log(navtop);
//       if(windowpos >= navtop){
//           console.log(windowpos+'----fixed')
//       }else{
//                console.log(windowpos+'----notfixed')
//           }
//               
//        
//    });
//
// });

$(window).load(function() {
    $(window).on('scroll', function() {

        var hnwHeight = $('#hnw').height();
        var winWidth = $(window).width();

        $(window).resize(function() {
            var winWidth = $(window).width();
            var hnwHeight = $('#hnw').height();
        });


        if (winWidth > 767) {

            if ($(window).scrollTop() > 50) {
                
                $('#hnw').css({'position': 'fixed', 'top': '0px', 'z-index': '1', 'margin': '0 auto', 'width': '100%'});
               
                $('#hnw').stop().animate({'paddingTop': '0'},200);
                $(".logo_search").css({'padding': '5px'});
                
            } else if ($(window).scrollTop() < 50) {
                
                $('#hnw').stop().animate({'paddingTop': '10'},200);
                $(".logo_search").css({'padding': '13px 0 23px'});
                
            }
            
            $('#top-balance').css({'margin-top': hnwHeight});
            
            
        } else {
            $('#hnw').css({'position': 'relative', 'z-index': 'initial', 'margin': '0 auto', 'padding-top': '0px'});
            $('#top-balance').css({'margin-top': 0});
        }

    });




    //Photo Galley Plugin-Fancy Box


    $('.cmsGallery').fancybox({
        closeBtn: false,
        helpers: {
            title: {
                type: 'inside'
            },
            buttons: {},
            thumbs: {
                width: 100

            }
        },
        afterLoad: function() {
            this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
        }
    });





    //Video Gallery Plugin-Fancy Box
    $('.cmsVideo')
            .attr('rel', 'media-gallery')
            .fancybox({
        openEffect: 'none',
        closeEffect: 'none',
        prevEffect: 'none',
        nextEffect: 'none',
        arrows: false,
        helpers: {
            media: {},
            buttons: {},
            thumbs: {
                height: 130,
                width: 130
            }
        }
    });
    // for the serarch div


    $('#slidelist').carouFredSel({
        responsive: true,
        auto: false,
        prev: '#prev',
        next: '#next',
        mousewheel: false,
        swipe: {
            onMouse: false,
            onTouch: true
        },
        items: {
            visible: {
                min: 1,
                max: 2
            }

        },
        scroll: {
            duration: 800,
            pauseOnHover: true
        }

    });


    /* for inquiry form*/


    $('#inquiry').validate({
        rules: {
            name: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            comments: {
                required: true
            },
            security_code: {
                required: true
            }
        }, //end rules

        messages: {
            name: {
                required: "Please type your name."

            },
            comments: {
                required: "Please type your message."

            },
            email: {
                required: "Please supply an e-mail address.",
                email: "This is not a valid email address."
            },
            security_code: {
                required: "Please enter the security code text"
            }

        },
        errorPlacement: function(error, element) {
            if (element.is(":radio") || element.is(":checkbox")) {
                error.appendTo(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    });
    // end validate 
    
    /////Navigation Changed Script/////
    
    
    
    
    $(".dropdownWrap .rhssection .innerNavs .right_banner ul li").hover(function() {
      $(this).prevnetDefault();
    }, function() {
      $(this).preventDefault();
    });
    
    $(".menu > ul > li").hover(function() {
        $(".dropdownWrap").hide();  
        $(".dropdownWrap .rhssection .innerNavs .childNavs").hide();
        $(".navigation  ul  li").removeClass("nextlinav");
        
        if ($(this).hasClass("last")) {
            $(this).addClass("lastselected");
        } else {
            if (!($(this).hasClass("select"))) {
                $(this).next("li").addClass("nextlinav");
                $(this).addClass("active")
            }
        }
        
        $(this).find(".dropdownWrap").slideDown();
        $(".dropdownWrap .rhssection .innerNavs").eq(0).find(".childNavs").eq(0).show();
        var _lhsheight = $(this).find(".lhssection").outerHeight();
        $(this).find(".rhssection").css("min-Height", _lhsheight);
        $(this).find(".rhssection").children(".innerNavs").css("min-Height", _lhsheight);
        $("#overlay").hide();
        if ($(this).find(".dropdownWrap").is(":visible")) {
            $("#overlay").show()
        }
    }, function() {
        $(this).removeClass("active");
        $(this).removeClass("lastselected");
        $(".navigation  ul  li").removeClass("nextlinav");

        $(".dropdownWrap .lhssection ul li").removeClass("active");
        $(".dropdownWrap .rhssection .innerNavs").hide();
        $(".dropdownWrap .rhssection .innerNavs .childNavs").hide();
        $(".dropdownWrap .rhssection").each(function() {
            $(this).find(".innerNavs").eq(0).show()
            $(this).find(".innerNavs").eq(0).find(".childNavs").eq(0).show();
            $(this).find(".innerNavs").eq(0).find('ul').eq(0).find('li').eq(0).addClass('active');
        });
        $(".dropdownWrap .lhssection").each(function() {
            $(this).find("li").eq(0).addClass("active")
        });
        $(this).find(".dropdownWrap").hide();
//        $("#overlay").hide()
    });
    
    $(".dropdownWrap .lhssection ul li").hover(function() {
        var _index = $(this).index();
        $(this).addClass("active").siblings("li").removeClass("active");
        _rhsnav = $(this).parents(".lhssection").next(".rhssection").find(".innerNavs");
        _rhschildnav = $(this).parents(".lhssection").next(".rhssection").find(".innerNavs").find(".childNavs");
        _rhsnav.css({
            "width": 0
        });
        _rhschildnav.css({
            "width": 0
        });
        _rhsnav.hide();
        _rhschildnav.hide();
        _rhsnav.eq(_index).show();
        _rhschildnav.eq(0).show();
        
        _rhsnav.eq(_index).animate({
            "width": "380px"
        });
        _rhschildnav.eq(0).animate({
            "width": "200px"
        });
    }, function() {
        $(this).removeClass("active");
        
        _rhsnav.eq(0).css({
            "width": "380px"
        })
        _rhschildnav.eq(0).css({
            "width": "200px"
        })
    });
    
    $(".dropdownWrap .rhssection").hover(function() {
        var _rhsindex = $(this).find(".innerNavs:visible").index();
        $(this).prev(".lhssection").find("li").eq(_rhsindex).addClass("active")
    })
    
    $(".dropdownWrap .rhssection .innerNavs .innerNavContainer ul li").hover(function() {
        var _index = $(this).index();
        $(this).addClass("active").siblings("li").removeClass("active");
        _rhschildnav = $(this).parents(".innerNavs").find(".childNavs");
        
        _rhschildnav.css({
            "width": 0
        });
        
        _rhschildnav.hide();
        
        _rhschildnav.eq(_index).show();
        
        _rhschildnav.eq(_index).animate({
            "width": "200px"
        });        
    }, function() {
        $(this).removeClass("active");
        
        _rhschildnav.eq(0).css({
            "width": "200px"
        })
    });
    
     $(".dropdownWrap .rhssection .right_banner").hover(function() {
        var _rhsindex = $(this).find(".childNavs:visible").index();
        $(this).prev("ul").find("li").eq(_rhsindex).addClass("active")
    })
});

$(window).load(function(){
  $(".menu > ul > li .dropdownWrap").each(function(){
    $(this).find(".lhssection").find("li").eq(0).addClass("active");
    $(this).find(".innerNavs").eq(0).show();
    $(this).find(".innerNavs").eq(0).find('ul').eq(0).find('li').eq(0).addClass('active');
  })
})
</script>
