



<!-- 
1. Užduotis

Parašykite rekursinę funkciją dviejų natūraliųjų skaičių didžiausiam bendram dalikliui
(dbd) rasti, remdamiesi tokiomis dbd savybėmis:
dbd(a, b) = a, jei a = b;
dbd(a, b) = dbd(a, b – a), jei a < b;
dbd(a, b) = dbd(a – b, b), jei a >b.
 -->

<?php
function dbd($a, $b){
    if ($a == $b){
        echo "dbd yra $a";
    }elseif($a < $b){
        return dbd($a, $b-$a);
    }else{
        return dbd($a-$b, $b);
    }
}
echo dbd(4, 2);
?>







 