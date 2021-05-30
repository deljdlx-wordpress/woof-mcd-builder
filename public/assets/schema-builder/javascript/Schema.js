
class Schema
{

  _application;

  _title;
  _excerpt;
  _xml;
  _id;

  constructor(application) {
    this._application = application;
  }

  getId() {
    return this._id;
  }

  getXML() {
    this._xml = this._application.getEditor().getXML();
    return this._xml;
  }

  setXML(xml) {
    this._xml = xml.replace(/.*?(<mxGraphModel.*?<\/mxGraphModel>).*/i, '$1');
    this._application.getEditor().loadXML(this._xml);
    return this;
  }


  loadXML(xml) {
    this._application.getEditor().loadXML(xml);
    return this;
  }


  setTitle(title) {
    this._title = title;
    return this;
  }

  setExcerpt(excerpt) {

    let node = document.createElement('span');
    node.innerHTML = excerpt;
    this._excerpt = node.textContent;
    return this;
  }

  getTitle() {
    return this._title;
  }

  getExcerpt() {
    return this._excerpt;
  }

  getId() {
    return this._id;
  }

  setId(id) {
    this._id = id;
    return this;
  }

  async save() {

    this.setXML(this._application.getEditor().getXML());

    this._application.post(
      this._application._configuration.apiBaseURL + '/save',
      {
        xml: this.getXML(),
        postId: this.getId(),
        title: this.getTitle(),
        excerpt: this.getExcerpt()
      }
    )
  }


  async loadFromApi(url) {

    let response = await this._application.get(url);
    let xml = response.content.rendered;

    this.setXML(xml);
    this.setExcerpt(response.excerpt.rendered);
    this.setTitle(response.title.rendered);
    this.setId(response.id)


  }

}