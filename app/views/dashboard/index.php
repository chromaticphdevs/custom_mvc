<?php build('content')?>
<?php Flash::show()?>
<div class="row">
	<div class="col-md-8">
		<div class="row">
			<div class="col-md-6 grid-margin">
				<div class="card">
					<div class="card-body">
					<div class="d-flex justify-content-between align-items-baseline">
						<h6 class="card-title mb-0">Total Catalogs</h6>
					</div>
					<div class="row">
						<div class="col-6 col-md-12 col-xl-5">
							<h3 class="mb-2"><?php echo $totalCatalog?></h3>
							<div class="d-flex align-items-baseline"></div>
						</div>
					</div>
					</div>
				</div>
			</div>

			<div class="col-md-6 grid-margin">
				<div class="card">
					<div class="card-body">
					<div class="d-flex justify-content-between align-items-baseline">
						<h6 class="card-title mb-0">Total Users</h6>
					</div>
					<div class="row">
						<div class="col-6 col-md-12 col-xl-5">
							<h3 class="mb-2"><?php echo $totalUser?></h3>
						</div>
					</div>
					</div>
				</div>
			</div>
		</div>
		<?php echo divider(40)?>

		<div class="card">
			<div class="card-body">
			<div class="d-flex justify-content-between align-items-baseline">
				<h6 class="card-title mb-0">Trends</h6>
			</div>
			<?php if($trends) :?>
				<?php foreach($trends as $key => $row) :?>
					<?php echo wCatalogToStringToLink($row->value, _route('item:index'), $row->category)?> , &nbsp;
				<?php endforeach?>
			</div>
			<?php else:?>
				<p>No Trends</p>
			<?php endif?>
		</div>
	</div>
	<div class="col-md-4">
		<div class="card">
			<div class="card-body">
				<?php
			        Form::open([
			            'method' => 'get',
			            'action' => _route('item:index')
			        ]);
			    ?> 
			        <h4>Quick Search</h4>
			        <?php if(isset($_GET['searchFocus'])) :?>
			            <div class="text-danger mt-2 mb-2">Narrowing search, search focus to: <strong><?php echo $_GET['searchFocus']?></strong></div>
			        <?php endif?>
			        <div class="form-group"><?php Form::text('keyword', '', 
			        	['class' => 'form-control','autocomplete'=>'off' , 'required' => true, 
			        'placeholder' => 'Search something here.'])?></div>
			    <?php Form::close()?>
			</div>
		</div>
	</div>
</div>
<?php endbuild()?>
<?php loadTo()?>