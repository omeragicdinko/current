$(document).ready(function() {

  $("main#spapp > section").height($(document).height() - 60);

  var app = $.spapp({pageNotFound : 'error_404'}); // initialize

  // define routes
  app.route({
    view: 'image1',
    load: 'image1.html'
  });
  app.route({
    view: 'selection',
    load: 'selection.html'
  });
  app.route({
    view: 'datatable',
    load: 'datatable.html'
  });

  // run app
  app.run();

});
