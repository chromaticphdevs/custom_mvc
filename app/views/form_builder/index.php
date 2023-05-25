<?php build('content') ?>
<div class="card">
	<div class="card-header">
		<h2 class="card-title">Forms</h2>
		<?php echo btnCreate( _route('form:create') )?>
		<?php Flash::show()?>
	</div>

	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered">
				<thead>
					<th>#</th>
					<th>Name</th>
					<th>Description</th>
					<th>Action</th>
				</thead>

				<tbody>
					<?php foreach( $forms as $key => $row) :?>
						<tr>
							<td><?php echo ++$key?></td>
							<td><?php echo $row->name?></td>
							<td>
								<span title="<?php echo $row->description?>"><?php echo crop_string($row->description, 60) ?></span>
							</td>
							<td>
								<?php echo btnView( _route('form:show' , $row->id) )?>
								<?php echo btnEdit( _route('form:edit' , $row->id) )?>
								<?php echo btnDelete( _route('form:delete' , $row->id) )?>
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