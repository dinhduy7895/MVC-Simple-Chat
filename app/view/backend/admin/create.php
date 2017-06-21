<div class="content-wrapper">
    <section class="content">
        <div class="pull-left">
            <div class="title" >
                <h1>USER MANAGER</h1>
            </div>
        </div>
        <div class="update" >
            <form action="<?php echo URL . '?ctl=Admin&act=create'; ?>" method="post">
                <?php
                require APP . 'view/backend/admin/_form.php';
                ?>
            </form>
        </div>


    </section>
</div>