$(document).ready(function() {

  $("main#spapp > section").height($(document).height() - 60);

  var app = $.spapp({pageNotFound : 'error_404'}); // initialize

  // define routes
  app.route({
    view: 'forms',
    load: 'forms.html'
  });
  app.route({
    view: 'selection',
    load: 'selection.html'
  });
  app.route({
    view: 'car_list',
    load: 'car_list.html'
  });
  app.route({
    view: 'comments',
    load: 'comments.html'
  });

  // run app
  app.run();

});
