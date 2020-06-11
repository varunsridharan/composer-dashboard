<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Title</title>
	<link rel="stylesheet" href="template/css/bootstrap.min.css">
	<link rel="stylesheet" href="template/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="template/css/buttons.bootstrap4.min.css">
</head>
<body>
<div class="container pt-3">

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

	<table id="sftTable" class="table table-hover table-dark">
		<thead class="thead-dark">
		<tr><?php echo Table_HTML::headers(); ?></tr>
		</thead>
		<tbody><?php echo Table_HTML::body(); ?></tbody>
	</table>
</div>
<script src="template/js/jquery-3.4.1.js"></script>
<script src="template/js/bootstrap.bundle.js"></script>
<script src="template/js/jquery.dataTables.min.js"></script>
<script src="template/js/dataTables.bootstrap4.min.js"></script>
<script src="template/js/dataTables.buttons.min.js"></script>
<script src="template/js/buttons.bootstrap4.min.js"></script>
<script src="template/js/jszip.min.js"></script>
<script src="template/js/pdfmake.min.js"></script>
<script src="template/js/vfs_fonts.js"></script>
<script src="template/js/buttons.html5.min.js"></script>
<script src="template/js/buttons.print.min.js"></script>
<script>
	$( document ).ready( function() {
		$( '#sftTable tfoot th' ).each( function() {
			var title = $( this ).text();
			if( title !== 'Action' ) {
				$( this )
					.html( '<input type="text" class="form-control" placeholder="Search ' + title + '" style="max-width:95%;" />' );
			} else {
				$( this ).html( '' );
			}
		} );
		// DataTable
		var table = $( '#sftTable' ).DataTable( {
			order: [ [ 0, "desc" ] ],
			responsive: true,
			pageLength: 10,
			buttons: []
		} );
		table.buttons().container().appendTo( '#sftTable_wrapper .col-md-6:eq(0)' );
		// Apply the search
		table.columns().every( function() {
			var that = this;
			$( 'input', this.footer() ).on( 'keyup change', function() {
				if( that.search() !== this.value ) {
					that
						.search( this.value )
						.draw();
				}
			} );
		} );
	} );
</script>
</body>
</html>