const cloud = document.getElementById("cloud");
const sidebar = document.querySelector(".sidebar");
const spans = document.querySelectorAll("span");
const switche = document.querySelector(".switch");
const circle = document.querySelector(".circle");
const menu = document.querySelector(".menu");
const main = document.querySelector("main");
let listElements = document.querySelectorAll(".list_button_click");

menu.addEventListener("click", ()=>{
    sidebar.classList.toggle("max-sidebar");
    if (sidebar.classList.contains("max-sidebar")){
        menu.children[0].style.display = "none";
        menu.children[1].style.display = "block";
    }else{
        menu.children[0].style.display = "block";
        menu.children[1].style.display = "none";
    }
    if (window.innerWidth<=320) {
        sidebar.classList.add("mini-sidebar");
        main.classList.add("min-main");
        spans.forEach((span)=>{
            span.classList.add("hidden");
        });
    }
});

switche.addEventListener("click", ()=>{
    let body = document.body;
    body.classList.toggle("dark-mode");
    circle.classList.toggle("on");
});


cloud.addEventListener("click",()=>{
    sidebar.classList.toggle("mini-sidebar");
    main.classList.toggle("min-main");
    spans.forEach((span)=>{
        span.classList.toggle("hidden");
    });
});

listElements.forEach(listElement=>{
    listElement.addEventListener('click', ()=>{
        listElement.classList.toggle('arrow');

        let height = 0;
        let menu2 = listElement.nextElementSibling;
        if (menu2.clientHeight == "0") {
            height=menu2.scrollHeight;
        }

        menu2.style.height = `${height}px`
    });
});