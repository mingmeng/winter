var answers=document.querySelectorAll('div.userInfoAnimateContent');
var questions=document.querySelectorAll('div#a');
var ca=document.querySelector('span.CountAnswers');
var cq=document.querySelector('span.CountQuestions');

var qc=document.querySelector('div.questionContainer');
var ac=document.querySelector('div.answerContainer');

var answerA=document.querySelectorAll('ul.userInfoAnimate li a');


window.onload=function () {
	var id='on';
	ca.innerHTML=answers.length;
	cq.innerHTML=questions.length;
	answerA[0].addEventListener('click',function () {
		ac.style.display='block';
		qc.style.display='none';
		answerA[0].setAttribute("id",id);
		answerA[1].setAttribute('id','');
	});
	answerA[1].addEventListener('click',function () {
		qc.style.display='block';
		ac.style.display='none';
		answerA[1].setAttribute('id',id);
		answerA[0].setAttribute('id','');
	});
}