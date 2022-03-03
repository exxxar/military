<template>
    <div class="login-back-button"><a href="page-login.html">
        <svg class="bi bi-arrow-left-short" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"></path>
        </svg></a></div>
    <div class="login-wrapper d-flex align-items-center justify-content-center">
        <div class="custom-container">
            <div class="text-center px-4"><img class="login-intro-img" src="img/bg-img/36.png" alt=""></div>
            <!-- Register Form -->
            <div class="register-form mt-4">
                <h6 class="mb-3 text-center">Register to continue to Affan.</h6>
                <form action="page-otp.html">
                    <div class="form-group text-start mb-3">
                        <input class="form-control" type="text" placeholder="Email address">
                    </div>
                    <div class="form-group text-start mb-3">
                        <input class="form-control" type="text" placeholder="Username">
                    </div>
                    <div class="form-group text-start mb-3 position-relative">
                        <input class="form-control" id="psw-input" type="password" placeholder="New password">
                        <div class="position-absolute" id="password-visibility"><i class="bi bi-eye"></i><i class="bi bi-eye-slash"></i></div>
                    </div>
                    <div class="mb-3 password-strength-meter" id="pswmeter" style="display: none;"><div class="password-strength-meter-score"></div></div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" id="checkedCheckbox" type="checkbox" value="" checked="">
                        <label class="form-check-label text-muted fw-normal" for="checkedCheckbox">I agree with the terms &amp; policy.</label>
                    </div>
                    <button class="btn btn-primary w-100" type="submit">Sign Up</button>
                </form>
            </div>
            <!-- Login Meta -->
            <div class="login-meta-data text-center">
                <p class="mt-3 mb-0">Already have an account? <a class="stretched-link" href="page-login.html">Login</a></p>
            </div>
        </div>
    </div>
</template>
