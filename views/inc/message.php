<?php 
        if(isset($_SESSION["success"])):
    ?>
    <div class="alert alert-success">
        <?php echo $_SESSION["success"]; ?>
    </div>
    <?php endif; ?>