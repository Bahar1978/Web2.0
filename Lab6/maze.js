window.onload = function()
{
	/*move check*/
	var doms = document.getElementsByClassName('boundary');
	for (var i = 0; i < doms.length; i++)
	{
		if (doms[i].className == "boundary example")
			continue;

		doms[i].onmouseover = MouseOver;
	}
	
	/*start check*/
	var s = document.getElementById("start");
	s.onmousedown = Start;

	/*end check*/
	var e = document.getElementById("end");
	e.onmouseover = Finish;


}

//0 for not start, 1 for start, -1 for lose
var status = 0;
function MouseOver(event)
{
	if (status == 1) 
	{
		var doms = document.getElementsByClassName('boundary');
		for (var i = 0; i < doms.length; i ++)
		{
			if (doms[i].className == "boundary example")
				continue;
			doms[i].style.background = "#ff8888";
		}
		status = -1;
		document.getElementById('status').innerHTML = "You Lose!";
	}
}



function Start(event)
{
	status = 1;
	var doms = document.getElementsByClassName('boundary');
	for (var i = 0; i < doms.length; i ++)
	{
		if (doms[i].className == "boundary example")
			continue;
		doms[i].style.background = "#eeeeee";
	}
	document.getElementById('status').innerHTML = "Start!";
}

function Finish(event)
{
	if (status == 1)
	{
		document.getElementById('status').innerHTML = "You Win!";
		status = 0;
	}
}