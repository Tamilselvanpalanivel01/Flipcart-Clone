<?php
include('connection.php');
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Flipkart</title>
  <link rel="stylesheet" href="index.css" />


  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>



  <style>
    * {
      padding: 0;
      margin: 0;

    }

    #collection {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      grid-gap: 15px;
      margin-top: 10px;
      cursor: pointer;
    }

    .image {
      position: relative;
      overflow: hidden;
    }

    .image img {
      width: 100%;
      height: auto;
      transition: transform 0.3s ease-in-out;
    }

    .image:hover img {
      transform: scale(1.2);
    }

    #mobilecontent {
      margin-top: 20px;
    }

    .card {
      margin-bottom: 20px;


    }

    .card-body img {
      align-items: center;


    }

    .model-name {
      color: pink;
    }

    .rating {
      color: black;
    }
  </style>
</head>

<body>

  <div id="container">
    <div id="nav">
      <div id="nav1" onclick="home()" class="navbar-brand">
        <span id="logo_name"> Flipkart </span>
        <span id="explore" class="text-muted font-italic" style="font-size: 12px;">Explore
          <span style="color: #ffc200"> Plus </span>
        </span>
      </div>
      <div class="navtab" id="searchbar">
        <span id="search_icon">
          <svg width="20" height="20" class="icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <title>Search Icon</title>
            <path
              d="M10.5 18C14.6421 18 18 14.6421 18 10.5C18 6.35786 14.6421 3 10.5 3C6.35786 3 3 6.35786 3 10.5C3 14.6421 6.35786 18 10.5 18Z"
              stroke="#717478" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"></path>
            <path d="M16 16L21 21" stroke="#717478" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round">
            </path>
          </svg>
        </span>
        <span>
          <input id="input_data" type="text" placeholder="Search product">
        </span>
      </div>
      <div class="navtab navtabse">
        <span id="profile" style="display:flex;">
          <i class="fas fa-user" style="margin: 5px;"></i>
        </span>
        <span id="shop"> <i class='fas fa-shopping-cart' ></i>Cart</span>

        <input type="hidden" id="addIdInput" value="<?php echo isset($_SESSION['addid']) ? $_SESSION['addid'] : ''; ?>">
        <input type="hidden" id="useModelArray"
          value="<?php echo isset($_SESSION['usemodel']) ? htmlspecialchars(json_encode($_SESSION['usemodel'])) : ''; ?>">
        <input type="hidden" id="useid" value="<?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : ''; ?>">
        <input type="hidden" id="use" value="<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>">
      </div>
      <div class="navtab1 navtabse" id="nav_sigin">
        <button id="sigin_button" type="button" class="btn btn-warning" data-toggle="modal"
          data-target="#exampleModal" style="display:none">Signin</button>
        <label id="signout" style="display:none;">Logout
        </label>
        <div class="modal fade" id="exampleModal">
          <!-- Your existing modal content here -->
          <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-1"></div>
                  <div class="col-md-10">
                    <!-- Signup Section -->
                    <div id="outerbox">
                      <div class="text-center">
                        <h1>Signup</h1>
                      </div>
                      <div class="form-group">
                        <input id="snaam" class="form-control" type="text" placeholder="Enter your Name"
                          autocomplete="off">
                        <div id="nameerror"></div>
                      </div>
                      <!-- Add Bootstrap classes to the form-group and input elements -->
                      <div class="form-group">
                        <input id="sphone" class="form-control" type="tel" placeholder="Enter Mobile Num" maxlength="10"
                          autocomplete="off" onkeypress="return /[0-9]/i.test(event.key)">
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
                           >
                            <i id="cEye" class="fas fa-eye"onclick="eye()"></i>
                          </span>
                        </div>
                        <div id="passworderror"></div>
                      </div>
                      <div class="form-group input-group">
                        <input id="cspass" class="form-control" type="password" placeholder="Re-Enter Pass">
                        <div class="input-group-append">
                          <span class="input-group-text" style="cursor: pointer;"
                            >
                            <i id="cEye1" class="fas fa-eye" onclick="eye1()"></i>
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
                          <input id="male" class="form-check-input" type="radio" name="gender" value="Male">
                          <label class="form-check-label" for="male">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input id="female" class="form-check-input" type="radio" name="gender" value="Female">
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
                          <button class="btn btn-info" onclick="Signup()">CONTINUE</button>
                        </div>
                        <div class="text-center mt-3">
                          <button class="btn btn-outline-secondary" onclick="toggleSections()">Existing User?
                            Login</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-1"></div>


                  <!-- Signin Section -->
                  <div id="innerbox" style="display: none;">
                    <div class="text-center">
                      <h1>Login</h1>
                    </div>
                    <div class="form-group">
                      <input id="lphone" class="form-control" type="tel" placeholder="Enter Mobile Number"
                        maxlength="10" autocomplete="off" onkeypress="return /[0-9]/i.test(event.key)">
                      <div id="lmerror"></div>
                    </div>
                    <div class="form-group">
                      <input id="lpass" class="form-control" type="password" placeholder="Enter Password">
                      <div id="lperror"></div>
                    </div>
                    <div class="form-group">
                      <!-- <div class="text-center mt-3">
                                <p class="textm">By continuing, you agree to Flipkart's
                                    <span style="color: blue;"> Terms of Use</span>
                                    and <span style="color: blue;">Privacy Policy.</span>
                                </p>
                            </div> -->
                      <div class="text-center mt-3">
                        <button class="btn btn-info" onclick="Signin()">LOGIN</button>
                      </div>
                      <div class="text-center mt-3">
                        <button class="btn btn-outline-secondary" onclick="toggleSections()">Not Existing User?
                          Signup</button>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="navtab" id="searchbar1">
      <span id="search_icon1">
        <svg width="20" height="20" class="icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <title>Search Icon</title>
          <path
            d="M10.5 18C14.6421 18 18 14.6421 18 10.5C18 6.35786 14.6421 3 10.5 3C6.35786 3 3 6.35786 3 10.5C3 14.6421 6.35786 18 10.5 18Z"
            stroke="#717478" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"></path>
          <path d="M16 16L21 21" stroke="#717478" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round">
          </path>
        </svg>
      </span>
      <span>
        <input id="input_data1" type="text" placeholder="Search" class="form-control">
      </span>
    </div>
    <div id="cat">

      <section id="categories">

        <div>
          <img src="grocery.webp">
          <p>Grocerry</p>
        </div>
        <div onclick="showMobileSection()" id="addmob">
          <img src="mobile.webp">
          <p>Mobiles</p>
        </div>
        <div>
          <img src="fashion.webp">
          <p>Fashion</p>
        </div>
        <div>
          <img src="electron.webp">
          <p>Electron</p>
        </div>
        <div>
          <img src="appliance.jpg">
          <p onclick="showAppliancesSection()">Home applaince</p>
        </div>

        <div>
          <img src="trevel.webp">
          <p>Travel</p>
        </div>
        <div>
          <img src="toys.webp">
          <p>Beauty,Toys and More</p>
        </div>
        <div>
          <img src="two.webp">
          <p>Two Wheelers</p>
        </div>


      </section>
      <section id="mobilecontent" class="container-fluid" style="display:none;">
        <h4 style="text-align:center; color:blue" id="mobileSectionHeading">Mobile section</h4>
        <div class="row">

          <div class="col-sm-4 card-container" data-product-id="1" data-brand-name="Redmi" data-model="Redmi-5A"
            data-ram="4GB" data-price="10000">
            <div class="card">
              <div class="card-body text-center" onclick="mobiledes_one()">
                <h5 class="card-title text-success" id="Rname">Redmi</h5>
                <img src="mobile/red.jpeg" class="img-fluid" id="Rimage">
                <p class="card-text model-name" id="Rmodel"><strong>Model:</strong><span id="red">Redmi-5A</span></p>
                <p class="card-text" id="Rram">RAM:4GB</p>
                <p class="card-text" id="Rprice"><span id="Rprice">10000&#8377;</span></p>
                <p class="card-text rating"><strong>Rating:</strong> 4.3/5</p>
              </div>
              <div class="d-flex justify-content-center">
                <button class="btn btn-primary  mb-3" id="addToCartBtn">Add</button>
                <button class="btn btn-danger mb-3" id="addToCartRemove" style="display:none">Remove</button>
              </div>
            </div>
          </div>

          <div class="col-sm-4 card-container" data-product-id="2" data-brand-name="Realme" data-model="Realme-s"
            data-ram="4GB" data-price="20000">
            <div class="card">
              <div class="card-body text-center" onclick="mobiledes_two()">
                <h5 class="card-title text-success" id="Realname">Realme</h5>
                <img src="mobile/real.jpeg" class="img-fluid" id="Realimage">
                <p class="card-text model-name" id="Realmodel"><strong>Model:</strong><span id="r">Realme-S</span></p>
                <p class="card-text" id="Realram">RAM:6GB</p>
                <p class="card-text" id="Realprice">Price:<span id="realprice">40000&#8377;</span></p>
                <p class="card-text rating"><strong>Rating:</strong> 4.2/5</p>
              </div>
              <div class="d-flex justify-content-center">
                <button class="btn btn-primary  mb-3" id="addToCartBtn">Add</button>
                <button class="btn btn-danger mb-3" id="addToCartRemove" style="display:none">Remove</button>
              </div>
            </div>
          </div>

          <div class="col-sm-4 card-container" data-product-id="3" data-brand-name="oneplus" data-model="oneplus11"
            data-ram="4GB" data-price="30000">
            <div class="card">
              <div class="card-body text-center" onclick="mobiledes_three()">
                <h5 class="card-title  text-success" id="Onename">Oneplus</h5>
                <img src="mobile/one11.jpeg" class="img-fluid " id="Oneimage">
                <p class="card-text model-name" id="Onemodel"><strong>Model:</strong><span id="one11">oneplus-11</span>
                </p>
                <p class="card-text" id="Oneram">RAM:8GB</p>
                <p class="card-text" id="oneprice">Price:<span id="oneplusprice">30000&#8377;</span></p>
                <p class="card-text rating"><strong>Rating:</strong> 4.5/5</p>
              </div>
              <div class="d-flex justify-content-center">
                <button class="btn btn-primary  mb-3" id="addToCartBtn">Add</button>
                <button class="btn btn-danger mb-3" id="addToCartRemove" style="display:none">Remove</button>
              </div>
            </div>
          </div>
          <div class="col-sm-4 card-container" data-product-id="4" data-brand-name="Samsung" data-model="A53"
            data-ram="4GB" data-price="40000">
            <div class="card">
              <div class="card-body text-center" onclick="mobiledes_four()">
                <h5 class="card-title  text-success" id="Samname">Samsung</h5>
                <img src="mobile/mob4.jpeg" class="img-fluid" id="Samimage">
                <p class="card-text model-name" id="Sammodel"><strong>Model:</strong><span id="A54">A53</span></p>
                <p class="card-text" id="Samram">RAM:10GB</p>
                <p class="card-text" id="Samprice">Price:<span id="samprice">25000&#8377;</span></p>
                <p class="card-text rating"><strong>Rating:</strong> 3.5/5</p>
              </div>
              <div class="d-flex justify-content-center">
                <button class="btn btn-primary  mb-3" id="addToCartBtn">Add</button>
                <button class="btn btn-danger mb-3" id="addToCartRemove" style="display:none">Remove</button>
              </div>
            </div>
          </div>

          <div class="col-sm-4 card-container" data-product-id="5" data-brand-name="Nord" data-model="Nord-2"
            data-ram="4GB" data-price="250000">
            <div class="card">
              <div class="card-body text-center" onclick="mobiledes_five()">
                <h5 class="card-title  text-success" id="Nordname">Nord-Oneplus</h5>
                <img src="mobile/mob1.jpeg" class="img-fluid" id="Nordimage">
                <p class="card-text model-name" id="Nordmodel"><strong>Model:</strong><span id="n2">Nord-2</span></p>
                <p class="card-text" id="Samram">RAM:12GB</p>
                <p class="card-text" id="Samprice">Price:<span id="nordprice">20000&#8377;</span></p>
                <p class="card-text rating"><strong>Rating:</strong> 4.5/5</p>
              </div>
              <div class="d-flex justify-content-center">
                <button class="btn btn-primary  mb-3" id="addToCartBtn">Add</button>
                <button class="btn btn-danger mb-3" id="addToCartRemove" style="display:none">Remove</button>
              </div>
            </div>
          </div>

          <div class="col-sm-4 card-container" data-product-id="6" data-brand-name="vivo" data-model="vivo-y16"
            data-ram="4GB" data-price="10000">
            <div class="card">
              <div class="card-body text-center" onclick="mobiledes_six()">
                <h5 class="card-title  text-success" id="Vname">Vivo</h5>
                <img src="mobile/mob6.jpeg" class="img-fluid" id="Vimage">
                <p class="card-text model-name" id="Vmodel"><strong>Model:</strong><span id="y">vivo-y16</span></p>
                <p class="card-text" id="Vram">RAM:10GB</p>
                <p class="card-text">Price:<span id="vprice">30000&#8377;<span></p>
                <p class="card-text rating"><strong>Rating:</strong> 4/5</p>
              </div>
              <div class="d-flex justify-content-center">
                <button class="btn btn-primary  mb-3" id="addToCartBtn">Add</button>
                <button class="btn btn-danger mb-3" id="addToCartRemove" style="display:none">Remove</button>
              </div>
            </div>
          </div>
      </section>

      <!-- -------------------- -->
      <section id="ShowmobileDescriptionredmi" style="display:none">
        <div class="d-flex align-items-center justify-content-center" style="min-height:50vh;">
          <div class="card border-0" style="width: 25rem;" style="display:none;" class="mobileimage">
            <img src="mobile/red.jpeg" class="card-img-top" alt="Redmi 5A">
          </div>
          <div class="card-body" class="mobiledes" style="width: 35rem;">
            <h5 class="card-title center">Redmi 5A</h5>

            <ul class="list-group ">
              <li class="list-group-item border-0"><strong>Model:</strong> Redmi 5A</li>
              <li class="list-group-item border-0"><strong>RAM:</strong> 2GB/3GB (depending on variant)</li>
              <li class="list-group-item border-0"><strong>ROM:</strong> 16GB/32GB (depending on variant)</li>
              <li class="list-group-item border-0"><strong>Camera:</strong> 13MP rear camera, 5MP front camera</li>
              <li class="list-group-item border-0"><strong>Battery:</strong> 3000mAh</li>
              <li class="list-group-item border-0"><strong>Description</strong> Lorem ipsum dolor sit amet consectetur
                adipisicing elit. Suscipit hic iure illum ex ipsam possimus excepturi reprehenderit provident eaque
                nobis quis autem porro, architecto magni, non quia beatae sed dolorem?</li>

            </ul>
          </div>
        </div>
      </section>


      <section id="ShowmobileDescriptionReal" style="display:none">
        <div class="d-flex align-items-center justify-content-center" style="min-height:50vh;">
          <div class="card border-0" style="width:35rem;" id="realme" style="display:none;">
            <img src="mobile/real.jpeg" class="card-img-top" alt="Redmi 5A">
          </div>
          <div class="card-body">
            <h5 class="card-title">Realme</h5>
            <ul class="list-group ">
              <li class="list-group-item border-0"><strong>Model:</strong> Realme</li>
              <li class="list-group-item border-0"><strong>RAM:</strong> 2GB/3GB (depending on variant)</li>
              <li class="list-group-item border-0"><strong>ROM:</strong> 16GB/32GB (depending on variant)</li>
              <li class="list-group-item border-0"><strong>Camera:</strong> 13MP rear camera, 5MP front camera</li>
              <li class="list-group-item border-0"><strong>Battery:</strong> 3000mAh</li>
              <li class="list-group-item border-0"><strong>Description</strong> Lorem ipsum dolor sit amet consectetur
                adipisicing elit. Suscipit hic iure illum ex ipsam possimus excepturi reprehenderit provident eaque
                nobis quis autem porro, architecto magni, non quia beatae sed dolorem?</li>
            </ul>
          </div>
        </div>

      </section>

      <section id="ShowmobileDescriptionOne" style="display:none">
        <div class="d-flex align-items-center justify-content-center" style="min-height:50vh;">
          <div class="card border-0" style="width:35rem;" id="realme" style="display:none;">
            <img src="mobile/one11.jpeg" class="card-img-top" alt="Redmi 5A">
          </div>
          <div class="card-body">
            <h5 class="card-title">Oneplus</h5>

            <ul class="list-group ">
              <li class="list-group-item border-0"><strong>Model:</strong> Oneplus</li>
              <li class="list-group-item border-0"><strong>RAM:</strong> 2GB/3GB (depending on variant)</li>
              <li class="list-group-item border-0"><strong>ROM:</strong> 16GB/32GB (depending on variant)</li>
              <li class="list-group-item border-0"><strong>Camera:</strong> 13MP rear camera, 5MP front camera</li>
              <li class="list-group-item border-0"><strong>Battery:</strong> 3000mAh</li>
              <li class="list-group-item border-0"><strong>Description</strong> Lorem ipsum dolor sit amet consectetur
                adipisicing elit. Suscipit hic iure illum ex ipsam possimus excepturi reprehenderit provident eaque
                nobis quis autem porro, architecto magni, non quia beatae sed dolorem?</li>
            </ul>
          </div>

        </div>

      </section>


      <section id="ShowmobileDescriptionSam" style="display:none">
        <div class="d-flex align-items-center justify-content-center" style="min-height:50vh;">
          <div class="card border-0" style="width:35rem;" id="realme" style="display:none;">
            <img src="mobile/mob4.jpeg" class="card-img-top" alt="Redmi 5A">
          </div>
          <div class="card-body">
            <h5 class="card-title">Samsung</h5>

            <ul class="list-group ">
              <li class="list-group-item border-0"><strong>Model:</strong> Samsung</li>
              <li class="list-group-item border-0"><strong>RAM:</strong> 2GB/3GB (depending on variant)</li>
              <li class="list-group-item border-0"><strong>ROM:</strong> 16GB/32GB (depending on variant)</li>
              <li class="list-group-item border-0"><strong>Camera:</strong> 13MP rear camera, 5MP front camera</li>
              <li class="list-group-item border-0"><strong>Battery:</strong> 3000mAh</li>
              <li class="list-group-item border-0"><strong>Description</strong> Lorem ipsum dolor sit amet consectetur
                adipisicing elit. Suscipit hic iure illum ex ipsam possimus excepturi reprehenderit provident eaque
                nobis quis autem porro, architecto magni, non quia beatae sed dolorem?</li>
            </ul>
          </div>
        </div>

      </section>




      <section id="ShowmobileDescriptionNord" style="display:none">
        <div class="d-flex align-items-center justify-content-center" style="min-height:50vh;">
          <div class="card border-0" style="width:35rem;" id="realme" style="display:none;">
            <img src="mobile/mob5.jpeg" class="card-img-top" alt="Redmi 5A">
          </div>
          <div class="card-body">
            <h5 class="card-title">OneplusNord</h5>

            <ul class="list-group ">
              <li class="list-group-item border-0"><strong>Model:</strong> OneplusNord</li>
              <li class="list-group-item border-0"><strong>RAM:</strong> 2GB/3GB (depending on variant)</li>
              <li class="list-group-item border-0"><strong>ROM:</strong> 16GB/32GB (depending on variant)</li>
              <li class="list-group-item border-0"><strong>Camera:</strong> 13MP rear camera, 5MP front camera</li>
              <li class="list-group-item border-0"><strong>Battery:</strong> 3000mAh</li>
              <li class="list-group-item border-0"><strong>Description</strong> Lorem ipsum dolor sit amet consectetur
                adipisicing elit. Suscipit hic iure illum ex ipsam possimus excepturi reprehenderit provident eaque
                nobis quis autem porro, architecto magni, non quia beatae sed dolorem?</li>
            </ul>
          </div>
        </div>

      </section>



      <section id="ShowmobileDescriptionVivo" style="display:none">
        <div class="d-flex align-items-center justify-content-center" style="min-height:50vh;">
          <div class="card border-0" style="width:35rem;" id="realme" style="display:none;">
            <img src="mobile/mob6.jpeg" class="card-img-top" alt="Redmi 5A">
          </div>
          <div class="card-body">
            <h5 class="card-title">Vivo</h5>

            <ul class="list-group ">
              <li class="list-group-item border-0"><strong>Model:</strong> Vivo</li>
              <li class="list-group-item border-0"><strong>RAM:</strong> 2GB/3GB (depending on variant)</li>
              <li class="list-group-item border-0"><strong>ROM:</strong> 16GB/32GB (depending on variant)</li>
              <li class="list-group-item border-0"><strong>Camera:</strong> 13MP rear camera, 5MP front camera</li>
              <li class="list-group-item border-0"><strong>Battery:</strong> 3000mAh</li>
              <li class="list-group-item border-0"><strong>Description</strong> Lorem ipsum dolor sit amet consectetur
                adipisicing elit. Suscipit hic iure illum ex ipsam possimus excepturi reprehenderit provident eaque
                nobis quis autem porro, architecto magni, non quia beatae sed dolorem?</li>
            </ul>
          </div>
        </div>

      </section>

      <section style="display:none" id="appliancecontent" class="container-fluid mt-3">
        <h4 style="text-align:center; color:blue ;" id="appliancesSectionHeading">Applaices section</h4>
        <div class="row">
          <div class="col-sm-4">
            <div class="card" data-category="appliance">
              <div class="card-body text-center">
                <h5 class="card-title text-success">Pristege</h5>
                <img src="wash-3.avif" class="img-fluid">
                <p class="card-text model-name">Model: <span>Pristege Model-X</span></p>
                <p class="card-text">Price:<span>20000&#8377;<span></p>
                <p class="card-text rating"><strong>Rating:</strong> 4.5/5</p>
                <button class="btn  btn-primary btn-add-to-cart">Add</button>
                <button class="btn btn-danger" style="display:none">Remove</button>
              </div>
            </div>
          </div>

          <div class="col-sm-4">
            <div class="card" data-category="appliance">
              <div class="card-body text-center">
                <h5 class="card-title text-success">Butterfly</h5>
                <img src="wash-4.avif" class="img-fluid">
                <p class="card-text model-name">Model: <span>Butterfly Model-Y</span></p>
                <p class="card-text">Price:<span>10000&#8377;<span></p>
                <p class="card-text rating"><strong>Rating:</strong> 4.5/5</p>
                <button class="btn  btn-primary btn-add-to-cart">Add</button>
                <button class="btn btn-danger" style="display:none">Remove</button>
              </div>
            </div>
          </div>





          <div class="col-sm-4">
            <div class="card" data-category="appliance">
              <div class="card-body text-center">
                <h5 class="card-title text-success">LG</h5>
                <img src="wash-3.avif" class="img-fluid">
                <p class="card-text model-name">Model: <span>LG Model-Z</span></p>
                <p class="card-text">Price:<span>25000&#8377;<span></p>
                <p class="card-text rating"><strong>Rating:</strong> 4.5/5</p>
                <button class="btn  btn-primary btn-add-to-cart">Add</button>
                <button class="btn btn-danger" style="display:none">Remove</button>
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="card" data-category="appliance">
              <div class="card-body text-center">
                <h5 class="card-title text-success">Sony</h5>
                <img src="tv-1.avif" class="img-fluid">
                <p class="card-text model-name">Model: <span>Sony Bravia X900H</span></p>
                <p class="card-text">Price:<span>30000&#8377;<span></p>
                <p class="card-text rating"><strong>Rating:</strong> 4.5/5</p>
                <button class="btn  btn-primary btn-add-to-cart">Add</button>
                <button class="btn btn-danger" style="display:none">Remove</button>
              </div>
            </div>
          </div>

          <div class="col-sm-4">
            <div class="card" data-category="appliance">
              <div class="card-body text-center">
                <h5 class="card-title text-success">Samsung</h5>
                <img src="tv-2.avif" class="img-fluid">
                <p class="card-text model-name">Model: <span>Samsung QLED Q80T</span></p>
                <p class="card-text">Price:<span>33000&#8377;<span></p>
                <p class="card-text rating"><strong>Rating:</strong> 4.5/5</p>
                <button class="btn  btn-primary btn-add-to-cart">Add</button>
                <button class="btn btn-danger" style="display:none">Remove</button>
              </div>
            </div>
          </div>

          <div class="col-sm-4">
            <div class="card" data-category="appliance">
              <div class="card-body text-center">
                <h5 class="card-title text-success">LG</h5>
                <img src="tv-3.avif" class="img-fluid">
                <p class="card-text model-name">Model: <span>LG OLED C1</span></p>
                <p class="card-text">Price:<span>31000&#8377;<span></p>
                <p class="card-text rating"><strong>Rating:</strong> 4.5/5</p>
                <button class="btn  btn-primary btn-add-to-cart">Add</button>
                <button class="btn btn-danger" style="display:none">Remove</button>
              </div>
            </div>
          </div>
        </div>

      </section>

      <section id="carousel" style="width:99%; justify-content:center" class="container-fluid">

        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img class="d-block w-100" src="cc1.webp" alt="First slide">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100 " src="cc2.webp" alt="Second slide">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="cc3.webp" alt="Third slide">
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>

      </section>
      <section class="container-fluid">
        <div id="collection">
          <div class="image">
            <img src=two.jpg>
            <p style="text-align: center;font-weight: bold;">Max</p>
          </div>
          <div class="image">
            <img src=one.jpg>
            <p style="text-align: center;font-weight: bold;">CelvinKelvin</p>
          </div>
          <div class="image">
            <img src=r1.jpg>
            <p style="text-align: center;font-weight: bold;">Ramraj</p>
          </div>
          <div class="image">
            <img src=r2.jpg>
            <p style="text-align: center;font-weight: bold;">Otto</p>
          </div>
          <div class="image">
            <img src=r4.jpg>
            <p style="text-align: center;font-weight: bold;">Jocky</p>
          </div>
          <div class="image">
            <img src=r5.jpg>
            <p style="text-align: center;font-weight: bold;">PeterEngland</p>
          </div>
          <div class="image">
            <img src=r3.jpg>
            <p style="text-align: center;font-weight: bold;">Lenin</p>
          </div>
          <div class="image">
            <img src=puma.jpg>
            <p style="text-align: center;font-weight: bold;">Puma</p>
          </div>
        </div>
      </section>

      <section id="footer">
        <div class="footdiv">
          <li class="heading">About</li>
          <li>About Us</li>
          <li>Career</li>
          <li>E-commerse</li>
          <li>Online shoping</li>
        </div>
        <div class="help">
          <li class="heading">Help</li>
          <li>Contact number</li>
          <li>Career</li>
          <li>Flipkart Stories</li>
          <li>Email</li>
        </div>
        <div class="footdiv">
          <ul>
            <li class="heading">Consumer policy</li>
            <li>Returns </li>
            <li>Refunds</li>
            <li>Privacy Policy</li>
            <li>Product Warranty </li>
          </ul>
        </div>
        <div class="social">
          <li class="heading">Social</li>
          <li>Instagram</li>
          <li>LinkedIn</li>
          <li>Facebook</li>
          <li>Whatsup</li>
        </div>
        <div class="footdiv">
          <li class="heading">Address</li>
          <li>About Us</li>
          <li>Career</li>
          <li>Flipkart Stories</li>
          <li>Cleartrip</li>
        </div>
        <div class="contact">
          <li class="heading">Contact us</li>
          <li>Mobile</li>
          <li>Email</li>
          <li>Manager Mail</li>
          <li>Company Mail</li>

        </div>
      </section>

      <!-- <script src="./signup.js"></script> -->

    </div>
    <script src="ajaxindex.js"></script>
    <script src="update.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>


</body>

</html>