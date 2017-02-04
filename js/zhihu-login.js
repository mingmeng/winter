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
	var reg=document.querySelector('#reg');
	var log=document.querySelector('#log');
	log.addEventListener('click',function(){
		transform(login,register);
		change(log,reg);
	},false);
	reg.addEventListener('click',function(){
		transform(register,login);
		change(reg,log);
	},false);