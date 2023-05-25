<?php extract($data)?>

<div>
	<h2 class="text-center mb-4">Patient Arrival</h2>
	<fieldset>
		<legend>Patient Details</legend>
		<table class="table table-bordered">
			<tr>
				<td>Full Name</td>
				<td><?php echo $user_data->first_name . ' '.$user_data->middle_name .' '. $user_data->last_name?></td>
			</tr>
			<tr>
				<td>Address</td>
				<td>
					<?php if($user_data->address_object) :?>
						<p>
						<?php
							$address = $user_data->address_object;
							echo "{$address->block_house_number} {$address->street} {$address->city} {$address->barangay} {$address->zip}";
						?>
						</p>
					<?php else:?>
						<p>No address</p>
					<?php endif?>
				</td>
			</tr>
			<tr>
				<td>Email</td>
				<td><?php echo $user_data->email?></td>
			</tr>
			<tr>
				<td>Phone Number</td>
				<td><?php echo $user_data->phone_number?></td>
			</tr>
		</table>
	</fieldset>

	<?php divider()?>

	<?php echo $patient_form->start()?>
	<?php echo $patient_form->get('user_id')?>

	<?php 
		if( $patient_form->checkField('id') )
			echo $patient_form->get('id');
	?>
	
	<div class="col-md-5">
		<h4>Arrival</h4>
		<table class="table table-bordered">
			<tr><?php echo $patient_form->getCol('date')?></tr>
			<tr><?php echo $patient_form->getCol('time')?></tr>
		</table>
	</div>
	<div class="mt-3"><?php echo $patient_form->get('submit')?></div>

	<?php echo $patient_form->end()?>
</div>