<h1>Applications</h1>

<div class="row">
    <a href="/Applications/Create" class="btn btn-md btn-primary">Create new</a>
</div>

<div class="row">
    <div class="col-lg-6">
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th class="col-lg-4">Name</th>
                    <th class="col-lg-6">Default user level</th>
                    <th class="col-lg-1">&nbsp;</th>
                    <th class="col-lg-1">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($Applications as $application):?>
                    <tr>
                        <td><a href="<?php echo "/Applications/Details/" . $application['Id'];?>"><?php echo $application['ApplicationName'];?></a></td>
                        <td><?php echo $application['DefaultUserLevel'];?></td>
                        <td><a href="<?php echo "/Applications/Edit/" . $application['Id'];?>" class="btn btn-md btn-default"><span class="glyphicon glyphicon-edit"></span></a></td>
                        <td><a href="<?php echo "/Applications/Delete/" . $application['Id'];?>" class="btn btn-md btn-default"><span class="glyphicon glyphicon-trash"></span></a></td>
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