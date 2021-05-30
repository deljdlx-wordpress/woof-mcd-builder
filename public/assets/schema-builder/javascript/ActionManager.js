class ActionManager
{

  _application;
  _actions = {};

  constructor(application) {
    this._application = application;

    this.shortcutManager = new KeyboardShortcuts(this);



    this._actions['save'] = new SaveSchema(this);

  }


  getApplication() {
    return this._application;
  }

  saveSchema() {
    this._actions['save'].run();
  }
}
