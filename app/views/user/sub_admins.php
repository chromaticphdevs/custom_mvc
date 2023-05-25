<?php build('content') ?>
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Sub Admins</h4>
		</div>

		<div class="card-body">
			<div class="table-responsive">
				<table class="table">
					<thead>
						<th>#</th>
						<th>Email</th>
						<th>Name</th>
						<th>Action</th>
					</thead>

					<tbody>
						<?php foreach($users as $key => $row) :?>
							<tr>
								<td><?php echo ++$key?></td>
								<td><?php echo $row->email?></td>
								<td><?php echo $row->firstname . ' ' .$row->lastname?></td>
								<td>
									<?php
										if(!$row->is_verified) {
											echo wLinkDefault(_route('user:approve-sub-admin', $row->id), 'Approve User', ['icon' => 'check-circle']);
										} else {
											echo wLinkDefault(_route('user:approve-sub-admin', $row->id), 'De-Activate', ['icon' => 'x-circle']);
										}
									?>
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