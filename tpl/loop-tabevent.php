<div class="coming_events">
        <div class="time"><?php echo $value['listval']['linkr_eventdate'].'<br>'.$value['listval']['linkr_time'] ?></div>
        <div class="shopname"><a href="<?php echo $value['plink']; ?>"><?php echo $value['title']; ?></a><?php
        if($value['listval']['linkr_eventplace']!=-1){
            ?>@ <a href="<?php echo $value['listval']['barlink']; ?>"><?php echo $value['listval']['linkr_eventplace']; ?></a><?php
            }
        ?></div>
        <div class="poster"><img src="<?php echo $value['mid']; ?>"/></div>
</div>