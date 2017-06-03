<?php

require_once('database.php');

$db = new DB();
//$db->migrate();

$users = $db->get_users();

?>

<html>
<head>
    <title>Encoder</title>
</head>
<body>

<div class="content">

    <table border="1">
        <thead>
        <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Phone</td>
            <td>E-mail</td>
        </tr>
        </thead>
        <tbody>
        <? foreach($users as $user): ?>
            <tr>
                <td><?=$user['id']?></td>
                <td><?=$user['name']?></td>
                <td><?=$user['phone']?></td>
                <td><?=$user['email']?></td>
            </tr>
        <? endforeach ?>
        </tbody>
    </table>

</div>

</body>
</html>

