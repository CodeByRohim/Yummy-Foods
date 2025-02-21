<?php 
    include_once "../inc/BackendHeader.php";
?>
<link rel="stylesheet" href="../assets/css/main.css">
<link rel="stylesheet" href="../assets/vendor/bootstrap-icons/bootstrap-icons.min.css">
<style>
.menuBtn,
.dark-background{
border: none;
width: 35px;
height: 35px;
display: inline-block;
cursor: pointer;
overflow: hidden;
}
.dark-background span{
    display: block;
    width: 100%;
    height: 100%;
    line-height: 35px;
} 
.dark-background span.sunIcon{
background-color: #f1c512;
transition: .3s;
}
.darkMode .dark-background span.sunIcon{
    margin-top: -35px;
}
.dark-background span.moonIcon{
    background-color: rgb(47, 47, 63);
    color: white;
}
h1,p{
    color: var(--primary-color);
}
.dark-background {
  --background-color: #1f1f24;
  --default-color: #ffffff;
  --heading-color: #ffffff;
  --surface-color: #37373f;
  --contrast-color: #ffffff;
}
</style>
          
       <div class="container">
       <div class="groupBtn">
         <button class="dark-background">
          <span class="sunIcon"><i class="bi bi-brightness-high-fill"></i></span>
          <span class="moonIcon"><i class="bi bi-moon-fill"></i></span>
          </button>
       </div>
       </div>

  <?php 
    include_once "../inc/BackendFooter.php";
  ?>
  <script>
 let darkBackground = document.querySelector(".dark-background");
let body = document.querySelector("body");

function darkMode(){
  body.classList.toggle('darkMode');
}
darkBackground.addEventListener("click",darkMode);







// const menuBtn = document.querySelector(".menuBtn");
// let sideBar = document.querySelector(".sideBar");

// function openSideBar(){
//   sideBar.classList.add("active");
// }

// menuBtn.addEventListener('click',openSideBar);


// function closeSideBar(event){
//   // sideBar.classList.remove("active");
//   if(event.target.classList.contains('sideBar') ||
//   event.target.classList.contains('fa-xmark')
//  ) {
//     sideBar.classList.remove("active");
//   }
// }

// let closeBtn = document.querySelector(".closeBtn");
// closeBtn.addEventListener('click',closeSideBar);
// sideBar.addEventListener('click',closeSideBar)

</script>