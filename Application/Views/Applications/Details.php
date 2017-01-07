<h1>Application Details</h1>

<div class="row">
    <div class="col-lg-4">
        <dl>
            <dt>Application Name</dt>
            <dd><?php echo $Application['ApplicationName'];?></dd>
            <dt>Is inactive</dt>
            <dd>
                <?php if($Application['IsInactive']):?>
                    <span>Yes</span>
                <?php else:?>
                    <span>No</span>
                <?php endif;?>
            </dd>
            <dt>RSA Public Key</dt>
            <dd>
                <?php if(empty($Application['RsaPublicKey'])):?>
                    <span class="light-grey">Empty</span>
                <?php else:?>
                    <?php echo $Application['RsaPublicKey'];?></dd>
                <?php endif;?>
        </dl>
    </div>
</div>

<div class="row">
    <div class="col-lg-2">
        <a href="/Applications/">Back</a>
    </div>
</div>