<?php
    class Equipment{
        // Connection
        private $conn;
        // Table
        private string $db_table = "equipment";
        // Columns
        public $id;
        public $vendorID;
        public $serial;
        public $created_at;
        public $updated_at;
        //public $created;
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }
        // GET ALL
        public function getEquipment(){
            $sqlQuery = "SELECT id, vendorID, serial, created_at, updated_at FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
        // CREATE
        public function createEquipment(): bool
        {
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                    vendorID = :vendorID,
                    serial = :serial";

            $stmt = $this->conn->prepare($sqlQuery);

            // sanitize
            $this->vendorID=htmlspecialchars(strip_tags($this->vendorID));
            $this->serial=htmlspecialchars(strip_tags($this->serial));

            // bind data
            $stmt->bindParam(":vendorID", $this->vendorID);
            $stmt->bindParam(":serial", $this->serial);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }
        // READ single
        public function getSingleEquipment(): void
        {
            $sqlQuery = "SELECT id, vendorID, serial, created_at, updated_at FROM " . $this->db_table . " WHERE id = ? ";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $this->id);
            $stmt->execute();
            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->vendorID = $dataRow['vendorID'];
            $this->serial = $dataRow['serial'];
            $this->created_at = $dataRow['created_at'];
            $this->updated_at = $dataRow['updated_at'];

        }
        // UPDATE
        public function updateEquipment(): bool
        {
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                    vendorID = :vendorID,
                    serial = :serial

                    WHERE
                        id = :id";

            $stmt = $this->conn->prepare($sqlQuery);

            $this->vendorID=htmlspecialchars(strip_tags($this->vendorID));
            $this->serial=htmlspecialchars(strip_tags($this->serial));
            $this->id=htmlspecialchars(strip_tags($this->id));

            // bind data
            $stmt->bindParam(":vendorID", $this->vendorID);
            $stmt->bindParam(":serial", $this->serial);
            $stmt->bindParam(":id", $this->id);

            if($stmt->execute()){
               return true;
            }
            return false;
        }
        // DELETE
        function deleteEquipment(): bool
        {
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
            $stmt = $this->conn->prepare($sqlQuery);

            $this->id=htmlspecialchars(strip_tags($this->id));

            $stmt->bindParam(1, $this->id);

            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }

