<?php

class Table_HTML {
	public static function headers() {
		static $header = array();
		if ( empty( $header ) ) {
			$data     = Handler::libs_to_check();
			$header[] = '<th>Plugin</th>';
			foreach ( $data as $id => $name ) {
				$header[] = '<th>' . $name . '</th>';
			}
		}
		return implode( ' ', $header );
	}

	public static function body() {
		$data = Handler::setup_repos_to_check();
		foreach ( $data as $id => $info ) {
			$latest   = ' @ <a class="text-dark " href="' . $info['latest']['zip'] . '">V ' . $info['latest']['version'] . '</a>';
			$badge    = ( true === $info['private'] ) ? '<small> <span class="badge badge-secondary">PRO</span></small>' : '';
			$released = last_updated( $info['latest']['published_at'] );
			$libs     = self::libs_status( $info );
			echo <<<HTML
<tr>
	<td> 
		${badge} <a class="text-dark" href="{$info['url']}">${info['name']}</a>
		${latest}  <br/><small class="text-info font-italic ">${released}</small>
	</td>
	${libs}
</tr>
HTML;
		}
	}

	protected static function libs_status( $plug ) {
		$libs     = Handler::libs_to_check();
		$return   = array();
		$git_data = Handler::setup_libs_to_check();
		foreach ( $libs as $id => $name ) {
			if ( isset( $plug['composer.lock']['packages'] ) ) {
				foreach ( $plug['composer.lock']['packages'] as $package ) {
					if ( $id === $package['name'] ) {
						if ( version_compare( $package['version'], $git_data[ $id ]['latest']['version'], '<' ) ) {
							$return[] = <<<HTML
<td class="table-danger font-weight-bolder">{$package['version']}</td>
HTML;
						} else {
							$return[] = <<<HTML
<td>{$package['version']} </td>
HTML;
						}
					}
				}
			}
		}
		return implode( ' ', $return );
	}
}