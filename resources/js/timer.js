window.setTimer = function () {
    //alert("masuk");
    var d = new Date();
    //d.getSeconds();
    //alert(d.getDay());

    var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];
    var xtmpday = "00" + d.getDate();
    var thisDay = d.getDay();
    thisDay = myDays[thisDay];
    xday = xtmpday.substr(xtmpday.length - 2, 2);
    //alert(xtmpday);
    xtmpmonth = "00" + (d.getMonth() + 1);
    xtmpyear = "00" + d.getFullYear();
    //alert(xtmpyear);
    xtmphour = "00" + d.getHours();
    xtmpmin = "00" + d.getMinutes();
    xtmpsec = "00" + d.getSeconds();


    //xday = d.getDate();
    xmonth = xtmpmonth.substr(xtmpmonth.length - 2, 2);
    xyear = xtmpyear.substr(xtmpyear.length - 4, 4);
    //alert(xyear);
    xhour = xtmphour.substr(xtmphour.length - 2, 2);
    xmin = xtmpmin.substr(xtmpmin.length - 2, 2);
    xsec = xtmpsec.substr(xtmpsec.length - 2, 2);

    //xtime = "<h2 style='margin-top:0px;padding-top:0px'><b>"+xday + "-"+xmonth+ "-"+ xyear+"  " +xhour + " : " + xmin +" : " + xsec +"</b></h2>";
    xtime = "<h1 style='margin-left:10px;margin-top:0px;padding-top:0px;margin-bottom:0px;padding-bottom:0px;color:yellow'><b>" + xhour + " : " + xmin + " : " + xsec + "</b></h1>";
    //xtime += "<br/><h2 style='margin-top:0px;padding-top:0px'>"+xhari+"</h2>";

    xdate = "<h3 style='margin-left:10px;margin-top:3px;padding-top:0px;margin-bottom:0px;padding-bottom:0px;color:white'><b>" + thisDay + " , " + xday + " - " + xmonth + " - " + xyear + "</b></h3>";
    //xtime = "<h4><b>"+ + d.getHours() + " : " + d.getMinutes()+" : " + d.getSeconds() +"</b></h4>";
    //alert(xhari + " , " + xday +" - " + xmonth +" - " + xyear );
    $("#divTime").html(xtime);
    $("#divDate").html(xdate);
}
