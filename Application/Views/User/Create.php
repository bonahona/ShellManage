<h1>Create user</h1>
<?php echo $this->Form->Start('ShellUser');?>
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
    <div class="label">Password</div>
    <?php echo $this->Form->Password('Password');?>
    <?php echo $this->Form->ValidationErrorFor('Password');?>
</div>
<div class="clear"></div>

<div>
    <div class="label">&nbsp;</div>
    <?php echo $this->Form->Submit('Create');?>
</div>
<?php echo $this->Form->End();?>
<div>
    <?php echo $this->Html->Link('/User/', 'Back');?>
</div>