<?php build('content') ?>
	
	<div class="card">
		<div class="card-header">
			<h4 class="card-title"> Welcome to your dashboard !</h4>
		</div>


		<div class="card-body">
			<?php if( !is_null($number_of_days_remaining)) : ?>

				<div class="content-container">
					<div class="text-center">
						<h1 class="large-text" style="font-size: 3em" id="id_count_down"><?php echo $number_of_days_remaining?></h1>
						<h3 class="semi-large-text" style="font-size: 1em;">Days Remaining Before quarantine Completion</h3>
						<p>Under Quarantine for Approx (<strong><?php echo $number_of_days_after_deployment ?></strong>)</p>

						<hr>
						<h3>Quarantine Start Date : <?php echo $deployment_date?></h3>
					</div>
				</div>

				<hr>
				<h2>Health Precautions</h2>
				<ul>
					<li>If possible, have the person who is sick use a separate bedroom and bathroom. If possible, have the person who is sick stay in their own “sick room” or area and away from others</li>		
					<li>Shared space: If you have to share space, make sure the room has good air flow</li>		
					<li>Avoid having visitors.</li>		
				</ul>
			<?php endif?> 		
		</div>
	</div>
<?php endbuild()?>

<?php build('styles')?>
	<style type="text/css">
		.content-container{
			background: blue;
			padding: 15px;
			color: #fff;
		}
	</style>
<?php endbuild()?>

<?php build('scripts')?>
	<script type="text/javascript">
		var quarantineReleaseDate = "<?php echo $finish_quarantine_date?>";
		// Set the date we're counting down to

		console.log(quarantineReleaseDate);
		var countDownDate = new Date(quarantineReleaseDate).getTime();

		// Update the count down every 1 second
		var x = setInterval(function() {

		  // Get today's date and time
		  var now = new Date().getTime();

		  // Find the distance between now and the count down date
		  var distance = countDownDate - now;

		  // Time calculations for days, hours, minutes and seconds
		  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
		  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
		  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
		  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

		  // Display the result in the element with id="demo"
		  document.getElementById("id_count_down").innerHTML = days + "d " + hours + "h "
		  + minutes + "m " + seconds + "s ";

		  // If the count down is finished, write some text
		  if (distance < 0) {
		    clearInterval(x);
		    document.getElementById("id_count_down").innerHTML = "Quarantine Complete";
		  }
		}, 1000);
	</script>
<?php endbuild()?>
<?php loadTo()?>