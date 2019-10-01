<?php

namespace Altis\Multilingual; // @codingStandardsIgnoreLine

use function Altis\register_module;

add_action( 'altis.modules.init', function () {
	register_module( 'multilingual', __DIR__, 'Multilingual', [] );
} );
