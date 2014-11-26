/*
  helpers.js
  Contains useful constants and functions to be used globally across the site
  Date: Nov 24 2014
  Authors: Sapling
  Updated: Alex Hockley
  Date Updated: Nov 25 2014
*/

//object containing a couple url constants
var GlobalConstants = {
  API_URL_LOCAL: "http://localhost/3750/repo/api/",
  BASE_URL_LOCAL: "http://localhost/3750/repo/"
}


/* Purpose: Finds the month from a datetime
 * Parameters: String datetime - A string in proper datetime format
 * Returns: String containing the month (ex. January)
 */
function getMonthFromDatetime(datetime){
  var d = new Date(datetime);
  return d.getMonth();
}

/* Purpose: Finds the day from a datetime
 * Parameters: String datetime - A string in proper datetime format
 * Returns: int containing the day number (ex. 25)
 */
function getDayFromDatetime(datetime){
  var d = new Date(datetime);
  return d.getDate();
}

/* Purpose: Creates a string containing the 12hr format time in the format (HH:MM am/pm)
 * Parameters: String datetime - A string in proper datetime format
 * Returns: String containing the month (ex. January)
 */
function getTime12StrFromDatetime(datetime){
  var d = new Date(datetime);
  var str = "";
  var hours = d.getHours();
  var hour12 = hours;
  var am = true;
  if(hours >= 12){
    hour12 = hour12-12;
    am = false;
  }
  else if(hours == 0){
    hours = 12;
    am = true;
  }
  var min = d.getMinutes();
  str = hour12.toString() + ":" + min.toString();
  if(am)
    str += " am";
  else
    str += " pm";
  return str;
}

/*  TODO
 * Purpose: Finds the difference between two datetimes, in hours
 * Parameters: String start - A string in proper datetime format, String end - A string in proper datetime format
 * Returns: int containing the number of hours between the two datetimes
 */
function getDurationFromDatetime(start,end){
  var stDate = new Date(start);
  var endDate = new Date(endDate);
  var diff = endDate - stDate;
  return diff;
}

/*
 * Purpose: Makes a request to the server ot hash a given value
 * Parameters: String text - value to hash
 * Returns: String containing the hashed value
 */
function hashValue(text){
  var hash = null;
  var hashData = {text : text};
  $.ajax({
    url: GlobalConstants.API_URL_LOCAL + "hash/",
    data: hashData,
    type: "POST",
    success: function(data){
      var json = $.parseJSON(data);
      hash = data['hashed'];
    },
    async: false
  });
  return hash;
}


/*
 * Purpose: Gets the user object from the server associated with the given id
 * Parameters: int id - the id of the user to fetch
 * Returns: Object a user as defined in the API
 */
function getUser(id){
    var toReturn = null;
    $.ajax({
      url: GlobalConstants.API_URL_LOCAL + "user/" + id,
      data: null,
      type: "GET",
      statusCode: {
        200: function(data){
          var json = $.parseJSON(data);
          toReturn = json;
        }
      },
      async: false
    });
    return toReturn;
}
