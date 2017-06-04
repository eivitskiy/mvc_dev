<h3>Список задач</h3>

<table class="table table-bordered" id="task_list">
    <thead>
    <tr>
        <th data-name="username" class="<?=($order == 'username' ? 'sort sort-'.$direction : '')?>">Имя</th>
        <th data-name="email" class="<?=($order == 'email' ? 'sort sort-'.$direction : '')?>">E-mail</th>
        <th data-name="text" class="<?=($order == 'text' ? 'sort sort-'.$direction : '')?>">Текст&nbsp;задачи</th>
        <th data-name="images" class="<?=($order == 'images' ? 'sort sort-'.$direction : '')?>">Картинки</th>
        <th data-name="status" class="<?=($order == 'status' ? 'sort sort-'.$direction : '')?>">Статус</th>
    </tr>
    </thead>
    <tbody>
    <? foreach($tasks as $task): ?>
        <tr class="<?=($task->status ? 'bg-success' : '')?>">
            <td><?=$task->username?></td>
            <td><?=$task->email?></td>
            <td><?=$task->text?></td>
            <td>
                <? foreach((array)unserialize($task->images) as $image): ?>
                <img src="<?=$image?>">
                <?endforeach?>
            </td>
            <td>
                <? if(isset($_SESSION['auth']) && $_SESSION['auth']): ?>
                    <select class="task-status form-control input-sm" data-id="<?=$task->id?>">
                        <option value="0" <?=($task->status==0 ? 'selected="selected"' : '')?>>активна</option>
                        <option value="1" <?=($task->status==1 ? 'selected="selected"' : '')?>>выполнена</option>
                    </select>
                <? else: ?>
                <?=($task->status ? 'выполнена' : 'активна')?>
                <? endif ?>
            </td>
        </tr>
    <? endforeach ?>
    </tbody>
</table>

<div class="col-md-12 text-center">
    <? require_once(APPPATH . 'views/paging.php') ?>
</div>
