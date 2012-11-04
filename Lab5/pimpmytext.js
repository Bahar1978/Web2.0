function OnButtonClicked()
{
	var size = $("input").style.fontSize
	if (size == "")
	{
		size = "24pt"
	}
	else
	{
		size = parseInt(size);
		size = (size + 2) + "pt"
	}
	$("input").style.fontSize = size
}

function OnCheckBoxClicked()
{
	if ($("checkBox").checked == true)
	{
		$("body").style.background="url(http://222.200.185.14/labs/lab5/hundred-dollar-bill.jpg)"
		$("input").style.fontWeight = "bold"
		$("input").style.textDecoration = "underline blink"
		$("input").style.color = "green"
	}
	else
	{
		$("body").style.background = "none"
		$("input").style.fontWeight = "normal"
		$("input").style.textDecoration = "none"
		$("input").style.color = "black"
	}
}

function OnSnoopifyClicked()
{
	var str = $("input").value.toUpperCase();
	var record = str.split(".")
	str = record.join("-izzle.")
	$("input").value = str
}