<h2>Register User</h2>
<p style="color: red;">All fields are required.</p>
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

<form name="usr_register" id="usr_register" method="post" action="<?php eh(url('')); ?>">

    <div>
        <label for="lastname">Last Name:</label>
        <input type="text" name="lastname" id="lastname" class="input-xlarge" value="<?php eh(!empty($lastname) ? $lastname : ''); ?>" />
    </div>

    <div>
        <label for="firstname">First Name:</label>
        <input type="text" name="firstname" id="firstname" class="input-xlarge" value="<?php eh(!empty($firstname) ? $firstname : ''); ?>" />
    </div>

    <div>
        <label for="middlename">Middle Name:</label>
        <input type="text" name="middlename" id="middlename" class="input-xlarge" value="<?php eh(!empty($middlename) ? $middlename : ''); ?>" />
    </div>

    <div>
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" class="input-xlarge" value="<?php eh(!empty($username) ? $username : ''); ?>" />
    </div>

    <div>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" class="input-xlarge" />
    </div><br>

    <div>
        <a href="<?php eh(url('user/index')); ?>" class="btn btn-danger">Back</a>
        <input type="submit" value="Register" name="register_btn" class="btn btn-info" />
    </div>

</form>