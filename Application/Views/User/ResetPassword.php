<h1>Reset user password</h1>

<h2>
    <?php echo $ShellUser['DisplayName'];?>
</h2>

<?php echo $this->Form->Start('ShellUser');?>
<?php echo $this->Form->Hidden('Id');?>
<?php echo $this->Form->Hidden('Username');?>
<?php echo $this->Form->Hidden('DisplayName');?>

<div>
    <div class="label">Password</div>
    <?php echo $this->Form->Password('Password');?>
    <?php echo $this->Form->ValidationErrorFor('Password');?>
</div>
<div class="clear"></div>
<div>
    <div class="label">&nbsp;</div>
    <?php echo $this->Form->Submit('Reset');?>
</div>
<?php echo $this->Form->End();?>
<div>
    <?php echo $this->Html->Link('/User/', 'Back');?>
</div>