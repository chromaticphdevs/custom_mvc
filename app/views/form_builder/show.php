<?php build('content') ?>
	
	<div class="card">
		<div class="card-header">
			<h4 class="card-title"><?php echo $form_data->name?> #<?php echo $form_data->reference?></h4>
			<?php echo anchor( _route('form:index') , 'list' , 'Back to forms' )?> | 
			<?php echo anchor( _route('form:respond' , $form_data->id) , 'view' , 'Respond' )?>
			<?php Flash::show()?>
		</div>

		<div class="card-body">

			<p class="mb-2">
				<strong>Description</strong> <br>
				<?php echo $form_data->description?>
			</p>

			<h4 class="mb-2">Questions</h4>
			<?php echo btnCreate( _route('form:add-item' , null , ['form_id' => $form_data->id]) )?>
			<div class="table-responsive mt-3">
				<table class="table table-bordered">
					<thead>
						<th>#</th>
						<th>Label</th>
						<th>Type</th>
						<th>Description</th>
						<th>Action</th>
					</thead>

					<tbody>
						<?php foreach( $form_builder_items as $key => $row) :?>
							<tr>
								<td><?php echo ++$key?></td>
								<td><?php echo $row->label?></td>
								<td><?php echo $row->type?></td>
								<td>
									<p title="<?php echo $row->description?>"><?php echo crop_string($row->item_description)?></p>
								</td>
								<td>
									<?php echo btnEdit(_route('form:edit-item' , $row->id))?>
									<?php echo btnDelete(_route('form:delete-item' , $row->id))?>
								</td>
							</tr>
						<?php endforeach?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
<?php endbuild()?>
<?php loadTo()?>