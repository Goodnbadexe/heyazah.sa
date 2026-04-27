<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <title>عفواً تم إغلاق الموقع</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta charset="utf-8">
    <meta name="author" content="Amir Nageh">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Css Files -->
    <link href="https://fonts.googleapis.com/css?family=Cairo:200,300,400,600,700,900&display=swap" rel="stylesheet">
    <!--    <link href="http://sayed.azq1.com/law/suspend/css/style-en.css" rel="stylesheet">-->
    <!--    <link href="http://sayed.azq1.com/law/suspend/css/style-res.css" rel="stylesheet">-->
    <style>
    @charset "utf-8";
    /* **************** */
    @import "http://sayed.azq1.com/law/suspend/css/fonts.css";
    @import "https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css";
    @import "https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap-grid.min.css";
    @import "https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css";
    @import "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css";

    /* ****************** */
    .owl-carousel {
        direction: ltr;
    }

    * {
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        text-transform: capitalize;
        font-family: 'Cairo', sans-serif;
        color: #1a1a1a;
        font-size: 14px;
    }

    .tooltip {
        z-index: 1100 !important;
    }

    .tooltip-inner {
        max-width: 200px;
        padding: 5px 10px;
        color: #fff;
        text-align: center;
        background-color: #121212;
        border-radius: 0.25rem;
        font-size: 11px;
        text-transform: uppercase;
        font-weight: 500;
    }

    .tooltip .tooltip-arrow {
        display: none;
    }

    .tooltip.top {
        padding: 5px 0;
    }

    body {
        padding: 0;
        margin: 0;
    }

    select {
        display: inline-block;
    }

    html,
    body,
    div,
    span,
    object,
    iframe,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    p,
    blockquote,
    pre,
    abbr,
    address,
    cite,
    code,
    del,
    dfn,
    em,
    img,
    ins,
    kbd,
    q,
    samp,
    small,
    strong,
    sub,
    sup,
    var,
    b,
    i,
    dl,
    dt,
    dd,
    ol,
    ul,
    li,
    fieldset,
    form,
    label,
    legend,
    table,
    caption,
    tbody,
    tfoot,
    thead,
    tr,
    th,
    td,
    article,
    aside,
    canvas,
    details,
    figcaption,
    figure,
    footer,
    header,
    hgroup,
    menu,
    nav,
    section,
    summary,
    time,
    mark,
    audio,
    video {
        margin: 0;
        padding: 0;
        border: 0;
        outline: 0;
        vertical-align: middle;
        background: transparent;
    }

    article,
    aside,
    details,
    figcaption,
    figure,
    footer,
    header,
    hgroup,
    menu,
    nav,
    section {
        display: block;
    }

    nav ul {
        list-style: none;
    }

    ul {
        list-style: none;
    }

    iframe {
        width: 100% !important;
        border: 0 !important;
        height: 100%;
    }

    ::-moz-selection {
        background-color: #1e5fcc;
        color: #fff;
    }

    ::selection {
        background-color: #1e5fcc;
        color: #fff;
    }

    a,
    a:hover,
    a:visited,
    a:link {
        text-decoration: none;
        outline: none;
        cursor: pointer;
    }

    a {
        display: inline-block;
    }

    table {
        border-collapse: collapse;
        border-spacing: 0;
    }

    img {
        vertical-align: middle;
        border-style: none;
        max-width: 100%;
    }

    p {
        line-height: 1.5;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        font-family: inherit;
        font-weight: normal;
        line-height: 1.3;
    }

    .modal-open {
        overflow: hidden !important;
    }

    .modal-backdrop.in {
        opacity: .9;
    }

    input,
    select,
    textarea {
        vertical-align: middle;
        margin: 0;
        padding: 0;
        outline: 0;
    }

    textarea {
        resize: none;
    }

    .form-control {
        height: 38px;
        line-height: 38px;
        padding-left: 10px;
        font-size: 13px;
        box-sizing: border-box;
        border-radius: 4px;
        box-shadow: none;
        text-transform: none;
        border: 1px solid #dfdfdf;
        margin-bottom: 0;
    }

    /* textarea.form-control {
     height: 100px !important;
}
 */
    .form-group,
    .form-control {
        margin-bottom: 0;
    }

    .btn {
        outline: 0;
    }

    .row {
        margin-bottom: 0;
    }

    .col-xs-12 {
        padding: 0;
        float: left;
        width: 100%;
    }

    i {
        color: inherit;
        font-style: normal;
    }

    .toTop {
        background-color: #ff605b;
        color: #fff;
        position: fixed;
        bottom: 75px;
        right: -60px;
        width: 40px;
        height: 40px;
        cursor: pointer;
        line-height: 40px;
        border-radius: 100%;
        text-align: center;
        z-index: 35;
        -webkit-transition: all .3s;
        transition: all .3s;
        -webkit-box-shadow: 0 0 15px 5px rgba(254, 95, 90, 0.22);
        box-shadow: 0 0 15px 5px rgba(254, 95, 90, 0.22);
    }

    .toTop:hover {
        background-color: #303030;
        -webkit-transition: all .5s;
        transition: all .5s;
    }

    .toTop i {
        font-size: 18px;
        -webkit-transition: all .5s;
        transition: all .5s;
        color: #fff;
    }

    #loading {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 999999;
        background-color: #fff;
        display: none;
    }

    .loading {
        position: absolute;
        top: 50%;
        left: 50%;
        margin: 0;
        padding: 0;
        list-style: none;
        -moz-transform: translateX(-50%) translateY(-50%);
        -webkit-transform: translateX(-50%) translateY(-50%);
        transform: translateX(-50%) translateY(-50%);
    }

    button {
        outline: 0 !important;
    }

    .wrapper,
    .inner-wrap {
        position: relative;
        overflow: hidden;
    }

    .wrapper:after {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        background-image: url(http://sayed.azq1.com/law/suspend/images/toright.png);
        width: 125px;
        height: 153px;
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
    }

    .wrapper:before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        background-image: url(http://sayed.azq1.com/law/suspend/images/toleft.png);
        width: 110px;
        height: 168px;
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
    }

    .inner-wrap:after {
        content: '';
        position: absolute;
        bottom: 0;
        right: 0;
        background-image: url(http://sayed.azq1.com/law/suspend/images/boright.png);
        width: 124px;
        height: 296px;
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
    }

    .inner-wrap:before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        background-image: url(http://sayed.azq1.com/law/suspend/images/boleft.png);
        width: 83px;
        height: 79px;
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
    }

    .inner-wrap {
        width: 100%;
        height: 100%;
        padding: 100px 70px;
    }

    .tocenter {
        position: absolute;
        left: 50%;
        top: 0;
        transform: translateX(-50%);
    }

    .r-right {
        float: right;
    }

    .r-right .logo {
        margin-bottom: 40px;
    }

    .r-right .logo img {}

    .r-right .r-data {}

    .r-right .r-data h3 {
        color: #fc5e3e;
        font-family: 'Cairo', sans-serif;
        font-weight: 700;
        font-size: 35px;
        margin-bottom: 30px;
    }

    .r-right .r-data p {
        color: #000;
        font-size: 27px;
        margin-bottom: 20px;
    }

    .r-right .r-data ul {
        position: relative;
    }

    .r-right .r-data ul:after {
        content: '';
        position: absolute;
        border-right: 1px dashed #fc5e3e;
        height: 81%;
        top: 9px;
        right: 7px;
    }

    .r-right .r-data ul li {
        position: relative;
        margin-bottom: 20px;
        padding-right: 25px;
        font-size: 14px;
        font-family: 'Cairo', sans-serif;
        color: #000;
    }

    .r-right .r-data ul li:before {
        content: '';
        position: absolute;
        width: 15px;
        height: 15px;
        background-color: #fc5e3e;
        border-radius: 100%;
        right: 0;
        top: 2px;
        z-index: 1;
        animation: fa-spin 5s infinite;
        border: 1px dashed #fefefe;
    }

    .l-left {
        float: left;
        text-align: center;
        position: relative;
        margin-top: 10%;
    }

    .l-left .rocket {
        max-width: 84%;
        animation: 50s;
    }

    .l-left .b-star {
        position: absolute;
        left: -25px;
        animation: fa-spin 5s infinite reverse;
    }

    .l-left .star1 {
        left: 30px;
        bottom: 140px;
        animation: fa-spin 5s infinite;
    }

    .l-left .star2 {
        right: 150px;
        top: 58px;
        width: 18px;
        animation: fa-spin 15s infinite reverse;
    }

    .l-left .star3 {
        right: 50px;
        bottom: 50px;
        animation: fa-spin 20s infinite;
    }

    .l-left .r-star {
        position: absolute;
        right: 0;
        top: 40px;
        animation: fa-spin 5s infinite reverse;
    }

    .l-left .y-star {
        position: absolute;
        top: 0;
        right: 150px;
        animation: fa-spin 5s infinite;
    }

    .l-left .g-circle {
        position: absolute;
        bottom: 50px;
        left: 50px;
        animation: bounce 20s infinite;
    }

    .l-left .r-circle {
        position: absolute;
        right: 95px;
        top: 90px;
        animation: bounce 15s infinite;
    }

    .l-left .zeg {
        position: absolute;
        left: 20px;
        z-index: -1;
        top: -50px;
        animation: pulse 10s infinite;
    }

    .r-bottom {
        margin-top: 60px;
        border-top: 1px solid #dfdfdf;
        padding-top: 50px;
    }

    .r-bottom .bot-r {
        float: right;
    }

    .r-bottom .bot-r img {
        float: right;
        width: 100px;
        margin-left: 30px;
    }

    .r-bottom .bot-r .bot-data {
        overflow: hidden;
        padding-top: 25px;
    }

    .r-bottom .bot-r .bot-data p {
        margin-bottom: 15px;
        font-family: 'Cairo', sans-serif;
        font-weight: 700;
        color: #7b7b7b;
        text-transform: uppercase;
    }

    .r-bottom .bot-l {}

    .r-bottom .bot-l h3 {
        font-family: 'Cairo', sans-serif;
        font-weight: 700;
        margin-bottom: 30px;
    }

    .r-bottom .bot-l h3 i {
        transform: rotateY(180deg);
        margin-left: 10px;
        position: relative;
        top: -4px;
    }

    .r-bottom .bot-l ul {}

    .r-bottom .bot-l ul li {
        float: right;
        width: 49%;
        margin-bottom: 10px;
    }

    .r-bottom .bot-l ul li a {
        color: #000;
        font-family: 'Cairo', sans-serif;
        transition: all .3s;
        font-weight: 700;
        font-size: 12px;
    }

    .r-bottom .bot-l ul li:hover,
    .r-bottom .bot-l ul li:hover a {
        color: #fc5e3e;
        transition: all .3s;
    }

    .r-bottom .bot-l ul li i {
        width: 30px;
        height: 30px;
        background-color: #ffedea;
        border-radius: 100%;
        text-align: center;
        line-height: 28px;
        color: #fd4621;
        font-size: 16px;
        margin-left: 10px;
        vertical-align: baseline;
        transition: all .3s;
    }

    .r-bottom .bot-l ul li:hover i {
        background-color: #fc5e3e;
        color: #fff;
        transition: all .3s;
    }


    @media(max-width:1024px) {
        .wrapper {
            height: 100% !important;
        }
    }

    @media(max-width:991px) {

        .r-right .r-data h3 {
            font-size: 27px;
        }

        .r-right .r-data p {
            font-size: 21px;
        }

        .container {
            width: 100%;
        }

        .inner-wrap {
            padding: 100px 20px;
        }
    }

    @media(max-width:768px) {
        .r-bottom .bot-r img {
            width: 75px;
            margin-left: 20px;
        }

        .r-bottom .bot-r .bot-data {
            padding-top: 15px;
        }

        .r-bottom .bot-r .bot-data p {
            font-size: 13px;
        }

        .r-bottom .bot-l {
            max-width: 50%;
        }

        .l-left .b-star {
            position: absolute;
            left: -4%;
            animation: fa-spin 5s infinite reverse;
        }

        .l-left .star1 {
            left: 30px;
            bottom: 140px;
            animation: fa-spin 5s infinite;
        }

        .l-left .star2 {
            right: 23%;
            top: 19%;
            width: 18px;
            animation: fa-spin 15s infinite reverse;
        }

        .l-left .star3 {
            right: 4%;
            bottom: 50px;
            animation: fa-spin 20s infinite;
        }

        .l-left .r-star {
            position: absolute;
            right: 6%;
            top: -4%;
            animation: fa-spin 5s infinite reverse;
        }

        .l-left .y-star {
            position: absolute;
            top: 0;
            right: 32%;
            animation: fa-spin 5s infinite;
        }

        .l-left .g-circle {
            position: absolute;
            bottom: 50px;
            left: 10%;
            animation: bounce 20s infinite;
        }

        .l-left .r-circle {
            position: absolute;
            right: 14%;
            top: 90px;
            animation: bounce 15s infinite;
        }

        .l-left .zeg {
            position: absolute;
            left: 10%;
            z-index: -1;
            top: -21%;
            animation: none;
            max-width: 100px;
        }

        .r-right .logo {
            margin-bottom: 20px;
            max-width: 45%;
        }

        .tocenter {
            position: absolute;
            left: 50%;
            top: 0;
            transform: translateX(-50%);
            max-width: 45%;
        }
    }


    @media(max-width:425px) {

        .wrapper:after,
        .inner-wrap:after {
            right: -10%;
        }

        .wrapper:before,
        .inner-wrap:before {
            left: -10%;
        }

        .r-bottom .bot-l {
            max-width: 100%;
            margin-bottom: 30px;
        }

        .r-bottom .bot-r {
            text-align: center;
        }

        .r-bottom .bot-r img {
            float: none;
            margin: 0;
        }

        .l-left {
            margin-top: 20%;
        }

        .r-bottom .bot-l ul li {
            width: 100%;
        }

        .what-icon {
            top: 3%;
            left: 4%;
        }



    }

    .what-icon {
        width: 40px;
        height: 40px;
        text-align: center;
        line-height: 40px;
        color: #fff;
        border-radius: 100%;
        background-color: #25D366;
        font-size: 20px;
        position: fixed;
        top: 10%;
        left: 2%;
        box-shadow: 0 0 0 7px #fff;
        transition: all .3s;
    }

    .what-icon:focus,
    .what-icon:hover {
        color: #fff;
        background-color: #2cca67;
        transition: all .3s;
    }

    .what-icon:before {
        content: "";
        position: absolute;
        border: #25D366 solid 2px;
        border-radius: 100%;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        -webkit-animation-duration: 1.5s;
        animation-duration: 1.5s;
        animation-fill-mode: forwards;
        -webkit-animation: ripple-out 1s infinite;
        animation: ripple-out 1s infinite;
    }


    /* Ripple Out */

    @keyframes ripple-out {
        100% {
            top: -15px;
            right: -15px;
            bottom: -15px;
            left: -15px;
            opacity: 0;
        }
    }

    @-webkit-keyframes ripple-out {
        100% {
            top: -15px;
            right: -15px;
            bottom: -15px;
            left: -15px;
            opacity: 0;
        }
    }
    </style>
    <!-- Favicons -->
    <link rel="shortcut icon" href="http://sayed.azq1.com/law/suspend/images/favicon.png">

</head>

<body>

    <div id="loading">
        <div class="loading"></div>
    </div>

    <div class="wrapper">
        <img src="http://sayed.azq1.com/law/suspend/images/tocenter.png" class="tocenter">
        <div class="inner-wrap">
            <div class="container wow jello" data-wow-duration="1s">
                <div class="r-right col-md-5 col-xs-12 wow fadeInRight" data-wow-duration="2s">
                    <div class="logo">
                        <img src="http://sayed.azq1.com/law/suspend/images/ryad-logo.png" alt="">
                    </div>
                    <div class="r-data">
                        <h3>عفواً تم إغلاق الموقع</h3>
                        <p>لأحد الأسباب التالية</p>
                        <ul>
                            <li>عدم سداد المستحقات</li>
                            <li>صيانة الموقع</li>
                            <li>تحديثات دورية</li>
                        </ul>
                    </div>
                </div>
                <div class="l-left col-md-6 col-xs-12 wow fadeInLeft" data-wow-duration="2s">
                    <img src="http://sayed.azq1.com/law/suspend/images/one.png" alt="" class="rocket">
                    <img src="http://sayed.azq1.com/law/suspend/images/b-star.png" class="b-star">
                    <img src="http://sayed.azq1.com/law/suspend/images/b-star.png" class="b-star star1">
                    <img src="http://sayed.azq1.com/law/suspend/images/b-star.png" class="b-star star2">
                    <img src="http://sayed.azq1.com/law/suspend/images/b-star.png" class="b-star star3">
                    <img src="http://sayed.azq1.com/law/suspend/images/r-star.png" class="r-star">
                    <img src="http://sayed.azq1.com/law/suspend/images/y-star.png" class="y-star">
                    <img src="http://sayed.azq1.com/law/suspend/images/g-circle.png" class="g-circle">
                    <img src="http://sayed.azq1.com/law/suspend/images/r-circle.png" class="r-circle">
                    <img src="http://sayed.azq1.com/law/suspend/images/zeg.png" class="zeg">
                </div>
                <div class="r-bottom col-md-12 col-xs-12">
                    <div class="bot-l col-md-5 col-xs-12 wow fadeInUp" data-wow-duration="2s">
                        <h3>
                            <i class="fa fa-phone"></i>
                            للتواصل معنا
                        </h3>
                        <ul>
                            <li>
                                <a href="tel:0548215160">
                                    <i class="fa fa-mobile"></i>
                                    0548215160
                                </a>
                            </li>
                            <li>
                                <a href="mailto:sales@elryad.com">
                                    <i class="fa fa-envelope"></i>
                                    sales@elryad.com
                                </a>
                            </li>
                            <li class="comp-name">
                                <i class="fa fa-globe"></i>
                                <a href="https://elryad.com/ar/" title="تصميم مواقع" alt="تصميم مواقع"
                                    target="_blank">الرياض </a>
                                <a href="https://elryad.com/ar/" title="تصميم مواقع" alt="تصميم مواقع"
                                    target="_blank">لـ </a>
                                <a href="https://elryad.com/ar/" title="تصميم مواقع" alt="تصميم مواقع"
                                    target="_blank">تصميم مواقع </a> /
                                <a href="https://elryad.com/ar/برمجة-تطبيقات-الجوال/" title="تطبيقات" alt="تطبيقات"
                                    target="_blank">تطبيقات</a>
                            </li>
                        </ul>
                    </div>
                    <div class="bot-r col-md-5 col-xs-12 wow fadeInUp" data-wow-duration="2s">
                        <img src="http://sayed.azq1.com/law/suspend/images/ryad-logo.png" alt="">
                        <div class="bot-data">
                            <p>thank you from our heart</p>
                            <p>شــكـــــراً مـــــن قلـــــوبنا</p>
                        </div>
                    </div>

                </div>
            </div>
            <a href="https://api.whatsapp.com/send?l=ar&phone=966548215160" class="what-icon">
                <i class="fa fa-whatsapp"></i>
            </a>
        </div>
    </div>

    <!-- Javascript Files -->
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-smooth-scroll/1.4.11/jquery.smooth-scroll.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/smooth-scroll/5.3.3/js/smooth-scroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <!--    <script src="js/script.js"></script>-->
    <script>
    /*global $,owl,smoothScroll,WOW,NProgress*/
    $(document).ready(function() {
        "use strict";

        $(window).load(function() {
            $("body").css('overflow-y', 'auto');
            $('#loading').fadeOut(1000);
        });

        //for smoth scroll
        smoothScroll.init({
            speed: 1000,
            updateURL: false,
            offset: 15
        });

        var wow = new WOW({
            boxClass: 'wow', // animated element css class (default is wow)
            animateClass: 'animated', // animation css class (default is animated)
            mobile: true, // trigger animations on mobile devices (default is true)
            live: true,
            offset: 0,
            scrollContainer: null // optional scroll container selector, otherwise use window
        });
        wow.init();

        //   $('.wrapper').height(window.innerHeight);
    });
    </script>

</body>

</html>