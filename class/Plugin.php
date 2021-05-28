<?php

namespace WoofSchemaBuilder;

use Woof\Plugin as WoofPlugin;

class Plugin extends WoofPlugin
{
    protected static $instance;
    protected $pageManager;

    public function __construct($filepath)
    {
        parent::__construct($filepath);
        $this->pageManager = new AdministrationSection();
    }

    public function registerPostTypes()
    {
        $this->createPostType('Woof schema', 'woof-schema');
    }
}
