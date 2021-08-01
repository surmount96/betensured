<?php 
        if(isset($_SESSION["auth_message"])):
    ?>
    <div class="alert alert-danger">
        <?php echo $_SESSION["auth_message"]; ?>
    </div>
    <?php endif; ?>