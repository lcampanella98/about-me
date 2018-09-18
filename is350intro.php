<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
$CONF = require('config.php');



?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content"width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>About Me</title>
    <link rel="stylesheet" href="./assets/lib/bootstrap/bootstrap.css" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

    <script type="text/javascript" src="./assets/lib/jquery.min.js"></script>
    <script src="./assets/lib/popper/popper.js"></script>
    <script type="text/javascript" src="./assets/lib/bootstrap/bootstrap.js"></script>

    <style>
        body {
            font-family: 'Open Sans', sans-serif;
        }
        .bg-img {
            position: fixed;
            background-position: center;
            -webkit-background-size: cover;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: -1;

        }
        .blurred-img {
            opacity: 0.0;
        }
        .page-container {
            position: relative;
        }
        #main-nav {
            position: fixed;
            top: 0;
            left: 0;
            width:100%;
            z-index: 1;
        }
        #main-nav .nav-link {
            color: #543958
        }
        #main-nav .nav-link.active {
            color: white;
            background-color: #543958
        }

        .slide {
            background-color: rgba(0,0,0,0.3);
            margin-bottom: 600px;
            color: white;
            padding: 20px;
            font-size: 1.5em;
        }
        .slide p {
            margin-bottom: 0;
        }
        .slide h1,h2,h3,h4,h5,h6 {
            text-align: center;
        }
        .title-slide {
            text-align:center;
            margin-top: 0;

        }
        .title-slide p {
            font-size: 2em;
        }
        .project-heading {
            text-align:center;
        }
        .project-link {
            color: white;
            text-decoration: none;
        }
        .project-link:hover {
            text-decoration: none;
            color: #82398e
        }



    </style>
</head>
<body>
<div class="bg-img-container">
    <div class="bg-img" style="background-image:url('./assets/img/me_in_newark.jpeg')">
    </div>
    <div class="bg-img blurred-img" style="background-image:url('./assets/img/me_in_newark_blur.jpg')">
    </div>
    <script type="text/javascript">

        $(function () {
            var isHidingNav = false;
            var isShowingNav = false;
            var toggleNavDuration = 800;

            var checkNavbarVisibility = function () {
                var nav = $('#main-nav');
                var navVisible = nav.is(':visible');
                var inTitleSection = $(window).scrollTop() < 150;
                var navHeight, navWidth;
                if (!navVisible && !inTitleSection && !isShowingNav && !isHidingNav) {
                    // show nav
                    nav.css('display','block');
                    navHeight = nav.outerHeight(true);
                    navWidth = nav.outerWidth(true);
                    nav.css('top',(-navHeight)+'px');
                    nav.css('left',($(window).width()-navWidth)+'px');
                    isShowingNav = true;
                    nav.animate({
                        'top': '0px'
                    }, {
                        duration: toggleNavDuration,
                        complete: function () {
                            isShowingNav = false;
                        }
                    });
                } else if (navVisible && inTitleSection && !isShowingNav && !isHidingNav) {
                    // hide nav
                    navHeight = nav.outerHeight(true);
                    navWidth = nav.outerWidth(true);
                    nav.css('left',($(window).width()-navWidth)+'px');
                    isHidingNav = true;
                    nav.animate({
                        'top': (-navHeight) + 'px'
                    }, {
                        duration: toggleNavDuration,
                        complete: function () {
                            nav.css('display', 'none');
                            isHidingNav = false;
                        }
                    });
                }
            };

            var updateNavbarActive = function () {
                var contentSlides = $('.slide.content-slide');
                for (var i = 0; i < contentSlides.length; ++i) {
                    if (contentSlides.eq(i).offset().top - $(window).scrollTop() >= 0) {
                        var navLinks = $('#main-nav').find('.nav-link');
                        var targetLink = navLinks.eq(i);
                        var activeLink = navLinks.filter('.active');
                        if (targetLink.length === 1 && activeLink.length === 1
                            && targetLink.get(0) !== activeLink.get(0)) {
                            activeLink.removeClass('active');
                            targetLink.addClass('active');
                        }
                        break;
                    }
                }
            };

            $(window).on("scroll", function () {
                $('.bg-img.blurred-img').css('opacity', $(window).scrollTop() / 100); // blur background img

                checkNavbarVisibility();
                updateNavbarActive();
            });

            $('#main-nav').find('.nav-link').on('click', function () {
                console.log('hello');
                var links = $('#main-nav').find('.nav-link');
                var linkIdx = 0;
                for (var i = 0; i < links.length; ++i) {
                    if (links.eq(i).get(0) === this) linkIdx = i;
                }
                $('html, body').animate({scrollTop: $('.content-slide').eq(linkIdx).offset().top - $('#main-nav').height()}, 1000);
                return false;
            });


            $(window).trigger("scroll");
        })
    </script>
</div>

<div class="page-container">
    <div class="slide title-slide">
        <p id="title-text">Introduction Lorenzo Campanella</p>

    </div>

    <div id="main-nav" style="display:none;">
        <div class="slide title-slide" style="margin: 0;">
            <ul class="nav nav-pills justify-content-end" >
                <li class="nav-item">
                    <a class="nav-link active" href="#">Background</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Academics</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Career Goals/Aspirations</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">My Family/Pets/Friends</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Leisure Time Activities</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Anything Else</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pictures</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="slide content-slide">
        <p>
            I was born in Atlanta and have since been living in northwestern NJ.
            My first job was mowing my lawn, and my second was working at a local farm.
            They were by no means the dirtiest jobs, but afterwards I knew I wanted a job that worked my mind, especially since I enjoyed math and science in school.
            A friend of the family owned a small tech company, I expressed my interest to him, and I ended up interning there one summer in high school when I was 15.
        </p>

    </div>

    <div class="slide content-slide">
        <p>
            That exposed me to programming, which led me to pursue a CS degree (w/ minor in Applied Math). I am now going for a master’s in CS as well, thanks to NJIT’s BS/MS.
        </p>
    </div>

    <div class="slide content-slide">
        <p>
            Beyond that, I am not quite sure where my career will take me other than most likely to a tech company in a software engineer capacity.
            <br />My plan is to work a few years for a mid-to-large sized company, and then maybe once I have an inkling of what I’m doing, launch a tech startup, and perhaps after that, work for a small company, eventually getting into a management position.
            <br />I don’t want to stay in one company/specialized industry my entire career. My dad did that, and now 30yrs later he feels incredibly boxed in. I also would like to know, maybe not right away but at least a good way through my career, that my work is helping people in the long term in some capacity.

        </p>
    </div>
    <div class="slide content-slide">
        <p>
            My family consists of my mom, dad, and brother of 17yrs. Our pets consist of a beagle, a lovable cat, and 6 chickens (that number may decrease soon, since their average production has recently dropped to only 1 egg/day ☹).
        </p>
    </div>
    <div class="slide content-slide">
        <p>
            My leisure time activities consist mainly of piano (which I've been playing since I was seven), coding projects/problem solving, chess, bodybuilding, and ping pong.
        </p>
    </div>
    <div class="slide content-slide">
        <p>
            I am excited to learn about and discuss these interesting topics. Hope everyone’s semester goes well!
        </p>
    </div>

    <div class="slide content-slide">
        <div class="row">
            <div class="col-md-6">
                <img src="./assets/img/intro/20180130_171712.jpg" style="width:100%;">
                <p style="text-align:center; font-size: 1em;">Me in my grandparent's wine cellar</p>
            </div>
            <div class="col-md-6">
                <img src="./assets/img/intro/20180203_124418.jpg" style="width:100%;">
                <p style="text-align:center; font-size: 1em;">My beagle, Kendra</p>
            </div>
        </div>
        <div class="row" style="margin-top:20px;">
            <div class="col-md-6">
                <video width="100%" controls>
                    <source src="./assets/img/intro/20171219_175634.mp4" type="video/mp4">
                    Your browser does not support HTML5 video.
                </video><br/>
                <p style="text-align:center; font-size: 1em;">Something I'm pretty proud of</p>
            </div>

        </div>
    </div>


</div>

</body>
</html>
