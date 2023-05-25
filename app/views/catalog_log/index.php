<?php build('content')?>
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Recent Logs</h4>
			<?php echo wLinkDefault(_route('catalog-log:index'), 'Logs')?>
			<?php echo wLinkDefault(_route('catalog-log:archived'), 'Archived')?>
		</div>

		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered">
					<thead>
						<th>#</th>
						<th>User</th>
						<th>Log Message</th>
						<th>Date</th>
					</thead>

					<tbody>
						<?php foreach($logs as $key => $row) :?>
							<tr>
								<td><?php echo ++$key?></td>
								<td><?php echo $row->fullname?></td>
								<td><?php echo $row->log_message?></td>
								<td><?php echo $row->created_at?></td>
							</tr>
						<?php endforeach?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
<?php endbuild()?>
<?php loadTo()?>