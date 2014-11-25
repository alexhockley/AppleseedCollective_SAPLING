
//When document is ready, aka, all elements are finished loading and created
$(document).ready(function(){
    testEvents();
    bindLoginEvents();
    bindMenuButtons();
});

function testEvents() {
	$("#test-view-button").click(function(){
		$("#not-logged-in-view").hide();
		$("#logged-in-view").show();
		$("#volunteer-menu-my-event-head").show();	// Just to ge things started
		$("#volunteer-my-event-body").show();

	});
}

function bindLoginEvents() {
	$("#volunteer-login-button").click(function(){
		alert("This works!");
	});
}

function bindMenuButtons() {
	// My Events
	$("#volunteer-my-event-menu-button").click(function(){
		// Hide headers
		$("#volunteer-menu-my-event-head").show();
		$("#volunteer-menu-signup-event-head").hide();
		$("#volunteer-menu-cancel-event-head").hide();
		// Set buttons not selected to inactive
		$("#volunteer-my-event-menu-button").attr("class", "active");
		$("#volunteer-sign-up-event-menu-button").attr("class", "");
		$("#volunteer-cancel-event-menu-button").attr("class", "");

		$("#volunteer-my-event-body").show();
	});

	// Sign Up For Event
	$("#volunteer-sign-up-event-menu-button").click(function(){
		$("#volunteer-menu-signup-event-head").show();
		$("#volunteer-menu-my-event-head").hide();
		$("#volunteer-menu-cancel-event-head").hide();

		$("#volunteer-my-event-menu-button").attr("class", "");
		$("#volunteer-sign-up-event-menu-button").attr("class", "active");
		$("#volunteer-cancel-event-menu-button").attr("class", "");
		$("#volunteer-my-event-body").hide();
	});

	$("#volunteer-cancel-event-menu-button").click(function(){
		$("#volunteer-menu-signup-event-head").hide();
		$("#volunteer-menu-my-event-head").hide();
		$("#volunteer-menu-cancel-event-head").show();

		$("#volunteer-my-event-menu-button").attr("class", "");
		$("#volunteer-sign-up-event-menu-button").attr("class", "");
		$("#volunteer-cancel-event-menu-button").attr("class", "active");

		$("#volunteer-my-event-body").hide();
	});
}