<?php
    class Employee{

        // Connection
        private $conn;

        // Table
        private $db_table = "user";

        // Columns
        public $id;
        public $name;
        public $email;
        public $score;
         public $matches;
        public $created;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getEmployees(){
            $sqlQuery = "SELECT id, name, email, score, created FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createEmployee(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        name = :name, 
                        email = :email, 
                        score = :score, 
                        matches = :matches, 
                        created = :created";
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->score=htmlspecialchars(strip_tags($this->score));
            $this->matches=htmlspecialchars(strip_tags($this->matches));
            $this->created=htmlspecialchars(strip_tags($this->created));
        
            // bind data
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":score", $this->score);
            $stmt->bindParam(":matches", $this->matches);
            $stmt->bindParam(":created", $this->created);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // UPDATE
        public function getSingleEmployee(){
            $sqlQuery = "SELECT
                        id, 
                        name, 
                        email, 
                        score, 
                        matches,
                        created
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       id = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->id);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->name = $dataRow['name'];
            $this->email = $dataRow['email'];
            $this->score = $dataRow['score'];
            $this->created = $dataRow['created'];
            $this->matches = $dataRow['matches'];
        }        

        // UPDATE
        public function updateEmployee(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        name = :name, 
                        email = :email, 
                        score = :score, 
                        created = :created
                    WHERE 
                        id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->score=htmlspecialchars(strip_tags($this->score));
            $this->created=htmlspecialchars(strip_tags($this->created));
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            // bind data
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":score", $this->score);
            $stmt->bindParam(":created", $this->created);
            $stmt->bindParam(":id", $this->id);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteEmployee(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            $stmt->bindParam(1, $this->id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }
        public function login($data)
        {
            $email = $data->email;

            $sqlQuery = "SELECT * FROM
                        ". $this->db_table ."
                    WHERE 
                       email = ?";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $email);

            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);

        }

    }
    class Matches{

        // Connection
        private $conn;

        // Table
        private $db_table = "matches";
        private $db_table_score = "Updatescore";

        // Columns
        public $id;
        public $date;
        public $homeName;
        public $awayName;
        public $willWin;
        public $byGoals;
        public $user;
        public $league;
        public $created;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getEmployees(){
            $sqlQuery = "SELECT id, name, email, score, created FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

          public function getMatches(){
            $sqlQuery = "SELECT id, date, league, homeName, user,awayName FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createEmployee(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        date = :date,
                        homeName = :homeName,
                        awayName = :awayName,
                        willWin = :willWin,
                        byGoals = :byGoals,
                        user = :user,
                        league = :league,
                        created = :created";
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->date=htmlspecialchars(strip_tags($this->date));
            $this->homeName=htmlspecialchars(strip_tags($this->homeName));
            $this->awayName=htmlspecialchars(strip_tags($this->awayName));
            $this->willWin=htmlspecialchars(strip_tags($this->willWin));
            $this->byGoals=htmlspecialchars(strip_tags($this->byGoals));
            $this->user=htmlspecialchars(strip_tags($this->user));
            $this->league=htmlspecialchars(strip_tags($this->league));
            $this->created=htmlspecialchars(strip_tags($this->created));
        
            // bind data
            $stmt->bindParam(":date", $this->date);
            $stmt->bindParam(":homeName", $this->homeName);
            $stmt->bindParam(":awayName", $this->awayName);
            $stmt->bindParam(":willWin", $this->willWin);
            $stmt->bindParam(":byGoals", $this->byGoals);
            $stmt->bindParam(":user", $this->user);
            $stmt->bindParam(":league", $this->league);
            $stmt->bindParam(":created", $this->created);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }
        public function updateScore(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table_score ."
                    SET
                        date = :date,
                        homeName = :homeName,
                        awayName = :awayName,
                        willWin = :willWin,
                        byGoals = :byGoals,
                        league = :league";
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->date=htmlspecialchars(strip_tags($this->date));
            $this->homeName=htmlspecialchars(strip_tags($this->homeName));
            $this->awayName=htmlspecialchars(strip_tags($this->awayName));
            $this->willWin=htmlspecialchars(strip_tags($this->willWin));
            $this->byGoals=htmlspecialchars(strip_tags($this->byGoals));
            $this->league=htmlspecialchars(strip_tags($this->league));

        
            // bind data
            $stmt->bindParam(":date", $this->date);
            $stmt->bindParam(":homeName", $this->homeName);
            $stmt->bindParam(":awayName", $this->awayName);
            $stmt->bindParam(":willWin", $this->willWin);
            $stmt->bindParam(":byGoals", $this->byGoals);

            $stmt->bindParam(":league", $this->league);

        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // UPDATE
        public function getSingleEmployee(){
            $sqlQuery = "SELECT
                        id, 
                        name, 
                        email, 
                        score, 
                        matches,
                        created
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       id = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->id);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->name = $dataRow['name'];
            $this->email = $dataRow['email'];
            $this->score = $dataRow['score'];
            $this->created = $dataRow['created'];
            $this->matches = $dataRow['matches'];
        }        

        // UPDATE
        public function updateEmployee(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        name = :name, 
                        email = :email, 
                        score = :score, 
                        created = :created
                    WHERE 
                        id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->score=htmlspecialchars(strip_tags($this->score));
            $this->created=htmlspecialchars(strip_tags($this->created));
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            // bind data
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":score", $this->score);
            $stmt->bindParam(":created", $this->created);
            $stmt->bindParam(":id", $this->id);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteEmployee(){
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
?>

