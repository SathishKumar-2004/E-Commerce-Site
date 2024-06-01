// Product search
var search=document.getElementById('inputtext');
var product_section=document.querySelector('.products')
var div=product_section.querySelectorAll('div')
search.addEventListener('keyup',function(){
  var text=event.target.value.toUpperCase();
  for (var i=0;i<div.length;i++){
    var item_name=div[i].querySelector("p").textContent;
    if(item_name.toUpperCase().indexOf(text)<0){
      div[i].style.display='none';
    }
    else{
      div[i].style.display='block'
    }
  }
})