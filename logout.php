<?php if(isset($_GET['logout'])): ?>
	<?php session_destroy(); ?>
	<?php unset($_SESSION['username']); ?>
	<?php header('location: index.php'); ?>
<?php endif ?>