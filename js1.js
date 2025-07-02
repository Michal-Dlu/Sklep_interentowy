const FOTAS = document.querySelectorAll('.foty img');
const POPUP = document.querySelector('.popup');
const POPUP_CLOSE = document.querySelector('.popup__close');
const POPUP__IMG = document.querySelector('.popup__img');
const L_ARROW = document.querySelector(".lArrow");
const R_ARROW = document.querySelector(".rArrow");



var imgIndex; 
FOTAS.forEach(function (fota, index)
{
fota.addEventListener("click",function()
	{
		POPUP.classList.remove('hidden');
		POPUP__IMG.src = event.target.src;
		imgIndex = index;
		 document.getElementById('numer').innerHTML = "Zdjęcie nr"+[imgIndex+1];
	});
});
POPUP_CLOSE.addEventListener("click",function ()
	{
		POPUP.classList.add('hidden');
	});

R_ARROW.addEventListener("click",function()
		{
			imgIndex++;
			if (imgIndex == 9)
				imgIndex = 0;
			POPUP__IMG.src = FOTAS[imgIndex].src;
			document.getElementById('numer').innerHTML = "Zdjęcie nr"+[imgIndex+1];
		});
L_ARROW.addEventListener("click",function()
		{
			imgIndex--;
			if(imgIndex == 0)
				imgIndex = 9;
			POPUP__IMG.src = FOTAS[imgIndex].src;
			document.getElementById('numer').innerHTML = "Zdjęcie nr"+[imgIndex+1];
		});

	

