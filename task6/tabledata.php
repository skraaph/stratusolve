<?php 

ob_start();
include 'templates/table.html';
$HtmlTable = ob_get_clean();

$TheadData = '';
$TbodyData = '';

if ($PeopleArr != null) {
    foreach (get_object_vars($PeopleArr[0]) as $key => $value) {
        $TheadData .= '<th>' . $key . '</th>';
    }
    
    foreach ($PeopleArr as $key => $field) {
        $TbodyData .= "<tr data-toggle='modal' data-target='#ModalEdit' data-row-id='$field->id'>";
        foreach ($field as $fieldName => $fieldValue) {
            $TbodyData .= '<td>' . $fieldValue . '</td>';
        }
        $TbodyData .= "<td><button id='deleteId' type='button' class='btn btn-danger'> X </button></td>";
        $TbodyData .= '</tr>';
    }
}

$HtmlTable = str_replace('{ thead_data }', $TheadData, $HtmlTable);
$HtmlTable = str_replace('{ tbody_data }', $TbodyData, $HtmlTable);

$HtmlPage = str_replace('{ table_data }', $HtmlTable, $HtmlPage);

?>