<?php

namespace WoofSchemaBuilder\Page;

use Woof\AdministrationPage;
use Woof\Model\Wordpress\Post;

use function Woof\slugify;

class SchemaBuilder extends AdministrationPage
{

    protected $template = '/views/admin-schema-builder.php';

    public function initialize()
    {
        $action = filter_input(INPUT_GET, 'action');

        if($action === 'delete') {
            $this->delete();
        }
    }

    protected function delete()
    {
        $postId = filter_input(INPUT_GET, 'post');

        $post = new Post();
        $post->loadById($postId);
        $post->delete();
    }


    public function display($args = [])
    {

        $args = [];
        $args['nonce'] = wp_create_nonce( 'wp_rest' );

        $args['postId'] = filter_input(INPUT_GET, 'post');
        $args['baseURL'] = get_home_url();
        $args['apiBaseURL'] = get_home_url() . '/wp-json/woof-shema-builder/v1';
        $args['wpApiBaseURL'] = get_home_url() . '/wp-json/wp/v2';

        parent::display($args);
    }


    public function addAssets()
    {
        parent::addAssets();
        $scripts = [

            '/assets/schema-builder/javascript/initGraphEditor.js',

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

            '/assets/schema-builder/javascript/WoofSchemaEditor.js',
            '/assets/schema-builder/javascript/Application.js',

            '/assets/schema-builder/javascript/ActionManager.js',
            '/assets/schema-builder/javascript/KeyboardShorcuts.js',
            '/assets/schema-builder/javascript/Action/ApplicationAction.js',
            '/assets/schema-builder/javascript/ActionManager.js',
            '/assets/schema-builder/javascript/Action/SaveSchema.js',

            '/assets/schema-builder/javascript/Schema.js',
            '/assets/schema-builder/javascript/bootstrap.js'
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
