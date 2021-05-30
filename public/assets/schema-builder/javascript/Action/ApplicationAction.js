class ApplicationAction
{

  _manager;
  _application;
  _modals = {};


  constructor(manager) {
    this._manager = manager;

    this._application = manager.getApplication();

    this._initializeDom();
  }



  _initializeDom() {
  }

}
