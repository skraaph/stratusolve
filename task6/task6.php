<?php 

class Task6 {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function printTable($TableData) {
        include __DIR__ . '/html_table.php';
        return htmlTable($TableData);
    }

    public function run() {
        $person = new Person($this->pdo);
        $person->createPerson(10);
        $peopleArr = $person->loadAllPeople();
        $htmlOutput = $this->printTable($peopleArr);
        echo $htmlOutput;
        $person->deleteAllPeople();
    }
}

?>