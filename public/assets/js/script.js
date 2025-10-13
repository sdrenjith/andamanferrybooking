$('#packageCardSlider').owlCarousel({

    loop: true,
    margin: 20,
    responsiveClass: true,
    navigator: true,
    responsive: {

        1400: {
            items: 4,
            nav: true,
        },
        1010: {
            items: 3,
            nav: true,
        },
        1000: {
            items: 2,
            nav: true,

        },
        600: {
            items: 2,
            nav: true
        },
        0: {
            items: 1,
            nav: true
        },

    }
})

$('#ferryCardSlider').owlCarousel({

    loop: true,
    margin: 20,
    responsiveClass: true,
    navigator: true,
    responsive: {


        1000: {
            items: 3,
            nav: true,

        },
        600: {
            items: 2,
            nav: true
        },
        500: {
            items: 2,
            nav: true
        },

        0: {
            items: 1,
            nav: true
        },

    }
})


$('#boatCardSlider').owlCarousel({

    loop: true,
    margin: 20,
    responsiveClass: true,
    navigator: true,
    responsive: {


        1000: {
            items: 2,
            nav: true,

        },
        600: {
            items: 2,
            nav: true
        },
        0: {
            items: 1,
            nav: true
        },

    }
})

$('#topDestinations').owlCarousel({

    loop: true,
    margin: 20,
    responsiveClass: true,
    navigator: true,
    responsive: {


        1000: {
            items: 5,
            nav: true,

        },
        600: {
            items: 3,
            nav: true
        },
        500: {
            items: 2,
            nav: true
        },
        467: {
            items: 2,
            nav: true
        },
        0: {
            items: 1,
            nav: true
        }

    }
})
$('#collabFerry').owlCarousel({

    loop: true,
    margin: 20,
    responsiveClass: true,
    navigator: true,
    responsive: {


        1000: {
            items: 5,
            nav: true,

        },
        600: {
            items: 3,
            nav: true
        },
        500: {
            items: 2,
            nav: true
        },
        467: {
            items: 2,
            nav: true
        },
        0: {
            items: 1,
            nav: true
        }

    }
})
$('#blogs').owlCarousel({

    loop: true,
    margin: 20,
    responsiveClass: true,
    navigator: true,
    responsive: {


        1000: {
            items: 4,
            nav: true,

        },
        600: {
            items: 2,
            nav: true
        },

        500: {
            items: 2,
            nav: true
        },
        450: {
            items: 2,
            nav: true

        },
        0: {
            items: 1,
            nav: true
        },

    }
})



$(".menuBtn").click(function () {
    $(".navbar-toggler").removeClass("show");
    $(".overlay").css('display', 'none');
    $("body").css({ 'overflow-x': 'hidden', 'overflow-y': 'visible' });
    $("#navbarNav").removeClass('show');

});

$(".navbar-toggler").click(function () {
    $(this).toggleClass("show");
    if ($(".navbar-toggler").hasClass("show")) {
        $(".overlay").css('display', 'block');
        $("body").css('overflow-y', 'hidden');
        $("#navbarNav").addClass('show');
    }
    else {
        $(".overlay").css('display', 'none');
        $("body").css({ 'overflow-x': 'hidden', 'overflow-y': 'visible' });
        $("#navbarNav").removeClass('show');
    }
});


$(".tabBtn1").addClass("active");
$(".tabs1").css({"opacity": "1" ,  "height" : "auto"});
$(".tabs2").css({"height": "0px" , "overflow" : "hidden"});
$(".tabBtn").click(function () {
    $(this).siblings().removeClass("active");
    $(this).addClass("active");

    var bannerTab = $(".tabBtn.active").data("list");

    $(".tabs").css({ "opacity": "0", "z-index": "-1" , "height": "0px" , "overflow" : "hidden" });
    $(".tabs" + bannerTab + " ").css({ "opacity": "1", "z-index": "5" , "height" : "auto" , "overflow" : "auto"});
});

if ($.fn.datepicker) {
    $(".my_date_picker").datepicker({
        dateFormat: 'dd-mm-yy',
        defaultDate: "today"
    });
}


