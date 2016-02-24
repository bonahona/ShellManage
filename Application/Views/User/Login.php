<?php echo $this->Form->Start('User');?>

<div>
    <div class="label">Username</div>
    <?php echo $this->Form->Input('Username');?>
    <?php echo $this->Form->ValidationErrorFor('Username');?>
</div>
<div class="clear"></div>
<div>
    <div class="label">Password</div>
    <?php echo $this->Form->Password('Password');?>
    <?php echo $this->Form->ValidationErrorFor('Password');?>
</div>
<div>
    <div class="label">&nbsp;</div>
    <?php echo $this->Form->Submit("Login");?>
</div>

<?php if(isset($errorMessage)):?>
    <div>
        <?php echo $errorMessage;?>
    </div>
<?php endif;?>

<?php echo $this->Form->End();?>
