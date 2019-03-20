var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    for(var j = 0; j < coll.length; j++){
        if(coll[j] != this){
            var content = coll[j].nextElementSibling;
            content.style.maxHeight = null;
            coll[j].classList.remove("active");
        }
    }
    var content = this.nextElementSibling;
    if (content.style.maxHeight){
      content.style.maxHeight = null;
    } else {
      content.style.maxHeight = content.scrollHeight + "px";
    } 
  });
}


window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
      document.getElementById("mainNav").style.paddingTop = "1%";
      document.getElementById("mainNav").style.paddingBottom = "1%";
  } else {
    document.getElementById("mainNav").style.paddingTop = "4%";
    document.getElementById("mainNav").style.paddingBottom = "0%";
  }
}

function showHoverText(){
  if( !/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
    if(window.innerWidth > 768){
      var hoverText = document.querySelector('.hover-text');
      hoverText.style.display = "block";
    }
   }
  // if(window.innerWidth > 992){
  //   var hoverText = document.querySelector('.hover-text');
  //   hoverText.style.display = "block";
  // }
  

}

function hideHoverText(){
  var hoverText = document.querySelector('.hover-text');
  hoverText.style.display = "none";

}