 var time1st = 30;
 var time2nd = 20;
 var timeother = 10;
var secs=time1st;
var raw_groups = new Array("A","B","C","D","E","F","G","H");

var CounterId;
var CountPass = 0;
var CountActive = true;
var DisplayFormat = "%%S%%";
//document.write("<span id='cntdwn' > </span>");
function CountBack() {
  if (secs < 0) {
  CountActive = false;
  //document.getElementById("cntdwn").value = "Time Up!";
 alert("Time Up!");
    return;
  }
 s = secs.toString();
 if( s.length < 2) 	s = "0"+s;
  DisplayStr = DisplayFormat.replace(/%%S%%/g, s);
document.getElementById("cntdwn").value = DisplayStr;

	
  if (CountActive)
  {secs--;
CounterId =  setTimeout("CountBack()", 1000);
}
}

function Start()
{

clearTimeout(CounterId);
CounterId= setTimeout("CountBack()",500);
CountPass = 0;
}

function resume()
{ 
but = document.getElementById("pr").value;
if(but == "Resume")
	{ 
	
	document.getElementById("pr").value = "Pause";
	clearTimeout(CounterId);  
	CounterId =  setTimeout("CountBack()", 500);
	}
else if(but == "Pause")
	{
	document.getElementById("pr").value= "Resume";
	clearTimeout(CounterId);
	}
          
}
function passed(no_groups)
{

CountPass++;
if(CountPass > no_groups-1)
    {
    
        confirm("Any answer from Audience?");
        CountPass--;
        return 0;
    }
if(CountPass == 0)
    secs = time1st;
else if(CountPass == 1)
    secs = time2nd;
else 
    secs = timeother;
//secs = tim41st - CountPass*10;
document.getElementById("Times").innerHTML = CountPass+ " Times ";
clearTimeout(CounterId); 
grp = document.getElementById("answaiting").innerHTML;

if(grp == raw_groups[no_groups-1])
	grp = raw_groups[0];
else
	{
	for( i=0;i<no_groups-1;i++)
		if(grp == raw_groups[i])
		break;
	grp = raw_groups[i+1];
	}

document.getElementById("answaiting").innerHTML = grp;
CounterId =  setTimeout("CountBack()", 500);
}
function restore()
{
secs = tim41st;
CountPass = 0;
document.getElementById("Times").innerHTML = "0 Times" ;
document.getElementById("cntdwn").value = secs;
clearTimeout(CounterId);
}

function showans(ans)
{
   document.getElementById("showans").innerHTML = ans;
}


