<?php
session_start();
// prendere la lista delle todo dal file.json (todo.json) (con file_get_contents)
$string = file_get_contents('todo.json');
// trasformarla in una struttura dati che php può usare (con json_decode)
$list = json_decode($string, true);

// nella variabile $data prendo i dati formato JSON che vengono inviati in POST quindi anziché l'array $_POST utilizzo $data
$data = json_decode(file_get_contents('php://input'), true);

// aggiungo la nuova todo se la variabile todoItem è stata settata
if(isset($data['todoItem'])){
    //creo una variabile e gli assegno i valore che viene ricevuto in post
    $todoItem = $data['todoItem'];
    //aggiungo il valore alla lista
    $list[] = $todoItem;
    //Sovrascrivo il file json con la lista aggiornata. Qindi con file_put_contentssalvo il nuovo json nel database todo.json ovviamente tramite json_encode il file viene prima trasformato in json per essere sovrascritto 
    file_put_contents('todo.json', json_encode($list)); 
}

// se ho l'indice quindi il tasto del cestino è stato cliccato allora tolgo con array_splice l'elemento dal file json e con file_put_contents aggiorno il file json
if(isset($data['deleteIndex'])){
    $deleteIndex = $data['deleteIndex'];
    array_splice($list, $deleteIndex, 1);
    file_put_contents('todo.json', json_encode($list)); 
}

// cambio dello stato del task completed quando viene cliccata la task
if(isset($data['taskDoneIndex'])){
    $taskDoneIndex = $data['taskDoneIndex'];
   if(!$list[$taskDoneIndex]['completed']){
    $list[$taskDoneIndex]['completed'] = true;
   } else {
    $list[$taskDoneIndex]['completed'] = false;
   }
   file_put_contents('todo.json', json_encode($list));     
}

// verifico se è stato cliccato un indice e quindi inviato
if(isset($data['showDescriptionIndex'])){
    // assegno l'indice ad una variabile
    $showDescriptionIndex = $data['showDescriptionIndex'];
    // se nella task selezionata dall'indice cliccato dall'utente è presente la descrizione allora metto in sessione la descrizione altrimenti un messaggio con 'nessuna descrizione!!!'
   if($list[$showDescriptionIndex]['description']){
    $_SESSION['description'] = $list[$showDescriptionIndex]['description'];
   } else{
    $_SESSION['description'] = 'Nessuna descrizione!!!';
   }
    // Metto in una variabile l'url per il reindirizzamento alla pagina per vedere la descrizione
    $redirectUrl = './landing.php';
   // Converto l'array PHP in una stringa JSON per restituire un JSON che include l'URL di reindirizzamento.
    echo json_encode(['redirectUrl' => $redirectUrl]);
   // inserisco exit che è fondamentale per interrompere l'esecuzione dello script in modo tale che non venga restituito inutilmente l'intero contenuto nel file JSON con header('Content-Type: application/json') e echo json_encode($list);
    exit;
}



//per specificare che le informazioni restituite sono di tipo json
header('Content-Type: application/json');
// restituire il json (con echo json_encode($array))
echo json_encode($list);