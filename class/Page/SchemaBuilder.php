<?php

namespace WoofSchemaBuilder\Page;

use Woof\AdministrationPage;

use function Woof\slugify;

class SchemaBuilder extends AdministrationPage
{

    public function addAssets()
    {
        $this->setTemplate('/views/admin-schema-builder.php');
        
        parent::addAssets();
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
}
