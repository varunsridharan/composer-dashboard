<?php

class Handler {
	protected static function get_json( $path ) {
		if ( file_exists( APP_PATH . $path ) ) {
			return json_decode( file_get_contents( APP_PATH . $path ), true );
		}
		return false;
	}

	public static function libs_to_check() {
		return self::get_json( 'library.json' );
	}

	public static function repo_to_check() {
		return self::get_json( 'repos.json' );
	}

	public static function setup_libs_to_check() {
		static $libs_to_check = false;
		if ( false === $libs_to_check ) {
			$data = self::libs_to_check();
			$ins  = new Repo();
			if ( ! empty( $data ) ) {
				foreach ( $data as $id => $name ) {
					$_data = $ins->get( $id, $name, true );
					if ( isset( $_data['name'] ) ) {
						$libs_to_check[ $id ] = $_data;
					}
				}
			}
		}
		return $libs_to_check;
	}

	public static function setup_repos_to_check() {
		static $repos_to_check = false;
		if ( empty( $repos_to_check ) ) {
			$data = self::repo_to_check();
			$ins  = new Repo();
			if ( ! empty( $data ) ) {
				foreach ( $data as $group => $info ) {
					foreach ( $info as $id ) {
						$_data = $ins->get( $id );
						if ( isset( $_data['name'] ) ) {
							$repos_to_check[ $id ] = $_data;
						}
					}
				}
			}
		}
		return $repos_to_check;
	}
}