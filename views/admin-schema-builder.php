<script>
// custom.js
document.addEventListener('DOMContentLoaded', () => {

    console.log('DOMContentLoaded');

    jQuery(function($) {
        var $info = jQuery("#modal-content");
        $info.dialog({
            'dialogClass'   : 'wp-dialog',
            'modal'         : true,
            'autoOpen'      : false,
            'closeOnEscape' : true,
            'buttons'       : {
                "Close": function() {
                    jQuery(this).dialog('close');
                }
            }
        });
        jQuery("#open-modal").click(function(event) {
            event.preventDefault();

            console.log('open');

            $info.dialog('open');
        });
    });
})


</script>



<button id="open-modal">open</button>



<div id="modal-content">
hello world
</div>


<div class="woof-schema-editor geEditor"></div>

<?php

echo '<script>';
echo PHP_EOL;
echo "window.mxBasePath = '" . $pluginURL . "/public/assets/mxgraph/src';";
echo PHP_EOL;
echo "window.STYLE_PATH = '" . $pluginURL . "/public/assets/grapheditor/styles';";
echo PHP_EOL;
echo "window.RESOURCES_PATH = '" . $pluginURL . "/public/assets/grapheditor/resources';";
echo PHP_EOL;
echo "window.STENCIL_PATH = '" . $pluginURL . "/public/assets/grapheditor/stencils';";
echo PHP_EOL;

echo "window.WP_API_NONCE='" . wp_create_nonce( 'wp_rest' ) . "';";
echo PHP_EOL;
echo "window.WP_BASE_URI='http://localhost/deploy-wordpress-sample/public';";
echo PHP_EOL;
echo '</script>';
?>


