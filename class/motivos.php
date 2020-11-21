<?php
    class Motivo{

        // Connection
        private $conn;

        // Table
        private $db_table = "motivos_es_gt";

        // Columns
        public $motivo;
        public $des_motivo;
        public $estado;
        public $tipo;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getMotivos(){
            $sqlQuery = "SELECT motivo, des_motivo, estado, tipo FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createMotivo(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    (des_motivo, estado, tipo)
                    VALUES(:des_motivo, :estado, :tipo)";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->motivo=htmlspecialchars(strip_tags($this->motivo));
            $this->des_motivo=htmlspecialchars(strip_tags($this->des_motivo));
            $this->estado=htmlspecialchars(strip_tags($this->estado));
            $this->tipo=htmlspecialchars(strip_tags($this->tipo));
        
            // bind data
            $stmt->bindParam(":des_motivo", $this->des_motivo);
            $stmt->bindParam(":estado", $this->estado);
            $stmt->bindParam(":tipo", $this->tipo);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // READ single
        public function getSingleMotivo(){
            $sqlQuery = "SELECT
                        motivo, 
                        des_motivo, 
                        estado, 
                        tipo
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       motivo = ?
                    LIMIT 1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->motivo);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->motivo = $dataRow['motivo'];
            $this->des_motivo = $dataRow['des_motivo'];
            $this->estado = $dataRow['estado'];
            $this->tipo = $dataRow['tipo'];
        }        

        // UPDATE
        public function updateMotivo(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                        
                    SET
                        des_motivo = :des_motivo, 
                        estado = :estado, 
                        tipo = :tipo
                    WHERE 
                        motivo = :motivo";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->motivo=htmlspecialchars(strip_tags($this->motivo));
            $this->des_motivo=htmlspecialchars(strip_tags($this->des_motivo));
            $this->estado=htmlspecialchars(strip_tags($this->estado));
            $this->tipo=htmlspecialchars(strip_tags($this->tipo));

        
            // bind data
            $stmt->bindParam(":motivo", $this->motivo);
            $stmt->bindParam(":des_motivo", $this->des_motivo);
            $stmt->bindParam(":estado", $this->estado);
            $stmt->bindParam(":tipo", $this->tipo);

        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteMotivo(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE motivo = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->motivo=htmlspecialchars(strip_tags($this->motivo));
        
            $stmt->bindParam(1, $this->motivo);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>