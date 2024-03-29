/******************************************************************************
 * FILE NAME: headers.js
 * PURPOSE: Contains necessary input binding and javascript functionality for the header. 
 * AUTHOR(S): Przemyslaw Gawron, Alex Hockley, Erica Pisani-Konert, 
 *            Jinhai Wang, Rhys Hall
 * GROUP NAME: Sapling
 * CREATED: Thursay November 25, 2014
 * CONTACT: 
 * UPDATED BY: Alex Hockley
 * LAST UPDATED: Tuesday November 25, 2014
 * UPDATE NOTES: 
 ******************************************************************************/


$(document).ready(function(){
    bindInputEvents();
});


/* Purpose: Binds the input events for the header and well as the login modal window
 * Parameters: None
 * Returns: Nothing
 */
function bindInputEvents(){
    bindHeaderEvents();
    bindLoginModalEvents();
}

/* Purpose: Binds the input events related to the header
 * Parameters: None
 * Returns: Nothing
 */
function bindHeaderEvents(){
    //when the login button is pressed
    $("#login-button").click(function(){
        $("#login-modal").modal('show');
    });
    //when the logout button is pressed
    $("#logout-button").off().click(function(){
      logoutUser();
    });

}

/* Purpose: Binds the input events for login modal window
 * Parameters: None
 * Returns: Nothing
 */
function bindLoginModalEvents(){
    //on login click
    $("#modal-login-button").off().click(function(){
        authenticateUser();
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
}

/* Purpose: Performs actions after a successful login. Currently only refreshes the page.
 * Parameters: None
 * Returns: Nothing
 */
function loginSuccess(){
  location.reload();
}

/* Purpose: Performs actions after a successful logout. Currently only refreshes the page.
 * Parameters: None
 * Returns: Nothing
 */
function logoutSuccess(){
  location.reload();
}

/* Purpose: Displays an error message in the login modal window
 * Parameters: String msg - The message to display
 * Returns: Nothing
 */
function loginError(msg){
  $("#login-error").html(msg);
  $("#login-error").show();
}

/* Purpose: Gets the input from the forms of the login modal window
 * Parameters: None
 * Returns: An object containing the entered email and a hashed password
 */
function getLoginData(){
  var data = {};

  data.email = $("#login-field").val();
  //data.passwordHash = hashValue($("#password-field").val());
  data.passwordHash = $("#password-field").val();
  return data;
}

/* Purpose: Makes an ajax request to authenticate a user. Calls loginSuccess() on success and loginError() on error.
 * Parameters: None
 * Returns: Nothing
 */
function authenticateUser(){
  var loginData = getLoginData(); //gets the login data from the forms\
  $.ajax({
    url: "/users/authenticate",
    data: loginData,
    type: "POST",
    statusCode: {
      200: function(data){
        //var json = $.parseJSON(data);
        //var json = JSON.parse(data);
        loginSuccess(); // call the success function
      },
      401: function(data){
        //var json = $.parseJSON(data);
        v//ar json = JSON.parse(data);
        loginError(data['message']); // call the failure function
      },
      403: function(data){
        var json = $.parseJSON(data.responseText);
        loginError(json['message']); // call the failure function
      }
    },
    async: false
  });
}

/* Purpose: Makes an ajax request to log the user out by terminating the session
 * Parameters: None
 * Returns: Nothing
 */
function logoutUser(){
  var loginData = getLoginData();
  $.ajax({
    url: "/users/current/logout",
    data: null,
    type: "POST",
    statusCode: {
      200: function(){
        logoutSuccess(); //call the success function
      }
    },
    async: false
  });
}
