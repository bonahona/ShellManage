<h1>Reset user password</h1>

<h2><?php echo $ShellUser['DisplayName'];?></h2>

<div class="row">
    <div class="col-lg-4">
        <?php echo $this->Form->Start('ShellUser');?>
        <?php echo $this->Form->Hidden('Id');?>
        <?php echo $this->Form->Hidden('Username');?>
        <?php echo $this->Form->Hidden('DisplayName');?>

        <div class="form-group">
            <label>Display Name</label>
            <?php echo $this->Form->Password('Password', array('attributes' => array('class' => 'form-control')));?>
            <?php echo $this->Form->ValidationErrorFor('Password');?>
        </div>
        <?php echo $this->Form->Submit('Reset', array('attributes' => array('class' => 'btn btn-md btn-default')));?>
        <?php echo $this->Form->End();?>
    </div>
</div>

<div>
    <?php echo $this->Html->Link('/User/Details/' . $ShellUser['Id'], 'Back');?>
</div>