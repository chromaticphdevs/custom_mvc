<?php build('content') ?>
	
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Add Form Item</h4>
			<?php echo anchor( _route('form:show' , $form_id) , 'show' , 'Back' )?>
		</div>

		<div class="card-body">
			<?php 
				Form::open([
					'method' => 'post',
					'action' => _route('form:add-item')
				]);

				Form::hidden('form_id' , $form_id);
			?>
				<div class="form-group">
					<?php
						echo $form->getRow('label');
					?>
				</div>

				<div class="form-group">
					<?php
						echo $form->getRow('type');
					?>
				</div>

				<div class="form-group">
					<?php
						echo $form->getRow('options');
					?>
				</div>

				<div class="form-group">
					<?php
						echo $form->getRow('item_description');
					?>
				</div>

				<div class="form-group">
					<?php
						echo $form->getRow('default_value');
					?>
				</div>

				<div>
					<?php echo $form->get('submit')?>
				</div>
			<?php Form::close()?>
		</div>
	</div>
<?php endbuild()?>
	
<?php build('scripts')?>
	<script type="text/javascript" src="<?php echo _path_public('js/form_builder/item.js')?>"></script>
<?php endbuild()?>
<?php loadTo()?>