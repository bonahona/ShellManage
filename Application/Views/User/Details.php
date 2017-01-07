<h1>User details</h1>

<div class="row">
    <div class="col-lg-4">
        <dl>
            <dt>Usermame</dt>
            <dd><?php echo $User['Username'];?></dd>
            <dt>Displayname</dt>
            <dd><?php echo $User['DisplayName'];?></dd>
        </dl>
    </div>
</div>
<div class="row">
    <div class="col-lg-3">
        <div class="row">
            <div class="col-lg-5">
                <a href="<?php echo "/User/ResetPassword/" . $User['Id'];?>" class="btn btn-default"><span class="glyphicon glyphicon-repeat"></span>Reset password</a>
            </div>
            <div class="col-lg-2">
                <a href="<?php echo "/User/Edit/" . $User['Id'];?>" class="btn btn-md btn-default"><span class="glyphicon glyphicon-edit"></span></a>
            </div>
            <div class="col-lg-2">
                <a href="<?php echo "/User/Delete/" . $User['Id'];?>" class="btn btn-md btn-default"><span class="glyphicon glyphicon-trash"></span></a>
            </div>
        </div>
    </div>
</div>

<h2>Privileges</h2>

<div class="row">
    <div class="col-lg-6">
        <table class="table table-responsive">
            <thead>
            <tr>
                <th class="col-lg-5">Application</th>
                <th class="col-lg-5">Userlevel</th>
                <th class="col-lg-2">&nbsp;</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach($User['ShellUserPrivileges'] as $privilege):?>
                    <tr>
                        <td><?php echo $privilege['ShellApplication']['ApplicationName'];?></td>
                        <td><?php echo $privilege['UserLevel'];?></td>
                        <td>
                            <?php if($privilege == 0):?>
                                <a href="<?php echo "/User/GrantAccess/" . $privilege['ShellUserId'] . "/" . $privilege['ShellApplicationId'];?>" class="btn btn-md btn-default"><span class="glyphicon glyphicon-chevron-up"></span></a>
                            <?php else:?>
                                <a href="<?php echo "/User/GrantAccess/" . $privilege['ShellUserId'] . "/" . $privilege['ShellApplicationId'];?>" class="btn btn-md btn-default"><span class="glyphicon glyphicon-chevron-down"></span></a>
                            <?php endif;?>
                        </td>
                    </tr>
                <?php endforeach;;?>
            </tbody>
        </table>
    </div>
</div>

<div class="row">
    <div class="collg-2">
        <?php echo $this->Html->Link('/User/', 'Back');?>
    </div>
</div>