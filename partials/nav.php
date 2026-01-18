<nav>
    <div class="register">
        <div class="home">
            <a href="index.php">Homepage</a>
        </div>
        <div class="about">
            <a href="about.php">About</a>
        </div>
        <div class="log">
            <?php 
            if (isset($_SESSION['user_id'])) {
                echo "<a href='logout.php'>Log Out</a>";
            } else {
                echo "<a href='login.php'>Log In</a>";
            }
            ?>
        </div>
        <div class="reg">
            <a href="register.php">Register</a>
        </div>
    </div>
</nav>