//Javascript表单验证登陆信息是否为空
function checkchkcode()
{
	if(!$("#chkcode").val())//获得id为chkcode的内容是否为空，不为空返回true，为空返回flase
		{	
			//目的：如果已经显示“验证码不能为空”这个字符串，就不再在其后添加提示字符串
			x=$("#hint_chkcode").get(0);
			if(!(x.innerHTML=="验证码为空!"))
				{
					$("#hint_chkcode").append("验证码为空!");//在id为chk的元素内容的基础上添加字符串
				}
			return false;
		}
	else
		{
			$("#hint_chkcode").replaceWith("");//将“验证码不能为空”替换成“”
			return true;
		}
}
//更换看不清的验证码
function reloadcode_login() 
{ 
	document.getElementById('chkimg').src = 'code.php?' + Math.random(); //将id为img的元素资源加上随机数，更换验证码
	document.forms[0].chkcode.value=""; //更换验证码的同时将验证码输入框清空
}

