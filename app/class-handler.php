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
					$libs_to_check[ $id ] = $ins->get( $id, $name, true );
				}
			}
		}
		return $libs_to_check;
	}

	public static function setup_repos_to_check() {
		static $repos_to_check = false;
		if ( false === $repos_to_check ) {
			$data = self::repo_to_check();
			$ins  = new Repo();
			if ( ! empty( $data ) ) {
				foreach ( $data as $group => $info ) {
					foreach ( $info as $id ) {
						$repos_to_check[ $id ] = $ins->get( $id );
					}
				}
			}
		}
		return $repos_to_check;
	}
}