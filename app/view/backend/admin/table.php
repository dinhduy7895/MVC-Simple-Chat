<?php foreach ($rows as $row) { ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['username']; ?></td>
        <td><?php echo $row['status']; ?></td>
        <td><?php echo $row['role']; ?></td>
        <td>
            <a class="btn btn-default action" href="<?php echo URL . '/Admin/view/'.$row['id']; ?>"> VIEW</a>
            <a class="btn btn-default action" href="<?php echo URL . '/Admin/update/'.$row['id']; ?>"> UPDATE</a>
            <a data-toggle="modal" data-target="#myModal<?php echo $row['id']; ?>" class="btn btn-default">DELETE </a>
            <div <?php echo "id='myModal".$row['id']."'";?> class="modal fade" role="dialog">
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
        </td>
    </tr>
<?php } ?>