<?php

namespace WoofSchemaBuilder;

use Woof\Administration as WoofAdministration;

use function Woof\slugify;

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

    public function addAssets()
    {
        parent::addAssets();

        $scripts = [
            'js/Init.js',
            'deflate/pako.min.js',
            'deflate/base64.js',
            'jscolor/jscolor.js',
            'sanitizer/sanitizer.min.js',
            '../assets/mxgraph/src/js/mxClient.js',
            'js/EditorUi.js',
            'js/Editor.js',
            'js/Sidebar.js',
            'js/Graph.js',
            'js/Format.js',
            'js/Shapes.js',
            'js/Actions.js',
            'js/Menus.js',
            'js/Toolbar.js',
            'js/Dialogs.js',
            'woof/WoofSchemaEditor.js',
            'woof/Application.js',

            'woof/bootstrap.js'
        ];
        foreach($scripts as $script) {
            $this->addScript(
                slugify($script),
                $this->getPluginURL() . '/public/grapheditor/' . $script,
                null,
                null,
                true
            );
        }


        $this->addCSS(
            'grapheditor.css',
            $this->getPluginURL() . '/public/grapheditor/styles/grapheditor.css'
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

