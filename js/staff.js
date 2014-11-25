
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

		$("#staff-pending-events-head").show(); // Getting things started
		$("#staff-create-gleaning-head").hide();
		$("#staff-delete-gleaning-head").hide();

		$("#staff-delete-events-body").hide();
		$("#staff-create-events-body").hide();
		$("#create-event-form").hide();
	});
}

function bindLoginEvents() {
	$("#staff-login-button").click(function(){
		$("#login-modal").modal('show');
	});
}

function bindMenuButtons() {
	$("#staff-pending-events-button").click(function(){
		$("#staff-pending-events-head").show();
		$("#staff-create-gleaning-head").hide();
		$("#staff-delete-gleaning-head").hide();

		$("#staff-pending-events-button").attr("class", "active");
		$("#staff-create-gleaning-button").attr("class", "");
		$("#staff-delete-gleaning-button").attr("class", "");

		$("#staff-pending-events-body").show();
		$("#staff-delete-events-body").hide();
		$("#staff-create-events-body").hide();
		$("#create-event-form").hide();
	});

	$("#staff-create-gleaning-button").click(function(){
		$("#staff-pending-events-head").hide();
		$("#staff-create-gleaning-head").show();
		$("#staff-delete-gleaning-head").hide();

		$("#staff-pending-events-button").attr("class", "");
		$("#staff-create-gleaning-button").attr("class", "active");
		$("#staff-delete-gleaning-button").attr("class", "");

		$("#staff-pending-events-body").hide();
		$("#staff-delete-events-body").hide();
		$("#staff-create-events-body").show();
		$("#create-event-form").show();
	});

	$("#staff-delete-gleaning-button").click(function(){
		$("#staff-pending-events-head").hide();
		$("#staff-create-gleaning-head").hide();
		$("#staff-delete-gleaning-head").show();

		$("#staff-pending-events-button").attr("class", "");
		$("#staff-create-gleaning-button").attr("class", "");
		$("#staff-delete-gleaning-button").attr("class", "active");

		$("#staff-pending-events-body").hide();
		$("#staff-delete-events-body").show();
		$("#staff-create-events-body").hide();
		$("#create-event-form").hide();
	});
}
