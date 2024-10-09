<?php
    //
    // Az $bd_element változón keresztül éri el a komponens tartalmát a hivatkozó elem.
    //
    include("rating.php");
    $bd_element =  '
    <div class="col-12 d-block d-md-none"><p class="fw-bold mb-3 fs-5 my-gray-3">Narnia 2. - Az oroszlán, a boszorkány és a ruhásszekrény - Illusztrált kiadás</p></div>
            <div class="row p-2">
                <div class="col-4 col-md-2 order-1 order-md-1">
                    <img class="w-100 rounded-20" src="https://s01.static.libri.hu/cover/f9/b/4841405_4.jpg" alt="">
                </div>
                <div class="col-12 col-md-7  order-3 order-md-2">
                    <div class="row">
                        <div class="col-12 d-none d-md-block"><p class="fw-bold mb-2 fs-5 my-gray-3">Narnia 2. - Az oroszlán, a boszorkány és a ruhásszekrény - Illusztrált kiadás</p></div>
                        <div class="col-12">
                            <p class="font-roboto fs-5 my-gray-3 my-2">Narnia egy jéggé dermesztett ország, ahol sohasem jár a Mikulás és nem létezik a karácsony. A négy testvér - Peter, Susan, Edmund és Lucy - egy vidéki kastélyban álló ruhásszekrényen keresztül lép be a birodalomba, hogy felvegye a harcot a Fehér Boszorkánnyal és csatlósaival. A hó is olvadásnak indul, hiszen Aslan, a Nagy Oroszlán egyre közeledik...</p>
                        </div>
                        <div class="col-12 p-3"><span class="my-blue"><i class="bi bi-grid me-2"></i>Kategóriák:</span> <span class="badge rounded-pill bg-my-light-blue fw-normal ms-1 py-2">Fantasy</span><span class="badge rounded-pill bg-my-light-blue fw-normal ms-1 py-2">Akció</span><span class="badge rounded-pill bg-my-light-blue fw-normal ms-1 py-2">Kaland</span></div>
                    </div>
                </div>
                <div class="col-6 col-md-3 order-2 order-md-3 d-flex flex-column align-items-center justify-content-center text-center">
                    <div class="rounded-10 p-2 p-md-4 border w-100">
                        <h5 class="my-blue text-center mb-3"><i class="bi bi-vector-pen me-2"></i>Író</h5>
                        <div class="mx-1 mx-md-3 rounded rounded-circle p-1 bg-white shadow circle-avatar overflow-hidden mb-3 ">
                            <img src="https://totallyhistory.com/wp-content/uploads/2013/07/CS-Lewis.jpg" alt="" class="rounded-circle">
                        </div>
                        <p class="text-center">C. S. Lewis</p>
                    </div>
                </div>

                <div class="col-6 col-md-3 order-2 order-md-3 d-flex flex-column align-items-center justify-content-center text-center">
                    <div class="rounded-10 p-2 p-md-4 border w-100">
                        
                            '.rating(4.5).'
                        
                    </div>
                </div>
            </div>
   ';
    
   // - toast notifications
   // - breadcrumb
   // - pagination
?>