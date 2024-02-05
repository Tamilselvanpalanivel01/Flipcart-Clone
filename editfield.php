<?php
include('connection.php');
session_start();

if (isset($_SESSION['user_Data'])) {
    $userData = $_SESSION['user_Data'];


} else {
    echo json_encode(["error" => "User not logged in" ]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="d-flex align-items-center justify-content-center ">
    <div class="container  text-dark bg-opacity-10 ">
        <div class="row ">
            <div class="col-md-4"></div> 
            <div class="col-md-4 bg-white shadow-lg  rounded  border border-danger">
                <h1 class="text-center">Edit Your Details</h1>

                <form class="needs-validation was-validated " novalidate>

                    <div class="form-group">
                        <input id="uid" class="form-control" type="hidden" value="<?php echo isset($userData['ID']) ? $userData['ID'] : ''; ?>" required />
                        
                    </div>

                    <!-- <div class="form-group">
                         <label for="image">Image:</label>
                          <input id="image" class="form-control" type="file" accept="image/*" placeholder="Choose image" />
                         <div class="invalid-feedback">Please choose an image.</div>
                    </div> -->

                    <div class="form-group">
                        <label for="snaam">First Name:</label>
                        <input id="snaam" class="form-control" type="text" placeholder="Enter your Firstname" value="<?php echo isset($userData['USER_NAME']) ? $userData['USER_NAME'] : ''; ?>" required />
                        <div class="invalid-feedback">Please enter your name.</div>
                    </div>


                    <div class="form-group">
                        <label for="sphone">Mobile Number:</label>
                        <input id="sphone" class="form-control" type="text" placeholder="Enter Mobile Number" maxlength="10" value="<?php echo isset($userData['MOBILE_NUM']) ? $userData['MOBILE_NUM'] : ''; ?>" required />
                        <div class="invalid-feedback">Please enter a valid 10-digit mobile number.</div>
                    </div>

                    <div class="form-group">
                        <label for="sgmail">Email:</label>
                        <input id="sgmail" class="form-control" type="email" placeholder="Enter email" value="<?php echo isset($userData['EMAIL']) ? $userData['EMAIL'] : ''; ?>" required />
                        <div class="invalid-feedback">Please enter a valid email.</div>
                    </div>

                    <div class="form-group">
                       <label for="spass">Password:</label>
                            <div class="input-group">
                            <input id="spass" class="form-control" type="password" placeholder="Enter Password" required value="<?php echo isset($userData['PASS_WORD']) ? $userData['PASS_WORD'] : ''; ?>" />
                             <div class="input-group-append">
                            <span class="input-group-text">
                            <i class="fas fa-eye" onclick="eye()"id="cEye"></i>
                            </span>
                        </div>
                      </div>
                         <div class="invalid-feedback">Please enter a password.</div>
                    </div>

                    <div class="form-group">
                        <label for="cspass">Re-enter Password:</label>
                        <div class="input-group">
                        <input id="cspass" class="form-control" type="password" placeholder="Re-Enter Password" required value="<?php echo isset($userData['CONFIRM_PASSWORD']) ? $userData['CONFIRM_PASSWORD'] : ''; ?>" />
                        <div class="input-group-append">
                            <span class="input-group-text">
                            <i class="fas fa-eye" onclick="eye1()" id="cEye1"></i>
                            </span>
                        </div>
                        </div>
                        <div class="invalid-feedback">Please re-enter your password.</div>
                    </div>

                    <div class="form-group">
                        <label for="DOB">Date of Birth:</label>
                        <input id="DOB" class="form-control" type="date" required value="<?php echo isset($userData['DOB']) ? $userData['DOB'] : ''; ?>" />
                        <div class="invalid-feedback">Please enter your date of birth.</div>
                    </div>

                    <div class="form-group">
                        <label>Gender:</label>
                        <div class="form-check form-check-inline">
                            <input id="male" class="form-check-input" type="radio" name="gender" value="Male" <?php echo (isset($userData['GENDER']) && $userData['GENDER'] === 'Male') ? 'checked' : ''; ?> required />
                            <label class="form-check-label" for="male">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input id="female" class="form-check-input" type="radio" name="gender" value="Female" <?php echo (isset($userData['GENDER']) && $userData['GENDER'] === 'Female') ? 'checked' : ''; ?> required />
                            <label class="form-check-label" for="female">Female</label>
                        </div>
                        <div class="invalid-feedback">Please select your gender.</div>
                    </div>
                    <div class="form-group text-center">
                        <button class="btn btn-primary" type="button" onclick="updateUserData()">Update</button>
                    </div>

                </form>
            </div>
            <div class="col-md-4"></div> 
        </div>
    </div> 

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="update.js"></script>

    <script>







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


    </script>
</body>
</html>


