<template>
    <div class="offcanvas offcanvas-start" id="affanOffcanvas" data-bs-scroll="true" tabindex="-1"
         aria-labelledby="affanOffcanvsLabel">
        <button class="btn-close btn-close-white text-reset" type="button" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        <div class="offcanvas-body p-0">
            <!-- Side Nav Wrapper -->
            <div class="sidenav-wrapper">
                <!-- Sidenav Profile -->
                <div class="sidenav-profile bg-gradient">
                    <div class="sidenav-style1"></div>
                    <!-- User Thumbnail -->
                    <div class="user-profile"><img src="img/bg-img/2.jpg" alt=""></div>
                    <!-- User Info -->
                    <div class="user-info">
                        <h6 class="user-name mb-0">Affan Islam</h6><span>CEO, Designing World</span>
                    </div>
                </div>
                <!-- Sidenav Nav -->
                <ul class="sidenav-nav ps-0">
                    <li><a href="page-home.html"><i class="bi bi-house-door"></i>Home</a></li>
                    <li><a href="elements.html"><i class="bi bi-folder2-open"></i>Elements<span
                        class="badge bg-danger rounded-pill ms-2">220+</span></a></li>
                    <li><a href="pages.html"><i class="bi bi-collection"></i>Pages<span
                        class="badge bg-success rounded-pill ms-2">100+</span></a></li>
                    <li><a href="#"><i class="bi bi-cart-check"></i>Shop</a>
                        <ul>
                            <li><a href="page-shop-grid.html">Shop Grid</a></li>
                            <li><a href="page-shop-list.html">Shop List</a></li>
                            <li><a href="page-shop-details.html">Shop Details</a></li>
                            <li><a href="page-cart.html">Cart</a></li>
                            <li><a href="page-checkout.html">Checkout</a></li>
                        </ul>
                    </li>
                    <li><a href="settings.html"><i class="bi bi-gear"></i>Settings</a></li>
                    <li>
                        <div class="night-mode-nav"><i class="bi bi-moon"></i>Night Mode
                            <div class="form-check form-switch">
                                <input class="form-check-input form-check-success" id="darkSwitch" type="checkbox">
                            </div>
                        </div>
                    </li>
                    <li><a href="page-login.html"><i class="bi bi-box-arrow-right"></i>Logout</a></li>
                </ul>
                <!-- Social Info -->
                <div class="social-info-wrap"><a href="#"><i class="bi bi-facebook"></i></a><a href="#"><i
                    class="bi bi-twitter"></i></a><a href="#"><i class="bi bi-linkedin"></i></a></div>
                <!-- Copyright Info -->
                <div class="copyright-info">
                    <p>2021 &copy; Made by<a href="#">Designing World</a></p>
                </div>
            </div>
        </div>
    </div>
</template>
