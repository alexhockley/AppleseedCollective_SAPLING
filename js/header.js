
//When document is ready, aka, all elements are finished loading and created
$(document).ready(function(){
    bindInputEvents();
});


//Bind the javascript input events for custom handling
function bindInputEvents(){
    bindHeaderEvents();
    bindLoginModalEvents();
}

//bind events related to the header bar
function bindHeaderEvents(){
    $("#login-button").click(function(){
        $("#login-modal").modal('show');
    });


}

//bind events related to the login modal
function bindLoginModalEvents(){
    //on login click
    $("#modal-login-button").off().click(function(){
        //ajax goes here, or a function which calls the login ajax, depending how we split it up
        //on success hide, on fail display error in modal
        authenticateUser();
        alert('log in yo');
    });

    //on cancel click
    $("#modal-cancel-button").off().click(function(){
        $("#login-modal input").each(function(){ //go through all the input fields and clear them
            $(this).attr('value',"");
        });
        $("#login-modal").modal('hide');//hide the modal
    });
    //on x click
    $("#modal-x").off().click(function(){
        $("#login-modal input").each(function(){ //go through all the input fields and clear them
            $(this).attr('value',"");
        });
        $("#login-modal").modal('hide');//hide the modal
    });
    $("#logout-button").off().click(function(){
      logoutUser();
      alert('logout');
    });
}

//refreshes the current page
function loginSuccess(){
  location.reload();
}

function loginError(msg){
  $("#login-error").html(msg);
  $("#login-error").show();
}

function getLoginData(){
  var data = {};

  data.email = $("#login-field").val();
  data.passwordHash = hashValue($("#password-field").val());

  return data;
}

function authenticateUser(){
  var loginData = getLoginData();
  $.ajax({
    url: GlobalConstants.API_URL_LOCAL + "users/authenticate/",
    data: loginData,
    type: "POST",
    statusCode: {
      200: function(data){
        var json = $.parseJSON(data);
        loginSuccess(); // call the success function
      },
      401: function(data){
        var json = $.parseJSON(data);
        loginError(data['message']); // call the success function
      },
      403: function(data){
        var json = $.parseJSON(data);
        loginError(data['message']); // call the success function
      }
    },
    async: false
  });
}

function logoutUser(){
  var loginData = getLoginData();
  $.ajax({
    url: GlobalConstants.API_URL_LOCAL + "users/current/logout",
    data: null,
    type: "POST",
    statusCode: {
      200: function(){
        console.log('logged out');
      }
    },
    async: false
  });
}
