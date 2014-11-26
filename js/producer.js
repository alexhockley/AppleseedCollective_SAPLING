
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
		$("#producer-register-gleaning-head").hide();
		$("#producer-cancel-gleaning-head").hide();

		// Show list of events created by producer first
		$("#producer-pending-events-body").show();
		$("#producer-register-gleaning-body").hide();
		$("#producer-cancel-gleaning-body").hide();

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
// Specifically, create and cancel events, and list events.
function bindMenuButtons() {
	$("#producer-pending-events-button").click(function(){
		// Set List Events button to active
		$("#producer-pending-events-button").attr("class", "active");
		$("#producer-register-gleaning-button").attr("class", "");
		$("#producer-cancel-gleaning-button").attr("class", "");

		// Show correct header
		$("#producer-pending-events-head").show();
		$("#producer-register-gleaning-head").hide();
		$("#producer-cancel-gleaning-head").hide();

		// Show correct body
		$("#producer-pending-events-body").show();
		$("#producer-register-gleaning-body").hide();
		$("#producer-cancel-gleaning-body").hide();
		$("#create-event-form").hide();

	});

	$("#producer-register-gleaning-button").click(function(){
		// Set Create Event button to active
		$("#producer-pending-events-button").attr("class", "");
		$("#producer-register-gleaning-button").attr("class", "active");
		$("#producer-cancel-gleaning-button").attr("class", "");

		// Show correct header
		$("#producer-pending-events-head").hide();
		$("#producer-register-gleaning-head").show();
		$("#producer-cancel-gleaning-head").hide();

		// Show correct body
		$("#producer-pending-events-body").hide();
		$("#producer-cancel-gleaning-body").hide();
		$("#producer-register-gleaning-body").show();
		$("#create-event-form").show();

	});

	$("#producer-cancel-gleaning-button").click(function(){
		// Set Cancel Event button to active
		$("#producer-pending-events-button").attr("class", "");
		$("#producer-register-gleaning-button").attr("class", "");
		$("#producer-cancel-gleaning-button").attr("class", "active");

		// Show correct header
		$("#producer-pending-events-head").hide();
		$("#producer-register-gleaning-head").hide();
		$("#producer-cancel-gleaning-head").show();

		// Show correct body
		$("#producer-pending-events-body").hide();
		$("#producer-register-gleaning-body").hide();
		$("#producer-cancel-gleaning-body").show();
		$("#create-event-form").hide();
	});
}
