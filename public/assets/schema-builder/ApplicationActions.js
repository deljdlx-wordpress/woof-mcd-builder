class ApplicationActions
{

  _application;
  _modals = {};


  constructor(application) {
    this._application = application;

    this._initializeDom();
  }


  openSavePopup() {
    if(this._application.getSchema().getId() && 0) {
      this._application.getSchema().save();
    }
    else {
      console.log('Opening Save popup');


      let title = this._application.getSchema().getTitle();
      let excerpt = this._application.getSchema().getExcerpt();

      document.querySelector('#graph-title').value = title;
      document.querySelector('#graph-excerpt').value = excerpt;


      this._modals.save.dialog('open');
    }

  }


  _initializeDom() {
    this._initializeSavePopup();
  }


  _initializeSavePopup() {
    this._modals.save = jQuery("#modal-save-graph");
    this._modals.save .dialog({
        'dialogClass'   : 'wp-dialog',
        'modal'         : true,
        'autoOpen'      : false,
        'closeOnEscape' : true,
        'buttons'       : {
          "Save": () => {
            let title = document.querySelector('#graph-title').value;
            let excerpt = document.querySelector('#graph-excerpt').value;

            this._application.getSchema().setTitle(title);
            this._application.getSchema().setExcerpt(excerpt);

            this._application.getSchema().save();
            this._modals.save.dialog('close');
          },
          "Cancel": () => {
            this._modals.save.dialog('close');
          }
        }
    });
  }
}
