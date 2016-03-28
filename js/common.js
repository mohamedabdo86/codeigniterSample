//allow only Numbers and Dots to inputs
function isNumberKey(evt)
{
	var charCode = (evt.which) ? evt.which : event.keyCode;
	if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)) 
	{
		return false;
	} 
	else 
	{
		return true;
	}
}

//This function allow Numbers only using it in phone and mobile 
function isNumberKeyOnly(evt)
{
	var charCode = (evt.which) ? evt.which : event.keyCode;
	if (charCode = 46 && charCode > 31 && (charCode < 48 || charCode > 57)) 
	{
		return false;
	} 
	else 
	{
		return true;
	}
}

//allow only Alphabets characters to inputs
function onlyAlphabets(e, t) 
{
	try {
		if (window.event) {
			var charCode = window.event.keyCode;
		}
		else if (e) {
			var charCode = e.which;
		}
		else { return true; }
		 //alert(charCode);
		if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123) || (charCode > 1568 && charCode < 1611))
			return true;
		else
			return false;
	}
	catch (err) {
	   // alert(err.Description);
	}
}

//allow only Alphabets characters and space to inputs
function onlyAlphabetsAndSpace(e, t) 
{
	try {
		if (window.event) {
			var charCode = window.event.keyCode;
		}
		else if (e) {
			var charCode = e.which;
		}
		else { return true; }
		 //alert(charCode);
		if ( (charCode == 32) || (charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123) || (charCode > 1568 && charCode < 1611))
			return true;
		else
			return false;
	}
	catch (err) {
	   // alert(err.Description);
	}
}

//allow only Numbers, Underscore, English and Arabic characters to inputs		
function onlyenglishandNumber(evt) 
{
   try {
		if (window.event) {
			var charCode = window.event.keyCode;
		}
		else if (e) {
			var charCode = e.which;
		}
		else { return true; }
		 //alert(charCode);
		if (  (charCode == 95) || (charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123) || (charCode > 47 && charCode < 58) ||(charCode > 1568 && charCode < 1611) )
			return true;
		else
			return false;
	}
	catch (err) {
	   // alert(err.Description);
	}
}
