<div class="content-wrapper">
    <section class="content">
        <div class="pull-left">
            <div class="title" >
                <h1>USER MANAGER</h1>
            </div>
        </div>
        <?php
        if (isset($_SESSION['mess'])){?>
            <div class="search alert alert-success">
                <a class="close" href="#">&times;</a>
                <p><strong>SUCCESS!!! </strong><?php echo $_SESSION['mess']; ?></p>
            </div>
            <?php
            unset($_SESSION['mess']);
        } ?>
        <div class="create">
            <a class="btn btn-success" href="<?php echo URL . '/Admin/create'; ?>">Create User</a>
        </div>
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Hover Data Table </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form action='' method="get">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Username</th>
                            <th>Status</th>
                            <th>ROle</th>
                            <th>Action</th>
                        </tr>

                        

                        <tr>
                            <td> <input type='text' name='id' class="search" id="id"></td>
                            <td> <input type='text' name='username' class="search" id="username"></td>
                            <td> <input type='text' name='status' class="search" id="status"></td>
                            <td> <input type='text' name='role' class="search" id="role"></td>
                        </tr>
                        </thead>

                        <tbody class="content-table">
                            <?php require APP.'view/backend/admin/table.php' ; ?>
                        </tbody>
                    </table>
                </form>

            </div>
        </div>
    </section>
</div>
<script type="text/javascript">
    $(function () {
        $('.search').keyup(function () {
            var username = $('#username').val();
            var id = $('#id').val();
            var status = $('#status').val();
            var role = $('#role').val();
            var url = window.location.href;
            url = url.replace("listUser","search");
            $.ajax({
                url: url,
                type: "Post",
                data: {
                    username : username,
                    id : id,
                    status : status,
                    role : role,
                },
                success: function (search) {
                    $('.content-table').html(search);
                }
            });
        });
    })
</script>