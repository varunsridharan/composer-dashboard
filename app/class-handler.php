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
		$return = array( 'Free' => array(), 'Paid' => array() );

		$paid = file_get_contents( 'https://cdn.svarun.dev/json/envato-items.json' );
		$free = file_get_contents( 'https://cdn.svarun.dev/json/wordpress-org-items.json' );
		$paid = json_decode( $paid, true );
		$free = json_decode( $free, true );

		if ( isset( $paid['plugins'] ) ) {
			$return['Paid'] = array_keys( $paid['plugins'] );
		}

		if ( is_array( $free ) && ! empty( $free ) ) {
			foreach ( $free as $item ) {
				$return['Free'][] = $item['slug'];
			}
		}
		print_r( $return );
		return $return;
		#return self::get_json( 'repos.json' );
	}

	public static function setup_libs_to_check() {
		static $libs_to_check = false;
		/*if ( file_exists( APP_PATH . 'cache/libs_to_check.json' ) ) {
			$libs_to_check = json_decode( file_get_contents( APP_PATH . 'cache/libs_to_check.json' ), true );
		}*/
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
			#file_put_contents( APP_PATH . 'cache/libs_to_check.json', json_encode( $libs_to_check ) );
		}
		return $libs_to_check;
	}

	public static function setup_repos_to_check() {
		static $repos_to_check = false;
		/*if ( file_exists( APP_PATH . 'cache/repos_tocheck.json' ) ) {
			$repos_to_check = json_decode( file_get_contents( APP_PATH . 'cache/repos_tocheck.json' ), true );
		}*/
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
				#file_put_contents( APP_PATH . 'cache/repos_tocheck.json', json_encode( $repos_to_check ) );
			}
		}
		return $repos_to_check;
	}
}