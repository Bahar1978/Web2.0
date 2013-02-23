window.onload = function()
{
	$("logout").addEventListener('click',OnLogoutButtonClicked);
	$("addButton").addEventListener('click',OnAddButtonClicked);
	UpdateNotification();
	UpdateFriendList();
	UpdateGroupList();
	UpdateManageGroupList();
}

function getCookie(name){
	var cookie=document.cookie;
	var array= cookie.split("; ");
	for(var i=0;i<array.length;i++)
	{
		var arr = array[i].split("=");
		if(arr[0]==name)return arr[1];
	}
	return "";
}

function setCookie(name,value,time)
{
	var date = new Date();
	date.setTime(date.getTime() + time);
	document.cookie = name + "=" + value + ";expires=" + date.toGMTString();
}

function deleteCookie(name)
{
	var exp = new Date();
	exp.setTime(exp.getTime() - 1);
	var cval=getCookie(name);
	if(cval!=null) document.cookie= name + "=" + cval + ";expires="+exp.toGMTString();
}

function OnLogoutButtonClicked(event)
{
	var oldDate = new Date();
	oldDate.setTime(oldDate.getTime() - 1);
	deleteCookie("username");
	deleteCookie("email");
	deleteCookie("sessionId");
	window.location.href="login.php";
}

//Ajax通知请求
function UpdateNotification()
{
	var request = new Ajax.Request("connection/friends_controler.php?flag=notification",
								{
									method:"post",
									onSuccess:AjaxNotificationSuccess
								});
}

//通知请求回调函数
function AjaxNotificationSuccess(ajax)
{
	var array = eval('('+ ajax.responseText +')');

	var noteDiv = document.getElementById("noteDiv");
	var child = noteDiv.childNodes;

	for (var i = child.length - 1; i >= 0; i --)
	{
		noteDiv.removeChild(child[i]);
	}

	var text = document.createElement("p");
	text.innerHTML = "通知";
	noteDiv.appendChild(text);
	for (var i = 0; i < array.length; i ++)
	{
		var div = document.createElement("div");
		div.innerHTML= "用户" + array[i] + "添加你为好友" ;

		var accept = document.createElement("img");
		accept.style.backgroundImage = "url('Image/ok.png')";
		accept.style.width = accept.style.height = 48;
		accept.onclick = OnAcceptButtonClicked;
		var cancel = document.createElement("img");
		cancel.style.backgroundImage = "url('Image/cancel.png')";
		cancel.onclick = OnCancelButtonClicked;
		cancel.style.width = cancel.style.height = 48;

		div.appendChild(accept);
		div.appendChild(cancel);
		noteDiv.appendChild(div);			    
	}
}

//接受好友添加
function OnAcceptButtonClicked(event)
{
	var div = this.parentNode;
	var str = div.firstChild.nodeValue;
	var userName = str.slice(2,str.length - 6);
	
	var request = new Ajax.Request("connection/friends_controler.php?flag=make",
								{
									method:"post",
									parameters:"username=" + userName,
								});
	var noteDiv = div.parentNode;
	noteDiv.removeChild(div);
	setTimeout(UpdateFriendList,1000);
}

//拒绝添加
function OnCancelButtonClicked(event)
{
	var div = this.parentNode;
	var str = div.firstChild.nodeValue;
	var userName = str.slice(2,str.length - 6);

	var request = new Ajax.Request("connection/friends_controler.php?flag=cancel",
							 	{
							 		method:"post",
							 		parameters:"username=" + userName,
								});
	var noteDiv = div.parentNode;
	noteDiv.removeChild(div);
}

//发送好友添加请求
function OnAddButtonClicked(event)
{
	var par = "targetname=" + $("searchContent").value;
	var request = new Ajax.Request("connection/friends_controler.php?flag=query",
								{
									method:"post",
									parameters:par,
									onSuccess:AjaxAddSuccess
								});
}

//好友添加成功
function AjaxAddSuccess(ajax)
{
	$("warning").innerHTML = ajax.responseText;
}

//更新页面中的好友列表
function UpdateFriendList()
{
	var request = new Ajax.Request("connection/friends_controler.php?flag=get",
								{
									method:"post",
									onSuccess:AjaxUpdateSuccess
								});
}

//更新页面中的好友列表回调函数
function AjaxUpdateSuccess(ajax)
{
	var array = eval('('+ ajax.responseText +')');
	
	var friendList = $("friendList");
	var children = friendList.childNodes;
	for (var i = children.length - 1; i >= 0; i --)
	{
		friendList.removeChild(children[i]);
	}

	var temp = document.createElement("p");
	temp.innerHTML = "我的好友";
	friendList.appendChild(temp);
	for (var i = 0; i < array.length; i ++)
	{
		var outDiv = document.createElement("div");
		var uid = array[i]['uid'];
		var str = "用户名:" + "<a href='note.php?uid=" + uid + "'>" + 
				array[i]['username'] + "</a>" +  "		邮箱:" + array[i]['email'];
		outDiv.innerHTML = outDiv.innerHTML + str;

		friendList.appendChild(outDiv);
	}
}

//更新小组列表
function UpdateGroupList()
{
	var request = new Ajax.Request("connection/group_controler.php?flag=query",
								{
									method:"post",
									onSuccess:UpdateGroupListSuccess
								});
}

//更新小组列表回调函数
function UpdateGroupListSuccess(ajax)
{
	var array = eval('('+ ajax.responseText +')');
	var groupList = $("groupList");
	var children = groupList.childNodes;
	for (var i = groupList.length - 1; i >= 0; i --)
	{
		groupList.removeChild(children[i]);
	}

	var temp = document.createElement("p");
	temp.innerHTML = "我的小组";
	groupList.appendChild(temp);
	for (var i = 0; i < array.length; i ++)
	{
		var link = document.createElement("a");
		link.href = "group.php?gid=" + array[i]['gid'];
		link.innerHTML = array[i]['name'];
		groupList.appendChild(link);
		groupList.appendChild(document.createElement("br"));
	}
}


function UpdateManageGroupList()
{
	var result = new Ajax.Request("connection/group_controler.php?flag=manageQuery",
								{
									method:"post",
									onSuccess:UpdateManageGroupListSuccess
								});
}

function UpdateManageGroupListSuccess(ajax)
{
	var array = eval('('+ ajax.responseText +')');
	var groupManageList = $("groupManageList");
	var children = groupManageList.childNodes;
	for (var i = groupManageList.length - 1; i >= 0; i --)
	{
		groupManageList.removeChild(children[i]);
	}

	var temp = document.createElement("p");
	temp.innerHTML = "管理小组";
	groupManageList.appendChild(temp);
	for (var i = 0; i < array.length; i ++)
	{
		var link = document.createElement("a");
		link.href = "group_manage.php?gid=" + array[i]['gid'];
		link.innerHTML = array[i]['name'];
		groupManageList.appendChild(link);
		groupManageList.appendChild(document.createElement("br"));
	}
}

