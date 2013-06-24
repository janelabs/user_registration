<h2>Register User</h2><br>

<form name="usr_register" id="usr_register" method="post" action="<?php eh(url('user/addUser')); ?>">

    <div>
        <label for="lastname">Last Name:</label>
        <input type="text" name="lastname" id="lastname" class="input-xlarge" />
    </div>

    <div>
        <label for="firstname">First Name:</label>
        <input type="text" name="firstname" id="firstname" class="input-xlarge" />
    </div>

    <div>
        <label for="middlename">Middle Name:</label>
        <input type="text" name="middlename" id="middlename" class="input-xlarge" />
    </div>

    <div>
        <label for="email">Email Address:</label>
        <input type="email" name="email" id="email" class="input-xlarge" />
    </div>

    <div>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" class="input-xlarge" />
    </div><br>

    <div>
        <a href="<?php eh(url('user/index')); ?>" class="btn btn-danger">Back</a>
        <input type="submit" value="Register" class="btn btn-info" />
    </div>

</form>