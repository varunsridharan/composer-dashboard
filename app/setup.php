<?php
// Creates Cache Folder.
if ( ! file_exists( APP_PATH . 'cache/' ) ) {
	@mkdir( APP_PATH . 'cache/' );
}

function gh_token() {
	static $gh_token_instance = false;
	if ( false === $gh_token_instance ) {
		$gh_token_instance = new \Milo\Github\OAuth\Token( GITHUB_ACCESS_TOKEN );
	}
	return $gh_token_instance;
}

function gh_api() {
	static $gh_api_instance = false;
	if ( false === $gh_api_instance ) {
		$gh_api_instance = new \Milo\Github\Api;
		$gh_api_instance->setToken( gh_token() );
	}
	return $gh_api_instance;
}

function last_updated( $updated_at ) {
	return date( 'd-M-yy | H:i A', strtotime( $updated_at ) );
}