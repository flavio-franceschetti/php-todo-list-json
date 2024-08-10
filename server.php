<?php

// 1. recuperare l'info che viene dalla richiesta
// 2. prendere la lista delle todo dal file.json (todo.json) (con file_get_contents)
$string = file_get_contents('todo.json');
// 3. trasformarla in una struttura dati che php può usare (con json_decode)
$list = json_decode($string, true);
// 4. aggiungere la nuova todo
// 5. trasformare l'array di nuovo in un file json (json_encode)

// 6. salvare il nuovo json nel file todo.json (con file_put_contents)
//per specificare che le informazioni restituite sono di tipo json
header('Content-Type: application/json');
// 7. restituire il json (con echo json_encode($array))
echo json_encode($list);