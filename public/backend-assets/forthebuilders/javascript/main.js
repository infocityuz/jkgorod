let list = document.querySelectorAll('.navigation .list');
localStorage.removeItem('menu_list');

if(page_name){
  switch(page_name){
    case 'chats':
      document.getElementById('page-chats').classList.add('active');
      $('#page-chats').find('path').attr('fill', 'black')
    break;
    case 'index':
      document.getElementById('page-index').classList.add('active'); 
      $('#page-index').find('path').attr('fill', 'black')
      break;
    case 'booking':
      document.getElementById('page-booking').classList.add('active');
      $('#page-booking').find('path').attr('stroke', 'black')
      break;
    case 'calendar':
      document.getElementById('page-calendar').classList.add('active');
      $('#page-calendar').find('path').attr('fill', 'black')
      break;
    
    case 'clients':
      document.getElementById('page-clients').classList.add('active');
      $('#page-clients').find('path').attr('stroke', 'black')
      break;
    case 'coupon':
      $('#page-coupon').find('path').attr('fill', 'black')
      document.getElementById('page-coupon').classList.add('active');
      break;
    case 'currency':
      document.getElementById('page-currency').classList.add('active');
      $('#page-currency').find('path').attr('fill', 'black')
      break;
    case 'deal':
      document.getElementById('page-deal').classList.add('active');
      $('#page-deal').find('path').attr('fill', 'black')
      break;
    case 'house':
      document.getElementById('page-house').classList.add('active');
      $('#page-house').find('path').attr('fill', 'black')
      break;
    case 'house-flat':
      document.getElementById('page-house-flat').classList.add('active');
      $('#page-house-flat').find('path').attr('fill', 'black')
      break;
    case 'installment-plan':
      document.getElementById('page-installment-plan').classList.add('active');
      $('#page-installment-plan').find('path').attr('stroke', 'black')
      break;
    case 'language':
      document.getElementById('page-language').classList.add('active');
      $('#page-language').find('path').attr('fill', 'black')
      break;
    case 'lead-comment':
      document.getElementById('page-lead-comment').classList.add('active');
      $('#page-lead-comment').find('path').attr('fill', 'black')
      break;
    case 'lead-status':
      document.getElementById('page-lead-status').classList.add('active');
      $('#page-lead-status').find('path').attr('fill', 'black')
      break;
    case 'leads':
      document.getElementById('page-leads').classList.add('active');
      $('#page-leads').find('path').attr('fill', 'black')
      break;
    case 'settings':
      document.getElementById('page-settings').classList.add('active');
      $('#page-settings').find('path').attr('stroke', 'black')
      break;
    case 'status-colors':
      document.getElementById('page-status-colors').classList.add('active');
      $('#page-status-colors').find('path').attr('fill', 'black')
      break;
    case 'tasks':
      document.getElementById('page-task').classList.add('active');
      $('#page-task').find('path').attr('fill', 'black')
      break;
    case 'user':
      document.getElementById('page-user').classList.add('active');
      $('#page-user').find('path').attr('fill', 'black')
      break;
    

  }
}


let list2 = document.querySelectorAll('.subDown');
for (let i = 0; i < list2.length; i++) {
  list2[i].onclick = function() {
    let j = 0;
    while(j < list2.length) {
      list2[j++].className = 'subDown';
    }
    list2[i].className = 'subDown activeList';
  }
}

function function1() {
  var mashi = document.querySelectorAll("#mashi01");
  var ul = document.querySelectorAll("#mashi");
  mashi.onclick = function() {
    ul.className = 'show'
    console.log('ishladi');
  };
}

var x, i, j, l, ll, selElmnt, a, b, c;
x = document.getElementsByClassName("custom-select");
l = x.length;

for (i = 0; i < l; i++) {
  selElmnt = x[i].getElementsByTagName("select")[0];
  ll = selElmnt.length;
  a = document.createElement("DIV");
  a.setAttribute("class", "select-selected");
  a.setAttribute("id", "select_selected");
  a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
  x[i].appendChild(a);
  b = document.createElement("DIV");
  
  b.setAttribute("class", "select-items test2 select-hide");
  b.setAttribute("id", "select_test");
  for (j = 1; j < ll; j++) {
    c = document.createElement("DIV");
    c.classList.add('selectModalDiv')
    c.classList.add('client-show-buttons')
    c.innerHTML = selElmnt.options[j].innerHTML;
    c.addEventListener("click", function(e) {
        var y, i, k, s, h, sl, yl;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        sl = s.length;
        h = this.parentNode.previousSibling;
        for (i = 0; i < sl; i++) {
          if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = this.innerHTML;
            y = this.parentNode.getElementsByClassName("same-as-selected");
            yl = y.length;
            for (k = 0; k < yl; k++) {
              // y[k].removeAttribute("class");
              y[k].classList.remove("same-as-selected");
            }
            this.setAttribute("class", "same-as-selected selectModalDiv client-show-buttons");
            break;
          }
        }
        h.click();
    });
    b.appendChild(c);
  }
  x[i].appendChild(b);
  a.addEventListener("click", function(e) {
      e.stopPropagation();
      closeAllSelect(this);
      this.nextSibling.classList.toggle("select-hide");
      this.classList.toggle("select-arrow-active");
    });
}

function closeAllSelect(elmnt) {
  var x, y, i, xl, yl, arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("select-selected");
  xl = x.length;
  yl = y.length;
  for (i = 0; i < yl; i++) {
    if (elmnt == y[i]) {
      arrNo.push(i)
    } else {
      y[i].classList.remove("select-arrow-active");
    }
  }
  for (i = 0; i < xl; i++) {
    if (arrNo.indexOf(i)) {
      x[i].classList.add("select-hide");
    }
  }
}

document.addEventListener("click", closeAllSelect);

var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
    } else {
      dropdownContent.style.display = "block";
    }
  });
}

var upBlack = document.getElementsByClassName("headerUpClass");
var upWhite = document.getElementsByClassName("headerUpClass2");
var hrefDrop = document.getElementsByClassName("hrefDrop24");
var q;

for (q = 0; q < hrefDrop.length; q++) {
  hrefDrop[q].addEventListener("click", function() {
    this.classList.toggle("active");
    var imgConntent = this.nextElementSibling;
    console.log(imgConntent);
    if (hrefDrop.className === "hrefDrop24") {
      upBlack.style.display = "none";
      upWhite.style.display = "block";
    } else {
      upWhite.style.display = "none";
      upBlack.style.display = "block";
    }
  });
}

// const dateInput = document.querySelector('#dateInput').valueAsDate = new Date();

let data_input = document.querySelector('#dateInput')
if(data_input){
  const dateInput = data_input.valueAsDate = new Date();
}


// const custom = document.querySelector('.rassrochkaProdnoCheckBox7')
// const noneDown = document.querySelector('#noneDownDrop')

// custom.addEventListener("click", function() {
//   console.log(noneDown);
//   noneDown.classList.add('blockDropDown')
// });


const test1 = document.querySelector('.selectModal');
if(test1 != null){
  var value = test1.value;
  var text = test1.options[test1.selectedIndex].text;
}
console.log(text);
