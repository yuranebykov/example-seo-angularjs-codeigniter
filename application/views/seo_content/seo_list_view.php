<ul class="list">
    <? foreach($data as $key=>$val):?>
    <li><a href="<?='/'.$page.'/'.$val->link?>">
            <div class="img-list"><img src="<?=$val->img?>" alt=""/></div>
            <div class="title-list"><?=$val->name?></div>
        </a></li>
    <? endforeach; ?>
</ul>