	var transform=function (cube1,cube2){
		cube2.style.display="none";
		cube1.style.display="block";
	}
	var change=function(cube1,cube2){
		cube1.style.borderBottom="2px solid #0f88eb";
		cube1.style.color="#0f88eb";
		cube2.style.borderBottom="none";
		cube2.style.color="black";
	}
	var register=document.querySelector('.register');
	var login=document.querySelector('.login');
	var reg=document.querySelector('.reg');
	var log=document.querySelector('.log');

	log.addEventListener('click',function(){
		transform(login,register);
		change(log,reg);
	},false);

	reg.addEventListener('click',function(){
		transform(register,login);
		change(reg,log);
	},false);

	var strcheck=function(str){ 
    	var re =  /^[0-9a-zA-Z]*$/g;  //判断字符串是否为数字和字母组合     //判断正整数 /^[1-9]+[0-9]*]*$/    
    	if (!re.test(str))
    	{
    		return 0;
		}
		else
		{
			return 1;
    	}
	}

/*	var isNull=function(str1,str2){
		if (str1!=null&&str2!=null) {
			return 1;
		}
		else{
			return 0;
		}
	}*/			//js判断表单是否有空值,继续完善谢谢 2017/2/11

	var check=function(){
		var input=document.querySelector('#username');
		var str=input.value;
		if (strcheck(str)==1) 
		{
			return true;
		}
		else
		{
			alert('您的填写不正确,表单不会提交,请注意用户名为由A-Z,a-z和0-9组成的字符串!');
			return false;
		}
	}