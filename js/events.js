function buildEventsPage(data){
  var eventContainer = $('events-container');
  for(var event in data){
    var table = null;
    var elem = null;
    if(event['status'] === "approved"){
      var monthElem = $('#' + getMonthFromDatetime(event['datetime'])+"-header");
      if(monthElem.length > 0){//if that header is found
        table = monthElem.parent();
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



function buildEventTable(month){
  var mTable = $("<table></table>");
  mTable.attr('class','table upcoming-event-date-table');

  var mHeader = $('<h4></h4>')
  mHeader.attr('id',month+'-header');
  mHeader.html(month);

  mTable.append(mHeader);
  return mTable;

}

function buildEventElement(d, loc, t, dur, viewId){
  var row = $('<tr></tr>');
  var day = $('<td></td>');
  day.html(d);
  var location = $('<td></td>');
  location.html(loc);
  var time = $('<td></td>');
  time.html(t);
  var detailLinkContainer = $('<td></td>');
  var detailLink = $('<a></a>');
  detailLink.attr('viewid',viewId);//event id in order to pull information for the view details page
  detailLink.html('View Details');
  detailLink.attr('href', GlobalConstants.BASE_URL_LOCAL + "eventDetails.php?id=" + viewId);

  detailLinkContainer.append(detailLink);

  row.append(day);
  row.append(location);
  row.append(time);
  row.append(detailLinkContainer);

  return row;
}
