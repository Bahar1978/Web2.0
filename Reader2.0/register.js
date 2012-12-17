window.onload = function()
{
	$("okButton").addEventListener('click',OnOkButtonClicked);
	$("cancelButton").addEventListener('click',OnCancelButtonClicked);
}

function OnOkButtonClicked(event)
{
	if (Validfy())
	{
		var par = "username=" + $("username").value + "&password=" + $("password").value
				+ "&email=" + $("email").value;
		var request = new Ajax.Request(
						"connection/user_controler.php?flag=register",
						{
							method:"post",
							parameters:par,
							onSuccess:ajaxSuccess
						});
	}
}

//if success, return true, else false
function Validfy()
{
	var flag = true;

	var username = $("username").value;
	var password = $("password").value;
	var email = $("email").value;

	var usernameRegx = /\w{6,20}/;
	var passwordRegx = /\w{6,20}/;
	var emailRegx = /^[_.0-9a-z-a-z-]+@([0-9a-z][0-9a-z-]+.)+[a-z]{2,4}$/;

	if (!usernameRegx.test(username))
	{
		$("warning").innerHTML = "用户名为6-20位的只包含数字、字母和下划线的字符串";
		flag = false;
	}
	else if (!passwordRegx.test(password))
	{
		$("warning").innerHTML = "密码为6-20位的只包含数字、字母和下划线的字符串";
		flag = false;
	}
	else if (!emailRegx.test(email))
	{
		$("warning").innerHTML = "邮箱格式不正确";
		flag = false;
	}

	return flag;
}

function ajaxSuccess(ajax)
{
	if (ajax.responseText != "-1")
	{
		alert("注册成功");
		window.location.href="login.php";
	}
	else
	{
		$("warning").innerHTML = "用户名已存在";
	}
}

function OnCancelButtonClicked(event)
{
	history.back();
}

