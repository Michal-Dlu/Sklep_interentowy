const OPISY = document.querySelectorAll('.opis .widoczny img');
const INPUTY = document.querySelectorAll('input');
const ZDJECIA = document.querySelectorAll('.zd img');



OPISY.forEach(function(img)
{
	img.addEventListener("click",function()
	{
		INPUTY.forEach(function(input,index)
{	
	input.classList.add('inputas');
});
});
});	







