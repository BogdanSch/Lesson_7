<?php

$films = [
    [
        "producer" => "Michael Mann",   
        "films" => [
            [
                "film_name" => "The Last of the Mohicans",
                "release_date" => "1992"
            ],
            [
                "film_name" => "The Insider",
                "release_date" => "1999"
            ],
        ]
    ],
    [
        "producer" => "Steven Spielberg",   
        "films" => [
            [
                "film_name" => "Men in Black",
                "release_date" => "1997"
            ],
            [
                "film_name" => "Transformers",
                "release_date" => "2007"
            ],
        ]
    ],
    [
        "producer" => "Jorge Lucas",   
        "films" => [
            [
                "film_name" => "Star Wars Episode 1",
                "release_date" => "1999"
            ],
            [
                "film_name" => "Star Wars Episode 3",
                "release_date" => "2005"
            ],
        ]
    ],
];

function try_walk($film, $key_film, $data){
    static $i = 1;
    echo "<tr><th style=\"color: #000; border: 3px #000 solid; background: #e6e6e6;\">$data.$i</th></tr>";
    foreach ($film as $key => $value) {
        print "<tr>";
        print "<td style=\"color: #000; border: 3px #000 solid; background: #e6e6e6;\">";
      if (!is_array($value))
        echo "$key: $value\t<br>";
      else {
          echo "$key: ";
          foreach ($value as $k => $v)
            if (is_array($v)){
                foreach ($v as $v_key => $v_value) {
                    echo "[{$v_key} - $v_value]; <br>";
                }
            }
            else{
                echo "[{$k} - $v]; <br>";
            }
          }
          print "</td>";
          print "</tr>";
    }
    $i++;
}

function search($films, $data) {
    $result = [];
    foreach ($films as $film_number => $film) {
        foreach ($film as $key => $value) {
            if (!is_array($value)) {
                if (stristr($value, $data)) {
                    $result[] = $film_number;
                }
            } else {
                foreach ($value as $k => $v) {
                    if (is_array($v)) {
                        foreach ($v as $v_key => $v_value) {
                            if (stristr($v_key, $data) || strstr($v_value, $data)) {
                                $result[] = $film_number;
                            }
                        }
                    }
                    else{
                        if (stristr($v, $data) || strstr($k, $data)) {
                            $result[] = $film_number;
                        }
                    }
                }
            }
        }
    }
    return array_unique($result);
}
function search_by_date($date, $films){
    print "<tr><td>Search by ".$date."</td><tr>";
    $search_result = array_flip(search($films, $date));

    if($search_result){
        $films_search_result = array_intersect_key($films, $search_result);
        array_walk($films_search_result, "try_walk", "№");
    }
    else{
        print("<strong>There is no the same keys in the site!</strong>");
    }
}
function search_by_name($name, $films){
    print "<tr><td>Search by ".$name."</td><tr>";
    $search_result = array_flip(search($films, $name));

    if($search_result){
        $films_search_result = array_intersect_key($films, $search_result);
        array_walk($films_search_result, "try_walk", "№");
    }
    else{
        print("<strong>There is no the same keys in the site!</strong>");
    }
}
function search_by_producer($producer, $films){
    print "<tr><td>Search by ".$producer."</td><tr>";
    $search_result = array_flip(search($films, $producer));

    if($search_result){
        $films_search_result = array_intersect_key($films, $search_result);
        array_walk($films_search_result, "try_walk", "№");
    }
    else{
        print("<strong>There is no the same keys in the site!</strong>");
    }
}
print "<table style=\"border: 3px solid #000; width: 80%; margin: 0 auto;\">";

search_by_date(1999, $films);
search_by_name("The", $films);
search_by_producer("Jorge", $films);

print "</table>";