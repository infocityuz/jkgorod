const bgr = document.querySelector('.infoematsiyaKlienti1Select')
const bgr2 = document.querySelector('.klientNameInformatsiaButtonKontact')
const option = bgr

option.addEventListener('click', function(){
  if (option.value == 'PerviyContact') {
    bgr2.setAttribute("style", "background-color: #FF9D9D; width: 150px;");
} else if (option.value == 'Peregovori') {
    bgr2.setAttribute("style", "background-color: #F7FF9C; width: 160px;");
  } else if (option.value == 'OformleniSdelki') {
    bgr2.setAttribute("style", "background-color: #B1FF9D; width: 180px; text-align: center;");
  }
});