<?php
class User extends DatabaseHandler{
    protected function getAllUsers(){
        $sql = "SELECT * FROM felhasznalok";

        // We use the parents connection
        $result = $this->connect()->query($sql);
        $numRows = $result->num_rows;

        // If we have any results
        if($numRows > 0){
            while($row = $result->fetch_assoc()){
                $data[] = $row;
            }

            return $data;
        }
    }
}
