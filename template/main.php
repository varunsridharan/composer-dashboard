<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Personal Composer Project Stats</title>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="assets/css/buttons.bootstrap4.min.css">
	<meta name="monetization" content="$ilp.uphold.com/b2zaa8zWZWUF"/>
</head>
<body style="background: #f1f0f0;">
<div class="container-fulid p-3">
	<div class="row mt-3 mb-3 bg-white pt-1 pb-1">
		<div class="col-12"><h2 class="text-center d-block">Personal Composer Project Stats</h2></div>
	</div>

	<table id="sftTable" class="table table table-hover  table-light">
		<thead class="thead-dark">
		<tr><?php echo Table_HTML::headers(); ?></tr>
		</thead>
		<tbody>
		<?php Table_HTML::body(); ?>
		</tbody>
		<tfoot class="table-secondary table-sm">
		<tr><?php echo Table_HTML::headers(); ?></tr>
		</tfoot>
	</table>

	<div class="row mt-4 bg-white pt-2 pb-2 text-center">
		<div class="col-12"><h2>Libraries used</h2></div>
	</div>

	<div class="row mt-4">
		<?php echo $lib_html; ?>
	</div>

	<footer class="text-muted text-center mt-3">
		<small>Last Updated : <?php echo last_updated(); ?></small>
	</footer>
</div>
<script src="assets/js/jquery-3.4.1.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
	
</body>
</html>
