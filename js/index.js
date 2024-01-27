
// navlists

const men = document.querySelector(".aside .nav-toggler");
const asideLists = document.querySelector(".aside");
const mainContent = document.querySelector(".main-content");
const section = document.querySelectorAll(".section");

men.addEventListener("click",()=>{
    asideLists.classList.toggle("open");
    mainContent.classList.toggle("open");
})


window.addEventListener("scroll", ()=>{
    if(document.querySelector(".aside").classList.contains("open")){
        document.querySelector(".aside").classList.remove("open");

    }
    
})

window.addEventListener('load', ()=>{
    document.querySelector('.main-conatiner').style.display = 'none';

    setTimeout(()=>{
        document.querySelector('.loader').style.display = 'none';
        document.querySelector('.main-conatiner').style.display = 'block';
        document.querySelector('.fa fa-seedling fa-spin').style.display='none';
    

},5000);
})

document.querySelector('.fa fa-comments').addEventListener('click',()=>{
    if(document.querySelector('#contact').style.display == 'none'){
        document.querySelector('#contact').style.display == 'block';
    }
})



