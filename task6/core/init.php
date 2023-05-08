<?php

include 'classes/connection.php';
include 'classes/logger.php';
include 'classes/person.php';

const LOG_FILE = 'log/logfile.log';
const RESULT_PER_PAGE = 15;

global $conn;