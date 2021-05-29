class WoofShemaEditor
{

  _containerElement;

  _editorUIInstance;
  _editor;
  _bundle;

  _defaultXML = ``;

  _listeners = {
    ready: [],
    run: [],
    save: [],
  };

  constructor(container) {

    this._containerElement = container;

    this._editorUiInit = EditorUi.prototype.init;


    // Adds required resources (disables loading of fallback properties, this can only
    // be used if we know that all keys are defined in the language specific file)
    mxResources.loadDefaultBundle = false;
    this._bundle = mxResources.getDefaultBundle(RESOURCE_BASE, mxLanguage) ||
    mxResources.getSpecialBundle(RESOURCE_BASE, mxLanguage);

    this._initialize();
  }

  _initialize() {

    mxUtils.getAll([this._bundle, STYLE_PATH + '/default.xml'], (xhr) => {
      // Adds bundle text to resources
      mxResources.parse(xhr[0].getText());

      // Configures the default graph theme
      var themes = new Object();
      themes[Graph.prototype.defaultThemeName] = xhr[1].getDocumentElement();

      // Main
      this._editorUIInstance = new EditorUi(
        new Editor(false, themes),
        this._containerElement
      );

      this._initializeEvents();
      this.executeListeners('ready');

    }, function()
    {
      document.body.innerHTML = '<center style="margin-top:10%;">Error loading resource files. Please check browser console.</center>';
    }
    );
  }


  _initializeEvents() {
    this._editorUIInstance.actions.addAction('save', () => {
      this.executeListeners('save');
      // console.log(this.getXML());
    });
  }



  addEventListener(name, callback) {
    if(!this._listeners[name]) {
      this._listeners[name] = [];
    }
    this._listeners[name].push(callback);
    return this;
  }

  executeListeners(name) {
    for(let listener of this._listeners[name]) {
      let callback = listener.bind(this);
      callback(this);
    }
    return this;
  }



  loadXML(xml) {
    let xmlNode = mxUtils.parseXml(xml).documentElement;
    this.loadXMLNode(xmlNode);
    return this;
  }

  loadXMLNode(node) {
    // NOTICE fonction aussi editorUIInstance.editor.setGraphXml(node);
    this._editorUIInstance.editor.graph.setSelectionCells(
      this._editorUIInstance.editor.graph.importGraphModel(node)
    );
    this._editorUIInstance.editor.setModified(false);
  }



  run() {
    this.addEventListener('ready', () => {
      this.executeListeners('run');
    });
  }

  getXML() {
    let currentXMLNode = this._editorUIInstance.editor.getGraphXml();
    let saveWrapper = document.createElement("div");
    saveWrapper.appendChild(currentXMLNode);
    return saveWrapper.innerHTML;
  }
}