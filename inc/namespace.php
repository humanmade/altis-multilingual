<?php

namespace Altis\Multilingual;

use const Altis\ROOT_DIR;
use function Altis\get_config;

use GP_Locales;
use GP_Project;
use GP_Translation_Set;

function bootstrap() {
	add_action( 'gp_init', __NAMESPACE__ . '\\ensure_project' );
}

function ensure_project() {
	$project = new GP_Project();
	$existing = $project->find_one( [ 'slug' => 'altis' ] );

	if ( $existing ) {
		// setup_project( $existing );
		return;
	}

	$project = $project->create( [
		'name' => 'Altis',
		'slug' => 'altis',
		'description' => '',
		'path' => ROOT_DIR,
		'source_url_template' => '',
		'active' => true,
	] );

	// setup_project( $project );
}

function setup_project( GP_Project $project ) {

	$locales = get_config()['modules']['multilingual']['locales'] ?? [];

	// Generate po files.

	$cwd = getcwd();
	chdir( ROOT_DIR );

	$command = sprintf(
		'wp i18n make-pot packages /tmp/all.pot --ignore-domain --exclude=.github,build'
	);
	exec( $command, $output, $failed );

	if ( $failed ) {
		die($failed);
	}

	$command = sprintf(
		'wp glotpress import-originals altis /tmp/all.pot --url=' . home_url()
	);
	exec( $command, $output, $failed );

	$translation_set = new GP_Translation_Set();

	foreach ( $locales as $locale ) {
		if ( ! GP_Locales::exists( $locale ) ) {
			continue;
		}

		$locale = GP_Locales::by_slug( $locale );

		$translation_set->create( [
			'name' => sprintf( '%s (%s)', $locale->native_name, $locale->slug ),
			'locale' => $locale->slug,
			'slug' => $locale->slug,
			'project_id' => $project->id,
		] );
	}


	chdir( $cwd );
}
