$(document).ready(function(){
  var loc;
 var lat;
  var lon;
  var api;
  var farhT, highfarhT, lowfarhT;
  var celT, highcelT, lowcelT;
  var city, windSpeed;
  var swap = true;
  var symbolF,symbolC;

  function getFormattedDate(date){
  var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
  return new Date(date * 1000).toLocaleDateString("es-US",options);
}

   $(function(){
  
  startClock();  
});

  function startClock(){
  setInterval(function(){
    $("#localTime").text(new Date().toLocaleTimeString());
  }, 1000);
}

  $.getJSON("https://ipinfo.io",function(position){
     //lat = position.lat;
     //lon = position.lon;
    loc = position.loc.split(",");
    city = position.city;
    
    console.log(loc);
    console.log(loc[0] +" "+loc[1]);
    $("#cityName").text(position.city);
    $("#cityCode").text(position.country);
    
    //$("#data").html("latitude: "+ loc[0] +"<br> longitude: " + loc[1]);
     //api = "https://api.openweathermap.org/data/2.5/weather?q="+city+"&appid=e6adfa272ccef59b2e4c9848be8aad08";
  
    api = "https://api.openweathermap.org/data/2.5/weather?q=quito&appid=e6adfa272ccef59b2e4c9848be8aad08";
  
  $.getJSON(api, function(data){
            // alert(data.city.coord.lon);
    var weather = data.weather[0].description;
    var tempKelvin = data.main.temp;
    var temp_min = data.main.temp_min;
    var temp_max = data.main.temp_max;
    city= data.name;
    windSpeed = data.wind.speed;
    //var sunrise=data.sys.sunrise;
    var icon = data.weather[0].icon;
    //var iconSrc = "http://openweathermap.org/img/w/"+ icon+".png";
    console.log(icon);
   var pressure = data.main.pressure+" hPa";
    var humidity =data.main.humidity+" %";
    var date = data.dt;
    symbolF = "F";
    symbolC="C";
    farhT = (tempKelvin*(9/5) - 459.67).toFixed()+"&deg;"+symbolF;
    //highfarhT ="Max Temp:  "+ (temp_max*(9/5)-459.67).toFixed()+" &deg;"+symbolF;
    //lowfarhT = "Min Temp:  "+(temp_min*(9/5)-459.67).toFixed()+" &deg;"+symbolF;
    celT = (tempKelvin-273).toFixed()+"&deg;"+ symbolC;
    //highcelT ="Max Temp:  "+ (temp_max-273).toFixed()+" &deg;"+symbolC;
    //lowcelT = "Min Temp:  "+(temp_min-273).toFixed()+" &deg;"+symbolC;
    windSpeed =(3.6*windSpeed).toFixed(1)+" Km/h";
    
      console.log(weather);
      console.log(farhT+" "+celT);
      console.log(date);
    
    $("#city").html(city);
    $("#weather").html(weather);
    $("#windSpeed").html(windSpeed);
    // $("#sunrise").html(sunrise);
    $("#farhT").html(celT);
    //$("#highFarhT").html(highfarhT);
    //$("#lowFarhT").html(lowfarhT);
    
    $("#pressure").html(pressure);
    $("#humidity").html(humidity);
     $("#farhT").prepend(' <img src="front/assets/img/'+icon+'.png" width="90"/>&nbsp');
      $("#localDate").text(getFormattedDate(date));

    $("#farhT").click(function(){
      
      if(swap===false){
         $("#farhT").html(celT);
       // $("#highFarhT").html(highcelT);
       // $("#lowFarhT").html(lowcelT);
        $("#farhT").prepend(' <img src="front/assets/img/'+icon+'.png" width="90"/>&nbsp');
  
        swap= true;
      }else{
       
         $("#farhT").html(farhT);
        //$("#highFarhT").html(highfarhT);
      //  $("#lowFarhT").html(lowfarhT);
        $("#farhT").prepend(' <img src="front/assets/img/'+icon+'.png" width="90"/>&nbsp');
        swap=false;

      }
      
    });
 });

  });
});