const bgr12 = document.querySelector('.select-items')
const bgr21 = document.querySelector('.PerviyContactGreen2')
const dkfjs = document.querySelector('.select-selected')
dkfjs.classList.add('selectSelectInportantDropDownGreen2')
const option12 = dkfjs

if (option12.innerHTML == 'Активный') {
  dkfjs.style.background = '#B1FF9D'
  bgr12.style.background = 'transparent' 
  bgr21.style.background = '#B1FF9D'
  dkfjs.style.margin = "-4px 10px 0px 0px"
  dkfjs.style.height = "22px"
}

option12.addEventListener('click', function(){
  if (option12.innerHTML == 'He Активный') {
    dkfjs.style.background = '#FF9D9D' 
    bgr12.style.background = 'transparent' 
    bgr21.style.background = '#FF9D9D' 
    dkfjs.style.margin = "-4px 10px 0px 0px"
    dkfjs.style.height = "22px"
  } else if (option12.innerHTML == 'Активный') {
    dkfjs.style.background = '#B1FF9D'
    bgr12.style.background = 'transparent' 
    bgr21.style.background = '#B1FF9D'
    dkfjs.style.margin = "-4px 10px 0px 0px"
    dkfjs.style.height = "22px"
  }
});

var $qtext = document.body.getElementsByClassName('select-items');
var $question = $qtext[0].parentNode.getElementsByTagName('div');

if ($question[3].innerText == 'He Активный') {
  $question[3].style.background = "#FF9D9D"
} 

if ($question[2].innerText == 'Активный') {
  $question[2].style.background = "#B1FF9D"
  $question[2].style.marginTop = "5px"
}