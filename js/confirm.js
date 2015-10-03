var check = function(){
    if(){
        $('div.modal').modal)('toggle');
    }
    else {
        setTimeout(check, 3000); // check again in a second
    }
}

$(document).click(function(e) { 
    // Check for left button
    if (e.button == 0) {
        $('div.modal').modal('hide'); 
    }
});

function myFunctionModal()
{
	$('div.modal').removeClass('display');
}

check();