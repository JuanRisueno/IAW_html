<?php
#$array = array(1,2,3,4,5);
$array2 = [10,11,12,13,14,15];

/*for ($i=0;$i<count($array2);$i++){
    echo $array2[$i]." ";

}*/

$suma = 0;
foreach($array2 as $num){
    #$suma = $suma + $num;
    $suma += $num;
}

echo "Suma total = $suma";
?>