<?php

namespace HM\Platform\Multilingual;

use HM\Platform;

add_action( 'hm-platform.modules.init', function () {
	Platform\register_module( 'multilingual', __DIR__, 'Multilingual', [] );
} );
