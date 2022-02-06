/******************************************************
*   fonction pour le dynamisme des prix d'index.php   *
*   function for price dynamism from index.php        *
******************************************************/
// On sélectionne les inputs de quantité
const qty1 = document.querySelector('#qtyBook0');
const qty2 = document.querySelector('#qtyBook1');
const qty3 = document.querySelector('#qtyBook2');

// On surveil si l'input est modifié
qty1.addEventListener('change', newPrice);
qty2.addEventListener('change', newPrice);
qty3.addEventListener('change', newPrice);

function newPrice(e) {
    // on récupère l'id du livre
    const idBook = parseInt(e.target.id.substr(e.target.id.length-1));
    // on sélectionne l'élément où l'on veut afficher le nouveau prix 
    const priceBookCompted = document.querySelector(`#priceBookCompted${idBook}`);
    // on sélectionne le prix du livre
    const price = document.querySelector(`#price${idBook}`);
    // on formate ce prix en float
    const pricefloat = parseFloat(price.innerHTML.replace(",",".").replace(' €',''));
    // on calcule le prix en fonction de la quantité de livre choisis
    const newPrice = pricefloat*e.target.value;
    // si l'on sélectionne autre chose qu'un nombre positif
    if (newPrice < 0){
        // la valeur de l'élément sera 0
        e.target.value=0;
        // et le prix 0,00 €
        return priceBookCompted.innerHTML = '0,00 €';
    }
    else {
        // ou alors on renvoi le prix calculé formaté en euro
        return priceBookCompted.innerHTML = new Intl.NumberFormat('fr-FR', { style: 'currency', currency: 'EUR' }).format(newPrice);
    }
}