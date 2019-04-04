<template>
    <div>
        <div id="tg-loginsingup" class="tg-loginsingup" data-vide-bg="poster: images/singup-img.jpg" data-vide-options="position: 0% 50%">
            <div class="tg-contentarea tg-themescrollbar">
                <div class="tg-scrollbar">
                    <button type="button" class="close">x</button>
                    <div class="tg-logincontent">
                        <nav id="tg-loginnav" class="tg-loginnav">
                            <ul>
                                <li><a href="index.htm#">About Us</a></li>
                                <li><a href="index.htm#">Contact Us</a></li>
                                <li><a href="index.htm#">My Account</a></li>
                                <li><a href="index.htm#">My Wishlist</a></li>
                            </ul>
                        </nav>
                        <div class="tg-themetabs">
                            <ul class="tg-navtbs" role="tablist">
                                <li role="presentation" class="active"><a href="index.htm#home" data-toggle="tab">Already Registered</a></li>
                                <li role="presentation"><a href="index.htm#profile" data-toggle="tab">New to Travleu ?</a></li>
                            </ul>
                            <div class="tg-tabcontent tab-content">
                                <div role="tabpanel" class="tab-pane active fade in" id="home">
                                    <form class="tg-formtheme tg-formlogin">
                                        <fieldset>
                                            <div class="form-group">
                                                <label>Name or Email <sup>*</sup></label>
                                                <input type="text" name="firstname" class="form-control" placeholder="">
                                            </div>
                                            <div class="form-group">
                                                <label>Password <sup>*</sup></label>
                                                <input type="password" name="password" class="form-control" placeholder="">
                                            </div>
                                            <div class="form-group">
                                                <div class="tg-checkbox">
                                                    <input type="checkbox" name="remember" id="rememberpass">
                                                    <label for="rememberpass">Remember Me</label>
                                                </div>
                                                <span><a href="index.htm#">Lost your password?</a></span>
                                            </div>
                                            <button class="tg-btn tg-btn-lg"><span>update profile</span></button>
                                        </fieldset>
                                    </form>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="profile">
                                    <form class="tg-formtheme tg-formlogin">
                                        <fieldset>
                                            <div class="form-group">
                                                <label>Name or Email <sup>*</sup></label>
                                                <input type="text" name="firstname" class="form-control" placeholder="">
                                            </div>
                                            <div class="form-group">
                                                <label>Password <sup>*</sup></label>
                                                <input type="password" name="password" class="form-control" placeholder="">
                                            </div>
                                            <div class="form-group">
                                                <label>Confirm Password <sup>*</sup></label>
                                                <input type="password" name="password" class="form-control" placeholder="">
                                            </div>
                                            <div class="form-group">
                                                <div class="tg-checkbox">
                                                    <input type="checkbox" name="remember" id="remember">
                                                    <label for="remember">Remember Me</label>
                                                </div>
                                                <span><a href="index.htm#">Lost your password?</a></span>
                                            </div>
                                            <button class="tg-btn tg-btn-lg"><span>update profile</span></button>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tg-shareor"><span>or</span></div>
                        <div class="tg-signupwith">
                            <h2>Sign in With...</h2>
                            <ul class="tg-sharesocialicon">
                                <li class="tg-facebook"><a href="index.htm#"><i class="icon-facebook-1"></i><span>Facebook</span></a></li>
                                <li class="tg-twitter"><a href="index.htm#"><i class="icon-twitter-1"></i><span>Twitter</span></a></li>
                                <li class="tg-googleplus"><a href="index.htm#"><i class="icon-google4"></i><span>Google+</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

    }
</script>
