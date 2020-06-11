<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Title</title>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="assets/css/buttons.bootstrap4.min.css">
</head>
<body>
<div class="container-fulid p-3">

	<div class="accordion mb-4" id="allacc">
		<div class="card">
			<div class="card-header" id="libshead">
				<h2 class="mb-0">
					<button class="btn btn-block text-left" type="button" data-toggle="collapse" data-target="#libs"
							aria-expanded="true" aria-controls="libs">Libraries
					</button>
				</h2>
			</div>

			<div id="libs" class="collapse" aria-labelledby="libshead" data-parent="#allacc">
				<div class="card-body">
					<div class="row"><?php echo $lib_html; ?></div>
				</div>
			</div>
		</div>
	</div>

	<table id="sftTable" class="table table-hover table-bordered">
		<thead class="thead-dark">
		<tr><?php echo Table_HTML::headers(); ?></tr>
		</thead>
		<tbody>
		<?php echo Table_HTML::body(); ?>
		</tbody>
		<tfoot>
		<tr><?php echo Table_HTML::headers(); ?></tr>
		</tfoot>
	</table>
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