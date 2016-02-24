<h1>
    Local users
</h1>

<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Username</th>
            <th>User level</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($Users as $user):?>
            <tr>
                <td><?php echo $user['User']['Id'];?></td>
                <td><?php echo $user['User']['DisplayName'];?></td>
                <td><?php echo $user['User']['Username'];?></td>
                <td><?php echo $user['UserLevel'];?></td>
                <td>
                    <?php if($user['UserLevel'] == 0):?>
                        <?php echo $this->Html->Link('/User/GrantAccess/' . $user['User']['Id'], 'Grant access');?>
                    <?php else:?>
                        <?php echo $this->Html->Link('/User/RevokeAccess/' . $user['User']['Id'], 'Revoke access');?>
                    <?php endif;?>
                </td>
            </tr>
        <?php endforeach;?>
    </tbody>
</table>
<div>
    <?php echo $this->Html->Link('/', 'Back');?>
</div>