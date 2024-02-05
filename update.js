

function updateUserData() {
    // var image = $("#image")[0].files[0];
    var firstName = $("#snaam");
    var firstName = $("#snaam");
    var mobile = $("#sphone");
    var email = $("#sgmail");
    var password = $("#spass");
    var confirmPassword = $("#cspass");
    var dob = $("#DOB");
    var genderMale = $("#male");
    var genderFemale = $("#female");




    // if (!image) {
    //     $("#image").addClass('is-invalid');
    //     return;
    // } else {
    //     $("#image").removeClass('is-invalid');
    // }



    if (firstName.val() === '') {
        $("#snaam").addClass('is-invalid');
        return;
    } else {
        $("#snaam").removeClass('is-invalid');
    }

    if (mobile.val() === '' || !/^\d{10}$/.test(mobile.val())) {
        $("#sphone").addClass('is-invalid');
        return;
    } else {
        $("#sphone").removeClass('is-invalid');
    }

    if (email.val() === '' || !email[0].checkValidity()) {
        $("#sgmail").addClass('is-invalid');
        return;
    } else {
        $("#sgmail").removeClass('is-invalid');
    }

    if (password.val() === '' || !password[0].checkValidity()) {
        $("#spass").addClass('is-invalid');
        return;
    } else {
        $("#spass").removeClass('is-invalid');
    }

    if (confirmPassword.val() === '' || !confirmPassword[0].checkValidity() || confirmPassword.val() !== password.val()) {
        $("#cspass").addClass('is-invalid');
        return;
    } else {
        $("#cspass").removeClass('is-invalid');
    }

    if (dob.val() === '' || !dob[0].checkValidity()) {
        $("#DOB").addClass('is-invalid');
        return;
    } else {
        $("#DOB").removeClass('is-invalid');
    }

    if (!genderMale.is(":checked") && !genderFemale.is(":checked")) {
        $("#male").addClass('is-invalid');
        $("#female").addClass('is-invalid');
        return;
    } else {
        $("#male").removeClass('is-invalid');
        $("#female").removeClass('is-invalid');
    }

    var editedData = {
        // image: image,
        userId: $("#uid").val(),
        firstname: firstName.val(),
        mobile: mobile.val(),
        email: email.val(),
        password: password.val(),
        conformpass: confirmPassword.val(),
        DOB: dob.val(),
        gender: $("input[name='gender']:checked").val(),

    };

    var formData = new FormData();
    for (var key in editedData) {
        formData.append(key, editedData[key]);

    }
    $.ajax({
        type: "POST",
        url: "updated.php",
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            console.log("Update successful:", response);
            alert("Updated successfully");

            window.location.href = 'index.php';
        }
    });
}

