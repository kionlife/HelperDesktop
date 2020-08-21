<?php

include 'config.php';

$action = $_GET['do'];
$mysqli = new mysqli($server, $user, $pass, $db);
switch($action) {
    
    case 'add':
        if($_POST['key'] == $key) {
            
            $text = $_POST['text'];
            $mysqli->query("INSERT INTO tickets(text, doer) VALUES ('$text', '')");
        }
        break;
    
    case 'get':
        $tickets = $mysqli->query("SELECT * FROM tickets");
        $tickets->data_seek(0);
        while ($row = $tickets->fetch_assoc()) {
            echo '<div class="ticket"><input name="ticket_id" type="hidden" value="">' . nl2br($row['text']) . '<button data-id="'.$row['id'].'">Прийняти</button></div>';
        }
        break;
}
    
//addTicket($_POST);

?>