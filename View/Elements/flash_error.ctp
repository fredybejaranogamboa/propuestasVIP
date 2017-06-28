<script>

    $(document).ready(function () {

        $("#container").html("");

    });
</script>
<div class="container">
    <div class="alert alert-danger fade in" role="alert" style="width: 60%;">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <?php echo $message ?>
    </div>
</div>