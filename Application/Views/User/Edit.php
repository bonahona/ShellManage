<h1>Edit user</h1>
<?php echo $this->Form->Start('ShellUser');?>
<?php echo $this->Form->Hidden('Id');?>
<div>
    <div class="label">Username</div>
    <?php echo $this->Form->Input('Username');?>
    <?php echo $this->Form->ValidationErrorFor('Username');?>
</div>
<div class="clear"></div>
<div>
    <div class="label">Display name</div>
    <?php echo $this->Form->Input('DisplayName');?>
    <?php echo $this->Form->ValidationErrorFor('DisplayName');?>
</div>
<div class="clear"></div>
<div>
    <div class="label">&nbsp;</div>
    <?php echo $this->Form->Submit('Save');?>
</div>
<?php echo $this->Form->End();?>
<div>
    <?php echo $this->Html->Link('/User/', 'Back');?>
</div>