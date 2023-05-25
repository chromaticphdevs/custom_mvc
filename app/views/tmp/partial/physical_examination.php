<?php extract($data)?>
<div>
	<h2 class="text-center mb-4">Phyiscal Examination</h2>
	<fieldset>
		<legend>Patient Details</legend>
		<table class="table table-bordered">
			<tr>
				<td>Full Name</td>
				<td><?php echo $user_data->first_name . ' '.$user_data->middle_name .' '. $user_data->last_name?></td>
			</tr>
			<tr>
				<td>Address</td>
				<td><?php echo $user_data->address?></td>
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
	<?php echo $patient_form->get('id')?>

	<fieldset>
		<div>
			<p>Fill patient phyiscal exam details</p>
		</div>
		<?php divider()?>

		<div class="col-md-5">
			<div class="form-group"><?php echo $patient_form->getRow('oxygen_level_num')?></div>
			<div class="form-group"><?php echo $patient_form->getRow('blood_presure_num')?></div>
			<div class="form-group"><?php echo $patient_form->getRow('temperature_num')?></div>
			<div class="form-group"><?php echo $patient_form->getRow('pulse_rate_num')?></div>
			<div class="form-group"><?php echo $patient_form->getRow('respirator_rate_num')?></div>
			<div class="form-group"><?php echo $patient_form->getRow('height_num')?></div>
			<div class="form-group"><?php echo $patient_form->getRow('weight_num')?></div>
		</div>
		<div><?php echo $patient_form->get('submit')?></div>
	</fieldset>
	<?php echo $patient_form->end()?>
</div>