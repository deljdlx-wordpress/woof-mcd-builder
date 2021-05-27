<style>
body {
    overflow: hidden;
}
#wpwrap {
    height: 100%;
}

#wpcontent {
    min-height: 100%;
    height: 100%;
    padding-left: 0;
}

#wpbody {
    min-height: 100%;
    overflow: hidden;
    /*height: 100%;*/
}

#wpbody-content {
    min-height: 100%;
    height: 100%;
}

</style>

<!--
<iframe style="height: 100%; width: 100%" src="http://localhost/deploy-wordpress-sample/public/wp-content/plugins/woof-schema-builder/public/grapheditor/"></iframe>
//-->

<?php

// echo plugin_dir_url(__DIR__) . '/public/grapheditor/js/Init.js';

echo '<script>';
echo PHP_EOL;
echo 'console.log("' . plugin_dir_url(__DIR__) . '");';
echo PHP_EOL;
echo "window.mxBasePath = '" . plugin_dir_url(__DIR__) . "/public/assets/mxgraph/src';";
echo PHP_EOL;
echo "window.STYLE_PATH = '" . plugin_dir_url(__DIR__) . "/public/grapheditor/styles';";
echo PHP_EOL;
echo "window.RESOURCES_PATH = '" . plugin_dir_url(__DIR__) . "/public/grapheditor/resources';";
echo PHP_EOL;
echo "window.STENCIL_PATH = '" . plugin_dir_url(__DIR__) . "/public/grapheditor/stencils';";
echo PHP_EOL;

echo "window.WP_API_NONCE='" . wp_create_nonce( 'wp_rest' ) . "';";
echo PHP_EOL;
echo "window.WP_BASE_URI='http://localhost/deploy-wordpress-sample/public';";
echo PHP_EOL;


echo '</script>';
?>

<?php
echo '<link rel="stylesheet" type="text/css" href="' . plugin_dir_url(__DIR__) . '/public/grapheditor/styles/grapheditor.css">';


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


    'woof/bootstrap.js',
];

foreach($scripts as $source) {
    echo '<script type="text/javascript" src="' . plugin_dir_url(__DIR__) . '/public/grapheditor/' . $source . '"></script>' . PHP_EOL;
}
?>

<style>

</style>


<div class="woof-schema-editor geEditor"></div>

<script>

document.addEventListener('DOMContentLoaded', () => {



});

</script>


