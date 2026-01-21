<?php
session_start();
require_once 'functions.php';
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$paginationData = messages($page);
$messages = $paginationData['messages'];
$currentPage = $paginationData['currentPage'];
$totalPages = $paginationData['totalPages'];
?>

<?php require('partials/head.php')?>
<?php require('partials/nav.php')?>

    <fieldset class="firstFieldset">
        <legend>Leave a message</legend>
        <?php if (isset($_SESSION['user_id'])): ?>
        <form method="POST">
            <textarea name="message" placeholder="Your message" maxlength="50" required></textarea><br><br>
            <button type="submit" name="submit">Send</button>
        </form>
        <?php else: ?>
            <p>In order to leave a message <a href="login.php">Log In</a> or <a href="register.php">Register</a></p>
        <?php endif;?>
        <fieldset class="secondFieldset">
            <legend>Messages</legend>
            <div class="messages">
                <?php if (empty($messages)): ?>
                    <p style="text-align: center; color: grey;">No messages yet. Be the first to leave a message!</p>
                <?php else: ?>
                    <?php foreach ($messages as $m): ?>
                        <strong><?= htmlspecialchars($m['username']) . "<br>" ?></strong>
                        <?= htmlspecialchars($m['message']) . "<br>" ?>
                        <em class="left"><?= $m['created_at'] ?></em><hr>
                    <?php endforeach ?>
                <?php endif; ?>
            </div>
            
            <?php if ($totalPages > 1): ?>
            <div class="pagination">
                <?php if ($currentPage > 1): ?>
                    <a href="?page=1" class="page-btn">« First</a>
                    <a href="?page=<?= $currentPage - 1 ?>" class="page-btn">‹ Previous</a>
                <?php endif; ?>
                    <span class="page-info">Page <?= $currentPage ?> of <?= $totalPages ?></span>
                <?php if ($currentPage < $totalPages): ?>
                    <a href="?page=<?= $currentPage + 1 ?>" class="page-btn">Next ›</a>
                    <a href="?page=<?= $totalPages ?>" class="page-btn">Last »</a>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </fieldset>
    </fieldset>

<?php require('partials/footer.php')?>