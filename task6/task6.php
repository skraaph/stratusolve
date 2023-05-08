<?php 

class Task6 {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function printTable($TableData) {
        include __DIR__ . '/html_table.php';
        return htmlTable($TableData);
    }

    public function run() {
        $Person = new Person($this->conn);
        $Person->createPerson(10);
        $PeopleArr = $Person->loadAllPeople();
        $HtmlOutput = $this->printTable($PeopleArr);
        echo $HtmlOutput;
        $Person->deleteAllPeople();
    }
}

?>