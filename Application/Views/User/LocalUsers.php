<h1>Local users</h1>
<div class="row">
    <div class="col-lg-2">
        <a href="/User/Create/" class="btn btn-md- btn-primary">Create new</a>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th class="col-lg-4">Name</th>
                    <th class="col-lg-4">Username</th>
                    <th class="col-lg-3">User level</th>
                    <th class="col-lg-1">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($LocalUsers['ShellApplication']['Privileges'] as $privilege):?>
                    <tr>
                        <td>
                            <?php echo $privilege['ShellUser']['DisplayName'];?>
                        </td>
                        <td>
                            <a href="<?php echo "/User/Details/" . $privilege['ShellUser']['Id'];?>">
                                <?php echo $privilege['ShellUser']['Username'];?>
                            </a>
                        </td>
                        <td><?php echo $privilege['UserLevel'];?></td>
                        <td>
                            <?php if($privilege['UserLevel'] == 0):?>
                                <a href="<?php echo "/User/GrantAccess/" . $privilege['Id'] . "?ref=" . $this->RequestString;?>" class="btn btn-sm btn-default">
                                    <span class="glyphicon glyphicon-ok"></span>
                                </a>
                            <?php else:?>
                                <a href="<?php echo "/User/RevokeAccess/" . $privilege['Id'] . "?ref=" . $this->RequestString;?>" class="btn btn-sm btn-default">
                                    <span class="glyphicon glyphicon-remove"></span>
                                </a>
                            <?php endif;?>
                        </td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>

<div class="row">
    <div class="col-lg-2">
        <?php echo $this->Html->Link('/', 'Back');?>
    </div>
</div>