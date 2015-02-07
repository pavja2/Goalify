$(document).ready(function(){
//Handles the dropbox button with a popup to request permission    
 var client = new Dropbox.Client({ key: "1uu8re3yq0h6i13" });
  client.authDriver(new Dropbox.AuthDriver.Popup({ receiverUrl: "https://ec2-52-0-124-40.compute-1.amazonaws.com/signup.php"}))
    client.authenticate({interactive: false}, function(error, client) { 
  if (error) {
    return alert("Error");
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
          return alert("error 2");
        }
        alert("new authentication");
      });
    });
  }
    });
    });