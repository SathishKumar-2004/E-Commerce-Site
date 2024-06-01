var bar=document.querySelector(".bars");
var sidebar=document.querySelector(".sidebar")
var xmark=document.querySelector(".x-mark")

// sidebar open
bar.addEventListener('click',function(){
  sidebar.style.left=0;
})

// sidebar close
xmark.addEventListener('click',function(){
  sidebar.style.left='-50%'
})