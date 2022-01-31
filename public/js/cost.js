//const cost = require('public/json/cost.json');
// fetch("public/json/cost.json")
//   .then(response => response.json())
//   .then(json => console.log(json));

let cost = JSON.parse('{ "cost" : {"transporters" : { "chronopost" : {"name" : "Chronopost","price" : null,"min" : 4,"max" : 7},"colissimo" : {"name" : "Colissimo","price" : null,"min" : 2,"max" : 5},"ups" : {"name" : "UPS","price" : 4,"min" : null,"max" : 3},"fedex" : {"name" : "FedEx","price" : 7,"min" : 1,"max" : null}},"ship" : { "1" : 5000,"2" : 10000}}}');
cost = cost["cost"]
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
                costPrice.innerHTML = new Intl.NumberFormat('fr-FR', { style: 'currency', currency: 'EUR' }).format(Math.trunc(ship)/100);
            }
            else if (subAmountInt > cost['ship'][2]) {
                newAmount = subAmountInt;
                costPrice.innerHTML = '0,00 €'
            }
            else{
                newAmount = subAmountInt+(ship/2);
                costPrice.innerHTML = new Intl.NumberFormat('fr-FR', { style: 'currency', currency: 'EUR' }).format(Math.trunc(ship/2)/100);
            }
            console.log(ship);
            console.log(ship/2);
        }
        else {
            newAmount = subAmountInt;
            costPrice.innerHTML = '0,00 €'
        }
        newAmount = Math.trunc(newAmount)/100
        amount.innerHTML = new Intl.NumberFormat('fr-FR', { style: 'currency', currency: 'EUR' }).format(newAmount);
    }
    else {
        newAmount = subAmountInt/100;
        amount.innerHTML = new Intl.NumberFormat('fr-FR', { style: 'currency', currency: 'EUR' }).format(newAmount);
        costPrice.innerHTML = '0,00 €'
    }
    checkIfPromo (reducInt);
}

function formatToCents(price){
    return parseFloat(price.innerHTML.replace(",",".").replace(' €',''))*100;
}

function checkIfPromo (promo) {
    if (promo === 0) {
        console.log(promo);
    }
    else {
        console.log(promo);
    }
}