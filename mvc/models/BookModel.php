<?php
class BookModel
{
    private $db;

    public function __construct($dbConnection){
        $this->db = $dbConnection;
    }

    // 1. Random kedvcsinalo konyv a kezdooldalra
    public function getRandomBooks(){
        $query = "SELECT k.id, k.cim, k.leiras, k.boritokep_url, sz.nev AS szerzo_nev, sz.profilkep_url,
                         AVG(e.ertekeles) AS atlag_ertekeles
                  FROM konyvek k
                  JOIN konyv_szerzo ksz ON k.id = ksz.konyv_id
                  JOIN szerzok sz ON sz.id = ksz.szerzo_id
                  LEFT JOIN ertekelesek e ON e.konyv_id = k.id
                  GROUP BY k.id, sz.id
                  ORDER BY RAND()
                  LIMIT 1;";

        // Sql lekérdezés futtatása
        $result = $this->db->query($query);

        // Eredmény beolvasása majd visszatérése
        return $result->fetch_assoc();
    }
}
?>