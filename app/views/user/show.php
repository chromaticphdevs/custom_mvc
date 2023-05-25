<?php build('content') ?>
	<?php Flash::show()?>
	<div class="row">
		<div class="col-md-4">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">User Preview</h4>
					<?php echo wLinkDefault(_route('user:edit', $user->id), 'Edit User', [
						'icon' => 'edit'
					])?>
				</div>

				<div class="card-body">
					<div><img src="<?php echo $user->profile?>" style="width: 150px;"></div>
					<span class="badge badge-primary">USERID : #<?php echo $user->user_identification?></span>
					<div class="table-responsive">
						<table class="table table-bordered">
							<tr>
								<td style="width:35%">Name</td>
								<td><?php echo $user->lastname . ',' . $user->firstname?></td>
							</tr>
							<tr>
								<td style="width:35%">Gender</td>
								<td><?php echo $user->gender?></td>
							</tr>
							<tr>
								<td style="width:35%">Email</td>
								<td><?php echo $user->email?></td>
							</tr>
							<?php if(!empty($user->phone)) :?>
							<tr>
								<td style="width:35%">Phone</td>
								<td><?php echo $user->phone?></td>
							</tr>
							<?php endif?>

							<?php if(!empty($user->phone)) :?>
							<tr>
								<td style="width:35%">Address</td>
								<td><?php echo $user->address?></td>
							</tr>
							<?php endif?>
						</table>
					</div>
				</div>
			</div>	
		</div>

		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">User Details</h4>
				</div>

				<div class="card-body">
					<div class="row">
						<div class="col-md-4">
							<div class="card">
								<div class="card-body">
									<?php if(!$userDetail['favGenre']) :?>
										<h4>No Data Available</h4>
									<?php else:?>
										<h4><?php echo $userDetail['favGenre']?></h4>
									<?php endif?>
									<label for="#">Favorite Genre</label>
								</div>
							</div>
						</div>

						<div class="col-md-4">
							<div class="card">
								<div class="card-body">
									<h4>No Data Available</h4>
									<label for="#">Favorite Topic</label>
								</div>
							</div>
						</div>

						<div class="col-md-4">
							<div class="card">
								<div class="card-body">
									<h4>No Data Available</h4>
									<label for="#">Books Red</label>
								</div>
							</div>
						</div>
					</div>

					<div class="row mt-2">
						<div class="col-md-4">
							<div class="card">
								<div class="card-body">
									<h4>No Data Available</h4>
									<label for="#">Favorite Author</label>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- SEND LAB RESULT TO EMAIL -->
	<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">EMAIL ABOUT QUARANTINE STATUS</h5>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
	      </div>
	      <div class="modal-body">
	      	<form method="post" action="<?php echo _route('mailer:send')?>">

	      		<input type="hidden" name="route" value="<?php echo seal( _route('user:show' , $user->id) ) ?>">
	      		<h5 class="mb-2">Send To Email</h5>


	      		<input type="hidden" name="lab_id" value="<?php echo $lab_result->id?>">

	      		<div class="form-group">
	      			<label>Subject</label>
	      			<?php Form::textarea('subject' , " Hey !".$user->first_name, ['class' => 'form-control' , 
	      			'rows' => 1 , 'placeholder' => $user->first_name . ', Enter Motivating Subject'])?>

	      			<small>Seperate Emails with (,) to send on multiple recipients</small>
	      		</div>


	      		<div class="form-group">
	      			<label>Email</label>
	      			<?php Form::textarea('recipients' , $user->email , ['class' => 'form-control' , 
	      			'rows' => 1 , 'placeholder' => 'eg.'.$user->email])?>

	      			<small>Seperate Emails with (,) to send on multiple recipients</small>
	      		</div>

	      		<div class="form-group">
	      			<label>Additional Notes</label>
	      			<?php
	      				$message = "Good day ".$user->first_name .',';
	      				$message .= ' '.COMPANY_NAME . ' Would like to extend our support to your quarantine';
	      				$message .= " We are also emailing you to update you that you are ".$number_of_days_remaining ." days away before completing your quarantine";
	      			?>
	      			<?php Form::textarea('body' , $message , ['class' => 'form-control' , 
	      			'rows' => 3 , 'placeholder' => 'some-text' ])?>

	      			<small>Seperate Emails with (,) to send on multiple recipients</small>
	      		</div>

	      		<input type="submit" name="" class="btn btn-primary" value="Send">
	      	</form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>
	<!-- -->
<?php endbuild()?>
<?php loadTo()?>