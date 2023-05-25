<?php build('content') ?>
	
	<div class="card">
		<div class="card-header">
			<h4 class="card-title"><?php echo $form_data->form_detail_array->title?></h4>
			<p><?php echo $form_data->form_detail_array->description?></p>
		</div>

		<div class="card-body">
			<div class="table-bordered">
				<table class="table table-bordered">
					<thead>
						<th>#</th>
						<th>Question</th>
						<th>Answer</th>
					</thead>

					<tbody>
						<?php foreach( $item_array as $key => $row ) : ?>
							<tr>
								<td><?php echo ++$key?></td>
								<td><?php echo $row->name?></td>
								<td><?php echo $row->answer?></td>
							</tr>
						<?php endforeach?>
					</tbody>
				</table>
			</div>
			
		</div>
	</div>
<?php endbuild()?>
<?php loadTo()?>