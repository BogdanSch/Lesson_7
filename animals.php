<?php

if (preg_match_all('/[bcrh]at/i', "The rat run from the cat and bat help this rat with hat", $arr)){
    // echo $arr[0]."\n";
    print_r($arr);
}