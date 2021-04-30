const btnRules = document.querySelector('.buttonRules');
const rules = document.querySelector('.Rules');
const cross = document.querySelector('.crossHome');


btnRules.addEventListener("click", () => {
    
    rules.classList.add("open");

})

cross.addEventListener("click", () => {

    rules.classList.remove("open");
    
})


