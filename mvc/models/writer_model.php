<?php

require '../config/db.php';

class WriterModel
{
    private $db;

    public function __construct($dbConnection) {
        $this->db = $dbConnection;
    }

    // Iro informacioinak lekerese
    public function getWriterInfo($writerId) {
        $query = "SELECT id, nev, profilkep_url FROM szerzok WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $writerId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Iro konyveinek lekerese
    public function getWriterBooks($writerId) {
        $query = "SELECT k.id, k.cim, k.leiras, k.boritokep_url 
                  FROM konyvek k
                  JOIN konyv_szerzo ksz ON k.id = ksz.konyv_id
                  WHERE ksz.szerzo_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $writerId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Iro konyveinek atlagos ertekelese
    public function getWriterBooksAvgRating($writerId) {
        $query = "SELECT AVG(e.ertekeles) as atlag_ertekeles
                  FROM ertekelesek e
                  JOIN konyv_szerzo ksz ON e.konyv_id = ksz.konyv_id
                  WHERE ksz.szerzo_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $writerId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc()['atlag_ertekeles'];
    }
}
?>
