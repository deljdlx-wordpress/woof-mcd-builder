<?php

namespace WoofSchemaBuilder;

use Woof\AdministrationPage;
use Woof\AdministrationSection as WoofAdministrationSection;
use WoofSchemaBuilder\Page\SchemaBuilder;


class AdministrationSection extends WoofAdministrationSection
{

    public function registerPages()
    {

        $home = new AdministrationPage(
            $this,
            'Woof schema builder',
            'woof-schema-builder--home'
        );
        $home->setMenuTitle('Woof shema builder');
        $home->setTemplate('/views/admin-schema-home.php');
        $this->addPage($home);


        $schemaBuilder = new SchemaBuilder(
            $this,
            'Builder',
            'woof-schema-builder--builder',
            $home

        );
        $this->addPage($schemaBuilder);
    }
}

