class SaveSchema extends ApplicationAction
{

  _titleElement;
  _excerptElement;

  _modal;


  constructor(manager) {
    super(manager);

    this._modal = jQuery("#modal-save-graph");
    this._titleElement = document.querySelector('#graph-title');
    this._excerptElement = document.querySelector('#graph-excerpt');

    this._modal.dialog({
        'dialogClass'   : 'wp-dialog',
        'modal'         : true,
        'autoOpen'      : false,
        'closeOnEscape' : true,
        'buttons'       : {
          "Save": () => {
            let title = this.getTitleElement().value;
            let excerpt = this.getExcerptElement().value;

            this._application.getSchema().setTitle(title);
            this._application.getSchema().setExcerpt(excerpt);

            this._application.getSchema().save();
            this._modal.dialog('close');
          },
          "Cancel": () => {
            this._modal.dialog('close');
          }
        }
    });
  }


  _initializeDom() {
    document.querySelector('#save-graph-form').addEventListener('submit', (event) => {
      event.preventDefault();
      this._application.getSchema().save();
    });
  }


  run() {
    if(this._application.getSchema().getId() && 0) {
      this._application.getSchema().save();
    }
    else {

      let title = this._application.getSchema().getTitle();
      let excerpt = this._application.getSchema().getExcerpt();

      this._titleElement.value = title;
      this._excerptElement.value = excerpt;

      this._modal.dialog('open');
    }
  }


  getTitleElement() {
    return document.querySelector('#graph-title');
  }

  getExcerptElement() {
    return document.querySelector('#graph-excerpt');
  }
}
