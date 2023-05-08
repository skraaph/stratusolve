<?php 

class Logger {
    private $StartTime;
    private $EndTime;
    private $LogFile;
    
    public function __construct($LogFile) {
        $this->LogFile = $LogFile;
    }
    
    public function startLog() {
        $this->StartTime = microtime(true);
    }
    
    public function endLog() {
        $this->EndTime = microtime(true);
    }

    public function saveLog() {
        $StartLog = "Started at: " . date("Y-m-d H:i:s", $this->StartTime) . "\n";
        $EndLog = "Ended at: " . date("Y-m-d H:i:s", $this->EndTime) . "\n";
        $DurationLog = "Total time execute: " . round(($this->EndTime - $this->StartTime), 2) . " seconds.\n";
        
        file_put_contents($this->LogFile, $StartLog, FILE_APPEND);
        file_put_contents($this->LogFile, $EndLog, FILE_APPEND);
        file_put_contents($this->LogFile, $DurationLog, FILE_APPEND);

        echo $StartLog . '<br>';
        echo $EndLog . '<br>';
        echo $DurationLog . '<br>';
    }
}
?>