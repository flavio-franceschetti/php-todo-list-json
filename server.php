<?php

// prendere la lista delle todo dal file.json (todo.json) (con file_get_contents)
$string = file_get_contents('todo.json');
// trasformarla in una struttura dati che php può usare (con json_decode)
$list = json_decode($string, true);

// aggiungo la nuova todo se la variabile todoItem è stata settata
if(isset($_POST['todoItem'])){
    //creo una variabile e gli assegno i valore che viene ricevuto in post
    $todoItem = $_POST['todoItem'];
    //aggiungo il valore alla lista
    $list[] = $todoItem;
    //Sovrascrivo il file json con la lista aggiornata. Qindi con file_put_contentssalvo il nuovo json nel database todo.json ovviamente tramite json_encode il file viene prima trasformato in json per essere sovrascritto 
    file_put_contents('todo.json', json_encode($list)); 
}

if(isset($_POST['deleteIndex'])){
    $deleteIndex = $_POST['deleteIndex'];
    array_splice($list, $deleteIndex, 1);
    file_put_contents('todo.json', json_encode($list)); 
}



//per specificare che le informazioni restituite sono di tipo json
header('Content-Type: application/json');
// restituire il json (con echo json_encode($array))
echo json_encode($list);