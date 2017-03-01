var offbtn=document.querySelector('button.header-off-btn');
var quesarea=document.querySelector('div.hide-area');
var opeanarea_a=document.querySelector('button.top-new-question-btn');


offbtn.addEventListener('click',function () {
	quesarea.style.display='none';
});
opeanarea_a.addEventListener('click',function () {
	quesarea.style.display='block';
});