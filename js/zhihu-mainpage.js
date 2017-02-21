var offbtn=document.querySelector('button.header-off-btn');
var quesarea=document.querySelector('div.hide-area');
var opeanarea_a=document.querySelector('button.top-new-question-btn');
var opeanarea_b=document.querySelectorAll("a.a-function-list")[0];







offbtn.addEventListener('click',function () {
	quesarea.style.display='none';
});
opeanarea_a.addEventListener('click',function () {
	quesarea.style.display='block';
});
opeanarea_b.addEventListener('click',function () {
	quesarea.style.display='block';
})