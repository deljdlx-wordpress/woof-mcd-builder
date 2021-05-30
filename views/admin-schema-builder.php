
<div id="modal-save-graph" class="modal">
    <form>
        <div>
            <label>Title <input name="graph-title" id="graph-title"/></label>
        </div>

        <div>
            <label>Description <textarea name="graph-description" id="graph-excerpt"></textarea></label>
        </div>

    </form>
</div>


<div class="woof-schema-editor geEditor"></div>

<script>
const WOOF_GRAPH_EDITOR_CONFIGURATION = {
    baseURL :'<?=$baseURL?>',
    apiBaseURL: '<?=$apiBaseURL?>',
    wpApiBaseURL: '<?=$wpApiBaseURL?>',
    postId: Number('<?=$postId?>'),
    element: '.woof-schema-editor',
    nonce: '<?=$nonce?>',
};

</script>



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
echo '</script>';
?>


