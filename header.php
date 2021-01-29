<div class="headbox headfix">
    <?php if( $is_login ): ?>
        <ul class="menu">
            <li><span class="menu_square"></span><a href="doc_list.php">我的文档</a></li>
            <li><span class="menu_square"></span><a href="#">/</a></li> 
            <li><span class="menu_square"></span><a href="user_logout.php">退出</a></li>
        </ul>
        <?php else: ?>
        <ul class="menu">
            <li><span class="menu_square"></span><a href="user_login.php">登入</a></li>
       </ul>
        <?php endif; ?>
        <div class="logo"><a href="index.php"><img src="image/logo.png" alt="共享文档 | logo"/></a></div>
</div>