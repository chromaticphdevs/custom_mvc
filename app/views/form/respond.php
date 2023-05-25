<?php build('content') ?>
		
	<div class="container">
		<div class="card">
			<div class="card-header">
				<h2><?php echo $form_data->name?></h2>
				<p><?php echo $form_data->description?></p>

				<?php echo anchor( _route('form:show' , $form_data->id) , 'back' , 'Back to overview' )?>
			</div>

			<div class="card-body">
				<?php
					Form::open([
						'method' => 'post',
						'action' => _route('form:respond' , $form_data->id)
					]);

					Form::hidden('user_id' , whoIs('id'));
					Form::hidden('form_id' , $form_data->id);

					echo $form->addAndCall([
						'name'  => "form[title]",
						'value' => $form_data->name,
						'type' => 'hidden'
					]);

					echo $form->addAndCall([
						'name'  => "form[description]",
						'value' => $form_data->description,
						'type' => 'hidden'
					]);
				?>
				<?php if(!empty($form_data->items)) :?>
					<?php foreach( $form_data->items as $key => $row) : ?>
						<?php
							echo $form->addAndCall([
								'name'  => "items[{$key}][name]",
								'value' => $row->label,
								'type' => 'hidden'
							]);

							echo $form->addAndCall([
								'name'  => "items[{$key}][input_id]",
								'value' => $row->id,
								'type' => 'hidden'
							]);
						?>

						<div class="form-group">
							<label><?php echo $row->label?></label>
							<?php
								echo $form->addAndCall([
									'name' => "items[{$key}][answer]",
									'type' => $form->formConvertType($row->type),
									'class' => 'form-control',
									'value' => $row->default_value,
									'required' => true,
									'options' => [
										'label' => $row->label,
										'option_values' => $row->options_array
									],
									'attributes' => [
										'id' => 'id-'.$row->id
									]
								]);
							?>
							<i><small style="color: #3c3c3c;"><?php echo $row->item_description?></small></i>
						</div>
					<?php endforeach?>
				<?php endif?>

				<div class="mt-3">
					<?php Form::submit('' , 'Submit')?>
				</div>
				<?php Form::close()?>
			</div>
		</div>
	</div>
<?php endbuild()?>

<?php loadTo('tmp/skeleton')?>