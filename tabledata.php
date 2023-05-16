<?php 

if (!isset ($_GET['page']) ) {
    $page = 1;
} else {
    $page =  intval($_GET['page']);
}

ob_start();
include 'templates/table.html';
$HtmlTable = ob_get_clean();

ob_start();
include 'templates/navbar.html';
$HtmlNavBar = ob_get_clean();

$TheadData = '';
$TbodyData = '';

if ($PeopleArr != null) {
    foreach ($PeopleArr[0] as $key => $value) {
        $TheadData .= '<th>' . $key . '</th>';
    }
    
    foreach ($PeopleArr as $key => $field) {
        $TbodyData .= "<tr data-toggle='modal' data-target='#ModalEdit' data-row-id='{$field['id']}'>";
        foreach ($field as $fieldName => $fieldValue) {
            $TbodyData .= '<td>' . $fieldValue . '</td>';
        }
        $TbodyData .= "<td><button id='deleteId' type='button' class='btn btn-danger'> X </button></td>";
        $TbodyData .= '</tr>';
    }
}

// Table
$HtmlTable = str_replace('{ thead_data }', $TheadData, $HtmlTable);
$HtmlTable = str_replace('{ tbody_data }', $TbodyData, $HtmlTable);
$HtmlPage = str_replace('{ table_data }', $HtmlTable, $HtmlPage);

$NavBarData = '';

if($page > 4) {
    $NavBarStart = $page - 3;
} else {
    $NavBarStart = 1;
}
if($page > $PageCount-4) {
    $NavBarEnd = $PageCount;
    $NavBarStart = $PageCount - 6;
} else {
    $NavBarEnd = $NavBarStart + 6;
}

if($PageCount <= 6) {
    $NavBarStart = 1;
    $NavBarEnd = $PageCount;
}

if($NavBarStart != 1) {
    $NavBarData .= '<li class="page-item"><a class="page-link" href = "index.php?page=1">First</a></li>';
}
for($PageItem = $NavBarStart; $PageItem <= $NavBarEnd; $PageItem++) {
    $NavBarData .= '<li class="page-item"><a class="page-link" href = "index.php?page=' . $PageItem . '">' . $PageItem . ' </a></li>';
}
if($NavBarEnd != $PageCount) {
    $NavBarData .= '<li class="page-item"><a class="page-link" href = "index.php?page=' . $PageCount . '">Last</a></li>';
}

// Navbar
$HtmlNavBar = str_replace('{ navbar_item }', $NavBarData, $HtmlNavBar);
$HtmlPage = str_replace('{ navbar_data }', $HtmlNavBar, $HtmlPage);

?>