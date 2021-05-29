class Application
{

  _containerElement;
  _shemaEditor;

  _baseURL;

  _configuration;


  constructor(configuration) {

    this._configuration = configuration;
    console.log(this._configuration);

    this._containerElement = document.querySelector(this._configuration.element);
    this._baseURL = this._configuration.apiBaseURL;
    this._shemaEditor = new WoofShemaEditor(this._containerElement);

		this._initialize();
  }



  _initialize() {
    this._shemaEditor.addEventListener('save', () => {
      console.log('%c' + "saving data", 'color: #0bf; font-size: 1rem; background-color:#fff');
      console.log(this.getXML());

      this.post(
        this._configuration.apiBaseURL + '/save',
        {
          xml: this.getXML(),
          postId: this._configuration.postId
        }
      )

    });
  }

  getXML() {
    return this._shemaEditor.getXML();
  }

  async loadFromApi(url) {
    let response = await this.get(url);

    let xml = response.content.rendered;
    xml = xml.replace(/.*?(<mxGraphModel.*?<\/mxGraphModel>).*/i, '$1');

    this.loadXML(xml)
  }

  loadXML(xml) {
    this._shemaEditor.loadXML(xml);
    return this;
  }


  /*
  save() {
    this._shemaEditor.save()
  }
  */


  run(callback) {
    this._shemaEditor.addEventListener('run', callback);
    this._shemaEditor.run();
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



    // console.log('%c' + window.WP_API_NONCE, 'color: #0bf; font-size: 1rem; background-color:#fff');

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
