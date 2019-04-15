<?php

namespace HM\Platform\Multilingual;

use HM\Platform;

// Don't self-initialize if this is not a Platform execution.
if ( ! function_exists( 'add_action' ) ) {
	return;
}

add_action( 'hm-platform.modules.init', function () {
	Platform\register_module( 'multilingual', __DIR__, 'Multilingual', [] );
} );
