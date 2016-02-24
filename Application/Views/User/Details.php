<h1>User</h1>

<h2>Details</h2>
<?php if(isset($User)):?>
    <div>
        <?php echo $User['Id'];?>
    </div>
    <div>
        <?php echo $User['Username'];?>
    </div>
    <div>
        <?php echo $User['DisplayName'];?>
    </div>

    <div>
        <?php echo $this->Html->Link('/User/ResetPassword/' . $User['Id'], 'Reset password');?>
    </div>
    <div>
        <?php echo $this->Html->Link('/User/Edit/' . $User['Id'], 'Edit');?>
    </div>
    <div>
        <?php echo $this->Html->Link('/User/Delete' . $User['Id'], 'Delete');?>
    </div>

    <h2>
        Privileges
    </h2>
    <table>
        <thead>
        <tr>
            <th>Application</th>
            <th>User level</th>
            <th>&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($User['ShellUserPrivileges'] as $privilege):?>
            <tr>
                <td><?php echo $privilege['ShellApplication']['ApplicationName'];?></td>
                <td><?php echo $privilege['UserLevel'];?></td>
                <td>
                    <?php if($privilege['UserLevel'] == 0):?>
                        <?php echo $this->Html->Link('/User/GrantAccess/' . $privilege['ShellUserId'] . '/' . $privilege['ShellApplicationId'], 'Grant Access');?>
                    <?php else:?>
                        <?php echo $this->Html->Link('/User/RevokeAccess/' . $privilege['ShellUserId'] . '/' . $privilege['ShellApplicationId'], 'Revoke Access');?>
                    <?php endif;?>
                </td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
<?php else:?>
    <div>
        <h2>Not found</h2>
    </div>
<?php endif;?>
<div>
    <?php echo $this->Html->Link('/User/', 'Back');?>
</div>