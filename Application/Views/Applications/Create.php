<h1>Create application</h1>

<?php echo $this->Form->Start('ShellApplication');?>
<div class="row">
    <div class="col-lg-4">
        <h2>General</h2>
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
        <div class="clear"></div>
        <div>
            <label>Is inactive</label>
            <?php echo $this->Form->Bool('IsActive');?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-4">
        <h2>Global menu</h2>
        <div>
            <label>Show in menu</label>
            <?php echo $this->Form->Bool('ShowInMenu');?>
        </div>
        <div class="form-group">
            <label>Menu name</label>
            <?php echo $this->Form->Input('MenuName', array('attributes' => array('class' => 'form-control')));?>
        </div>
        <div class="form-group">
            <label>Url</label>
            <?php echo $this->Form->Input('Url', array('attributes' => array('class' => 'form-control')));?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-4">
        <?php echo $this->Form->Submit('Save', array('attributes' => array('class' => 'btn btn-md btn-default')));?>
    </div>
</div>

<?php echo $this->Form->End();?>

<div class="row">
    <div class="col-lg-4">
        <?php echo $this->Html->Link('/Applications/', 'Back');?>
    </div>
</div>