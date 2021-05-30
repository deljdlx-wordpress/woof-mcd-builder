class ApplicationActions
{

  _application;
  _modals = {};


  constructor(application) {
    this._application = application;

    this._initializeDom();
  }


  openSavePopup() {
    if(this._application.getSchema().getId()) {
      this._application.getSchema().save();
    }
    else {
      console.log('Opening Save popup');
      this._modals.save.dialog('open');
    }

  }


  save() {

    let graphTitle = document.querySelector('#graph-title').value;
    let graphExcerpt = document.querySelector('#graph-excerpt').value;

    this._application.getSchema().setTitle(graphTitle);
    this._application.getSchema().setExcerpt(graphExcerpt);
    this._application.getSchema().save();


    console.log('%c' + "saving data", 'color: #0bf; font-size: 1rem; background-color:#fff');
    console.log(this._application.getXML());

    this._application.post(
      this._application._configuration.apiBaseURL + '/save',
      {
        xml: this._application.getXML(),
        postId: this._application._configuration.postId,
        title: graphTitle,
        excerpt: graphExcerpt
      }
    )
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
            this.save();
            this._modals.save.dialog('close');
          },
          "Cancel": () => {
            this._modals.save.dialog('close');
          }
        }
    });
  }
}
