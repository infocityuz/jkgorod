const bgr = document.querySelector('.infoematsiyaKlienti1Select')
const bgr2 = document.querySelector('.klientNameInformatsiaButtonKontactYellow2')
const option = bgr

option.addEventListener('click', function(){
  if (option.value == 'PerviyContact') {
    bgr2.setAttribute("style", "background-color: #FF9D9D;");
} else if (option.value == 'Peregovori') {
    bgr2.setAttribute("style", "background-color: #F7FF9C;");
  } else if (option.value == 'OformleniSdelki') {
    bgr2.setAttribute("style", "background-color: #B1FF9D; text-align: center;");
  }
});