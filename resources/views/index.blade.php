
<!DOCTYPE html>
<html id="previewPage" lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Всё в твоих силах! Действуй!">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#0134d4">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <!-- Title -->
    <title>Щит ДНР - твоя республика в твоих руках</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <!-- Favicon -->
    <link rel="icon" href="img/core-img/favicon.ico">
    <link rel="apple-touch-icon" href="img/icons/icon-96x96.png">
    <link rel="apple-touch-icon" sizes="152x152" href="img/icons/icon-152x152.png">
    <link rel="apple-touch-icon" sizes="167x167" href="img/icons/icon-167x167.png">
    <link rel="apple-touch-icon" sizes="180x180" href="img/icons/icon-180x180.png">
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{asset('/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-icons.css')}}">
    <link rel="stylesheet" href="{{asset('css/tiny-slider.css')}}">
    <link rel="stylesheet" href="{{asset('css/baguetteBox.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/rangeslider.css')}}">
    <link rel="stylesheet" href="{{asset('css/vanilla-dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/apexcharts.css')}}">
    <!-- Core Stylesheet -->
    <link rel="stylesheet" href="{{asset('style.css')}}">
    <!-- Web App Manifest -->
    <link rel="manifest" href="{{asset('manifest.json')}}">
    <!-- Dark mode switching -->
    <div class="dark-mode-switching">
        <div class="d-flex w-100 h-100 align-items-center justify-content-center">
            <div class="dark-mode-text text-center">
                <svg class="bi bi-moon" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M14.53 10.53a7 7 0 0 1-9.058-9.058A7.003 7.003 0 0 0 8 15a7.002 7.002 0 0 0 6.53-4.47z"></path>
                </svg>
                <p class="mb-0">Switching to dark mode</p>
            </div>
            <div class="light-mode-text text-center">
                <svg class="bi bi-brightness-high" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"></path>
                </svg>
                <p class="mb-0">Switching to light mode</p>
            </div>
        </div>
    </div>
    <!-- RTL mode switching -->
    <div class="rtl-mode-switching">
        <div class="d-flex w-100 h-100 align-items-center justify-content-center">
            <div class="rtl-mode-text text-center">
                <svg class="bi bi-text-right" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-4-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm4-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-4-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"></path>
                </svg>
                <p class="mb-0">Switching to RTL mode</p>
            </div>
            <div class="ltr-mode-text text-center">
                <svg class="bi bi-text-left" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2 12.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"></path>
                </svg>
                <p class="mb-0">Switching to default mode</p>
            </div>
        </div>
    </div>
    <!-- Setting Popup Overlay -->
    <div id="setting-popup-overlay"></div>
    <!-- Setting Popup Card -->
    <div class="card setting-popup-card shadow-lg" id="settingCard">
        <div class="card-body">
            <div class="container">
                <div class="setting-heading d-flex align-items-center justify-content-between mb-3">
                    <p class="mb-0">Settings</p>
                    <div class="btn-close" id="settingCardClose"></div>
                </div>
                <div class="single-setting-panel">
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" id="availabilityStatus" checked>
                        <label class="form-check-label" for="availabilityStatus">Availability status</label>
                    </div>
                </div>
                <div class="single-setting-panel">
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" id="sendMeNotifications" checked>
                        <label class="form-check-label" for="sendMeNotifications">Send me notifications</label>
                    </div>
                </div>
                <div class="single-setting-panel">
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" id="darkSwitch">
                        <label class="form-check-label" for="darkSwitch">Dark mode</label>
                    </div>
                </div>
                <div class="single-setting-panel">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="rtlSwitch">
                        <label class="form-check-label" for="rtlSwitch">RTL mode</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</head>
<body>
<div class="preview-iframe-wrapper">
    <!-- Video Popup-->
    <div class="video-popup-modal modal fade" id="videobtn" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button class="btn-close" id="popupVideoBtnClose" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body p-0">
                    <div class="ratio ratio-16x9">
                        <iframe id="homePagePopupVideo" src="/mobile" title="Affan Promo Video" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header Area-->
    <div class="demo-header-wrapper">
        <div class="container demo-container">
            <!-- Header Content -->
            <div class="header-content header-style-five position-relative d-flex align-items-center justify-content-between">
                <!-- Logo Wrapper -->
                <div class="logo-wrapper"><a href="page-home.html"><img src="img/core-img/logo.png" alt=""></a></div>
                <!-- Settings -->
                <div class="setting-wrapper">
                    <div class="setting-trigger-btn" id="settingTriggerBtn">
                        <svg class="bi bi-gear" width="18" height="18" viewBox="0 0 16 16" fill="url(#gradientSettings)" xmlns="http://www.w3.org/2000/svg">
                            <defs>
                                <linearGradient id="gradientSettings" spreadMethod="pad" x1="0%" y1="0%" x2="100%" y2="100%">
                                    <stop offset="0" style="stop-color: #0134d4; stop-opacity:1;"></stop>
                                    <stop offset="100%" style="stop-color: #28a745; stop-opacity:1;"></stop>
                                </linearGradient>
                            </defs>
                            <path fill-rule="evenodd" d="M8.837 1.626c-.246-.835-1.428-.835-1.674 0l-.094.319A1.873 1.873 0 0 1 4.377 3.06l-.292-.16c-.764-.415-1.6.42-1.184 1.185l.159.292a1.873 1.873 0 0 1-1.115 2.692l-.319.094c-.835.246-.835 1.428 0 1.674l.319.094a1.873 1.873 0 0 1 1.115 2.693l-.16.291c-.415.764.42 1.6 1.185 1.184l.292-.159a1.873 1.873 0 0 1 2.692 1.116l.094.318c.246.835 1.428.835 1.674 0l.094-.319a1.873 1.873 0 0 1 2.693-1.115l.291.16c.764.415 1.6-.42 1.184-1.185l-.159-.291a1.873 1.873 0 0 1 1.116-2.693l.318-.094c.835-.246.835-1.428 0-1.674l-.319-.094a1.873 1.873 0 0 1-1.115-2.692l.16-.292c.415-.764-.42-1.6-1.185-1.184l-.291.159A1.873 1.873 0 0 1 8.93 1.945l-.094-.319zm-2.633-.283c.527-1.79 3.065-1.79 3.592 0l.094.319a.873.873 0 0 0 1.255.52l.292-.16c1.64-.892 3.434.901 2.54 2.541l-.159.292a.873.873 0 0 0 .52 1.255l.319.094c1.79.527 1.79 3.065 0 3.592l-.319.094a.873.873 0 0 0-.52 1.255l.16.292c.893 1.64-.902 3.434-2.541 2.54l-.292-.159a.873.873 0 0 0-1.255.52l-.094.319c-.527 1.79-3.065 1.79-3.592 0l-.094-.319a.873.873 0 0 0-1.255-.52l-.292.16c-1.64.893-3.433-.902-2.54-2.541l.159-.292a.873.873 0 0 0-.52-1.255l-.319-.094c-1.79-.527-1.79-3.065 0-3.592l.319-.094a.873.873 0 0 0 .52-1.255l-.16-.292c-.892-1.64.902-3.433 2.541-2.54l.292.159a.873.873 0 0 0 1.255-.52l.094-.319z"></path>
                            <path fill-rule="evenodd" d="M8 5.754a2.246 2.246 0 1 0 0 4.492 2.246 2.246 0 0 0 0-4.492zM4.754 8a3.246 3.246 0 1 1 6.492 0 3.246 3.246 0 0 1-6.492 0z"></path>
                        </svg><span></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Preview Hero Area -->
    <div class="preview-hero-area"><span class="big-shadow-text">Affan</span>
        <div class="container demo-container direction-rtl">
            <div class="row g-2 align-items-center justify-content-between">
                <div class="col-12 col-lg-3">
                    <h6 class="version-number d-inline-block px-3 py-2 rounded-pill mb-3 lh-1">Current version - 1.3.0</h6>
                    <h2 class="demo-title mb-3"><span>Affan </span> - PWA Mobile HTML Template</h2>
                    <ul class="demo-desc ps-0 mb-5">
                        <li><i class="bi bi-check2"></i>PWA Ready</li>
                        <li><i class="bi bi-check2"></i>Vanilla JavaScript</li>
                        <li><i class="bi bi-check2"></i>Bootstrap 5.1.0</li>
                        <li><i class="bi bi-check2"></i>Creative Design</li>
                        <li><i class="bi bi-check2"></i>Dark Mode</li>
                        <li><i class="bi bi-check2"></i>Right to Left (RTL)</li>
                    </ul><a class="btn btn-outline-danger btn-lg" href="#" data-bs-toggle="modal" data-bs-target="#videobtn">Watch promo video</a>
                </div>
                <div class="col-12 col-lg-5">
                    <div class="text-center">
                        <iframe class="shadow-lg" src="/mobile"></iframe>
                    </div>
                </div>
                <div class="col-12 col-lg-3">
                    <div class="text-lg-end">
                        <!-- Mobile Live Preview -->
                        <div class="live-preview-btn mb-3"><a class="btn btn-primary btn-lg d-lg-none mb-5" href="element-hero-blocks.html" target="_blank">Click the button to live preview</a></div>
                        <!-- QR Code -->
                        <div class="qr-code-wrapper"><img class="mb-3" src="img/demo-img/qr-code.svg" alt="">
                            <h6 class="mb-0">Scan this QR code to view <br> on your mobile device.</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Features Area -->
    <div class="features-area">
        <div class="container demo-container direction-rtl">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-7 col-xl-6">
                    <div class="section-heading text-center">
                        <h2 class="display-5 mb-3">Key Features</h2>
                        <p class="mb-0">Affan is a modern and latest technology-based mobile template. It's come with <span class="special-text">Creative Design, Vanilla JavaScript, Bootstrap 5, PWA Ready, Dark Mode &amp; Right to Left (RTL) </span>features.</p>
                    </div>
                </div>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                    <div class="card active">
                        <div class="card-body text-center py-5"><img class="mb-4" src="img/demo-img/bootstrap.png" alt="">
                            <h5 class="mb-0">Bootstrap 5.1.0</h5>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                    <div class="card active">
                        <div class="card-body text-center py-5"><img class="mb-4" src="img/demo-img/pwa.png" alt="">
                            <h5 class="mb-0">PWA Ready</h5>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                    <div class="card active">
                        <div class="card-body text-center py-5"><img class="mb-4" src="img/demo-img/js.png" alt="">
                            <h5 class="mb-0">Vanilla JavaScript</h5>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                    <div class="card active">
                        <div class="card-body text-center py-5"><img class="mb-4" src="img/demo-img/npm.png" alt="">
                            <h5 class="mb-0">NPM</h5>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                    <div class="card active">
                        <div class="card-body text-center py-5"><img class="mb-4" src="img/demo-img/gulp.png" alt="">
                            <h5 class="mb-0">Gulp 4</h5>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                    <div class="card active">
                        <div class="card-body text-center py-5"><img class="mb-4" src="img/demo-img/pug.png" alt="">
                            <h5 class="mb-0">PUG</h5>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                    <div class="card active">
                        <div class="card-body text-center py-5"><img class="mb-4" src="img/demo-img/sass.png" alt="">
                            <h5 class="mb-0">SCSS</h5>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                    <div class="card active">
                        <div class="card-body text-center py-5"><img class="mb-4" src="img/demo-img/dark.png" alt="">
                            <h5 class="mb-0">Dark &amp; RTL Mode</h5>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card">
                        <div class="card-body p-2">
                            <div class="d-flex align-items-center">
                                <svg class="bi bi-check text-success" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"></path>
                                </svg>
                                <h6 class="mb-0">HTML5</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card">
                        <div class="card-body p-2">
                            <div class="d-flex align-items-center">
                                <svg class="bi bi-check text-success" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"></path>
                                </svg>
                                <h6 class="mb-0">220+ Elements</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card">
                        <div class="card-body p-2">
                            <div class="d-flex align-items-center">
                                <svg class="bi bi-check text-success" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"></path>
                                </svg>
                                <h6 class="ms-1 mb-0">Varieties Header Menu</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card">
                        <div class="card-body p-2">
                            <div class="d-flex align-items-center">
                                <svg class="bi bi-check text-success" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"></path>
                                </svg>
                                <h6 class="ms-1 mb-0">Varieties Footer Menu</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card active">
                        <div class="card-body p-2">
                            <div class="d-flex align-items-center">
                                <svg class="bi bi-check text-success" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"></path>
                                </svg>
                                <h6 class="ms-1 mb-0">Left &amp; Right Sidebar Menu</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card">
                        <div class="card-body p-2">
                            <div class="d-flex align-items-center">
                                <svg class="bi bi-check text-success" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"></path>
                                </svg>
                                <h6 class="ms-1 mb-0">Alerts &amp; Toasts</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card active">
                        <div class="card-body p-2">
                            <div class="d-flex align-items-center">
                                <svg class="bi bi-check text-success" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"></path>
                                </svg>
                                <h6 class="ms-1 mb-0">Automated Online/Offline Detection</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card active">
                        <div class="card-body p-2">
                            <div class="d-flex align-items-center">
                                <svg class="bi bi-check text-success" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"></path>
                                </svg>
                                <h6 class="ms-1 mb-0">RTL Ready</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card active">
                        <div class="card-body p-2">
                            <div class="d-flex align-items-center">
                                <svg class="bi bi-check text-success" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"></path>
                                </svg>
                                <h6 class="ms-1 mb-0">220+ Reusable Elements</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card active">
                        <div class="card-body p-2">
                            <div class="d-flex align-items-center">
                                <svg class="bi bi-check text-success" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"></path>
                                </svg>
                                <h6 class="ms-1 mb-0">100+ Ready Pages</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card">
                        <div class="card-body p-2">
                            <div class="d-flex align-items-center">
                                <svg class="bi bi-check text-success" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"></path>
                                </svg>
                                <h6 class="ms-1 mb-0">Varieties Form Elements</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card active">
                        <div class="card-body p-2">
                            <div class="d-flex align-items-center">
                                <svg class="bi bi-check text-success" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"></path>
                                </svg>
                                <h6 class="ms-1 mb-0">Auto Complete Form</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card">
                        <div class="card-body p-2">
                            <div class="d-flex align-items-center">
                                <svg class="bi bi-check text-success" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"></path>
                                </svg>
                                <h6 class="ms-1 mb-0">Range Input Slider</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card">
                        <div class="card-body p-2">
                            <div class="d-flex align-items-center">
                                <svg class="bi bi-check text-success" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"></path>
                                </svg>
                                <h6 class="ms-1 mb-0">Accordion/FAQ</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card">
                        <div class="card-body p-2">
                            <div class="d-flex align-items-center">
                                <svg class="bi bi-check text-success" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"></path>
                                </svg>
                                <h6 class="ms-1 mb-0">Timeline</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card">
                        <div class="card-body p-2">
                            <div class="d-flex align-items-center">
                                <svg class="bi bi-check text-success" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"></path>
                                </svg>
                                <h6 class="ms-1 mb-0">Image Gallery</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card">
                        <div class="card-body p-2">
                            <div class="d-flex align-items-center">
                                <svg class="bi bi-check text-success" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"></path>
                                </svg>
                                <h6 class="ms-1 mb-0">User Ratings</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card">
                        <div class="card-body p-2">
                            <div class="d-flex align-items-center">
                                <svg class="bi bi-check text-success" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"></path>
                                </svg>
                                <h6 class="ms-1 mb-0">Lots of Helper Elements</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card">
                        <div class="card-body p-2">
                            <div class="d-flex align-items-center">
                                <svg class="bi bi-check text-success" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"></path>
                                </svg>
                                <h6 class="ms-1 mb-0">Carousel</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card active">
                        <div class="card-body p-2">
                            <div class="d-flex align-items-center">
                                <svg class="bi bi-check text-success" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"></path>
                                </svg>
                                <h6 class="ms-1 mb-0">Data Table</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card">
                        <div class="card-body p-2">
                            <div class="d-flex align-items-center">
                                <svg class="bi bi-check text-success" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"></path>
                                </svg>
                                <h6 class="ms-1 mb-0">Countdown &amp; Counterup</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card active">
                        <div class="card-body p-2">
                            <div class="d-flex align-items-center">
                                <svg class="bi bi-check text-success" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"></path>
                                </svg>
                                <h6 class="ms-1 mb-0">Apex Charts</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card">
                        <div class="card-body p-2">
                            <div class="d-flex align-items-center">
                                <svg class="bi bi-check text-success" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"></path>
                                </svg>
                                <h6 class="ms-1 mb-0">Versatile Mobile Template</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card">
                        <div class="card-body p-2">
                            <div class="d-flex align-items-center">
                                <svg class="bi bi-check text-success" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"></path>
                                </svg>
                                <h6 class="ms-1 mb-0">Nicely Designed</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card active">
                        <div class="card-body p-2">
                            <div class="d-flex align-items-center">
                                <svg class="bi bi-check text-success" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"></path>
                                </svg>
                                <h6 class="ms-1 mb-0">PWA Ready</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card active">
                        <div class="card-body p-2">
                            <div class="d-flex align-items-center">
                                <svg class="bi bi-check text-success" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"></path>
                                </svg>
                                <h6 class="ms-1 mb-0">Bootstrap 5.1.0</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card">
                        <div class="card-body p-2">
                            <div class="d-flex align-items-center">
                                <svg class="bi bi-check text-success" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"></path>
                                </svg>
                                <h6 class="ms-1 mb-0">Node Package Manager</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card">
                        <div class="card-body p-2">
                            <div class="d-flex align-items-center">
                                <svg class="bi bi-check text-success" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"></path>
                                </svg>
                                <h6 class="ms-1 mb-0">Gulp 4</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card active">
                        <div class="card-body p-2">
                            <div class="d-flex align-items-center">
                                <svg class="bi bi-check text-success" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"></path>
                                </svg>
                                <h6 class="ms-1 mb-0">SCSS CSS preprocessor</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card active">
                        <div class="card-body p-2">
                            <div class="d-flex align-items-center">
                                <svg class="bi bi-check text-success" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"></path>
                                </svg>
                                <h6 class="ms-1 mb-0">Pug</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card">
                        <div class="card-body p-2">
                            <div class="d-flex align-items-center">
                                <svg class="bi bi-check text-success" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"></path>
                                </svg>
                                <h6 class="ms-1 mb-0">Coded with the Latest Technology</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card">
                        <div class="card-body p-2">
                            <div class="d-flex align-items-center">
                                <svg class="bi bi-check text-success" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"></path>
                                </svg>
                                <h6 class="ms-1 mb-0">Bug Free Code</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card">
                        <div class="card-body p-2">
                            <div class="d-flex align-items-center">
                                <svg class="bi bi-check text-success" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"></path>
                                </svg>
                                <h6 class="ms-1 mb-0">Cross Browser Support</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card">
                        <div class="card-body p-2">
                            <div class="d-flex align-items-center">
                                <svg class="bi bi-check text-success" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"></path>
                                </svg>
                                <h6 class="ms-1 mb-0">Notifications Pages</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card">
                        <div class="card-body p-2">
                            <div class="d-flex align-items-center">
                                <svg class="bi bi-check text-success" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"></path>
                                </svg>
                                <h6 class="ms-1 mb-0">Language Page</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card">
                        <div class="card-body p-2">
                            <div class="d-flex align-items-center">
                                <svg class="bi bi-check text-success" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"></path>
                                </svg>
                                <h6 class="ms-1 mb-0">Password Strength Meter</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card">
                        <div class="card-body p-2">
                            <div class="d-flex align-items-center">
                                <svg class="bi bi-check text-success" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"></path>
                                </svg>
                                <h6 class="ms-1 mb-0">OTP Pages</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card active">
                        <div class="card-body p-2">
                            <div class="d-flex align-items-center">
                                <svg class="bi bi-check text-success" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"></path>
                                </svg>
                                <h6 class="ms-1 mb-0">Shop Pages</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card">
                        <div class="card-body p-2">
                            <div class="d-flex align-items-center">
                                <svg class="bi bi-check text-success" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"></path>
                                </svg>
                                <h6 class="ms-1 mb-0">User Profile</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card">
                        <div class="card-body p-2">
                            <div class="d-flex align-items-center">
                                <svg class="bi bi-check text-success" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"></path>
                                </svg>
                                <h6 class="ms-1 mb-0">Coming Soon</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card">
                        <div class="card-body p-2">
                            <div class="d-flex align-items-center">
                                <svg class="bi bi-check text-success" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"></path>
                                </svg>
                                <h6 class="ms-1 mb-0">Authentication Pages</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card">
                        <div class="card-body p-2">
                            <div class="d-flex align-items-center">
                                <svg class="bi bi-check text-success" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"></path>
                                </svg>
                                <h6 class="ms-1 mb-0">Unique Design</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card">
                        <div class="card-body p-2">
                            <div class="d-flex align-items-center">
                                <svg class="bi bi-check text-success" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"></path>
                                </svg>
                                <h6 class="ms-1 mb-0">Blog Pages</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card">
                        <div class="card-body p-2">
                            <div class="d-flex align-items-center">
                                <svg class="bi bi-check text-success" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"></path>
                                </svg>
                                <h6 class="ms-1 mb-0">Google Fonts</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card">
                        <div class="card-body p-2">
                            <div class="d-flex align-items-center">
                                <svg class="bi bi-check text-success" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"></path>
                                </svg>
                                <h6 class="ms-1 mb-0">Easy to Customize</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card">
                        <div class="card-body p-2">
                            <div class="d-flex align-items-center">
                                <svg class="bi bi-check text-success" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"></path>
                                </svg>
                                <h6 class="ms-1 mb-0">Clean &amp; 100% Validate Code</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card">
                        <div class="card-body p-2">
                            <div class="d-flex align-items-center">
                                <svg class="bi bi-check text-success" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"></path>
                                </svg>
                                <h6 class="ms-1 mb-0">Settings Page</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card active">
                        <div class="card-body p-2">
                            <div class="d-flex align-items-center">
                                <svg class="bi bi-check text-success" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"></path>
                                </svg>
                                <h6 class="ms-1 mb-0">Dark Mode</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card active">
                        <div class="card-body p-2">
                            <div class="d-flex align-items-center">
                                <svg class="bi bi-check text-success" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"></path>
                                </svg>
                                <h6 class="ms-1 mb-0">404</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card">
                        <div class="card-body p-2">
                            <div class="d-flex align-items-center">
                                <svg class="bi bi-check text-success" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"></path>
                                </svg>
                                <h6 class="ms-1 mb-0">Fancy Button</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card active">
                        <div class="card-body p-2">
                            <div class="d-flex align-items-center">
                                <svg class="bi bi-check text-success" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"></path>
                                </svg>
                                <h6 class="ms-1 mb-0">Vanilla JavaScript</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card active">
                        <div class="card-body p-2">
                            <div class="d-flex align-items-center">
                                <svg class="bi bi-check text-success" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"></path>
                                </svg>
                                <h6 class="ms-1 mb-0">Comparison Table</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card">
                        <div class="card-body p-2">
                            <div class="d-flex align-items-center">
                                <svg class="bi bi-check text-success" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"></path>
                                </svg>
                                <h6 class="ms-1 mb-0">Offcanvas</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card">
                        <div class="card-body p-2">
                            <div class="d-flex align-items-center">
                                <svg class="bi bi-check text-success" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"></path>
                                </svg>
                                <h6 class="ms-1 mb-0">Tab</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card active">
                        <div class="card-body p-2">
                            <div class="d-flex align-items-center">
                                <svg class="bi bi-check text-success" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"></path>
                                </svg>
                                <h6 class="ms-1 mb-0">Tiny Slider</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card">
                        <div class="card-body p-2">
                            <div class="d-flex align-items-center">
                                <svg class="bi bi-check text-success" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"></path>
                                </svg>
                                <h6 class="ms-1 mb-0">Fallback Page</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="card">
                        <div class="card-body p-2">
                            <div class="d-flex align-items-center">
                                <svg class="bi bi-check text-success" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"></path>
                                </svg>
                                <h6 class="ms-1 mb-0">Fancy UI Card</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Area -->
    <div class="preview-footer-area py-5">
        <div class="container demo-container direction-rtl h-100 d-flex align-items-center justify-content-between">
            <p class="mb-0">2021 &copy; Made by Designing World</p><a class="btn btn-info" href="https://themeforest.net/item/affan-pwa-mobile-html-template/29715548" target="_blank">Buy Now</a>
        </div>
    </div>
    <script>
        var tag = document.createElement('script');
        tag.src = "https://www.youtube.com/iframe_api";
        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

        var closeButtom = document.getElementById("popupVideoBtnClose");
        var player;
        function onYouTubeIframeAPIReady() {
            player = new YT.Player("homePagePopupVideo", {
                videoId: '-D6QFpH7zCA',
                events: {
                    'onReady': onPlayerReady,
                }
            });
        }

        function onPlayerReady(event) {
            closeButtom.addEventListener("click", function () {
                player.stopVideo();
            });
        }

    </script>
</div>
<!-- All JavaScript Files -->
<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('js/slideToggle.min.js')}}"></script>
<script src="{{asset('js/internet-status.js')}}"></script>
<script src="{{asset('js/tiny-slider.js')}}"></script>
<script src="{{asset('js/baguetteBox.min.js')}}"></script>
<script src="{{asset('js/countdown.js')}}"></script>
<script src="{{asset('js/rangeslider.min.js')}}"></script>
<script src="{{asset('js/vanilla-dataTables.min.js')}}"></script>
<script src="{{asset('js/index.js')}}"></script>
<script src="{{asset('js/magic-grid.min.js')}}"></script>
<script src="{{asset('js/dark-rtl.js')}}"></script>
<script src="{{asset('js/active.js')}}"></script>
<!-- PWA -->
<script src="{{asset('js/pwa.js')}}"></script>
</body>
</html>
