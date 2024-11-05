$(document).ready(function () {
    // Validate username
    $("#username").on('keyup', function () {
        let username = $(this).val();
        if (username.length >= 3) {
            $.ajax({
                url: 'check_username.php', // Path to your server-side script
                method: 'POST',
                data: { username: username },
                success: function (response) {
                    if (response == "taken") {
                        $("#username-status").html("Username is already taken").addClass("text-danger").removeClass("text-success");
                    } else {
                        $("#username-status").html("Username is available").addClass("text-success").removeClass("text-danger");
                    }
                }
            });
        } else {
            $("#username-status").html(""); // Clear status if length is less than 3
        }
    });

    // Validate email
    $("#email").on('keyup', function () {
        let email = $(this).val();
        if (email.length >= 5) {
            $.ajax({
                url: 'check_email.php', // Path to your server-side script
                method: 'POST',
                data: { email: email },
                success: function (response) {
                    if (response == "taken") {
                        $("#email-status").html("Email is already registered").addClass("text-danger").removeClass("text-success");
                    } else {
                        $("#email-status").html("Email is available").addClass("text-success").removeClass("text-danger");
                    }
                }
            });
        } else {
            $("#email-status").html(""); // Clear status if length is less than 5
        }
    });
});
