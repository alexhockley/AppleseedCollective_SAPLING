/******************************************************************************
 * FILE NAME: homepage.js
 * PURPOSE: Contains necessary functions for the staff
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

		$("#staff-pending-events-head").show(); // Getting things started
		$("#staff-create-gleaning-head").hide();
		$("#staff-delete-gleaning-head").hide();

		$("#staff-delete-events-body").hide();
		$("#staff-create-events-body").hide();
		$("#create-event-form").hide();
	});
}

// Show login modal
function bindLoginEvents() {
	$("#staff-login-button").click(function(){
		$("#login-modal").modal('show');
	});
}

// Actions for when one of the Producer buttons are hit.
// Specifically, create and cancel events, and show events waiting for approval.
function bindMenuButtons() {
	$("#staff-pending-events-button").click(function(){
		// Show correct header
		$("#staff-pending-events-head").show();
		$("#staff-create-gleaning-head").hide();
		$("#staff-delete-gleaning-head").hide();

		// set 'list pending approval events' button to active
		$("#staff-pending-events-button").attr("class", "active");
		$("#staff-create-gleaning-button").attr("class", "");
		$("#staff-delete-gleaning-button").attr("class", "");

		// Show correct body
		$("#staff-pending-events-body").show();
		$("#staff-delete-events-body").hide();
		$("#staff-create-events-body").hide();
		$("#create-event-form").hide();
	});

	$("#staff-create-gleaning-button").click(function(){
		// Show correct header
		$("#staff-pending-events-head").hide();
		$("#staff-create-gleaning-head").show();
		$("#staff-delete-gleaning-head").hide();

		// set create events button to active
		$("#staff-pending-events-button").attr("class", "");
		$("#staff-create-gleaning-button").attr("class", "active");
		$("#staff-delete-gleaning-button").attr("class", "");

		// Show correct body
		$("#staff-pending-events-body").hide();
		$("#staff-delete-events-body").hide();
		$("#staff-create-events-body").show();
		$("#create-event-form").show();
	});

	$("#staff-delete-gleaning-button").click(function(){
		// Show correct header
		$("#staff-pending-events-head").hide();
		$("#staff-create-gleaning-head").hide();
		$("#staff-delete-gleaning-head").show();

		// set delete events button to active
		$("#staff-pending-events-button").attr("class", "");
		$("#staff-create-gleaning-button").attr("class", "");
		$("#staff-delete-gleaning-button").attr("class", "active");

		// Show correct body
		$("#staff-pending-events-body").hide();
		$("#staff-delete-events-body").show();
		$("#staff-create-events-body").hide();
		$("#create-event-form").hide();
	});
}
