window.onload = function()
{
	UpdateMember();
	$('addButton').addEventListener('click',AddMember);
}

function UpdateMember()
{
	var request = new Ajax.Request("connection/group_controler.php?flag=memberQuery",
								{
									method:"post",
									parameters:"gid=" + $("inputGid").value,
									onSuccess:UpdateMemberSuccess 
								});
}

function UpdateMemberSuccess(ajax)
{
	var array = eval('('+ ajax.responseText +')');
	var memberList = $("memberList");
	var children = memberList.childNodes;
	for (var i = children.length - 1; i >= 0; i --)
		memberList.removeChild(children[i]);

	var temp = document.createElement("p");
	temp.innerHTML = "小组成员";
	memberList.appendChild(temp);

	for (var i = 0; i < array.length; i ++)
	{
		var div = document.createElement("div");
		var temp = document.createElement("span");
		temp.innerHTML = array[i]['username'];
		var button = document.createElement("button");
		button.innerHTML = "移除成员";
		button.id =  "uid:" + array[i]['uid'];
		button.addEventListener('click',OnRemoveClicked);
		div.appendChild(temp);
		div.appendChild(button);
		memberList.appendChild(div);
	}
}

function OnRemoveClicked(event)
{
	var uid = this.id.slice(4);
	var ajax = new Ajax.Request("connection/group_controler.php?flag=deleteMember",
							{
								method:"post",
								parameters:"gid=" + $("inputGid").value + "&uid=" + uid,
								onSuccess:DeleteSuccess
							});
}

function DeleteSuccess(ajax)
{
	if (ajax.responseText != "false")
		UpdateMember();
}

function AddMember(event)
{
	var request = new Ajax.Request("connection/group_controler.php?flag=addMember",
								{
									method:"post",
									parameters:"username=" + addText.value + "&gid=" + $("inputGid").value,
									onSuccess:AddSuccess
								});
}

function AddSuccess(ajax)
{
	if (ajax.responseText)
	{
		UpdateMember();
		$("warning").innerHTML = "添加成功";
	}
	else
	{
		$("warning").innerHTML = "用户不存在或用户已在小组内"
	}
}