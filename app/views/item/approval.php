<?php build('content') ?>
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Catalogs for approval</h4>
		</div>

		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered">
					<thead>
						<th>#</th>
						<th>Title</th>
						<th>Genre</th>
						<th>Uploader</th>
						<th>Date of upload</th>
						<th>Action</th>
					</thead>

					<tbody>
						<?php foreach($catalogs as $key => $row) :?>
							<tr>
								<td><?php echo ++$key?></td>
								<td><?php echo $row->title?></td>
								<td><?php echo $row->genre?></td>
								<td><?php echo $row->uploader_name?></td>
								<td><?php echo $row->created_at?></td>
								<td>
									<?php
										echo wLinkDefault(_route('item:show', $row->id, [
											'itemID' => seal($row->id)
										]), 'Show', [
											'icon' => 'eye'
										])
									?>
									 | 
									<?php
										echo wLinkDefault(_route('item:approval', null, [
											'itemID' => seal($row->id),
											'action' => 'approve'
										]), 'Approve', [
											'icon' => 'check-circle'
										])
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