var GlobalConstants = {
  API_URL:"",
  BASE_URL_LOCAL: "http://localhost/3750/repo/";
}



function getMonthFromDatetime(datetime){
  var d = new Date(datetime);
  return d.getMonth();
}
function getDayFromDatetime(datetime){
  var d = new Date(datetime);
  return d.getDate();
}
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
function getDurationFromDatetime(start,end){
  var d = new Date(datetime);
  return d.getMonth();
}
