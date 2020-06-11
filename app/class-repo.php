<?php

class Repo {
	protected $id;
	protected $name;
	protected $is_lib;
	protected $data = array();


	public function get( $repo_id, $repo_name = false, $is_lib = false ) {
		$this->data   = array();
		$this->id     = $repo_id;
		$this->name   = $repo_name;
		$this->is_lib = $is_lib;
		$this->basic_info();
		if ( ! $this->is_lib ) {
			$this->fetch_files( 'composer.json' );
			$this->fetch_files( 'composer.lock' );
		}
		return $this->data;
	}

	private function basic_info() {
		try {
			$response   = gh_api()->decode( gh_api()->get( '/repos/' . $this->id ) );
			$tag_info   = gh_api()->decode( gh_api()->get( '/repos/' . $this->id . '/releases/latest' ) );
			$this->data = array(
				'name'       => ( isset( $response->name ) ) ? $response->name : null,
				'private'    => ( isset( $response->private ) ) ? $response->private : false,
				'updated_at' => ( isset( $response->updated_at ) ) ? $response->updated_at : null,
				'url'        => ( isset( $response->html_url ) ) ? $response->html_url : null,
				'latest'     => array(
					'version'      => ( isset( $tag_info->tag_name ) ) ? $tag_info->tag_name : null,
					'zip'          => ( isset( $tag_info->zipball_url ) ) ? $tag_info->zipball_url : null,
					'published_at' => ( isset( $tag_info->published_at ) ) ? $tag_info->published_at : false,
				),
			);
			if ( ! empty( $this->name ) ) {
				$this->data['name'] = $this->name;
			}
		} catch ( \Milo\Github\NotFoundException $exception ) {
		}
	}

	private function fetch_files( $file ) {
		$this->data[ $file ] = false;
		try {
			$response = gh_api()->decode( gh_api()->get( 'repos/' . $this->id . '/contents/' . $file ) );
			if ( isset( $response->content ) && ! empty( $response->content ) && 'base64' === $response->encoding ) {
				$this->data[ $file ] = json_decode( base64_decode( $response->content ), true );
			}
		} catch ( \Milo\Github\NotFoundException $exception ) {

		}
	}
}