<?php

class Lib_HTML {
	public static function run() {
		$libs = Handler::setup_libs_to_check();
		$html = array();
		foreach ( $libs as $id => $data ) {
			$last_updated = last_updated( $data['updated_at'] );
			$html[]       = <<<HTML
<div class="col-3 mb-3">
	<div class="card">
	  <div class="card-body">
		<h5 class="card-title"><a href="{$data['url']}" class="text-dark">{$data['name']}</a></h5>
		<small class="card-subtitle mb-2 text-muted d-block font-italic">📝 ${last_updated}</small>
		<a href="{$data['latest']['zip']}" class="btn btn-outline-success btn-block btn-sm mt-3 text-left rounded-0">Download {$data['latest']['version']}</a>
	  </div>
	</div>
</div>
HTML;
		}
		return implode( ' ', $html );
	}
}