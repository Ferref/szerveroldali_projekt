<?php
require '../config/db.php';

class BookModel
{
    private $db;

    public function __construct($dbConnection){
        $this->db = $dbConnection;
    }

    // 1. Random kedvcsinalo konyv a kezdooldalra
    public function getRandomBooks(){
        $query = "SELECT k.id, k.cim, k.leiras, k.boritokep_url, sz.nev AS szerzo_nev, sz.profilkep_url
                  FROM konyvek k
                  JOIN konyv_szerzo ksz ON k.id = ksz.konyv_id
                  JOIN szerzok sz ON sz.id = ksz.szerzo_id
                  ORDER BY RAND()
                  LIMIT 1;";

        // Sql lekerdezés futtatasa
        $result = $this->db->query($query);

        // Eredmeny beolvasasa majd visszateritese
        return $result->fetch_assoc();
    }
    
};
?>
