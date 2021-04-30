
const btnBattle = document.querySelector('.button-battle');
const battlePage = document.querySelector('.battle-page');
const cross = document.querySelector('.cross');



btnBattle.addEventListener("click", () => {
    battlePage.classList.add("open");
    
    cross.classList.remove("change");
})

cross.addEventListener("click", () => {
    battlePage.classList.remove("open");
    cross.classList.toggle('change');
})