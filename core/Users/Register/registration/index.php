<?php

?>
<head>
    <link rel="stylesheet" href="../../../css/bootstrap.css">
    <link rel="stylesheet" href="../../../css/reg.css">
</head>
<body>
<div id="regForm">
    <form action="../reg_ajax.php" method="post">
        <div class="form-group">
            <span class="header">Регистрация</span>
        </div>
        <div class="form-group">
            <label for="login" class="reg">Login</label>
            <input type="text" class="form-control" id="login" name="login" placeholder="Login" required>
        </div>
        <div class="form-group">
            <label for="email" class="reg">Email address</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
        </div>
        <div class="form-group">
            <label for="password" class="reg">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
        </div>
        <input type="hidden" name="action" value="register">
        <button type="submit" class="btn btn-default btn-primary">Зарегестрироваться</button>
    </form>
</div>
</body>
