window.onload = function()
{
	$('addButton').addEventListener('click',AddMemberClicked);
	MemberQuery();
}

function MemberQuery()
{
	var ajax = new Ajax.Request("connection/user_controler.php?flag=query",
							{
								method:"post",
								onSuccess:MemberQuerySuccess
							});
}

function MemberQuerySuccess(ajax)
{
	var array = eval('(' + ajax.responseText + ')');
	var memberManage = $("memberManage");
	var children = memberManage.childNodes;
	for (var i = children.length - 1; i >= 0; i --)
		memberManage.removeChild(children[i]);

	var temp = document.createElement("p");
	temp.innerHTML = "用户管理";
	memberManage.appendChild(temp);

	var temp = document.createElement("p");
	temp.innerHTML = "用户名		密码			邮箱";
	memberManage.appendChild(temp);

	for (var i = 0; i < array.length; i ++)
	{
		var uid = array[i]['uid'].toString();
		var div = document.createElement("div");

		var username = document.createElement("span");
		username.innerHTML = array[i]['username'];
		username.id = uid + "username";

		var password = document.createElement("input");
		password.type = "text";
		password.value = array[i]['password'];
		password.id = uid + "password";

		var email = document.createElement("input");
		email.type = "text";
		email.value = array[i]['email'];
		email.id = uid + "email";

		var editButton = document.createElement("button");
		editButton.innerHTML = "修改信息";
		editButton.id = uid + "edit";
		editButton.addEventListener('click',EditClicked);

		var deleteButton = document.createElement("button");
		deleteButton.innerHTML = "删除成员";
		deleteButton.id = uid + "delete";
		deleteButton.addEventListener('click',DeleteClicked);

		div.appendChild(username);
		div.appendChild(password);
		div.appendChild(email);
		div.appendChild(editButton);
		div.appendChild(deleteButton);
		memberManage.appendChild(div);
	}	
}

function AddMemberClicked(event)
{
	var ajax = new Ajax.Request("connection/user_controler.php?flag=register",
							{
								method:"post",
								parameters:"username=" + $("inputUsername").value + 
										      "&password=" + $('inputPassword').value +
										      "&email=" + $('inputEmail').value,
								onSuccess:AddMemberSuccess
							});
}

function AddMemberSuccess(ajax)
{
	if (ajax.responseText == "-1") $("addWarning").value = "用户已存在";
	else $("addWarning").value = "添加成功";
}


function EditClicked(event)
{
	var uid = this.id.slice(0,-4);
	var par = "username=" + $(uid + "username").innerHTML +
			"&password=" + $(uid + "password").value +
			"&email=" + $(uid + "email").value;
	var ajax = new Ajax.Request("connection/user_controler?flag=update",
							{
								method:"post",
								parameters:par,
								onSuccess:EditSuccess
							});
}

function EditSuccess(ajax)
{
	alert("修改成功");
	MemberQuery();
}

function DeleteClicked(event)
{
	var uid = this.id.slice(0,-6);
	var ajax = new Ajax.Request("connection/user_controler?flag=delete",
							{
								method:"post",
								parameters:"uid=" + uid,
								onSuccess:DeleteSuccess
							});
}

function DeleteSuccess(ajax)
{
	alert("删除成功");
	MemberQuery();
}