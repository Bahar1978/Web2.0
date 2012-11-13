//All extra features have been completed
 window.onload = function()
 {
 	//Play controls
 	var startButton = document.getElementById("startButton");
 	var stopButton = document.getElementById("stopButton");
 	startButton.addEventListener('click',OnStartButtonClicked);
 	stopButton.addEventListener('click',OnStopButtonCLicked);

 	//Size controls
 	var fontSize = document.getElementById("fontSize");
 	fontSize.addEventListener('click',OnFontSizeChanged);

 	//Animation controls
 	var selectButton = document.getElementById("selectButton");
 	selectButton.addEventListener('click',OnAnimationChanged);

 	//speed controls
 	var turboSpeed = document.getElementById("turboSpeed");
 	turboSpeed.addEventListener('click',ChangeSpeed);

 	IdleState();
 }

//Change the animation
function OnAnimationChanged(event)
{
	var textArea = document.getElementById("displayarea");
	var record = this.getElementsByTagName("option");
	if (record[0].selected)		textArea.value = blank;	
	else if (record[1].selected)	textArea.value = exercise;
	else if (record[2].selected)	textArea.value = juggler;
	else if (record[3].selected)	textArea.value = bike;
	else if (record[4].selected)	textArea.value = dive;
	else if (record[5].selected)	textArea.value = custon;
}

//change font size in displayarea
function OnFontSizeChanged (event)
{
	var textArea = document.getElementById("displayarea");
	var record = this.getElementsByTagName("input");
	if (record[0].checked == true)
	{
		textArea.style.fontSize = "7pt";
	}
	else if (record[1].checked == true)
	{
		textArea.style.fontSize = "12pt";
	}
	else if (record[2].checked == true)
	{
		textArea.style.fontSize = "24pt";
	}  
}

var nextTimerId;
var textContent;
//invoke animation
 function OnStartButtonClicked (event)
 {
 	PlayState();
 	var textArea = document.getElementById("displayarea");
 	textContent = textArea.value;
 	OnAnimationStart(textContent,0);
 }

//play animation
var speed = 200;
 function OnAnimationStart(content,index)
 {
 	var array = content.split("=====\n");

 	if (index < array.length)
 	{
 		ChangeDisplayArea(array[index]);
 		nextTimerId = setTimeout(OnAnimationStart,speed,content,index + 1);
 	}
 	else if (array.length > 0)
 	{
 		OnAnimationStart(content,0);
 	}

 }

//stop animation and restore the content in displayarea
function OnStopButtonCLicked(event)
{
	clearTimeout(nextTimerId);
	var textArea = document.getElementById("displayarea");
	textArea.value = textContent;
	IdleState();
}

//change the display area
function ChangeDisplayArea (content)
{
	var textArea = document.getElementById("displayarea");
	textArea.value = content;
}

//when animation off
function IdleState()
{
	document.getElementById("startButton").disabled = false;
 	document.getElementById("stopButton").disabled = true;
 	document.getElementById("selectButton").disabled = false;
}

//when animation on
function PlayState()
{
	document.getElementById("startButton").disabled = true;
	document.getElementById("stopButton").disabled = false;
	document.getElementById("selectButton").disabled = true;
}

//turbo speed control
function ChangeSpeed(event)
{
	if (this.checked == true)	speed = 50;
	else speed = 200;
}
//custon string
var custon = 
"          |\n" + 
"          |\n" + 
"          |\n" + 
"  o       |\n" + 
" /#\\      |\n" + 
" ||     . |\n" + 
"=====\n" + 
"          |\n" + 
"          |\n" + 
"          |\n" + 
"   o      |\n" + 
"  /#\\     |\n" + 
"  /|    . |\n" + 
"=====\n" + 
"          |\n" + 
"          |\n" + 
"          |\n" + 
"    o     |\n" + 
"   /#\\    |\n" + 
"    |\\  . |\n" + 
"=====\n" + 
"          |\n" + 
"          |\n" + 
"          |\n" + 
"     o    |\n" + 
"    /#\\   |\n" + 
"    /|  . |\n" + 
"=====\n" + 
"          |\n" + 
"          |\n" + 
"          |\n" + 
"      o   |\n" + 
"     /#\\  |\n" + 
"      |\\. |\n" + 
"=====\n" + 
"          |\n" + 
"          |\n" + 
"          |\n" + 
"        o |\n" + 
"      /#\\ |\n" + 
"      //. |\n" + 
"=====\n" + 
"          |\n" + 
"          |\n" + 
"          |\n" + 
"         o|\n" + 
"       /#\\|\n" + 
"      //. |\n" + 
"=====\n" + 
"          |\n" + 
"  |Ahhh!| |\n" + 
"          |\n" + 
"         o*\n" + 
"       /#\\|\n" + 
"      //. |\n";