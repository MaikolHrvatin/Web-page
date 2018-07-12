<?php if(count($errors) > 0): ?>
	<?php foreach($errors as $error): ?>
		<p><?php echo "<p class='alert alert-danger'>".$error."</p>"; ?></p>
	<?php endforeach ?>
<?php endif ?>