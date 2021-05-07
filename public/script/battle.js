/*========================*/
/*======BATTLE PART ======*/
/*========================*/
const btnBattle = document.querySelector('.button-Battle');
const battlePage = document.querySelector('.battle-page');
const cross = document.querySelector('.cross');
const titreFight = document.querySelector('h1');
const tableSterketUser = document.querySelector('.table-sterket-User');
const tableSterketEnnemy = document.querySelector('.table-sterket-ennemy');
const titreVS = document.querySelector('.tables-stercket h2');
const phasesCombat = document.querySelector('.combat');

titreFight.classList.add("fade");
battlePage.classList.add("open");
cross.classList.remove("change");
tableSterketUser.classList.add("fade");
tableSterketEnnemy.classList.add("fade");
titreVS.classList.add("fade");
phasesCombat.classList.add("fade");


cross.addEventListener("click", () => {
    titreFight.classList.remove("fade");
    battlePage.classList.remove("open");
    cross.classList.toggle('change');
    tableSterketUser.classList.remove("fade");
    tableSterketEnnemy.classList.remove("fade");
    titreVS.classList.remove("fade");
    phasesCombat.classList.remove("fade");
});