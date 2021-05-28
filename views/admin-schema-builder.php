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

?>


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

<script>

document.addEventListener('DOMContentLoaded', () => {



});

</script>


