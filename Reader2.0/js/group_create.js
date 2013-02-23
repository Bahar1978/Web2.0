window.onload = function()
{
	$("addButton").addEventListener('click',OnAddButtonClicked);
	$("cancelButton").addEventListener('click',OnCancelButtonClicked);
}

function OnAddButtonClicked(event)
{
	var uid = $("inputUid").value;
	var name = $("inputGroupName").value;
	var des = $("inputDescription").value;
	var ajax = new Ajax.Request("connection/group_controler.php?flag=create",
							{
								method:"post",
								parameters:"uid=" + uid + "&groupName=" + name + "&description=" + des,
								onSuccess:AddAjaxSuccess
							});
}

function AddAjaxSuccess(ajax)
{
	if (ajax.responseText != -1)
	{
		$("warnning").innerHTML = "创建成功，5秒后返回";
		$("addButton").removeEventListener('click',OnAddButtonClicked);
		$("cancelButton").removeEventListener('click',OnCancelButtonClicked);
		setTimeout(function(){window.history.back(-1); },5000);
	}
	else
	{
		$("warnning").innerHTML = "创建失败";
	}
}

function OnCancelButtonClicked(event)
{
	window.history.back(-1);
}