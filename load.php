<?php

namespace Altis\Multilingual; // @codingStandardsIgnoreLine

use function Altis\register_module;

function register() {
	register_module( 'multilingual', __DIR__, 'Multilingual', [] );
}

// Don't self-initialize if this is not an Altis execution.
if ( ! function_exists( 'add_action' ) ) {
	return;
}

add_action( 'altis.modules.init', __NAMESPACE__ . '\\register' );
