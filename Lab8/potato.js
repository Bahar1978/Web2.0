//Lab 8 (Mr. Potato Head) starter JS code

var WEB_APP = "potato.php";   // URL of web app to contact

document.observe("dom:loaded", function() {
    // set up listeners on all checkboxes
    var checkboxes = $$("#controls input");
    for (var i = 0; i < checkboxes.length; i++) {
        checkboxes[i].checked = false;
        checkboxes[i].observe("change", toggleAccessory);

    }

    // Exercise 4: reload saved initial state from web server ...
    var request = new Ajax.Request(
                                                 WEB_APP,
                                                 {
                                                    method:"get",
                                                    onSuccess:ajaxSuccess,
                                                    onFailure:ajaxFailure
                                                }
                                                );
    
});

// called when any checkbox is checked/unchecked;
// toggles that accessory and sends the changes to the server
function toggleAccessory() {
    // Exercise 5: make the accessory appear / disappear ...
    if (this.checked)
            new Effect.Appear(this.id + "_image");
    else
            new Effect.Fade(this.id + "_image");
    
    
    // Exercise 6: save the state to the server using Ajax ...
    
    var request = new Ajax.Request(
                                                WEB_APP,
                                                {
                                                    method:"post",
                                                    parameters:"accessories=" + getAccessoriesString(),
                                                    onSuccess:ajaxSuccess,
                                                    onFailure:ajaxFailure
                                                }
                                            );

    
}



// converts a string of accessories such as "eyes ears moustache" into an array
// of strings such as ["eyes", "ears", "moustache"] and returns the array
function getAccessoriesArray(accessoriesString) {
    return accessoriesString.strip().split(" ");
}

// returns a string of all accessories that are currently selected on 
// mr. potato head, such as "eyes ears moustache"
function getAccessoriesString() {
    var accessories = [];
    var checkboxes = $$("#controls input");
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].checked) {
            accessories.push(checkboxes[i].id);
        }
    }
    return accessories.join(" ");
}

function ajaxSuccess(ajax)
{
    $("status").innerHTML =  "He is wearing: " + ajax.responseText;

    if (ajax.responseText == "") return;

    var array = getAccessoriesArray(ajax.responseText);
    for (var i = 0; i < array.length; i ++)
    {
        if (array[i])
        {
            var str = array[i];
            $(str).checked = true;
            new Effect.Appear($(str + "_image"));
        }
    }
    return;
}


// standard provided Ajax error-handling function
function ajaxFailure(ajax, exception) {
    alert("Error making Ajax request:" + 
          "\n\nServer status:\n" + ajax.status + " " + ajax.statusText + 
          "\n\nServer response text:\n" + ajax.responseText);
    if (exception) {
        throw exception;
    }
}
