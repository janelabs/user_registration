<style type="text/css">
    .div {
        margin: 10px auto;
    }
</style>

<h2>List of User(s)</h2>

<div class="div">
    <a href="<?php eh(url('user/register')); ?>" class="btn btn-info">Add User</a>
</div>

<div>
<table class="table table-striped">
    <tbody>
        <tr>
            <th width="320px">Name</th>
            <th width="310px">Username</th>
            <th width="310px">Date Registered</th>
        </tr>
        <?php
            if ($users):
                foreach($users as $user):
                    ?>
                    <tr>
                        <td><?php echo ucwords($user['firstname']) . " " . ucwords($user['lastname']); ?></td>
                        <td><?php echo $user['username']; ?></td>
                        <td><?php echo date('F j, Y (h:i A)', strtotime($user['date_registered'])); ?></td>
                    </tr>
                    <?php
                endforeach;
            else:
                ?>
                <tr>
                    <td colspan="3">No record(s) found.</td>
                </tr>
                <?php
            endif;
        ?>
    </tbody>
</table>
</div>

<div class="pagination">
    <?php echo $page; ?>
</div>