


document.addEventListener('DOMContentLoaded', () => {


  let application = new Application(
    document.querySelector('.woof-schema-editor'),
    window.WP_BASE_URI
  );

  application.run(() => {
    application.loadFromApi('http://localhost/deploy-wordpress-sample/public/wp-json/wp/v2/woof-schema/247');
    // application.loadXML(xml);
  });
});



