
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
    $("#modal-login-button").click(function(){
        //ajax goes here, or a function which calls the login ajax, depending how we split it up
        //on success hide, on fail display error in modal
        alert('log in yo');
    });

    //on cancel click
    $("#modal-cancel-button").click(function(){
        $("#login-modal input").each(function(){ //go through all the input fields and clear them
            $(this).attr('value',"");
        });
        $("#login-modal").modal('hide');//hide the modal
    });
    //on x click
    $("#modal-x").click(function(){
        $("#login-modal input").each(function(){ //go through all the input fields and clear them
            $(this).attr('value',"");
        });
        $("#login-modal").modal('hide');//hide the modal
    });
}

//refreshes the current page
function loginSuccess(token){
  location.reload();
}
