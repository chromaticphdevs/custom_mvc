<?php build('content') ?>
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Archived</h4>
			<?php echo wLinkDefault(_route('catalog-log:index'), 'Logs')?>
			<?php echo wLinkDefault(_route('catalog-log:archived'), 'Archived')?>
		</div>

		<div class="card-body">
		  <div class="table-responsive">
		  	<table class="table dataTable">
		  		<thead>
		  			<th>#</th>
		  			<th>User</th>
		  			<th>Message</th>
		  			<th>Reference</th>
		  			<th>Date</th>
		  			<th>Action</th>
		  		</thead>

		  		<tbody>
		  			<?php foreach($logs as $key => $row) :?>
		  				<?php $catval = json_decode($row->catalog_values)?>
		  				<tr>
		  					<td><?php echo ++$key?></td>
		  					<td><?php echo $row->fullname?></td>
		  					<td><?php echo $row->log_message?></td>
		  					<th><?php echo $catval->reference?></th>
		  					<td><?php echo $row->created_at?></td>
		  					<td>
		  						<a href="<?php echo _route('catalog-log:show', $row->id)?>">Preview</a>
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