<?php

/**
 * Get an (x,y) point and return the position in a 3x3 grid for a screen size of 2560x1600 px
 *
 * @param $x
 * @param $y
 *
 * @return string
 */
function getGridPositionFromCoordinates($x, $y)
{
    $horizontal = "left";
    $vertical = "top";

    if ($x >= 866) {
        $horizontal = $x < 1732 ? "center" : "right";
    }

    if ($y >= 533) {
        $vertical = $y < 1066 ? "middle" : "bottom";
    }

    return $horizontal.$vertical;
}

if ($argc != 2) {
    echo "Syntax: php coordinates2grid.php <csv_file>\n";
    exit;
}

$file = fopen($argv[1], 'r');

while ($data = fgetcsv($file)) {
    $arraySize = count($data);

    $positionX = $arraySize - 2;
    $positionY = $arraySize - 1;

    $positionGrid = getGridPositionFromCoordinates((float) $data[$positionX], (float) $data[$positionY]);

    //echo $data[$positionX] . " " . $data[$positionY] . " " . $positionGrid . "\n";

    echo implode(',', array_slice($data, 0, $arraySize - 2)).",".$positionGrid."\n";
}

fclose($file);
