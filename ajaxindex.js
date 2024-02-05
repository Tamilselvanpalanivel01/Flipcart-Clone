
function Signup() {
    var username = document.getElementById("snaam").value;
    var mobile = document.getElementById("sphone").value;
    var password = document.getElementById("spass").value;
    var cpassword = document.getElementById("cspass").value;
    var email = document.getElementById("sgmail").value;
    var DOB = document.getElementById("DOB").value;
    var gender = document.querySelector('input[name="gender"]:checked');
    var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    var passwordPattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]).{8,}$/;


    $("#nameerror").text("");
    $("#lastnameerror").text("");
    $("#mobileerror").text("");
    $("#emailerror").text("");
    $("#passworderror").text("");
    $("#DOBerror").text("");
    $("#gendererror").text("");
    $("#passworderror").text("");

    if (username == "") {
        $("#nameerror").text("Please enter your name");
        $("#nameerror").css("color", "red");
        return;
    }
    else if (mobile === "" || !/^\d{10}$/.test(mobile)) {
        $("#mobileerror").text("Please enter a valid 10-digit mobile number");
        $("#mobileerror").css("color", "red");
        return;
    }

    else if (email == "") {
        $("#emailerror").text("Please enter email");
        $("#emailerror").css("color", "red");
        return;
    }
    else if (!emailPattern.test(email)) {
        $("#emailerror").text("Please enter a valid email");
        $("#emailerror").css("color", "red");
        return;
    }
    else if (password == "") {
        $("#passworderror").text("Please enter password");
        $("#passworderror").css("color", "red");
        return;
    }
    else if (!passwordPattern.test(password)) {
        $("#passworderror").text("Please enter valid password");
        $("#passworderror").css("color", "red");
        return;
    }
    else if (cpassword == "") {
        $("#rpassworderror").text("Please re-enter password");
        $("#rpassworderror").css("color", "red");
        return;
    }
    else if (cpassword !== password) {
        $("#rpassworderror").text("Please re-enter password mismatch");
        $("#rpassworderror").css("color", "red");
        return;
    }

    else if (DOB == "") {
        $("#DOBerror").text("Please enter date of birth");
        $("#DOBerror").css("color", "red");
        return;
    }
    else if (!gender) {
        $("#gendererror").text("Please select gender");
        $("#gendererror").css("color", "red");
        return;
    }
    else {
        var newUser = {
            username: username,
            email: email,
            mobile: mobile,
            password: password,
            cpassword: cpassword,
            DOB: DOB,
            gender: gender.value,
        };


        $.ajax({
            type: 'POST',
            url: 'insert.php',
            data: newUser,
            success: function (response) {
                if (response.includes('User already exists')) {
                    alert('User already exists signup with new credentails')
                    document.getElementById("snaam").value = "";
                    document.getElementById("sphone").value = "";
                    document.getElementById("spass").value = "";
                    document.getElementById("sgmail").value = "";
                    document.getElementById("DOB").value = "";
                    document.getElementById("cspass").value = "";
                    document.querySelector('input[name="gender"]:checked').checked = false;
                    document.getElementById("outerbox").style.display = 'block';

                }
                else {
                    alert(response);
                    document.getElementById("snaam").value = "";
                    document.getElementById("sphone").value = "";
                    document.getElementById("spass").value = "";
                    document.getElementById("sgmail").value = "";
                    document.getElementById("DOB").value = "";
                    document.getElementById("cspass").value = "";
                    document.querySelector('input[name="gender"]:checked').checked = false;
                    document.getElementById("outerbox").style.display = 'none';
                    document.getElementById("innerbox").style.display = 'block';    
                }


            },
        });
    }
}




document.getElementById("snaam").addEventListener("input", function () {
    $("#nameerror").text("");
});

document.getElementById("sphone").addEventListener("input", function () {
    $("#mobileerror").text("");
});

document.getElementById("sgmail").addEventListener("input", function () {
    $("#emailerror").text("");
});

document.getElementById("spass").addEventListener("input", function () {
    $("#passworderror").text("");
});

document.getElementById("DOB").addEventListener("input", function () {
    $("#DOBerror").text("");
});
document.getElementById("cspass").addEventListener("input", function () {
    $("#rpassworderror").text("");
});

function clearSignupFields() {
    $('#snaam, #sphone, #sgmail, #spass, #cspass, #DOB').val('');

    $('#male, #female').prop('checked', false);

    $('#nameerror, #mobileerror, #emailerror, #passworderror, #rpassworderror, #DOBerror, #gendererror').html('');
}

function clearLoginFields() {
    $('#lphone, #lpass').val('');
    $('#lmerror, #lperror').html('');
}


function home() {
    window.location.href = "index.php";
}

function Signin() {
    let lmobile = document.getElementById("lphone").value;
    let passwordElement = document.getElementById("lpass").value;


    if (lmobile.length !== 10) {
        $("#lmerror").text("Mobile number should be of 10 digits");
        $("#lmerror").css("color", "red");
    } else if (lmobile.length === 0) {
        $("#lmerror").text("Enter Mobile Number");
        $("#lmerror").css("color", "red");
    } else if (passwordElement === "") {
        $("#lperror").text("Enter password");
        $("#lperror").css("color", "red");
    } else {
        $.ajax({
            type: "POST",
            url: "login.php",
            data: {
                mobile: lmobile,
                password: passwordElement
            },
            success: function (response) {
                try {
                    var responseData = JSON.parse(response);
                    if (responseData.status === "success") {
                        var userName = responseData.username;
                        $("#profile").html('<i class="fa-regular fa-user" style="margin: 5px;"></i>' + userName);
                        var addIdValue = responseData.addid;
                        $("#addIdInput").val(addIdValue);
                        toggleShopIcon(addIdValue);
                        // displayCartItems();
                        window.location.href = 'index.php'
                    } else if (responseData.status === "failure") {
                        alert("Invalid credentials. Please try again.");
                    } else if (responseData.status === "user_not_found") {
                        alert("User does not exist. Please sign up.");
                    } else {
                        console.log("Unexpected response:", response);
                    }
                } catch (e) {
                    console.log("Error parsing JSON response:", e);
                }
            }

        });


        return false;

    }
}


document.getElementById("lphone").addEventListener("input", function () {
    $("#lmerror").text("");
});

document.getElementById("lpass").addEventListener("input", function () {
    $("#lperror").text("");
});

function toggleSections() {
    var signupBox = document.getElementById('outerbox');
    var loginBox = document.getElementById('innerbox');

    if (signupBox.style.display === 'none') {
        signupBox.style.display = 'block';
        loginBox.style.display = 'none';
        clearSignupFields()

    } else {
        signupBox.style.display = 'none';
        loginBox.style.display = 'block';
        clearLoginFields()

    }
}


function eye() {
    var passwordInput = $("#spass");
    var eyeIcon = $("#cEye");

if (passwordInput.attr("type") === "password") {
    passwordInput.attr("type", "text");
    eyeIcon.removeClass("fas fa-eye").addClass("fas fa-eye-slash");
} else {
    passwordInput.attr("type", "password");
    eyeIcon.removeClass("fas fa-eye-slash").addClass("fas fa-eye");
}
};


function eye1() {
    var passwordInput = $("#cspass");
    var eyeIcon = $("#cEye1");

if (passwordInput.attr("type") === "password") {
    passwordInput.attr("type", "text");
    eyeIcon.removeClass("fas fa-eye").addClass("fas fa-eye-slash");
} else {
    passwordInput.attr("type", "password");
    eyeIcon.removeClass("fas fa-eye-slash").addClass("fas fa-eye");
}
};

$(document).ready(function () {
    var addIdValue = $("#addIdInput").val();
    toggleShopIcon(addIdValue);
});
function toggleShopIcon(addIdValue) {
    var shopIcon = $("#shop");

    if (addIdValue > 0) {

        shopIcon.show();
    } else {

        shopIcon.hide();
    }
}


function signOut() {
    $.ajax({
        type: "POST",
        url: "singout.php",
        success: function (response) {

            if (response === 'success') {
                $("#sigin_button").hide();
                $("#shop").hide();
                $("#profile").hide();
            }
            else {
                alert("logout failure")

            }
        },
        error: function (error) {
            console.log("Error:", error);
        }
    });

}


$('#signout').one('click', function (e) {
    e.preventDefault();
    var confirmLogout = confirm('Are you sure you want to log out?');

    if (confirmLogout) {
        window.location.reload();
        signOut();
    }
});


window.addEventListener('load', function () {
    const userid = document.getElementById('useid').value;
    if (userid) {
        const userName = document.getElementById('use').value;
        $("#sigin_button").hide();
        $("#signout").show();
        $("#profile").html('<i class="fa-regular fa-user" style="margin: 5px;"></i>' + userName);
    } else {

        $("#sigin_button").show();
        $(".navtab button#signout").hide();
        $(".navtab #profile").html("");
    }
});


$('#profile').click(function (e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "edit.php",

        success: function (response) {
            try {
                if (response.includes("error")) {
                    console.error("Error:", response.error);
                } else {
                    window.location.href = 'editfield.php';
                }
            } catch (error) {
                console.error('JSON Parsing Error:', error);
            }
        },
        error: function (xhr, status, error) {
            console.error(error);
        }
    });
});




function mobiledes_one() {
    document.getElementById('carousel').style.display = 'none';
    document.getElementById('collection').style.display = 'none';
    document.getElementById('mobilecontent').style.display = 'none';
    document.getElementById('ShowmobileDescriptionNord').style.display = 'none';
    document.getElementById('ShowmobileDescriptionSam').style.display = 'none';
    document.getElementById('ShowmobileDescriptionReal').style.display = 'none';
    document.getElementById('ShowmobileDescriptionOne').style.display = 'none';
    document.getElementById('ShowmobileDescriptionVivo').style.display = 'none';
    document.getElementById('ShowmobileDescriptionredmi').style.display = 'block';

}



function mobiledes_two() {
    document.getElementById('carousel').style.display = 'none';
    document.getElementById('collection').style.display = 'none';
    document.getElementById('mobilecontent').style.display = 'none';
    document.getElementById('ShowmobileDescriptionNord').style.display = 'none';
    document.getElementById('ShowmobileDescriptionSam').style.display = 'none';
    document.getElementById('ShowmobileDescriptionReal').style.display = 'block';
    document.getElementById('ShowmobileDescriptionOne').style.display = 'none';
    document.getElementById('ShowmobileDescriptionVivo').style.display = 'none';
    document.getElementById('ShowmobileDescriptionredmi').style.display = 'none';

}

function mobiledes_three() {
    document.getElementById('carousel').style.display = 'none';
    document.getElementById('collection').style.display = 'none';
    document.getElementById('mobilecontent').style.display = 'none';
    document.getElementById('ShowmobileDescriptionNord').style.display = 'none';
    document.getElementById('ShowmobileDescriptionSam').style.display = 'none';
    document.getElementById('ShowmobileDescriptionReal').style.display = 'none';
    document.getElementById('ShowmobileDescriptionOne').style.display = 'block';
    document.getElementById('ShowmobileDescriptionVivo').style.display = 'none';
    document.getElementById('ShowmobileDescriptionredmi').style.display = 'none';

}



function mobiledes_four() {
    document.getElementById('carousel').style.display = 'none';
    document.getElementById('collection').style.display = 'none';
    document.getElementById('mobilecontent').style.display = 'none';
    document.getElementById('ShowmobileDescriptionredmi').style.display = 'none';
    document.getElementById('ShowmobileDescriptionReal').style.display = 'none';
    document.getElementById('ShowmobileDescriptionredmi').style.display = 'none';
    document.getElementById('ShowmobileDescriptionOne').style.display = 'none';
    document.getElementById('ShowmobileDescriptionVivo').style.display = 'none';
    document.getElementById('ShowmobileDescriptionSam').style.display = 'block';

}

function mobiledes_five() {
    document.getElementById('carousel').style.display = 'none';
    document.getElementById('collection').style.display = 'none';
    document.getElementById('mobilecontent').style.display = 'none';
    document.getElementById('ShowmobileDescriptionVivo').style.display = 'none';
    document.getElementById('ShowmobileDescriptionReal').style.display = 'none';
    document.getElementById('ShowmobileDescriptionredmi').style.display = 'none';
    document.getElementById('ShowmobileDescriptionOne').style.display = 'none';
    document.getElementById('ShowmobileDescriptionSam').style.display = 'none';
    document.getElementById('ShowmobileDescriptionNord').style.display = 'block';

}


function mobiledes_six() {
    document.getElementById('carousel').style.display = 'none';
    document.getElementById('collection').style.display = 'none';
    document.getElementById('mobilecontent').style.display = 'none';
    document.getElementById('ShowmobileDescriptionReal').style.display = 'none';
    document.getElementById('ShowmobileDescriptionredmi').style.display = 'none';
    document.getElementById('ShowmobileDescriptionOne').style.display = 'none';
    document.getElementById('ShowmobileDescriptionSam').style.display = 'none';
    document.getElementById('ShowmobileDescriptionNord').style.display = 'none';
    document.getElementById('ShowmobileDescriptionVivo').style.display = 'block';


}

function hideCards(hiddenCards) {
    $('.card').each(function () {
        var model = $(this).find('.model-name span').text().trim();

        if (hiddenCards.includes(model)) {
            $(this).closest('.col-sm-4').hide();
            $('#carousel, #collection').hide();
        } else {
            $(this).closest('.col-sm-4').show();
        }
    });
}


function showMobileSection() {

    var useraddid = document.getElementById('addIdInput').value;
    if (parseInt(useraddid) > 0) {
        var hiddenCards = JSON.parse($('#useModelArray').val());
        hideCards(hiddenCards);
        document.getElementById('carousel').style.display = 'none';
        document.getElementById('collection').style.display = 'none';
        document.getElementById('mobilecontent').style.display = 'block';
        document.getElementById('addToCartRemove').style.display = 'none';
        document.getElementById('ShowmobileDescriptionredmi').style.display = 'none';
        document.getElementById('ShowmobileDescriptionSam').style.display = 'none';
        document.getElementById('ShowmobileDescriptionNord').style.display = 'none';
        document.getElementById('ShowmobileDescriptionVivo').style.display = 'none';
        document.getElementById('appliancecontent').style.display = 'none';
        document.getElementById('ShowmobileDescriptionOne').style.display = 'none';
        document.getElementById('ShowmobileDescriptionReal').style.display = 'none';
    }

    else {
        document.getElementById('carousel').style.display = 'none';
        document.getElementById('collection').style.display = 'none';
        document.getElementById('mobilecontent').style.display = 'block';
        document.getElementById('ShowmobileDescriptionredmi').style.display = 'none';
        document.getElementById('ShowmobileDescriptionSam').style.display = 'none';
        document.getElementById('ShowmobileDescriptionNord').style.display = 'none';
        document.getElementById('ShowmobileDescriptionVivo').style.display = 'none';
        document.getElementById('appliancecontent').style.display = 'none';
        document.getElementById('ShowmobileDescriptionOne').style.display = 'none';
        document.getElementById('ShowmobileDescriptionReal').style.display = 'none';
    }
}

var userModelArray = JSON.parse($('#useModelArray').val());
function showAppliancesSection() {
     var userModelArray = JSON.parse($('#useModelArray').val());
    document.getElementById('carousel').style.display = 'none';
    document.getElementById('collection').style.display = 'none';
    document.getElementById('mobilecontent').style.display = 'none';
    document.getElementById('appliancecontent').style.display = 'block';

     displayAllAppliancesExceptCarted(userModelArray);
}

function displayAllAppliancesExceptCarted(userModelArray) {
    if (userModelArray && Array.isArray(userModelArray)) {
        $('.card').each(function () {
            var model = $(this).find('.model-name span').text().trim();
            if (!userModelArray.includes(model)) {
                $(this).closest('.col-sm-4').show();
                $(this).find('.btn').show();
                $(this).find('.btn-danger').hide();
            } else {
                $(this).closest('.col-sm-4').hide();
            }
        });
    } else {
        console.error('Invalid or undefined userModelArray');
    }
}

$("#shop").on("click", function () {
    var userModelArray = JSON.parse($('#useModelArray').val());
    document.getElementById('mobilecontent').style.display = 'block';
    document.getElementById('appliancecontent').style.display = 'block';
    document.getElementById('mobileSectionHeading').style.display = "none";
    document.getElementById('appliancesSectionHeading').style.display = "none";

    if (userModelArray && Array.isArray(userModelArray)) {
        $('.card').each(function () {
            var model = $(this).find('.model-name span').text().trim();
            if (userModelArray.includes(model)) {
                $(this).closest('.col-sm-4').show();
                $(this).find('.btn').hide();
                $(this).find('.btn-danger').show();
            } else {
                $(this).closest('.col-sm-4').hide();
            }
        });
        $('#carousel, #collection').hide(); // Hide other sections
    } else {
        console.error('Invalid or undefined userModelArray');
    }
});

// function displayCartItems(userModelArray) {
//     console.log(userModelArray)
//     if (userModelArray && Array.isArray(userModelArray)) {
//         $('.card').each(function () {
//             var model = $(this).find('.model-name span').text().trim();
//             if (userModelArray.includes(model)) {
//                 $(this).closest('.col-sm-4').show();
//                 $(this).find('.btn').hide();
//                 $(this).find('.btn-danger').show();
//             } else {
//                 $(this).closest('.col-sm-4').hide();
//             }
//         });
//         $('#carousel, #collection').hide(); // Hide other sections
//     } else {
//         console.error('Invalid or undefined userModelArray');
//     }

// }

function updateUIAfterRemoval(cartItems) {
    $('.card').filter(function () {
        var cardModel = $(this).find('.model-name span').text().trim();
        return cartItems.includes(cardModel);
    }).closest('.col-sm-4').hide();
}


var isCartEmpty;
function toggleCartVisibility() {
    var shopElement = $("#shop");
    if (isCartEmpty) {
        shopElement.hide();
    } else {
        shopElement.show();
    }
}

function fetchAndUpdateCartStatus() {
    $.ajax({
        type: 'POST',
        url: 'getcartstatus.php',
        dataType: 'json',
        success: function (response) {
            isCartEmpty = response.isEmpty;
            toggleCartVisibility();
        },
        error: function (error) {
            console.error(error);
            alert('Failed to fetch cart status!');
        }
    });
}

$(document).ready(function () {
    $('.btn-primary').on('click', function () {
        var productContainer = $(this).closest('.card');
        var itemName = productContainer.find('.card-title').text().trim();
        var model = productContainer.find('.model-name span').text().trim();
        var ram = productContainer.find('.card-text:contains("RAM") span').text().trim();
        var price = productContainer.find('.card-text:contains("Price") span').text().trim();

        $.ajax({
            type: 'POST',
            url: 'inserttocart.php',
            data: {
                itemName: itemName,
                model: model,
                ram: ram,
                price: price
            },
            success: function (response) {
                alert('Item added to cart!');
                productContainer.closest('.col-sm-4').hide();
                $("#shop").show();
                fetchAndUpdateCartStatus();
                location.reload();
            },
            error: function (error) {
                console.error(error);
                alert('Failed to add item to cart!');

            }
        });
    });


    $('.btn-danger').on('click', function () {
        var productContainer = $(this).closest('.card');
        var model = productContainer.find('.model-name span').text().trim();

        $.ajax({
            type: 'POST',
            url: 'removecart.php',
            data: {
                model: model
            },
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    updateUIAfterRemoval(response.cartItems);
                    isCartEmpty = response.isEmpty;
                    toggleCartVisibility();
                    alert('Item removed from cart!');
                    $('#mobilecontent').hide();
                    $('#carousel').show();
                    $('#collection').show();
                    productContainer.closest('.col-sm-4').hide();
                    toggleShopIcon(response.cartItems.length);
                    fetchAndUpdateCartStatus();
                    location.reload();
                } else {
                    alert('Failed to remove item from cart: ' + response.message);
                }
            },
            error: function (error) {
                console.error(error);
                alert('Failed to remove item from cart!');
            }
        });
    });
    fetchAndUpdateCartStatus();
});
