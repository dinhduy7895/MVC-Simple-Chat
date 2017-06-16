</div>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Please Choose New Avataer</h4>
            </div>
            <div class="modal-body">
                <form action="upload.php" method="post" enctype="multipart/form-data">
                    <input id="file-0" class="file" name="image" type="file" multiple data-min-file-count="1">
                    <br>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

            </div>
        </div>

    </div>
</div>
</div>
</div>
<script src="plugin/jquery-3.2.1.min.js"></script>
<script src="plugin/chat.js"></script>
<script src="plugin/fileinput.js" type="text/javascript"></script>
<script src="plugin/bootstrap.min.js"></script>

<script>

    $("#myDropdown").hide();
    $(".show-status").on("mousedown", function () {
        if ($("#myDropdown").css("display") == 'none') {
            $("#myDropdown").slideDown("slow");
            $(".list-users").hide(300);
        }
        else {
            $("#myDropdown").hide(300);
            $(".list-users").slideDown("slow");
        }

    });


</script>
</body>
</html>