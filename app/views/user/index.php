<style type="text/css">
    .user_div {
        outline: 1px solid gray;
        padding: 15px;
        margin-top: 10px auto;
    }

    .div {
        margin: 10px auto;
    }
</style>

<h2>List of User(s)</h2>

<div class="div">
    <a href="<?php eh(url('user/register')); ?>" class="btn btn-info">Add User</a>
</div>

<?php
    if ($users):
        foreach ($users as $user):
            ?>
            <div id="<?php echo $user['id']; ?>" class="user_div">
                Name: <?php echo ucwords($user['firstname']) . " " . ucwords($user['lastname']); ?><br />
                Email Address: <?php echo $user['email']; ?>
            </div>
            <?php
        endforeach;
    endif;
?>