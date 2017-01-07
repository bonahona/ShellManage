<h1>Edit user</h1>

<div class="row">
    <div class="col-lg-4">
        <?php echo $this->Form->Start('ShellUser');?>
        <?php echo $this->Form->Hidden('Id');?>
        <div class="form-group">
            <label>Display Name</label>
            <?php echo $this->Form->Input('DisplayName', array('attributes' => array('class' => 'form-control')));?>
        </div>
        <div class="form-group">
            <label>Username</label>
            <?php echo $this->Form->Input('Username', array('attributes' => array('class' => 'form-control')));?>
        </div>

        <?php echo $this->Form->Submit('Save', array('attributes' => array('class' => 'btn btn-md btn-default')));?>
        <?php echo $this->Form->End();?>
    </div>
</div>
