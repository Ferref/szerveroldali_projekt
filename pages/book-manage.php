<?php
//----------------------
//  Oldal változók beállítása
//----------------------

$ROOT = "../";                       //Az adott fájl relatív elérése a `generate.php`-hoz képest.
//$SRC = "https://localhost/szerveroldali_projekt/";
require_once($ROOT."generate.php"); //`generate.php` meghívása
$homePage = new Generate();
$homePage->root = $ROOT;     //relatív útvonal átadása az osztályban használt elérésekhez (css, képek...)
$homePage->name = "Könyv Kezelés"; //title attributum értéke
//echo $ROOT."media/images/nincs-borito.jpg";
//----------------------
//      Tartalom
//----------------------

// Könyvek kezelése

// Új vagy Szerkesztés vagy NotFound!
if(isset($_GET['id']) && !empty($_GET['id']))
{
    // Adatbázis ellenörzés, hogy létezik-e a könyv
    // Ha igen, akkor SZERKESZTÉS
    // Ha nem,  akkor NotFound!
    $cim = "Könyv szerkesztése: id( ".$_GET['id']." )";
    
}
else{
    $cim = "Új könyv felvitele";
}

$konyvKezelesContent = '<div class="row">
    <form action="" class="row">
        <div class="mb-3 col-12">
            <label for="cim" class="form-label my-light-blue">Cím</label>
            <input type="text" class="form-control" id="cim" name="cim" required>
        </div>
        <div class="mb-3 col-12">
            <label for="leiras" class="form-label my-light-blue">Leírás</label>
            <textarea class="form-control" id="leiras" name="leiras" required></textarea>
        </div>
        <div class="mb-3 col-6 col-lg-3">
            <label for="oldalszam" class="form-label my-light-blue">Oldalszám</label>
            <input type="number" class="form-control" id="oldalszam" name="oldalszam" required>
        </div>
        <div class="mb-3 col-6 col-lg-3">
            <label for="kiadasev" class="form-label my-light-blue">Kiadási év</label>
            <input type="number" class="form-control" id="kiadasev" name="kiadasev" required>
        </div>
        <div class="mb-3 col-12 col-md-6">
            <label for="link-amazon" class="form-label my-light-blue">Amazon link</label>
            <input type="text" class="form-control" id="link-amazon" name="link-amazon"/>
        </div>
        <div class="mb-3 col-12 col-md-6">
            <label for="link-bookline" class="form-label my-light-blue">Bookline link</label>
            <input type="text" class="form-control" id="link-bookline" name="link-bookline"/>
        </div>
        <div class="mb-3 col-12 col-lg-6">
            <label for="borito" class="form-label my-light-blue">Borító</label>
            <input type="file" class="form-control" id="borito" name="borito" required>
        </div>

        <div class="mb-3 col-12">
            <fieldset class="border border-2 rounded-3 p-3">
                <legend class="float-none w-auto px-3 my-blue">Kategóriák</legend>
                <div class="row m-0">
                    <div class="col-12 col-md-6 col-lg-3"><input onkeyup="categoryFilter()" type="text" class="form-control" id="categoryInput" placeholder="Szűrés"/></div>
                </div>
                <div class="row mx-0 my-3">
                    <div class="col-12" id="categoriesContainer">
                        <label class="category-frame rounded-10 py-1 px-3 c-pointer me-2" for="kat1">
                            <input class="kat" type="checkbox" name="categories[]" value="1" id="kat1" hidden>
                            <span>Fantasy</span>
                        </label>
                        
                    </div>
                </div>
                <script>
                    var kats = document.getElementsByClassName("kat");
                    for(var i = 0; i<kats.length; i++){
                        kats[i].addEventListener("click", function(e){
                            if(this.checked){
                                this.parentElement.style.backgroundColor = "#4B6587";
                                this.parentElement.style.color = "white";
                            }else{
                                this.parentElement.style.backgroundColor = "";
                                this.parentElement.style.color = "#4B6587";
                            }
                        });
                    }

                    //Filter
                    function categoryFilter() {
                    var input, filter, container, label, span, i, txtValue;
                    input = document.getElementById("categoryInput");
                    filter = input.value.toUpperCase();
                    container = document.getElementById("categoriesContainer");
                    label = container.getElementsByTagName("label");
                    for (i = 0; i < label.length; i++) {
                        span = label[i].getElementsByTagName("span")[0];
                        txtValue = span.textContent || span.innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            label[i].style.display = "";
                        } else {
                            label[i].style.display = "none";
                        }
                    }
                }
                </script>
            </fieldset>
        </div>

        <div class="row">
            <div class="col-12 col-md-5 col-lg-4">
                <div class="row">
                    <div class="col-6"><button type="submit" class="w-100 btn btn-danger my-3 shadow">Törlés</button></div>
                    <div class="col-6"><button type="submit" class="w-100 btn my-3 shadow bg-my-blue my-white-blue">Feltöltés</button></div>
                </div>
            </div>
        </div>
    </form>
</div>';

$konyvKezelesContainer = $homePage->createContainer($konyvKezelesContent,$cim, "bi-book");
//---


//Oldal megjelenítése
echo $homePage->genFramedPage($konyvKezelesContainer);
?>