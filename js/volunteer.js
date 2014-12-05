/******************************************************************************
 * FILE NAME: homepage.js
 * PURPOSE: Contains necessary functions for the volunteer
 * AUTHOR(S): Przemyslaw Gawron, Alex Hockley, Erica Pisani-Konert, 
 *            Jinhai Wang, Rhys Hall
 * GROUP NAME: Sapling
 * CREATED: Thursay November 21, 2014
 * CONTACT: 
 * UPDATED BY: Erica Pisani-Konert
 * LAST UPDATED: Tuesday November 25, 2014
 * UPDATE NOTES: 
 ******************************************************************************/

//When document is ready, aka, all elements are finished loading and created
$(document).ready(function(){
    testEvents();
    bindLoginEvents();
    bindMenuButtons();
});

// Button to bypass login process for testing purposes
function testEvents() {
	$("#test-view-button").click(function(){
		$("#not-logged-in-view").hide();
		$("#logged-in-view").show();

		// Show list of events user has volunteered for first
		$("#volunteer-menu-my-event-head").show();
		$("#volunteer-menu-signup-event-head").hide();
		$("#volunteer-menu-cancel-event-head").hide();

		// Show correct body
		$("#volunteer-my-event-body").show();
		$("#volunteer-sign-up-event-body").hide();
		$("#volunteer-cancel-event-body").hide();

	});
}

// Show login modal
function bindLoginEvents() {
	$("#volunteer-login-button").click(function(){
		$("#login-modal").modal('show');
	});
}

function bindMenuButtons() {
	// My Events
	$("#volunteer-my-event-menu-button").click(function(){
		// Show correct header
		$("#volunteer-menu-my-event-head").show();
		$("#volunteer-menu-signup-event-head").hide();
		$("#volunteer-menu-cancel-event-head").hide();

		// Set buttons not selected to inactive
		$("#volunteer-my-event-menu-button").attr("class", "active");
		$("#volunteer-sign-up-event-menu-button").attr("class", "");
		$("#volunteer-cancel-event-menu-button").attr("class", "");

		// Show correct body
		$("#volunteer-my-event-body").show();
		$("#volunteer-sign-up-event-body").hide();
		$("#volunteer-cancel-event-body").hide();
	});

	// Sign Up For Event
	$("#volunteer-sign-up-event-menu-button").click(function(){
		// Show correct header
		$("#volunteer-menu-signup-event-head").show();
		$("#volunteer-menu-my-event-head").hide();
		$("#volunteer-menu-cancel-event-head").hide();

		// Set buttons not selected to inactive
		$("#volunteer-my-event-menu-button").attr("class", "");
		$("#volunteer-sign-up-event-menu-button").attr("class", "active");
		$("#volunteer-cancel-event-menu-button").attr("class", "");

		// Show correct body
		$("#volunteer-my-event-body").hide();
		$("#volunteer-sign-up-event-body").show();
		$("#volunteer-cancel-event-body").hide();
	});

	// Cancel Event
	$("#volunteer-cancel-event-menu-button").click(function(){
		// Show correct header
		$("#volunteer-menu-signup-event-head").hide();
		$("#volunteer-menu-my-event-head").hide();
		$("#volunteer-menu-cancel-event-head").show();

		// Set buttons not selected to inactive
		$("#volunteer-my-event-menu-button").attr("class", "");
		$("#volunteer-sign-up-event-menu-button").attr("class", "");
		$("#volunteer-cancel-event-menu-button").attr("class", "active");

		// Show correct body
		$("#volunteer-my-event-body").hide();
		$("#volunteer-sign-up-event-body").hide();
		$("#volunteer-cancel-event-body").show();
	});
}
