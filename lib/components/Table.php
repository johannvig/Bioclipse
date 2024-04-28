<?php
global $indexDropDown;
$indexDropDown = 0;

function getSortableTable($columns, $records, $columnsToSort = null, $columnToSearch = null, $tableIndex = 0)
{
    $html = "";
    if ($columnsToSort != null || $columnToSearch != null) {
        $html .= '<div class="sortable-div">';
        if ($columnToSearch != null)
            $html .= getSearchBar($columnToSearch, $columns, $tableIndex);
        if ($columnsToSort != null)
            $html .= getSortDropDown($columns, $columnsToSort, $tableIndex);
        $html .= '</div>';
    }
    $html .= '<div class="table-fix-head">';
    $html .= '<table class="sortable-table">';
    $html .= getTableHeader($columns);
    $html .= getTableBody($records);
    $html .= '</table>';
    $html .= '</div>';
    return $html;
}

function getTableHeader($columns)
{
    $html = '<thead><tr>';
    foreach ($columns as $column) {
        $html .= '<th>' . $column . '</th>';
    }
    $html .= '</tr></thead>';
    return $html;
}

function getTableBody($records)
{
    $html = '<tbody>';
    foreach ($records as $record) {
        $html .= '<tr>';
        foreach ($record as $value) {
            $html .= '<td>' . $value . '</td>';
        }
        $html .= '</tr>';
    }
    $html .= '</tbody>';
    return $html;
}

function getSearchBar($columnToSearch, $columns, $tableIndex = 0)
{
    return '
    <div class="search-bar">
        <input type="text" class="search" placeholder="Rechercher par ' . $columnToSearch . '" onkeyup="searchTable(' . array_search($columnToSearch, $columns) . ','.$tableIndex.')">
        <img src="images/table/search.svg" alt="Rechercher">
    </div>';
}

function getImage($img, $alt)
{
    return '<img src="' . $img . '" alt="' . $alt . '">';
}

function getSortDropDown($columns, $columnsToSort, $tableIndex = 0)
{
    $i = 0;
    $html = '
    <div class="sort-drop-down">
    <label for="sort">Trier par :</label>
    <select id="sort" onchange="sortTable(this.value,'.$tableIndex.')">';
    foreach ($columns as $column) {
        if (in_array($column, $columnsToSort)) {
            $html .= '<option value="' . $i++ . '">' . $column . '</option>';
        }
    }
    $html .= '</select></div>';
    return $html;
}

function getDropDownButton($dropDownArray, $post_array)
{
    $buttons = '';
    global $indexDropDown;
    foreach ($dropDownArray['Values'] as $value) {
        $buttons .=
            '<form action="' . $value['link'] . '" method="post">
            <input type="hidden" name="' . $post_array['post'] . '" value="' . $post_array['value'] . '">
            <input type="submit" name="submit" value="' . $value['text'] . '">
        </form>
        ';
    }
    return '<div class="dropdown">
    <button onclick="showDropDown(' . $indexDropDown . ')" class="dropbtn">' . $dropDownArray['Text'] . '</button>
    <div id="dropDown' . $indexDropDown++ . '"class="dropdown-content">
      ' . $buttons . ' 
    </div>
  </div>';
}

function getTableLink($link,$text) {
    return '<a href="'.$link.'">'.$text.'</a>';
}

function getTableButton($dropDownArray,$id)
{
    $buttons = '';
    global $indexDropDown;
    foreach ($dropDownArray['Values'] as $value) {
        $buttons .=
            '<button '. ((isset($id))?' id='.$id.' ':"") . ((isset($value["class"]))?' class='.$value["class"].' ':"").(($value['link'])!=""?' onclick="window.location.href='."'". $value['link'].$id : "")."'".'">' . $value['text'] . '</button>
        ';
    }
    return '<div class="dropdown">
    <button onclick="showDropDown(' . $indexDropDown . ')" class="dropbtn">' . $dropDownArray['Text'] . '</button>
    <div id="dropDown' . $indexDropDown++ . '"class="dropdown-content">
      ' . $buttons . ' 
    </div>
  </div>';
}
