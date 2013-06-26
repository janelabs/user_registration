<style type="text/css">
    .div {
        margin: 10px auto;
    }
</style>

<h2>List of User(s)</h2>

<div class="div">
    <a href="<?php eh(url('user/info')); ?>" class="btn btn-info">Add User</a>
</div>

<div>
<table class="table table-striped">
    <tbody>
        <tr>
            <th style="width: 290px;">Name</th>
            <th style="width: 240px;">Username</th>
            <th style="width: 240px;">Date Registered</th>
            <th style="width: 170px;">Action</th>
        </tr>
        <?php
            if ($users):
                foreach($users as $user):
                    ?>
                    <tr>
                        <td><?php echo ucwords($user['firstname']) . " " . ucwords($user['lastname']); ?></td>
                        <td><?php echo $user['username']; ?></td>
                        <td><?php echo date('F j, Y (h:i A)', strtotime($user['date_registered'])); ?></td>
                        <td>
                            <a id="<?php echo $user['id']; ?>" class="btn btn-info action-edit" title="Edit <?php echo $user['username']; ?>">
                                <i class="icon icon-pencil"></i> Edit
                            </a>
                            <a id="<?php echo $user['id']; ?>" class="btn btn-danger action-delete" title="Delete <?php echo $user['username']; ?>">
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
        $('.action-delete').click(function(){
            var ans = confirm($(this).attr('title') + "?");
            if (ans) {
                $.post("<?php eh(url('user/deleteUser')); ?>", {id: $(this).attr('id')}, function(){
                    window.location = "<?php echo url('user/index'); ?>";
                });
            }
        });

        $('.action-edit').click(function(){
            var ans = confirm($(this).attr('title') + "?");
            if (ans) {
                window.location = "<?php eh(url('user/info?id=')); ?>" + $(this).attr('id');
            }
        });
    });
</script>