/*
  events.js
  This javascript is responsible for building the events page using data stored in the database
  Date: Nov 25 2014
  Authors: Sapling
  Updated: Alex Hockley
  Date Updated: Nov 25 2014
*/


$(document).ready(function(){
  //call ajax to get events
  $.ajax({
    url: "/events",
    data: null,
    type: "GET",
    contentType: "application/json",
    statusCode: {
      200: function(data){
//        var json = JSON.parse(data.responseText);
        buildEventsPage(data); // call the success function
      },
      401: function(data){
        var json = JSON.parse(data.responseText);
        fetchEventsError(json['message']); // call the failure function
      },
      403: function(data){
        var json = JSON.parse(data.responseText);
        fetchEventsError(data['message']); // call the failure function
      }
    },
    async: false
  });
});

/* TODO
 * Purpose: Displays an error when the events fetching fails
 * Parameters: String msg - the error message
 * Returns: Nothing
 */
function fetchEventsError(msg){



}

/* Purpose: Builds all of the event info and appends it to the events-container
 * Parameters: Object json - contains all of the event info as defined in the API
 * Returns: Nothing
 */
function buildEventsPage(json){
  var eventContainer = $('events-container');
  for(var event in json['events']){
    var table = null;
    var elem = null;
    if(event['status'] === "approved"){
      var monthElem = $('#' + getMonthFromDatetime(event['datetime'])+"-header");
      if(monthElem.length > 0){//if that header is found
        table = monthElem.parent(); //get the table
        elem = buildEventElement(getDayFromDatetime(event['datetime']),event['location']['address1'],getTime12StrFromDatetime(event['datetime']),getDurationFromDatetime(event['datetime'],event['endtime']));
        table.append(elem); // add the new element to the existing table
      }
      else{
        table = buildEventTable(getMonthFromDatetime(event['datetime']));
        elem = buildEventElement(getDayFromDatetime(event['datetime']),event['location']['address1'],getTime12StrFromDatetime(event['datetime']),getDurationFromDatetime(event['datetime'],event['endtime']));
        table.append(elem); // add the new element to the new table
        eventContainer.append(table); //add the new table to the container
      }
    }
  }
}


/* Purpose: Builds the table representing each month of the events page
 * Parameters: String month - month to build the table for
 * Returns: JQuery table element containing the header of the current month
 */
function buildEventTable(month){
  var mTable = $("<table></table>"); //table element
  mTable.attr('class','table upcoming-event-date-table');

  var mHeader = $('<h4></h4>'); // header element
  mHeader.attr('id',month+'-header');//set the id to the month
  mHeader.html(month);

  mTable.append(mHeader);
  return mTable;

}

/* Purpose: Binds the input events related to the header
 * Parameters: int d - day of the month, String location - address of the event, String t - Start time of the event, String dur - Duration of the event, int viewId - id of the event
 * Returns: JQuery element of the table row containing the event information
 */
function buildEventElement(d, loc, t, dur, viewId){
  var row = $('<tr></tr>'); //build row element
  var day = $('<td></td>'); //build day data
  day.html(d);
  var location = $('<td></td>'); //build location data
  location.html(loc);
  var time = $('<td></td>'); //build time data
  time.html(t);
  var detailLinkContainer = $('<td></td>');//build container for the view details link
  var detailLink = $('<a></a>'); //view details link
  detailLink.attr('viewid',viewId);//event id in order to pull information for the view details page
  detailLink.html('View Details');
  detailLink.attr('href', GlobalConstants.BASE_URL_LOCAL + "eventDetails.php?id=" + viewId);

  detailLinkContainer.append(detailLink); //append the link to the container

  //append all the data to the row
  row.append(day);
  row.append(location);
  row.append(time);
  row.append(detailLinkContainer);

  return row;
}
