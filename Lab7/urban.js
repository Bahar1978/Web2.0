window.onload = function()
{
	document.getElementById("lookup").onclick = OnLookUpButtonClicked;
}

function OnLookUpButtonClicked(event)
{
	new Ajax.Request("http://222.200.185.14/urban.php?term=what",
					{
						method:"get",
						onSuccess:ShowResult,
						onFailure: ajaxFailure
					}
				);
}

function ShowResult(ajax)
{

	alert(ajax.responseText);
	document.getElementById("result").innerHTML = ajax.responseText;
}

function ajaxFailure(ajax)
{
	alert(ajax.status + " " + ajax.statusText);
}