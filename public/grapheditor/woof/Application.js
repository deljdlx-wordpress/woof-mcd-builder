class Application
{

  _containerElement;
  _shemaEditor;

  constructor(container) {
    this._containerElement = container;
		this._shemaEditor = new WoofShemaEditor(this._containerElement);
		this._initialize();
  }



  _initialize() {
    this._shemaEditor.addEventListener('save', () => {
      console.log('%c' + "saving data", 'color: #0bf; font-size: 1rem; background-color:#fff');
      console.log(this.getXML());

      this.post(
        'http://localhost/deploy-wordpress-sample/public/wp-json/woof-shema-builder/v1/save',
        // 'http://localhost/deploy-wordpress-sample/public/wp-json/woof-shema-builder/v1/save?_wpnonce=' + window.WP_API_NONCE,
        {
          xml: this.getXML()
        }
      )

    });
  }

  getXML() {
    return this._shemaEditor.getXML();
  }

  loadXML(xml) {
    this._shemaEditor.loadXML(xml);
    return this;
  }


  save() {
    // this._shemaEditor.
  }


  run(callback) {
    this._shemaEditor.addEventListener('run', callback);
    this._shemaEditor.run();
  }



  async get(url, options = {}) {
    const response = await this.ajax('GET', url, options);
    return response;
  }

  async post(url, data = {}, options = {}) {
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



    // console.log('%c' + window.WP_API_NONCE, 'color: #0bf; font-size: 1rem; background-color:#fff');

    currentOptions.headers = {};

    if(window.WP_API_NONCE) {
      currentOptions.headers['X-WP-Nonce'] = window.WP_API_NONCE;
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
