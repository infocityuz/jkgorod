const bgr = document.querySelector('.jkSelectZanyat')
const bgr2 = document.querySelector('.jkAttributEdit72')
const option = bgr

option.addEventListener('click', function(){
  if (option.value == 'Занято') {
    bgr2.style.backgroundColor = '#F7FF9C' 
  } else if (option.value == 'Продано') {
    bgr2.style.backgroundColor = '#FF9D9D'
  } else if (option.value == 'Свободно') {
    bgr2.style.backgroundColor = '#B1FF9D'
  }
});