<?php

class DatabaseHelper{
    private $db;

    public function __construct($servername, $username, $password,$dbname, $port){
        $this->db = new mysqli($servername, $username, $password,$dbname, $port);
        if ($this->db->connect_error) {
            die("connesione al db fallita");
        }
    }

    public function getRandomPosts($n=2){
        //statement
        $stmt = $this->db->prepare("SELECT titoloarticolo, imgarticolo FROM articolo ORDER BY RAND() LIMIT ?");
        //binding dei parametri, tipo e valore del parametro da aassociare
        $stmt->bind_param("i", $n);
        //esegui l'interrogazione
        $stmt->execute();
        //fetch risultati
        $result = $stmt->get_result();

        //Estraiamo i dati sottoforma di array associativo
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getCategories(){
        $stmt = $this->db->prepare("SELECT idcategoria, nomecategoria FROM categoria");
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getPosts($n=-1){
        $query = "SELECT idarticolo, titoloarticolo, imgarticolo, dataarticolo, anteprimaarticolo, nome FROM articolo, autore WHERE autore=idautore ORDER BY dataarticolo DESC";
        if($n>0){
            $query = $query . " LIMIT ?";
        }
        $stmt = $this->db->prepare($query);
        if($n>0){
            $stmt->bind_param("i", $n);
        }
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);

    }

    public function getAuthors(){
        $query = "SELECT username, nome, GROUP_CONCAT(DISTINCT nomecategoria) as argomenti FROM categoria, articolo, autore, articolo_ha_categoria WHERE idarticolo=articolo AND categoria=idcategoria AND autore=idautore AND attivo=1 GROUP BY username, nome"
        ;$stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getIdFromName($name){
        return preg_replace("/[^a-z]/", '', strtolower($name));
    }
}

?>