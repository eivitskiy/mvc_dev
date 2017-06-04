<h3>Список задач</h3>

<table class="table table-bordered" id="task_list">
    <thead>
    <tr>
        <th>Имя пользователя</th>
        <th>E-mail</th>
        <th>Текст задачи</th>
        <th>Картинки</th>
        <th>Статус</th>
    </tr>
    </thead>
    <tbody>
    <? foreach($tasks as $task): ?>
        <tr>
            <td><?='user'.$task?></td>
            <td><?='email'.$task?></td>
            <td><?='text'.$task?></td>
            <td><?='images'.$task?></td>
            <td><?='status'.$task?></td>
        </tr>
    <? endforeach ?>
    </tbody>
</table>

<span class="glyphicon glyphicon-sort-by-attributes"></span>
