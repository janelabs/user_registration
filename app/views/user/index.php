<h2>List of User(s)</h2>

<div class="div">
    <a href="<?php eh(url('user/info')); ?>" class="btn btn-info">Add User</a>
</div>

<div>
<table class="table table-striped">
    <tbody>
        <tr>
            <th class="width-290">Name</th>
            <th class="width-240">Username</th>
            <th class="width-240">Date Registered</th>
            <th class="width-170">Action</th>
        </tr>
        <?php
            if ($users):
                $id = null;
                foreach($users as $user):
                    $id = base64_encode(ENC_KEY . "-" . $user['id']);
                    ?>
                    <tr>
                        <td><?php echo ucwords($user['firstname']) . " " . ucwords($user['lastname']); ?></td>
                        <td><?php echo $user['username']; ?></td>
                        <td><?php echo date('F j, Y (h:i A)', strtotime($user['date_registered'])); ?></td>
                        <td>
                            <a id="<?php echo $id; ?>" class="btn btn-info action-edit" title="Edit <?php echo $user['username']; ?>">
                                <i class="icon icon-pencil"></i> Edit
                            </a>
                            <a id="<?php echo $id; ?>" class="btn btn-danger action-delete" title="Delete <?php echo $user['username']; ?>">
                                <i class="icon icon-trash"></i> Delete
                            </a>
                        </td>
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

<script type="text/javascript">
    $(function(){
        User.initIndex();
    });
</script>