
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
		$("#producer-register-gleaning-head").hide();
		$("#producer-cancel-gleaning-head").hide();

		$("#producer-pending-events-body").show();
		$("#producer-register-gleaning-body").hide();
		$("#producer-cancel-gleaning-body").hide();

		$("#create-event-form").hide();
	});
}

function bindLoginEvents() {
	$("#staff-login-button").click(function(){
		$("#login-modal").modal('show');
	});
}

function bindMenuButtons() {
	$("#producer-pending-events-button").click(function(){
		$("#producer-pending-events-button").attr("class", "active");
		$("#producer-register-gleaning-button").attr("class", "");
		$("#producer-cancel-gleaning-button").attr("class", "");


		$("#producer-pending-events-head").show();
		$("#producer-register-gleaning-head").hide();
		$("#producer-cancel-gleaning-head").hide();

		$("#producer-pending-events-body").show();
		$("#producer-register-gleaning-body").hide();
		$("#producer-cancel-gleaning-body").hide();
		$("#create-event-form").hide();

	});

	$("#producer-register-gleaning-button").click(function(){
		$("#producer-pending-events-button").attr("class", "");
		$("#producer-register-gleaning-button").attr("class", "active");
		$("#producer-cancel-gleaning-button").attr("class", "");

		$("#producer-pending-events-head").hide();
		$("#producer-register-gleaning-head").show();
		$("#producer-cancel-gleaning-head").hide();

		$("#producer-pending-events-body").hide();
		$("#producer-cancel-gleaning-body").hide();
		$("#producer-register-gleaning-body").show();
		$("#create-event-form").show();

	});

	$("#producer-cancel-gleaning-button").click(function(){
		$("#producer-pending-events-button").attr("class", "");
		$("#producer-register-gleaning-button").attr("class", "");
		$("#producer-cancel-gleaning-button").attr("class", "active");

		$("#producer-pending-events-head").hide();
		$("#producer-register-gleaning-head").hide();
		$("#producer-cancel-gleaning-head").show();

		$("#producer-pending-events-body").hide();
		$("#producer-register-gleaning-body").hide();
		$("#producer-cancel-gleaning-body").show();
		$("#create-event-form").hide();
	});
}
