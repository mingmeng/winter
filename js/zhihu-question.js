var offbtn=document.querySelector('button.header-off-btn');
var quesarea=document.querySelector('div.hide-area');
var opeanarea_a=document.querySelector('button.top-new-question-btn');
var opeanarea_b=document.querySelector('a.w-answer');
var answerarea=document.querySelector('div.answer-area-container');
var offbtn_b=document.querySelector('button.answer-area-off-btn');

var a=document.querySelectorAll('div.ind-answer');
var b=document.querySelector('div.q-numbers span');
b.innerHTML=a.length+'个回答';

offbtn.addEventListener('click',function () {
	quesarea.style.display='none';
});
opeanarea_a.addEventListener('click',function () {
	quesarea.style.display='block';
});
offbtn_b.addEventListener('click',function(){
	answerarea.style.display='none';
});
opeanarea_b.addEventListener('click',function(){
	answerarea.style.display='block';
});
