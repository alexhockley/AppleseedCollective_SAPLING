
//When document is ready, aka, all elements are finished loading and created
$(document).ready(function(){
    bindLoginEvents();
});

function bindLoginEvents() {
	$("#volunteer-login-button").click(function(){
		alert("This works!");
	});
}
