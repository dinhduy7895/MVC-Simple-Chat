<div class="join-room" title="true">
    Do you want to join this Room ?
    <form action="<?php echo URL.'User/join/'.$_GET['id']; ?>" method="post">
        <input type="submit"  class="btn btn-success" name="join" value="JOIN">
    </form>
</div>