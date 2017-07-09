var headOne = document.querySelector('#one') // queryselector använder css referencing
var headTwo = document.querySelector('#two') 
var headThree = document.querySelector('#three')

headOne.addEventListener('mouseover', function(){
	headOne.textContent = "Mouse currently over";
	headOne.style.color = 'red';
}) 

headOne.addEventListener('mouseout', function(){
	headOne.textContent = "Hover over me";
	headOne.style.color = 'black';
})

headTwo.addEventListener('click', function(){
	headTwo.textContent = 'Clicked on';
	headTwo.style.color = 'blue';
})

headThree.addEventListener('dblclick', function(){
	headThree.textContent = 'I was dubble clicked';
	headThree.style.color = 'green'; 
})