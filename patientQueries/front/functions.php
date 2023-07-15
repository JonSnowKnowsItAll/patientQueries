<?php


function showTable($query)
{
    global $con;
    $stmt = $con->prepare($query);
    $stmt->execute();
    $meta = array(); // zum Speichern der Attributeigenschaften

    echo '<table class="table"><tr>';

    //Spaltenbezeichner ausgeben
    for ($i = 0; $i < $stmt->columnCount(); $i++) {
        $meta[] = $stmt->getColumnMeta($i); // Attributeigenschaften
        echo '<th>' . $meta[$i]['name'] . '</th>';
    }
    echo '</tr>';
    while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
        echo '<tr>';
        foreach ($row as $r) {
            echo '<td>' . $r . '</td>';
        }
        echo '</tr>';
    }
    echo '</table>';
}

function makeStatement($query, $arrayValues = null)
{
    global $con;

    $stmt = $con->prepare($query);
    $stmt->execute($arrayValues);
    return $stmt;
}

function createDropdownList($stmt, $label)
{
    echo '<br><label for="foundRecipes">' . $label . '</label><select name="foundRecipes" class="form-control">';
    while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
        echo '<option value="' . $row[0] . '">' . $row[1];
    }
    echo '</select><br>';
}

