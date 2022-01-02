<?php

function tokenizing($s1, $s2){

    //compare the shortest string
    if(strlen($s1) > strlen($s2)){
        $string1 = strtolower($s2);
        $string2 = strtolower($s1);
    }

    else{
        $string1 = strtolower($s1);
        $string2 = strtolower($s2);
    }
    
    //tokenizing dengan spasi, titik, dan koma
    $tok1 = strtok($string1, " ,.\n\t-?=:_;/()&^%$#@!{}[]|+");
    $parts1 = [];
    
    while ($tok1 !== false) {
        $parts1[] = $tok1;
        $tok1 = strtok(" ,.\n\t-?=:_;/()&^%$#@!{}[]|+");
    }
    
    $tok2 = strtok($string2, " ,.\n\t-?=:_;/()&^%$#@!{}[]|+");
    $parts2 = [];
    
    while ($tok2 !== false) {
        $parts2[] = $tok2;
        $tok2 = strtok(" ,.\n\t-?=:_;/()&^%$#@!{}[]|+");
    }
    
    //mencari kesamaan kata dari kedua string dan menjadikannya t0
    $result = array_intersect($parts1, $parts2);
    $t0 = array_values($result);

    //mencari perbedaan dari kedua string dan menjadikannya masing - masing t1 dan t2
    $result = array_diff($parts1, $parts2);
    $t1 = array_values($result);
    $result = array_diff($parts2, $parts1);
    $t2 = array_values($result);
    
    asort($t0);
    asort($t1);
    asort($t2);
    
    $t0 = implode(" ",$t0);
    $t1 = implode(" ",$t1);
    $t2 = implode(" ",$t2);
    
    //menghasilkan masing - masing t1 = t0 + t1, dan t2 = t0 + t2
    $t1 = $t0 . " " . $t1;
    $t2 = $t0 . " " . $t2;
    
    return array($t0, $t1, $t2);
}

function ratio($t1, $t2){
    
    //menjadikan string ke array
    $t1_arr = str_split($t1);
    $t2_arr = str_split($t2);

    //deklarasi matrix
    $a = [];
    for($i = 0; $i < count($t1_arr); $i++){
        for($j = 0;$j < count($t2_arr); $j++){
            $a[$i][$j] = -1;
        }
    }
    
    
    //proses string matching 
    $j_counter = 0;   
    for ($i = 0; $i<count($t1_arr); $i++){
        while($j_counter < count($t2_arr)){
            if($t1_arr[$i] != $t2_arr[$j_counter]){
                $a[$i][$j_counter] = 0;
                $j_counter++;
                continue;
            }
            else if(($t1_arr[$i] == $t2_arr[$j_counter]) && ($i == 0)){
                $a[$i][$j_counter] = 1;
                $j_counter++;
                break;
            }
            else if(($t1_arr[$i] == $t2_arr[$j_counter]) && ($i > 0) && ($t1_arr[$i - 1 ] == $t2_arr[$j_counter - 1])){
                $a[$i][$j_counter] = $a[$i-1][$j_counter-1] + 1;
                $j_counter++;
                break;
            }
            else{
                $a[$i][$j_counter] = 1;
                $j_counter++;
                break;
            }
        }
        
    }

    //mencari a max
    $a_max = 0;
    foreach ($a as $val)
    {
        foreach($val as $key=>$val1)
        {
            if ($val1 > $a_max)
            {
            $a_max = $val1;
            }
        }       
    }
    
    $ratio = (2*$a_max) / (strlen($t1) + strlen($t2));
    return $ratio;
}

function fuzzy_string_matching($s1, $s2){
    
    //menjalankan fungsi tokenizing dan menghapus spasi
    $token = tokenizing($s1, $s2);
    $t0 = str_replace(' ', '', $token[0]);
    $t1 = str_replace(' ', '', $token[1]);
    $t2 = str_replace(' ', '', $token[2]);
    
    //mencari ratio masing masing pasangan token
    $ratio1 = ratio($t0, $t1);
    $ratio2 = ratio($t0, $t2);
    $ratio3 = ratio($t1, $t2);
    
    //mengambil ratio tertinggi
    $ratio = max($ratio1, $ratio2, $ratio3);

    return $ratio;
}

?>