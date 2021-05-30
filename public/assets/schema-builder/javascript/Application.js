class Application
{

  _containerElement;

  _schemaEditor;
  _schema;

  _baseURL;

  _configuration;


  _actions;

  constructor(configuration) {

    this._configuration = configuration;
    console.log(this._configuration);

    this._actions = new ActionManager(this);



    this._containerElement = document.querySelector(this._configuration.element);
    this._baseURL = this._configuration.apiBaseURL;


    this._schemaEditor = new WoofShemaEditor(this._containerElement);
    this._schema = new Schema(this);

    this._initializeDom();
		this._initialize();

  }


  _initialize() {
    this._schemaEditor.addEventListener('save', () => {
      this._actions.saveSchema();
    });
  }

  _initializeDom() {

  }

  getSchema() {
    return this._schema;
  }


  getEditor() {
    return this._schemaEditor;
  }


  run(callback) {
    this._schemaEditor.addEventListener('run', callback);
    this._schemaEditor.run();
  }


  async get(url, options = {}) {
    const response = await this.ajax('GET', url, null, options);
    return response;
  }

  async post(url, data = null, options = {}) {
    const response = await this.ajax('POST', url, data, options);
    return response;
  }

  async ajax(method, url, data = {},  options = {}) {
    // Default options are marked with *
    let currentOptions = {
      method: method,
      // mode: 'cors',
      cache: 'no-cache',
      credentials: 'include', // include, *same-origin, omit handling cookies
      redirect: 'follow', // manual, *follow, error
      referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
    };

    currentOptions.headers = {};

    if(this._configuration.nonce) {
      currentOptions.headers['X-WP-Nonce'] = this._configuration.nonce;
    }



    if(method === 'POST') {
      // data._wpnonce = window.WOOF_SHEMA_BUILDER_WP_NONCE;
    }

    if(data) {
      currentOptions.body = JSON.stringify(data); // body data type must match "Content-Type" header
      currentOptions.headers['Content-Type'] = 'application/json';
      // 'Content-Type': 'application/x-www-form-urlencoded',
    }
    const response = await fetch(url, currentOptions);
    return response.json(); // parses JSON response into native JavaScript objects
  }

}
