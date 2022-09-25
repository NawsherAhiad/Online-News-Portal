<?php
function random_number($length)
{
    $text = "";

    $len = $length;

    for($i=0; $i<$len; $i++)
    {
        $text .= rand(0,9);
    }

    return $text;
}

?>