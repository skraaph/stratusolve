<?php

function getTableData($TableData) {
    $TheadData = '';
    $TbodyData = '';
    $TheadArr = array_keys($TableData[0]);

    foreach ($TheadArr as $row) {
        $TheadData .= '<th>' . $row . '</th>';
    }

    foreach ($TableData as $key => $field) {
        $TbodyData .= '<tr>';
        foreach ($field as $fieldName => $fieldValue) {
            $TbodyData .= '<td>' . $fieldValue . '</td>';
        }
        $TbodyData .= '</tr>';
    }

    return array($TheadData, $TbodyData);
}

function htmlTable($TableData) {

    $TheadData = '';
    $TbodyData = '';

    ob_start();
    include 'index.html';
    $htmlTable = ob_get_clean();

    List($TheadData, $TbodyData) = getTableData($TableData);

    $htmlTable = str_replace('{ thead_data }', $TheadData, $htmlTable);
    $htmlTable = str_replace('{ tbody_data }', $TbodyData, $htmlTable);

    return $htmlTable;
}

?>