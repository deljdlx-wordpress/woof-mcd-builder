<?php

namespace WoofSchemaBuilder;

use Woof\Administration as WoofAdministration;


class Administration extends WoofAdministration
{


    public function __construct()
    {
        parent::__construct();


        $this->addPage(
            'Woof schema builder',        // label
            [$this, 'woofShemaBuilderHome'],    //callback
            'woof-schema-builder'     // slug
        );

        $this->addPage(
            'Schema builder',                   // caption
            [$this, 'displaySchemaBuilderPage'],    //callback
            'woof-administration-schema-builder',    // slug
            'woof-schema-builder'       // parent
        );
    }

    public function displaySchemaBuilderPage()
    {
        echo $this->loadTemplate(__DIR__ . '/../views/admin-schema-builder.php');
    }

    public function woofShemaBuilderHome()
    {

        echo $this->loadTemplate(__DIR__ . '/../views/admin-schema-home.php');

    }

}

