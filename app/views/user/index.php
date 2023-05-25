<?php build('content') ?>
	
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Users</h4>
			<?php echo wLinkDefault(_route('user:create'), 'Create Users', [
				'icon' => 'plus-circle'
			])?>

			<?php 
			if(isAdmin())
				echo wLinkDefault(_route('user:subadmin-list'), 'Sub Admins', [
					'icon' => 'plus-circle'
				]);
			?>
		</div>

		<div class="card-body">
			<?php Flash::show()?>
			<div class="table-responsive" style="min-height: 30vh;">
				<table class="table table-bordered dataTable">
					<thead>
						<th>Name</th>
						<th>Type</th>
						<th>Action</th>
					</thead>

					<tbody>
						<?php foreach( $users as $row) :?>
							<tr>
								<td><?php echo $row->lastname . ' , ' .$row->firstname?></td>
								<td><?php echo $row->user_type ?></td>
								<td>
									<?php echo wLinkDefault(_route('user:show', $row->id), 'View', ['icon' => 'eye']) ;?>
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