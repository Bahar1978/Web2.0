

window.onload = function()
{
	var request1 = new Ajax.Request(
					"connection/notes_controler.php?flag=number",
					{
						method:"post",
						onSuccess:ajaxNoteSuccess
					});
	var request2 = new Ajax.Request(
					"connection/comments_controler.php?flag=number",
					{
						method:"post",
						onSuccess:ajaxCommentSuccess
					});
	var request3 = new Ajax.Request(
					"connection/group_controler.php?flag=number",
					{
						method:"post",
						onSuccess:ajaxGroupSuccess
					});
	var request4 = new Ajax.Request(
					"connection/user_controler.php?flag=number",
					{
						method:"post",
						onSuccess:ajaxUserSuccess
					});
}


function ajaxNoteSuccess(ajax)
{
	$("note").innerHTML = ajax.responseText + "条笔记";
}

function ajaxCommentSuccess(ajax)
{
	$("comment").innerHTML = ajax.responseText + "条评论";
}

function ajaxGroupSuccess(ajax)
{
	$("group").innerHTML = ajax.responseText + "个小组";
}

function ajaxUserSuccess(ajax)
{
	$("user").innerHTML = ajax.responseText + "个用户";
}