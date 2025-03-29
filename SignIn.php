<!DOCTYPE html>
<html lang="en">
<head>
    <!-- all meta data -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Landing page">
    <meta name="robots" content="noindex, nofollow">
    <meta name="author" content="Kai Thompson">
    <title>Home</title>
    <!-- link to the css file -->
    <link rel="stylesheet" href="./css/styles.css">
    <!-- link to font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
<!-- add the header -->
<?php
include './templates/header.php';
?>
<main>
    <!-- 2 very basic login / create account forms -->

    <!-- id for links -->
    <h2  id="LogIn">Log In</h2>
    <!-- form for login -->
    <!-- method is post, action is the same page -->
    <form method="POST">
        <!-- hidden input to determine which form is being submitted -->
        <input type="hidden" value="signIn" name="hidden">
        <!-- divs for each question, holding a label and the input -->
        <div>
            <label for="username2">Username: </label>
            <input type="text" placeholder="Username" id="username2" name="username" required>
        </div>
        <div>
            <label for="password2">Password: </label>
            <input type="password" placeholder="Password" id="password2" name="password" required>
        </div>
        <input type="submit" name="submit" id="submit1">
    </form>
    <!-- second header and form for creating an account -->
    <h2 id="createAccount">Create Account</h2>
    <form method="POST">
        <!-- hidden input to determine which form is being submitted -->
        <input type="hidden" name="hidden" value="createAccount">
        <!-- divs for each question, holding a label and the input, same as above -->
        <div>
            <label for="username1">Username: </label>
            <input type="text" placeholder="Username" id="username1" name="username" required>
        </div>
        <div>
            <label for="password1">Password: </label>
            <input type="password" placeholder="Password" id="password1" name="password" required>
        </div>
        <div>
            <label for="repeatPassword">Repeat Password: </label>
            <input type="password" placeholder="Repeat Password" id="repeatPassword" name="repeatPassword" required>
        </div>

        <input type="submit" name="submit" id="submit2">
    </form>
    <!-- php to hold the bulk of the logic -->
    <?php
        // include the crud class, which handles the database connection and queries
        require_once 'crud.php';
        // include the validate class, which handles the validation of the input
        require_once 'validate.php';
        // create a new crud and validate object
        $crud = new crud();
        $validate = new Validate();
        // check if the form has been submitted
        if(isset($_POST['submit'])) {
            // get the username and password from the form, and real escape them to prevent sql injection
            $username = $crud->sanatise($_POST['username']);
            $password = $crud->sanatise($_POST['password']);
            // ensure the username and password are valid using the validate class
            if (!$validate->isValidUsername($username)) 
            {
                echo "<h3>Ensure the username is only letters and numbers and is at least 3 characters long!</h3>";
            }
            elseif (!$validate->isValidPassword($password)) 
            {
                echo "<h3>Ensure the password is at least 6 characters long!</h3>";
            }
            // if both are valid, depending on which form was submitted, either create an account or log in
            else if ($_POST['hidden'] == "signIn") {
                // make an sql query to get the password hash from the database for the inputted username
                $query = "SELECT password FROM users WHERE username = '$username'";
                // send to database via the crud class and get the response
                $response = $crud->read($query);
                // is there is a user with that username, check the password
                if ($response->num_rows > 0)
                {
                    // fetch the password hash from the database and check if the hash matches the inputted password
                    if ($response->fetch_assoc()["password"] == hash("sha512",$password))
                    {
                        // if the password matches, start a session and redirect to the success page
                        // checks is a session is already started, (stems from header starting sessions to add extra links)
                        if (session_status() == PHP_SESSION_NONE) {
                            session_start();
                        }
                        $_SESSION['username'] = $username;
                        header("Location: ./LogInSuccess.php");
                    }
                    // if the password does not match, show an error message
                    else {
                        echo "<h3>Wrong password!</h3>";
                    }
                }
                // if there is no user with that username, show an error message
                else
                {
                    echo "<h3>User does not exist!</h3>";
                }
            }
            // if the form submitted was the create account form
            elseif ($_POST['hidden'] == "createAccount") {
                // get the repeat password field and check if it matches the password input
                $repeatPassword = $crud->sanatise($_POST['repeatPassword']);
                if ($password == $repeatPassword) {
                    // if it does match, hash the password and create the account
                    $password = hash('sha512', $password);
                    $query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
                    if ($crud->create($query)) {
                        // if the account was created successfully, show a success message
                        echo "<h4>Create User Successful!</h4>";
                    }
                    // if the account was not created successfully, show an error message
                    else {
                        echo "<h3>Create Failed!</h3>";
                    }
                }
                // if the passwords do not match, show an error message
                else {
                    echo "<h3>Passwords do not match!</h3>";
                }
            }
        }
    ?>
</main>
<!-- add the footer -->
<?php
include './templates/footer.php';
?>
</body>
</html>