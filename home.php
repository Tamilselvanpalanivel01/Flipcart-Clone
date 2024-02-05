
<!-- 
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-1"> </div>
                        <div class="col-md-10">
                             Signup Section 
                            <div id="outerbox">
                                <div class="form-group">
                                    <input id="snaam" class="form-control" type="text" placeholder="Enter your Name"
                                        autocomplete="off">
                                    <div id="nameerror"></div>
                                </div>
                                <div class="form-group">
                                    <input id="sphone" class="form-control" type="tel" placeholder="Enter Mobile Num"
                                        maxlength="10" autocomplete="off"
                                        onkeypress="return /[0-9]/i.test(event.key)">
                                    <div id="mobileerror"></div>
                                </div>
                                <div class="form-group">
                                    <input id="sgmail" class="form-control" type="email" placeholder="Enter email"
                                        autocomplete="off">
                                    <div id="emailerror"></div>
                                </div>
                                <div class="form-group input-group">
                                    <input id="spass" class="form-control" type="password" placeholder="Enter Password">
                                    <div class="input-group-append">
                                        <span class="input-group-text" style="cursor: pointer;"
                                            onclick="togglePasswordVisibility('spass')">
                                            <i id="cEye" class="fas fa-eye"></i>
                                        </span>
                                    </div>
                                    <div id="passworderror"></div>
                                </div>
                                <div class="form-group input-group">
                                    <input id="cspass" class="form-control" type="password" placeholder="Re-Enter Pass">
                                    <div class="input-group-append">
                                        <span class="input-group-text" style="cursor: pointer;"
                                            onclick="togglePasswordVisibility('cspass')">
                                            <i id="cEye" class="fas fa-eye"></i>
                                        </span>
                                    </div>
                                    <div id="rpassworderror"></div>
                                </div>
                                <div class="form-group">
                                    <input id="DOB" class="form-control" type="date">
                                    <div id="DOBerror"></div>
                                </div>
                                <div class="form-group">
                                    <label class="mr-2">Gender:</label>
                                    <div class="form-check form-check-inline">
                                        <input id="male" class="form-check-input" type="radio" name="gender"
                                            value="Male">
                                        <label class="form-check-label" for="male">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input id="female" class="form-check-input" type="radio" name="gender"
                                            value="Female">
                                        <label class="form-check-label" for="female">Female</label>
                                    </div>
                                    <div id="gendererror"></div>
                                </div>
                                <div class="form-group">
                                    <div class="text-center mt-4">
                                        <span class="textm">By continuing, you agree to Flipkart's
                                            <span style="color: blue;"> Terms of Use</span>
                                            <span style="color: blue;">Privacy Policy.</span>
                                        </span>
                                    </div>
                                    <div class="text-center mt-3">
                                        <button class="btn btn-primary" onclick="Signup()">CONTINUE</button>
                                    </div>
                                    <div class="text-center mt-3">
                                        <button class="btn btn-outline-secondary" onclick="toggleSections()">Existing
                                            User? Login</button>
                                    </div>
                                </div>
                            </div>

                            <div id="innerbox" style="display:none">
                                <div class="form-group">
                                    <input id="lphone" class="form-control" type="tel"
                                        placeholder="Enter Mobile Number" maxlength="10" autocomplete="off"
                                        onkeypress="return /[0-9]/i.test(event.key)">
                                    <div id="lmerror"></div>
                                </div>
                                <div class="form-group">
                                    <input id="lpass" class="form-control" type="password"
                                        placeholder="Enter Password">
                                    <div id="lperror"></div>
                                </div>
                                <div class="form-group">
                                    <div class="text-center mt-3">
                                        <p class="textm">By continuing, you agree to Flipkart's
                                            <span style="color: blue;"> Terms of Use</span>
                                            and <span style="color: blue;">Privacy Policy.</span>
                                        </p>
                                    </div>
                                    <div class="text-center mt-3">
                                        <button class="btn btn-primary" onclick="Signin()">LOGIN</button>
                                    </div>
                                    <div class="text-center mt-3">
                                        <button class="btn btn-outline-secondary" onclick="toggleSections()">Not
                                            Existing User? Signup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                </div>
            </div>
        </div>
    </div> 