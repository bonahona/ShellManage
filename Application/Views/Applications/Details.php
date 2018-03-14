<h1>Application Details</h1>

<div class="row">
    <div class="col-lg-4">
        <dl>
            <dt>Application Name</dt>
            <dd><?php echo $Application['ShellApplication']['Name'];?></dd>
            <dt>Is inactive</dt>
            <dd>
                <?php if($Application['ShellApplication']['IsActive'] == 0):?>
                    <span>Yes</span>
                <?php else:?>
                    <span>No</span>
                <?php endif;?>
            </dd>
            <dt>RSA Public Key</dt>
            <dd>
                <?php if(empty($Application['ShellApplication']['RsaPublicKey'])):?>
                    <span class="light-grey">Empty</span>
                <?php else:?>
                    <?php echo $Application['ShellApplication']['RsaPublicKey'];?>
                <?php endif;?>
            </dd>
        </dl>
    </div>
</div>

<h2>Global menu</h2>
<div class="row">
    <div class="col-lg-4">
        <dl>
            <dt>Show in menu</dt>
            <dd>
                <?php if($Application['ShellApplication']['ShowInMenu'] == 1):?>
                    <span>Yes</span>
                <?php else:?>
                    <span>No</span>
                <?php endif;?>
            </dd>
            <dt>Name</dt>
            <dd><?php echo $Application['ShellApplication']['MenuName'];?></dd>
            <dt>Url</dt>
            <dd><?php echo $Application['ShellApplication']['Url'];?></dd>
        </dl>
    </div>
</div>

<div class="row">
    <div class="col-lg-4">
        <a href="<?php echo "/Applications/Edit/" . $Application['ShellApplication']['Id'];?>" class="btn btn-md btn-default ">
            <span class="glyphicon glyphicon-pencil"></span>
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-2">
        <a href="/Applications/">Back</a>
    </div>
</div>