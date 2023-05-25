<!DOCTYPE html>
<!--
Template Name: NobleUI - HTML Bootstrap 5 Admin Dashboard Template
Author: NobleUI
Purchase: https://1.envato.market/nobleui_admin
Website: https://www.nobleui.com
Portfolio: https://themeforest.net/user/nobleui/portfolio
Contact: nobleui123@gmail.com
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="<?php echo DESCRIPTION?>">
	<meta name="author" content="<?php echo COMPANY_NAME?>">
	<meta name="keywords" content="<?php echo KEY_WORDS?>">

	<title><?php echo $pageTitle ?? COMPANY_NAME?></title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
  <!-- End fonts -->

  <!-- core:css -->
<link rel="stylesheet" href="<?php echo _path_tmp('assets/vendors/core/core.css')?>">
<!-- endinject -->

  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="<?php echo _path_tmp('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css')?>">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?php echo _path_tmp('assets/fonts/feather-font/css/iconfont.css')?>">
  <link rel="stylesheet" href="<?php echo _path_tmp('assets/vendors/flag-icon-css/css/flag-icon.min.css')?>">
  <!-- Layout styles -->  
  <link rel="stylesheet" href="<?php echo _path_tmp('assets/css/demo1/style.css')?>">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="<?php echo _path_tmp('assets/images/favicon.png')?>" />
  <link rel="stylesheet" href="<?php echo _path_public('css/main/global.css')?>">
  <style>
    .form-group {
      margin-bottom: 5px !important;
    }
  </style>
  <?php produce('styles')?>
</head>
<body>
	<div class="main-wrapper">
		<!-- partial:partials/_sidebar.html -->
		<?php grab('tmp/inc/navigation')?>
		<div class="page-wrapper">
      <?php grab('tmp/inc/powernav')?>

			<div class="page-content">
        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
          <!-- <div>
            <h4 class="mb-3 mb-md-0">Welcome to Dashboard</h4>
          </div> -->
          <?php produce('page-controls')?>
        </div>
        <?php produce('content')?>
			</div>

			<!-- partial:partials/_footer.html -->
			<footer class="footer d-flex flex-column flex-md-row align-items-center justify-content-between px-4 py-3 border-top small" 
        style="background-color: #fff; color:#000 !important">
				<p class="text-muted mb-1 mb-md-0">Copyright © <?php echo date('Y')?> <a href="https://www.nobleui.com" target="_blank"><?php echo COMPANY_NAME?></a>.</p>
			</footer>
			<!-- partial -->
		
		</div>
	</div>

	<!-- core:js -->
  <script src="<?php echo _path_tmp('assets/vendors/core/core.js')?>"></script>
    <script src="<?php echo _path_public('js/core.js')?>"></script>
    <script src="<?php echo _path_public('js/global.js')?>"></script>
    <?php produce('scripts')?>
    <!-- endinject -->

    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->

    <!-- inject:js -->
    <script src="<?php echo _path_tmp('assets/vendors/feather-icons/feather.min.js')?>"></script>
    <script src="<?php echo _path_tmp('assets/js/template.js')?>"></script>
    <!-- endinject -->

    <!-- Plugin js for this page -->
    <script src="<?php echo _path_tmp('assets/vendors/datatables.net/jquery.dataTables.js')?>"></script>
    <script src="<?php echo _path_tmp('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js')?>"></script>

    <script type="text/javascript" defer>
        $(function() {
          'use strict';

          $(function() {
            $('.dataTable').DataTable({
              "aLengthMenu": [
                [10, 30, 50, -1],
                [10, 30, 50, "All"]
              ],
              "iDisplayLength": 10,
              "language": {
                search: ""
              }
            });
            $('.dataTable').each(function() {
              var datatable = $(this);
              // SEARCH - Add the placeholder for Search and Turn this into in-line form control
              var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
              search_input.attr('placeholder', 'Search');
              search_input.removeClass('form-control-sm');
              // LENGTH - Inline-Form control
              var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
              length_sel.removeClass('form-control-sm');
            });
          });

        });
    </script>
    
</body>
</html>    