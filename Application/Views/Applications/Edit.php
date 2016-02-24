<h1>Edit application</h1>
<?php echo $this->Form->Start('ShellApplication');?>
<?php echo $this->Form->Hidden('Id');?>
<div>
    <div class="label">Application Name</div>
    <?php echo $this->Form->Input('ApplicationName');?>
    <?php echo $this->Form->ValidationErrorFor('ApplicationName');?>
</div>
<div class="clear"></div>
<div>
    <div class="label">Default user level</div>
    <?php echo $this->Form->Input('DefaultUserLevel');?>
    <?php echo $this->Form->ValidationErrorFor('DefaultUserLevel');?>
</div>
<div class="clear"></div>
<div>
    <div class="label">Public key</div>
    <?php echo $this->Form->Input('RsaPublicKey');?>
    <?php echo $this->Form->ValidationErrorFor('RsaPublicKey');?>
</div>
<div class="clear"></div>
<div>
    <div class="label">Is inactive</div>
    <?php echo $this->Form->Bool('IsInactive');?>
    <?php echo $this->Form->ValidationErrorFor('IsInactive');?>
</div>
<div class="clear"></div>

<div>
    <div class="label">&nbsp;</div>
    <?php echo $this->Form->Submit('Save');?>
</div>
<?php echo $this->Form->End();?>
<div>
    <?php echo $this->Html->Link('/Applications/', 'Back');?>
</div>