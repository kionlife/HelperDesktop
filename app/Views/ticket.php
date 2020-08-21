<?php foreach ($tickets as $item): 
    if ($item['status'] == 'success') {
        $msg_class = 'msg_success';
        $disabled = 'disabled';


    } elseif ($item['status'] == 'accept') {
        $msg_class = 'msg_accept';
        $disabled = 'disabled';

        
    } elseif ($item['status'] == 'new') {
        $msg_class = 'msg_new';
        setcookie('tickets_new', '3');
        
        $disabled = '';
        echo "<script>
             if (Cookies.get('new_tickets') == undefined) {
                Cookies.set('new_tickets', '0');
             } else {
                var curr_cookies = Cookies.get('new_tickets');
             }
             
             array = curr_cookies.split(',');
             var id = " . $item['id'] . ";
             
             if($.inArray(id.toString(), array) == -1) {
                
                console.log($.inArray(id.toString(), array));
                var new_cookies = curr_cookies + ',' + id;
                Cookies.set('new_tickets', new_cookies);

                sendNotification('Новий тікет!', {
                    body: '',
                    icon: '" . base_url('template/img/logo.png') . "',
                    dir: 'auto'
                });

                src = '" . base_url('template/notify.mp3') . "';
                audio = new Audio(src);
                audio.play();

             } else {
             
            }
            

            </script>";
        

    } else {
        $msg_class = 'msg_other';
        $disabled = '';
    }
?>

<div class="ticket <?=$msg_class; ?>">
	<p>ID тікету: <b><?=($item['id']);?></b></p>
	<p>Доступні автоматичні скрипти: <b><?=($item['script']);?></b></p>
    <a href="teamviewer10://control?device=<?=($item['client_id']);?>">Підключитись по TeamViewer</a> <br>
    <?=nl2br($item['text']);?>
    <div class="btn_group">
        <button <?=$disabled;?> onclick="accept($(this).attr('data-id'));" class="accept" data-id="<?=$item['id'];?>">Прийняти</button>
        <button onclick="success($(this).attr('data-id'));" class="accept" data-id="<?=$item['id'];?>">Виконано</button>
        <!--<button onclick="cls($(this).attr('data-id'));" class="accept" data-id="<?=$item['id'];?>">Закрити тікет</button>-->
    </div>
    <p style="font-weight: 600;">Статус: <span id="status"><?=lang('app.' . $item['status']);?></span> </p>
    <?php
	if ($item['doer'] != "") {
		echo '<p style="font-weight: 600;">Виконавець: <span id="status">' . $item['doer'] . '</span> </p>';
	}
	?>
</div>



<?php endforeach; ?>