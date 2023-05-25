<?php build('content') ?>
	
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Create Form</h4>
			<?php echo btnList( _route('form:index') , 'Back' )?>
		</div>

		<div class="card-body">
				<?php 
					Form::open([
						'method' => 'post',
						'action' => _route('form:edit' , $form_id)
					]);
				?>
				<div class="form-group">
					<?php
						echo $form->getRow('name');
					?>
				</div>

				<div class="form-group">
					<?php
						echo $form->getRow('description');
					?>
				</div>

				<div>
					<?php echo $form->get('submit')?>
				</div>
			<?php Form::close()?>
		</div>
	</div>
<?php endbuild()?>
<?php loadTo()?>