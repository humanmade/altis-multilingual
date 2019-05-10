<?php

namespace Altis\Multilingual;

use function Altis\register_module;

// Don't self-initialize if this is not an Altis execution.
if ( ! function_exists( 'add_action' ) ) {
	return;
}

add_action( 'altis.modules.init', function () {
	register_module( 'multilingual', __DIR__, 'Multilingual', [] );
} );
