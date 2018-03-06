<h1>Create application</h1>

<div class="row">
    <div class="col-lg-4">
        <?php echo $this->Form->Start('ShellApplication');?>
        <div class="form-group">
            <label>Applicatiom Name</label>
            <?php echo $this->Form->Input('Name', array('attributes' => array('class' => 'form-control')));?>
        </div>
        <div class="form-group">
            <label>Default user Level</label>
            <?php echo $this->Form->Input('DefaultUserLevel', array('attributes' => array('class' => 'form-control')));?>
        </div>
        <div class="form-group">
            <label>Public key</label>
            <?php echo $this->Form->Input('RsaPublicKey', array('attributes' => array('class' => 'form-control')));?>
        </div>
        <div class="form-group">
            <label>Private key</label>
            <?php echo $this->Form->Input('RsaPrivateKey', array('attributes' => array('class' => 'form-control')));?>
        </div>
        <div class="clear"></div>
        <div>
            <label>Is inactive</label>
            <?php echo $this->Form->Bool('IsActive', array('value' => 1));?>
        </div>
        <?php echo $this->Form->Submit('Create', array('attributes' => array('class' => 'btn btn-md btn-default')));?>
        <?php echo $this->Form->End();?>
    </div>
</div>

<div class="row">
    <div class="col-lg-4">
        <?php echo $this->Html->Link('/Applications/', 'Back');?>
    </div>
</div>