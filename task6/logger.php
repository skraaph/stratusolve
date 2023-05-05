<?php 
class Logger {
    private $startTime;
    private $endTime;
    private $logFile;
    
    public function __construct($logFile) {
        $this->logFile = $logFile;
    }
    
    public function startLog() {
        $this->startTime = microtime(true);
    }
    
    public function endLog() {
        $this->endTime = microtime(true);
    }

    public function saveLog() {
        $startLog = "Started at: " . date("Y-m-d H:i:s", $this->startTime) . "\n";
        $endLog = "Ended at: " . date("Y-m-d H:i:s", $this->endTime) . "\n";
        $durationLog = "Total time execute: " . round(($this->endTime - $this->startTime), 2) . " seconds.\n";
        
        file_put_contents($this->logFile, $startLog, FILE_APPEND);
        file_put_contents($this->logFile, $endLog, FILE_APPEND);
        file_put_contents($this->logFile, $durationLog, FILE_APPEND);

        echo $startLog . '<br>';
        echo $endLog . '<br>';
        echo $durationLog . '<br>';
    }
}
?>