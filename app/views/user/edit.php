<?php build('content') ?>
	
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Edit User</h4>
			<?php echo wLinkDefault(_route('user:show', $id), 'Cancel Edit', [
				'icon' => 'x-circle'
			])?>

			<?php echo wLinkDefault(_route('user:delete', $id, [
				'returnTo'=> seal(_route('user:index'))
			]), 'Delete User', [
				'icon' => 'x-circle',
				'class' => 'btn btn-danger form-verify',
			])?>
		</div>

		<div class="card-body">
			<?php Flash::show()?>

			<h5>USER ID : <?php echo $user->user_identification?></h5>
			<?php echo $user_form->start()?>
			<?php echo $user_form->getFormItems()?>
				<input type="submit" name="" class="btn btn-primary btn-sm" value="Save Changes">
			<?php echo $user_form->end()?>
		</div>
	</div>
<?php endbuild()?>
<?php loadTo()?>