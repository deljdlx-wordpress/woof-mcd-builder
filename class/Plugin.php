<?php

namespace WoofSchemaBuilder;

use Woof\Plugin as WoofPlugin;

class Plugin extends WoofPlugin
{
    protected static $instance;

    public function registerPostTypes()
    {
        $this->createPostType('Woof schema', 'woof-schema');
    }
}
