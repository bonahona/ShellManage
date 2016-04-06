<div>
    <?php echo $this->Html->Link('/Applications/Create/', 'Create new application');?>
</div>

<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Default</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($Applications as $application):?>
        <tr>
            <td>
                <?php echo $this->Html->Link('/Applications/Details/' . $application['Id'], $application['Id']);?>
            </td>
            <td>
                <?php echo $this->Html->Link('/Applications/Details/' . $application['Id'], $application['ApplicationName']);?>
            </td>
            <td>
                <?php echo $this->Html->Link('/Applications/Details/' . $application['Id'], $application['DefaultUserLevel']);?>
            </td>
            <td>
                <?php echo $this->Html->Link('/Applications/Edit/'  . $application['Id'], 'Edit');?> |
                <?php echo $this->Html->Link('/Applications/Delete/'  . $application['Id'], 'Delete');?>
            </td>
        </tr>
    <?php endforeach;?>
    </tbody>
</table>

<div>
    <?php echo $this->Html->Link('/', 'Back');?>
</div>