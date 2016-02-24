<h1>Users</h1>

<div>
    <?php echo $this->Html->Link('/User/Create', 'Create new user');?>
</div>

<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Display name</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($Users as $user):?>
            <tr>
                <td><?php echo $this->Html->Link('/User/Details/' . $user['Id'], $user['Id']);?></td>
                <td><?php echo $this->Html->Link('/User/Details/' . $user['Id'], $user['Username']);?></td>
                <td><?php echo $this->Html->Link('/User/Details/' . $user['Id'], $user['DisplayName']);?></td>
                <td>
                    <?php echo $this->Html->Link('/User/Edit/' . $user['Id'], 'Edit');?> |
                    <?php echo $this->Html->Link('/User/Delete/' . $user['Id'], 'Delete');?>
                </td>
            </tr>
        <?php endforeach;?>
    </tbody>
</table>

<div>
    <?php echo $this->Html->Link('/', 'Back');?>
</div>