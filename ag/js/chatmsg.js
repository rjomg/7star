

function openwin_chatmsg(url){ 
	newwindow=window.open(url,"chatmsgwindow","height=600,width=650,toolbar=no,menubar=no,scrollbars=no,resizable=no, location=no,status=no,depended=yes,alwaysLowered =yes,alwaysRaised =yes");
	if (window.focus) {newwindow.focus()}
	return false;
} 