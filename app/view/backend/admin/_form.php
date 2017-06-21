 <?php
        if (isset($_SESSION['mess'])){?>
                <div class="search alert alert-danger">
                    <a class="close" href="#">&times;</a>
                    <p><strong>ERROR!!! </strong><?php echo $_SESSION['mess']; ?></p>
                </div>
            <?php 
            unset($_SESSION['mess']);
        } ?>
    <div class="form-group field-user-username required">
        <label class="control-label" for="user-username" >Username</label>
        <input type="text" id="user-username" class="form-control" name="username" maxlength="255" required="required" value='<?php echo isset($row) ? $row['username'] : ''; ?>'>

        <div class="help-block"></div>
    </div>

    <div class="form-group field-user-username required">
        <label class="control-label" for="user-name">Role</label>
        <input type="number" id="user-name" class="form-control" name="role" maxlength="255" required="required" value='<?php echo isset($row) ? $row['role'] : ''; ?>'>

        <div class="help-block"></div>
    </div>
 <?php
    if(!isset($row)){ ?>
        <div class="form-group field-user-username required">
            <label class="control-label" for="user-name">Password</label>
            <input type="password" id="user-name" class="form-control" name="pass" maxlength="255" required="required" value='<?php echo isset($row) ? $row['role'] : ''; ?>'>

            <div class="help-block"></div>
        </div>
        <div class="form-group field-user-username required">
            <label class="control-label" for="user-name">Role</label>
            <input type="password" id="user-name" class="form-control" name="rePass" maxlength="255" required="required" value='<?php echo isset($row) ? $row['role'] : ''; ?>'>

            <div class="help-block"></div>
        </div>
   <?php }
 ?>
 
    <div class="form-group">
        <button type="submit" class="btn btn-success" name='<?php echo isset($row) ? 'update' : 'create'; ?>'><?php echo isset($row) ? 'Update' : 'Create'; ?></button>
    </div>
