<h1>Create user</h1>

<div class="row">
    <div class="col-lg-4">
        <?php echo $this->Form->Start('ShellUser');?>
        <div class="form-group">
            <label>Display Name</label>
            <?php echo $this->Form->Input('DisplayName', array('attributes' => array('class' => 'form-control')));?>
        </div>
        <div class="form-group">
            <label>Username</label>
            <?php echo $this->Form->Input('Username', array('attributes' => array('class' => 'form-control')));?>
        </div>
        <div class="form-group">
            <label>Password</label>
            <?php echo $this->Form->Password('Password', array('attributes' => array('class' => 'form-control')));?>
        </div>
        <?php echo $this->Form->Submit('Create', array('attributes' => array('class' => 'btn btn-md btn-default')));?>
        <?php echo $this->Form->End();?>
    </div>
</div>
