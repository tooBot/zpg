<?php

?>
<head>
    <link rel="stylesheet" href="../../../css/bootstrap.css">
    <link rel="stylesheet" href="../../../css/reg.css">
</head>
<body>
<div id="checkForm">
    <span class="header">Для подтверждения регистрации введите адрес вашей почты и присланный код подтверждения</span>
    <form method="post" action="../reg_ajax.php">
        <div class="form-group">
            <label for="email" class="reg">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
        </div>
        <div class="form-group">
            <label for="code" class="reg">Code</label>
            <input type="text" class="form-control" id="code" name="code" placeholder="Code" required>
        </div>
        <input type="hidden" name="action" value="check">
        <button type="submit" class="btn btn-default btn-primary">Отправить</button>
    </form>
</div>
</body>