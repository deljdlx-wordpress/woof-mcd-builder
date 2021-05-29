


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


  let application = new Application(
    WOOF_GRAPH_EDITOR_CONFIGURATION
    // document.querySelector('.woof-schema-editor'),
    // window.WP_BASE_URI
  );

  application.run(() => {
    console.log(WOOF_GRAPH_EDITOR_CONFIGURATION);
    if(WOOF_GRAPH_EDITOR_CONFIGURATION.postId) {
      application.loadFromApi(WOOF_GRAPH_EDITOR_CONFIGURATION.wpApiBaseURL + '/woof-schema/' + WOOF_GRAPH_EDITOR_CONFIGURATION.postId);
    }
  });
});



