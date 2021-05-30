class ActionManager
{

  _application;
  _modals = {};


  _actions = {};

  constructor(application) {
    this._application = application;
    this._actions['save'] = new SaveSchema(this);
  }


  getApplication() {
    return this._application;
  }

  saveSchema() {
    this._actions['save'].run();
  }
}
