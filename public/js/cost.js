//const cost = require('public/json/cost.json');
// fetch("public/json/cost.json")
//   .then(response => response.json())
//   .then(json => console.log(json));
let promos = JSON.parse('{ "promos" : {"lessfifteen" :15, "newClient" :25}}');
let cost = JSON.parse('{ "cost" : {"transporters" : { "chronopost" : {"name" : "Chronopost","price" : null,"min" : 4,"max" : 7},"colissimo" : {"name" : "Colissimo","price" : null,"min" : 2,"max" : 5},"ups" : {"name" : "UPS","price" : 4,"min" : null,"max" : 3},"fedex" : {"name" : "FedEx","price" : 7,"min" : 1,"max" : null}},"ship" : { "1" : 5000,"2" : 10000}}}');
promos = promos["promos"];
cost = cost["cost"];
/******************************************************
*   fonction pour le dynamisme des prix d'index.php   *
*   function for price dynamism from index.php        *
******************************************************/
const selectCost = document.querySelector('#selectCost');

const subAmount = document.querySelector('#subAmount');
const reducPrice = document.querySelector('#reduc');
const costPrice = document.querySelector('#cost');
const amount = document.querySelector('#amount');
let subAmountInt = formatToCents(subAmount);
let reducInt = formatToCents(reducPrice);
let costInt = formatToCents(costPrice);


selectCost.addEventListener('change', priceCost);
function priceCost() {
    const costIDselected = selectCost.selectedIndex;
    console.log(costIDselected)
    const expeditor = document.querySelector(`#select${costIDselected}`).value;
    const expedInfos = cost['transporters'][expeditor];
    let newAmount = 0;
    if (costIDselected > 0 ){ 
        if (expedInfos['price'] != null) {
            const ship = subAmountInt*(expedInfos['price']/100);
            if (subAmountInt < cost['ship'][1]) {
                newAmount = subAmountInt+ship;
                costPrice.innerHTML = formatToDevise(Math.trunc(ship)/100);
            }
            else if (subAmountInt > cost['ship'][2]) {
                newAmount = subAmountInt;
                costPrice.innerHTML = '<del>0,00</del> €'
            }
            else{
                newAmount = subAmountInt+(ship/2);
                costPrice.innerHTML = formatToDevise(Math.trunc(ship/2)/100);
            }
        }
        else {
            newAmount = subAmountInt;
            costPrice.innerHTML = '0,00 €'
        }
        newAmount = Math.trunc(newAmount)/100
        amount.innerHTML = formatToDevise(newAmount);
    }
    else {
        newAmount = subAmountInt/100;
        amount.innerHTML = formatToDevise(newAmount);
        costPrice.innerHTML = '0,00 €'
    }
    checkIfPromo (reducInt);
}

function formatToCents(price){
    return parseFloat(price.innerHTML.replace(",",".").replace(' €',''))*100;
}

function formatToDevise(price){
    return new Intl.NumberFormat('fr-FR', { style: 'currency', currency: 'EUR' }).format(price);
}

function checkIfPromo (promo) {
    if (promo === 0) {
        console.log(promo);
    }
    else {
        console.log(promo);
    }
}