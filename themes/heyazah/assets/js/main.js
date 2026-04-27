$(window).scroll(function () {
  if ($(window).scrollTop() >= 70) {
    $("header").addClass("sticky");
  } else {
    $("header").removeClass("sticky");
  }
});
$(document).ready(function () {
    
     var mydir = $("html").attr("dir");

    if (mydir == 'rtl') {
        var isRTL = true
    }
    else {
        var isRTL = false
    }

    var mydirX = $("html").attr("dir");

    if (mydirX == 'rtl') {
        var isRTLX = false
    }
    else {
        var isRTLX = true
    }



  // sidebar
  $(".navbar-toggler").click(function () {
      $(".sidebar").toggleClass("sidebar-width");
      $(".close-overlay").addClass("open-overlay");
      $("body").addClass("overflowHidden");
    
      let delay = 0;
    
      $(".sidebar ul li").each(function () {
        let item = $(this);
        setTimeout(function () {
          item.addClass("show-link");
        }, delay);
    
        delay += 120;
      });
    
      // بعد اللينكات
      setTimeout(function () {
        $(".lang").addClass("show-link");
      }, delay);
    
      delay += 120;
    
      setTimeout(function () {
        $(".langedit").addClass("show-link");
      }, delay);
    
      delay += 120;
    
      setTimeout(function () {
        $(".request").addClass("show-link");
      }, delay);
    });
    
    
    $(".sidebar .close-side, .close-overlay, .sidebar .side-content ul li a").click(function () {
      $(".sidebar").removeClass("sidebar-width");
      $(".close-overlay").removeClass("open-overlay");
      $(".close-overlay").removeClass("open-overlay");
    //   $(".site-search").removeClass("open");
      $("body").removeClass("overflowHidden");
    
      $(".sidebar ul li, .lang, .langedit, .request").removeClass("show-link");
    });

  $(".side-content li").click(function () {
    $(this).siblings().find("ul.sub-menu").slideUp();
    $(this).find("ul.sub-menu").toggle();
  });

  $(".go-to-saqaf").click(function () {
    $("body , html").animate(
      {
        scrollTop: $("#" + $(this).data("scroll")).offset().top,
      },
      1000
    );
  });
  // animation
  wow = new WOW();
  wow.init();

  $(".sidebar .nav-item").click(function () {
    if ($(this).hasClass("active")) {
      $(this).removeClass("active");
    } else {
      $(".sidebar .nav-item").removeClass("active");
      $(this).addClass("active");
    }
  });
  //   -------------------------------------------------
  // Search

  jQuery(".btnSearch").click(function () {
    jQuery(".site-search").addClass("open");
  });

  jQuery(".site-search-close")
    .click(function () {
      jQuery(".site-search").removeClass("open");
    })
    .children()
    .click(function (e) {
      //	return false;
    });

  // home slider
  $(".slider-home").owlCarousel({
    items: 1,
    dots: false,
    dotsData: true,
    animateOut: "fadeOut",
    animateIn: "fadeIn",
    URLhashListener: true,
    startPosition: "URLHash",
    nav: true,
    autoHeight: true,
    video: true,
    navText: [
      "<i class='fal fa-angle-left'></i>",
      "<i class='fal fa-angle-right'></i>",
    ],
    autoplay: false,
    loop: true,
    autoplayTimeout: 7000,
  });
  
  
  // projects slider
  $(".projects-home").owlCarousel({
    items: 1,
    dots: true,
    // animateOut: "animate__zoomOut",
    // animateIn: "animate__zoomIn",
    URLhashListener: true,
    nav: true,
    rtl: isRTL,
    navText: [
      "<i class='fal fa-arrow-left-long'></i>",
      "<i class='fal fa-arrow-right-long'></i>",
    ],
    autoplay: true,
    loop: true,
    autoplayTimeout: 7000,
  });

  $(".card-slider").owlCarousel({
    loop: true,
    margin: 10,
    nav: true,
    rtl: isRTL,
    dots: false,
    navText: [
      "<i class='fal fa-long-arrow-left'></i>",
      "<i class='fal fa-long-arrow-right'></i>",
    ],
    responsive: {
      0: {
        items: 1,
      },
      600: {
        items: 2,
      },
      1000: {
        items: 4,
      },
    },
  });

  $(".projects-slider2").owlCarousel({
    loop: true,
    margin: 25,
    nav: false,
    rtl: isRTL,
    dots: false,
    navText: [
      "<i class='fal fa-long-arrow-left'></i>",
      "<i class='fal fa-long-arrow-right'></i>",
    ],
    responsive: {
      0: {
        items: 1,
      },
      600: {
        items: 2,
      },
      1000: {
        items: 3,
      },
    },
  });

  $(".awards-slider").owlCarousel({
    loop: true,
    margin: 64,
    nav: false,
    rtl: isRTL,
    dots: true,
    navText: [
      "<i class='fal fa-long-arrow-left'></i>",
      "<i class='fal fa-long-arrow-right'></i>",
    ],
    responsive: {
      0: {
        items: 1,
        margin: 10,
      },
      600: {
        items: 2,
        margin: 10,
      },
      1000: {
        items: 3,
        margin: 20,
      },
    },
  });
  

  $(".team-slider").owlCarousel({
    loop: true,
    margin: 25,
    nav: false,
    dots: true,
    rtl: isRTL,
    autoplay: true,
    autoWidth: true,
    centerMode: true,
    navText: [
      "<i class='fal fa-long-arrow-left'></i>",
      "<i class='fal fa-long-arrow-right'></i>",
    ],
    responsive: {
      0: {
        items: 1.5,
      },
      600: {
        items: 1.5,
      },
      1000: {
        items: 2.5,
      },
    },
  });
  // ------------------------------------------
  // silge-project-slider
  $(".silge-project-slider").owlCarousel({
    loop: true,
    margin: 10,
    nav: true,
    dots: false,
    navText: [
      "<i class='fal fa-long-arrow-left'></i>",
      "<i class='fal fa-long-arrow-right'></i>",
    ],
    responsive: {
      0: {
        items: 1,
      },
      600: {
        items: 2,
      },
      1000: {
        items: 3,
      },
    },
  });

  /*********************************************************************** */
  //  to top button
  var mybutton = $("#mybtn");
  $(window).scroll(function () {
    $(window).scrollTop() >= 600 ? mybutton.show() : mybutton.hide();
  });
  mybutton.click(function () {
    $("html,body").animate(
      {
        scrollTop: 0,
      },
      1000
    );
  });
  //    partner slider
  $(".part-slider").owlCarousel({
    loop: true,
    margin: 22,
    nav: false,
    dots: true,
    autoplay: true,
    navText: [
      "<i class='fal fa-long-arrow-left'></i> ",
      " <i class='fal fa-long-arrow-right'></i> ",
    ],
    responsive: {
      0: {
        items: 2,
      },
      600: {
        items: 2,
      },
      1000: {
        items: 6,
      },
    },
  });
  // -------------------------
  // $(".js-range-slider").ionRangeSlider();



  // ------------------------------------------------------------------------------
  //  nice select
  $("select").niceSelect();
  // -------------------------

  // FancyBox
  $('[data-fancybox="gallary"]').fancybox();
  $('[data-fancybox="gallary2"]').fancybox();
  $('[data-fancybox]').fancybox();
  /*********************************************************************** */
  // for upload file
  $(document).on("change", ":file", function () {
    var input = $(this),
      numFiles = input.get(0).files ? input.get(0).files.length : 1,
      label = input.val().replace(/\\/g, "/").replace(/.*\//, "");
    input.trigger("fileselect", [numFiles, label]);
  });
  $(":file").on("fileselect", function (event, numFiles, label) {
    var input = $(this).parents(".input-group").find(":text"),
      log = numFiles > 1 ? numFiles + " files selected" : label;
    if (input.length) {
      input.val(log);
    } else {
      //            if (log) alert(log);
    }
  });
  $(".form-control").focus(function () {
    $(this).parents(".form-group").addClass("focused");
  });
  $(".form-control").blur(function () {
    var inputValue = $(this).val();
    if (inputValue == "") {
      $(this).removeClass("filled");
      $(this).parents(".form-group").removeClass("focused");
    } else {
      $(this).addClass("filled");
    }
  });
  $(document).on("change", ".btn-file :file", function () {
    var fileName = $("#uploadfile").val();
    $(".filename").val(fileName);
  });

  // counter odemeter
  $(".counter-item").each(function () {
    $(this).isInViewport(function (status) {
      if (status === "entered") {
        for (
          var i = 0;
          i < document.querySelectorAll(".odometer").length;
          i++
        ) {
          var el = document.querySelectorAll(".odometer")[i];
          el.innerHTML = el.getAttribute("data-odometer-final");
        }
      }
    });
  });
});
/*********************************************************************** */
