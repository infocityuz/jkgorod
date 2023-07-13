const bgr12 = document.querySelector('.select-items')
const bgr21 = document.querySelector('.modalSelect')
const bgr42 = document.querySelector('.select-selected')
const option12 = bgr42

option12.addEventListener('click', function(){
  // console.log(option12.innerHTML)
  if (option12.innerHTML == 'Занято') {
    bgr21.style.background = '#F7FF9C' 
    bgr42.style.background = '#F7FF9C' 
  } else if (option12.innerHTML == 'Продано') {
    bgr21.style.background = '#FF9D9D'
    bgr42.style.background = '#FF9D9D'
  } else if (option12.innerHTML == 'Свободно') {
    bgr21.style.background = '#B1FF9D'
    bgr42.style.background = '#B1FF9D'
  }
});

const zamyatiOption = document.querySelector('#zanyatiOption')
const zamyatiOption2 = document.querySelector('#exampleModal')
const zamyatiOption3 = document.querySelector('#exampleModal2')

option12.addEventListener('click', function(){
  if (option12.innerHTML == ' Занято ||  Занято') {
    zamyatiOption2.classList.add('d-none');
    zamyatiOption3.classList.add('show');
  }
  if (option12.innerHTML == 'Продано') {
    window.open('prodno.html');
  }
});

const close12 = document.querySelector('#closeSpan')
const fade = document.querySelector('.modal-backdrop.fade')

close12.addEventListener('click', function(event){
  zamyatiOption3.classList.add('d-none');
  // fade.classList.remove = '.modal-backdrop'
});

