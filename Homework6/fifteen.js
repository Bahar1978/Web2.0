 //Extra features:
 //Animations and/or transitions
 //Multiple backgrounds
 window.onload = function()
 {
 	PuzzleInitialize();
 	document.getElementById("shufflebutton").onclick = OnShuffle;
 	document.getElementById("selectPic").onclick = BackgroundChange;
 }

var tileIndex = new Array();
var size = 4;

 function PuzzleInitialize()
 {
 	var puzzlearea = document.getElementById("puzzlearea");
 	var records = puzzlearea.getElementsByTagName("div");
 	for (var i = 0; i < records.length; i ++)
 	{
 		records[i].className = "puzzlepiece";
 		TileSetId(records[i],i);
 		TileSetLocation(records[i],i);
 		TileSetBackground(records[i],i);
 		records[i].addEventListener('click',TileMove);
 		records[i].onmouseover = MouseOverTile;
 		records[i].onmouseout = MouseOutTile;
 		tileIndex[i] = i +1;
 	}
 	tileIndex[records.length] = 0;
 	
 }

 function MouseOverTile(event)
 {
 	if ( TileCanMove( TileGetId(this) ) != -1)
 	{
 		this.style.borderColor = "red";
 		this.style.color = "#006600";
 		this.style.textDecoration = "underline";
 	}
 }

 function MouseOutTile(event)
 {
 	this.style.borderColor = "black";
 	this.style.color = "black";
 	this.style.textDecoration = "";
 }

 function TileSetLocation (element,index)
 {
 	var i = Math.floor(index / size), j = index % size;
 	var x = i * (400 / size), y = j * (400 / size);
 	element.style.top = x + "px";
 	element.style.left = y + "px";
 }

 function TileSetLocationAnimation (element,fromIndex,toIndex)
 {
 	var fromI = Math.floor(fromIndex/size), fromJ = fromIndex % size;
 	var toI = Math.floor(toIndex/size), toJ = toIndex % size;
 	var fromX = fromI * (400/size), fromY = fromJ * (400/size);
 	var toX = toI * (400/size), toY = toJ * (400/size);

 	//Same row move
 	if (fromX == toX)
 	{
 		var step = (toY - fromY) / 5;
 		for (var i = 1; i <= 5; i ++)
 			setTimeout(TileSetLocationPosition,i * 50,element,fromX,fromY + step * i);
 	}	
 	else
 	{
 		var step = (toX - fromX) / 5;
 		for (var i = 1; i <= 5; i ++)
 			setTimeout(TileSetLocationPosition,i* 50,element,fromX + step * i,fromY);
 	}
  }

function TileSetLocationPosition (element,x,y)
{
	element.style.top = x + "px";
	element.style.left = y + "px";
}

 function TileSetBackground(element,index)
 {
 	var i = Math.floor(index / size), j = index % size;
 	var x = -i * (400 / size) + "px", y = - j * (400 / size) + "px";
 	element.style.backgroundPosition = y + " " + x;
 }

function TileSetId(element,index)
{
	element.id = index;
}

function TileGetId(element)
{
	return parseInt(element.id);
}

 function TileMove (event)
 {
 	var index = TileGetId(this);
 	var to = TileCanMove(index);
 	if (to != -1)
 	{
 		tileIndex[to] = tileIndex[index];
 		tileIndex[index] = 0;
 		TileSetLocationAnimation(this,index,to);
 		//TileSetLocation(this,to);
 		TileSetId(this,to);
 	}
 }

 function TileCanMove(index)
 {
 	if (index - size >= 0  && tileIndex[index - size] == 0) return index - size;
 	if (index + size <  size * size && tileIndex[index + size] == 0) return index + size;
 	if (index - 1 >= 0 && index % 4 != 0 && tileIndex[index - 1] == 0) return index - 1;
 	if (index + 1 < size * size && index % 4 != 3 && tileIndex[index + 1] == 0) return index + 1;
 	return -1;
 }

 function OnShuffle (event)
 {
 	var array = new Array();
 	for (var i = 0; i < 10; i ++)
 	{
 		var records = document.getElementById("puzzlearea").getElementsByTagName("div");
 		for (var j = 0; j < records.length; j ++)
 			if ( TileCanMove( TileGetId(records[j]) ) != -1 ) 
 				array[array.length] = records[j];

 		var temp = array[Math.floor( Math.random() * array.length)];
 		var index = TileGetId(temp);
 		var to = TileCanMove(index);
 		tileIndex[to] = tileIndex[index];
 		tileIndex[index] = 0;
 		TileSetLocationAnimation(this,index,to);
 		//TileSetLocation(temp,to);
 		TileSetId(temp,to);

 		array = new Array();
 	}
 }

 function BackgroundChange(event)
 {
 	var records = document.getElementById("selectPic").getElementsByTagName("input");
 	var backgroundUrl = "https://raw.github.com/apir8181/Web2.0/master/Homework6/background.jpg";

 	if (records[1].checked == true) backgroundUrl = "https://raw.github.com/apir8181/Web2.0/master/Homework6/background2.jpg";
 	else if (records[2].checked == true) backgroundUrl = "https://raw.github.com/apir8181/Web2.0/master/Homework6/background3.jpg";
 	else if (records[3].checked == true) backgroundUrl = "https://raw.github.com/apir8181/Web2.0/master/Homework6/background4.jpg";

 	var puzzles = document.getElementById("puzzlearea").getElementsByTagName("div");
 	for (var i = 0; i < puzzles.length; i ++)
 	{
 		puzzles[i].style.backgroundImage = "url(" + backgroundUrl + ")";
 		var number = parseInt(puzzles[i].textContent) -1;
 		TileSetBackground(puzzles[i],number);
 	}
 }