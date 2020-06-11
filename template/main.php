<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Personal Composer Project Stats</title>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="assets/css/buttons.bootstrap4.min.css">
</head>
<body style="background: #f1f0f0;">
<div class="container-fulid p-3">
	<h2 class=" text-center d-block">Personal Composer Project Stats</h2>

	<table id="sftTable" class="table-responsive table table-table-responsive table table-light table-striped table-borderless">
		<thead class="thead-dark">
		<tr><?php echo Table_HTML::headers(); ?></tr>
		</thead>
		<tbody>
		<?php Table_HTML::body(); ?>
		</tbody>
		<tfoot>
		<tr><?php echo Table_HTML::headers(); ?></tr>
		</tfoot>
	</table>

	<div class="row mt-4"><?php echo $lib_html; ?></div>

	<footer class="text-muted text-center mt-3">
		<small>Last Updated : <?php echo last_updated(); ?></small>
	</footer>
</div>
<script src="assets/js/jquery-3.4.1.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/dataTables.bootstrap4.min.js"></script>
<script src="assets/js/dataTables.buttons.min.js"></script>
<script src="assets/js/buttons.bootstrap4.min.js"></script>
<script src="assets/js/buttons.html5.min.js"></script>
<script src="assets/js/buttons.print.min.js"></script>
<script>
	$( document ).ready( function() {
		$( '#sftTable tfoot th,#sftTable tbody tr.search th' ).each( function() {
			var title = $( this ).text();
			if( title !== 'Action' ) {
				$( this )
					.html( '<input type="text" class="form-control" placeholder="' + title + '" style="max-width:95%;" />' );
			} else {
				$( this ).html( '' );
			}
		} );
		// DataTable
		var table = $( '#sftTable' ).DataTable( {
			order: [ [ 1, "asc" ] ],
			responsive: true,
			paging: false,
			search: false,
			buttons: []
		} );

		table.columns().every( function() {
			var that = this;
			$( 'input', this.footer() ).on( 'keyup change', function() {
				if( that.search() !== this.value ) {
					that.search( this.value ).draw();
				}
			} );
		} );
	} );
</script>
</body>
</html>