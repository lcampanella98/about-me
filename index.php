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

		<title><?php echo $CONF["name"]; ?></title>
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
                <p id="title-text">Lorenzo Campanella</p>

            </div>

            <div id="main-nav" style="display:none;">
                <div class="slide title-slide" style="margin: 0;">
                    <ul class="nav nav-pills justify-content-end" >
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Intro</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Education</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Experience</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Projects</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="slide content-slide">
                <p style="text-align:center">A
                    <?php
		    date_default_timezone_set("US/Eastern");
                    $yr=date('Y') - 2016 + (date('m') >= 8 ? 1 : 0);
                    $graduated = false;
                    if ($yr === 1) echo '1st';
                    elseif ($yr === 2) echo '2nd';
                    elseif ($yr === 3) echo '3rd';
                    elseif ($yr === 4) echo '4th';
                    else $graduated = true;
                    if (!$graduated) echo ' year';
                    else echo 'graduated';
                    ?> Computer Science student who loves to show off his projects</p>
            </div>

            <div class="slide content-slide">
                <h1>Education</h1>
                <p>Bachelor's of Science in Computer Science (May 2020)</p>
                <p>New Jersey Institute of Technology</p>
                <p>3.97 GPA</p>
            </div>

            <div class="slide content-slide" style="text-align:right">
                <h1>Experience</h1>
                <p>Worked 1 year as full-stack web-developer</p>
                <p>Won RDE coding challenge 2.0</p>
                <p>Participated in several hackathons</p>
            </div>

            <div class="slide content-slide">
                <h1>My Projects</h1>
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="project-container">
                            <a class="project-link" href="./project_files/candidate_crush/candidate-crush.jar" download>
                            <div class="project-heading">Candidate Crush</div>
                                <div class="project-body">

                                    <img class="img-fluid" src="./assets/img/project_screenshots/candidate_crush_screenshot.jpg">

                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="project-container">
                            <a class="project-link" href="./project_files/tank_shootout/tank_shootout.zip" download>
                                <div class="project-heading">Tank Shootout</div>
                                <div class="project-body">

                                    <img class="img-fluid" src="./assets/img/project_screenshots/tank_shootout_screenshot.jpg">

                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="project-container">
                            <!---<a class="project-link" target="_blank" href="http://ec2-52-42-248-119.us-west-2.compute.amazonaws.com:3000" download>-->
			    <a class="project-link" target="_blank" href="http://69.142.165.108:3000">
                                <div class="project-heading">Bug of the Hill</div>
                                <div class="project-body">

                                    <img class="img-fluid" src="./assets/img/project_screenshots/bug_of_the_hill_screenshot.jpg">

                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </body>
</html>
