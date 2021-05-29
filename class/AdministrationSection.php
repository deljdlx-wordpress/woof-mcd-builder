<?php

namespace WoofSchemaBuilder;

use Woof\AdministrationSection as WoofAdministrationSection;

use function Woof\slugify;

class AdministrationSection extends WoofAdministrationSection
{


    public function __construct($plugin)
    {

        parent::__construct($plugin);

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
        return;

        $scripts = [
            '/assets/grapheditor/js/Init.js',
            '/assets/grapheditor/deflate/pako.min.js',
            '/assets/grapheditor/deflate/base64.js',
            '/assets/grapheditor/jscolor/jscolor.js',
            '/assets/grapheditor/sanitizer/sanitizer.min.js',
            '/assets/mxgraph/src/js/mxClient.js',
            '/assets/grapheditor/js/EditorUi.js',
            '/assets/grapheditor/js/Editor.js',
            '/assets/grapheditor/js/Sidebar.js',
            '/assets/grapheditor/js/Graph.js',
            '/assets/grapheditor/js/Format.js',
            '/assets/grapheditor/js/Shapes.js',
            '/assets/grapheditor/js/Actions.js',
            '/assets/grapheditor/js/Menus.js',
            '/assets/grapheditor/js/Toolbar.js',
            '/assets/grapheditor/js/Dialogs.js',

            '/assets/schema-builder/WoofSchemaEditor.js',
            '/assets/schema-builder/Application.js',
            '/assets/schema-builder/bootstrap.js'
        ];
        foreach($scripts as $script) {
            $this->addScript(
                slugify($script),
                $this->getPluginURL() . '/public' . $script,
                null,
                null,
                true
            );
        }


        $this->addCSS(
            'grapheditor.css',
            $this->getPluginURL() . '/public/assets/grapheditor/styles/grapheditor.css'
        );

        $this->addCSS(
            'schema-builder.css',
            $this->getPluginURL() . '/public/assets/schema-builder/css/schema-builder.css'
        );
    }

    public function displaySchemaBuilderPage()
    {
        $template = $this->loadTemplate(__DIR__ . '/../views/admin-schema-builder.php');
        echo $template;
    }

    public function woofShemaBuilderHome()
    {

        $template = $this->loadTemplate(__DIR__ . '/../views/admin-schema-home.php');
        echo $template;

    }
}

