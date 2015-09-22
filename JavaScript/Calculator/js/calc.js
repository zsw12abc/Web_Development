var x;
function cls()
{
	form.input.value = "";
}
function doit()
{
	if (isNaN(eval(form.input.value)) == true)
		form.input.value = "Error";
	else
	form.input.value = eval(form.input.value);	//全局函数，用于执行要计算的字符串或者要执行的语句
}
function sin()
{
	x = form.input.value
	if (x == '') alert('Error');
	else if (isNaN(Math.sin(x)) == true)
		form.input.value = "Error";
	else
		form.input.value = Math.sin(x);
}
function asin()
{
	x = form.input.value;
	if (x == '') alert('Error');
	else if (isNaN(Math.asin(x)) == true)
		form.input.value = "Error";
	else
		form.input.value = Math.asin(X);
}
function cos()
{
	x = form.input.value;
	if (x == '') alert('Error');
	else if (isNaN(Math.cos(x)) == true)
		form.input.value = "Error";
	else 
		form.input.value = Math.cos(x);
}
function acos()
{
	x = form.input.value;
	if (x == '') alert('Error');
	else if (isNaN(Math.acos(x)) == true)
		form.input.value = "Error";
	else 
		form.input.value = Math.acos(x);
}
function tan()
{
	x = form.input.value;
	if (x == '') alert('Error');
	else if (isNaN(Math.tan(x)) == true)
		form.input.value = "Error";
	else 
		form.input.value = Math.tan(x);
}
function atan()
{
	x = form.input.value;
	if (x == '') alert('Error');
	else if (isNaN(Math.atan(x)) == true)
		form.input.value = "Error";
	else 
		form.input.value = Math.atan(x);
}
function fac()				//阶乘
{
	var sum = 1;
	x = form.input.value;
	if (x == ''||isNaN(x)) alert('Error');
	else
	{
		while(x>0)
		{
			sum = sum * x;
			x--;
		}
		form.input.value = sum;
	}
}
function ln() 			//lnX
{
	x = form.input.value;
	if (x == ''||isNaN(x)) alert('Error');
	else form.input.value = Math.log(x);
}
function square()			//平方
{
	x = form.input.value;
	if (x == ''||isNaN(x)) alert('Error');
	else form.input.value = x * x;
}
function root() 			//开方
{
	x = form.input.value;
	if (x == ''||isNaN(x)||x<0) alert('Error');
	else form.input.value = Math.sqrt(x);
}
function neg()
{
	x = form.input.value * (-1);
	if (isNaN(x) == true)
		form.input.value = "Error";
	else
		form.input.value = x;
}
function binary()
{
	x = form.input.value;
	if (isNaN(x) !=false)
		form.input.value = "Error";
	else
	{
		var i = 1;
		var myarr = new Array();
		myarr[0] = x%2;
		x = Math.floor(x/2);
		while(x)
		{
			myarr[i] = x%2;
			x = Math.floor(x/2);
			i ++;
		}
		form.input.value = "";
		for(var i = myarr.length-1;i>=0;i--)
		form.input.value += myarr[i];
	}
}
function octal()
{
	x = form.input.value;
	if (isNaN(x) !=false)
		form.input.value = "Error";
	else
	{
		var i = 1;
		var myarr = new Array();
		myarr[0] = x%8;
		x = Math.floor(x/8);
		while(x)
		{
			myarr[i] = x%8;
			x = Math.floor(x/8);
			i ++;
		}
		form.input.value = "";
		for(var i = myarr.length-1;i>=0;i--)
		form.input.value += myarr[i];
	}
}
function hex()
{
	x = form.input.value;
	if (isNaN(x) !=false)
		form.input.value = "Error";
	else
	{
		var i = 1;
		var myarr = new Array();
		myarr[0] = x%16;
		x = Math.floor(x/16);
		while(x)
		{
			myarr[i] = x%16;
			x = Math.floor(x/16);
			i ++;
		}
		form.input.value = "";
		for(var i = 0;i<myarr.length;i++)
		{
			if (myarr[i] >= 10)
			switch(myarr[i])
			{
				case 10:myarr[i] = 'A';
					alert("go");
				break;
				case 11:myarr[i] = 'B';
				break;
				case 12:myarr[i] = 'C';
				break;
				case 13:myarr[i] = 'D';
				break;
				case 14:myarr[i] = 'E';
				break;
				case 15:myarr[i] = 'F';
				break;
			}
		}
		// alert("go");
		for(var i = myarr.length-1;i>=0;i--)
		form.input.value += myarr[i];
	}
}
function bs()				//退格
{
	x = form.input.value;
	x = x.substr(0,x.length-1);
	form.input.value = x;
}