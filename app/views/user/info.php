<h2><?php eh($title); ?> User</h2>
<p class="red">Fields with * are required.</p>
<br>

<?php
    if (!empty($error)) {
        ?>
        <div class="alert alert-error">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Error! </strong> <?php eh($error); ?>
        </div>
        <?php
    }
?>

<form name="usr_info" id="usr_info" method="post" action="<?php eh(url('')); ?>">

    <div>
        <label for="lastname"><span class="red">*</span>Last Name:</label>
        <input type="text" name="lastname" id="lastname" class="input-xlarge" value="<?php eh(!empty($lastname) ? $lastname : ''); ?>" />
    </div>

    <div>
        <label for="firstname"><span class="red">*</span>First Name:</label>
        <input type="text" name="firstname" id="firstname" class="input-xlarge" value="<?php eh(!empty($firstname) ? $firstname : ''); ?>" />
    </div>

    <div>
        <label for="middlename">Middle Name:</label>
        <input type="text" name="middlename" id="middlename" class="input-xlarge" value="<?php eh(!empty($middlename) ? $middlename : ''); ?>" />
    </div>

    <div>
        <label for="username"><span class="red">*</span>Username:</label>
        <input type="text" name="username" id="username" class="input-xlarge" value="<?php eh(!empty($username) ? $username : ''); ?>" />
    </div>

    <?php
        if (!$uid) {
            ?>
            <div>
                <label for="password"><span class="red">*</span>Password:</label>
                <input type="password" name="password" id="password" class="input-xlarge" value="<?php eh(!empty($password) ? $password : ''); ?>" />
            </div><br>
            <?php
        }
    ?>

    <div>
        <a href="<?php eh(url('user/index')); ?>" class="btn btn-danger">Back</a>
        <input type="submit" value="<?php eh($submit_value); ?>" name="info_btn" class="btn btn-info" />
    </div>

</form>

<?php
    if (!empty($last_date_modified)) {
        ?>
        <p>Last Modified: <?php eh(date('F j, Y (h:i A)', strtotime($last_date_modified))); ?></p>
        <?php
    }
?>