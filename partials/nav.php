<nav>
    <div class="register">
        <div class="home">
            <a href="index.php">Homepage</a>
        </div>
        <div class="about">
            <a href="about.php">About</a>
        </div>
        <?php if (!isset($_SESSION['user_id'])): ?> 
            <a href="login.php">Log In</a>
            <a href="register.php">Register</a>
        <?php else: ?>
            <a href="logout.php">Log Out</a>
        <?php endif; ?>
    </div>
</nav>