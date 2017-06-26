<div class="content-wrapper">
    <section class="content">
        <div class="pull-left">
            <div class="title" >
                <h1><?php echo $row['username']; ?></h1>
            </div>
        </div>
        <div class="view">
            <a class="btn btn-primary" href="<?php echo URL . '/Admin/update/'.$row['id']; ?>">Update</a>
            <a data-toggle="modal" data-target="#myModal" class="btn btn-danger">DELETE </a>
            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <p>Bạn có chắc chắn xóa không ?.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                            <a  class="action btn btn-default" href="<?php echo URL . '/Admin/delete/'.$row['id']; ?>"> YES</a>
                        </div>
                    </div>

                </div>
            </div>
            <table class="table table-striped table-bordered detail-view">
                <tr>
                    <td>Id</td>
                    <td><?php echo $row['id']; ?></td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td><?php echo $row['username']; ?></td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td><?php echo $row['role']; ?></td>
                </tr>
                <tr>
                    <td>Created At</td>
                    <td><?php echo $row['status']; ?></td>
                </tr>
            </table>
        </div>
    </section>
</div>