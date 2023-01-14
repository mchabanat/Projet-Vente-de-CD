// Ajouter au panier
var mesBoutonsAddToCart = document.querySelectorAll(".nonConnecte");

for(var i=0 ; i < mesBoutonsAddToCart.length ; i++) {
    mesBoutonsAddToCart[i].addEventListener('click', e=>{
        var id = e.target.getAttribute('name');
        var url = "ajouterPanier.php?id=" + id;

        //Requete AJAX
        var xhr = new XMLHttpRequest();
        xhr.open("GET", url, true);
        xhr.send();
    })
}