<?php

/**
 * Plugin Name: Woof schema builder
 * Author: Julien Delsescaux
 */

use WoofSchemaBuilder\Plugin;

require __DIR__ .'/static-vendor/autoload.php';
require __DIR__ .'/../woof/autoload.php';


register_activation_hook(realpath(__FILE__), [Plugin::class, 'activate']);
register_deactivation_hook(realpath(__FILE__), [Plugin::class, 'deactivate']);
register_uninstall_hook(realpath(__FILE__), [Plugin::class, 'uninstall']);


$plugin = Plugin::getInstance(__DIR__);

