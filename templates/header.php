
<!-- simple header -->
<header>
    <!-- company name -->
    <h2>LoginLogout Inc.</h2>
    <!-- navigation -->
    <nav>
        <menu>
            <!-- use php to generate different link if the user is logged in or not -->
            <?php
                // get the session
                session_start();
                // check if the user is logged in, if so, show the log out link and the link to the LogInSuccess page
                if (isset($_SESSION['username'])) {
                    echo "<li><a href='./LogOut.php'>Log Out</a></li>";
                    echo "<li><a href='./LogInSuccess.php'>Home</a></li>";
                }
                // if the user is not logged in, show the create account and log in links
                else {
                    echo '<li><a href="./SignIn.php#createAccount">Create Account</a></li>';
                    echo '<li><a href="./SignIn.php#LogIn">Log In</a></li>';
            
                }         
            ?>
            
            
        </menu>
    </nav>
</header>