$(document).ready(function(){
  client.authenticate({interactive: false}, function(error, client) {
  if (error) {
    return handleError(error);
  }
  if (client.isAuthenticated()) {
    // Cached credentials are available, make Dropbox API calls.
    alert("authenticated");
  } else {
    // show and set up the "Sign into Dropbox" button
    var button = document.querySelector("#signin-button");
    button.setAttribute("class", "visible");
    button.addEventListener("click", function() {
      // The user will have to click an 'Authorize' button.
      client.authenticate(function(error, client) {
        if (error) {
          return handleError(error);
        }
        alert("new authentication");
      });
    });
  }
  });
})