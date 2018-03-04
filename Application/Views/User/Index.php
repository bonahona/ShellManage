<h1>Users</h1>

<div class="row">
    <div class="col-lg-2">
        <a href="/User/Create" class="btn btn-md btn-primary">Create new</a>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th class="col-lg-5">Display name</th>
                    <th class="col-lg-5">Username</th>
                    <th class="col-lg-1">&nbsp;</th>
                    <th class="col-lg-1">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($Users['ShellUsers'] as $user):?>
                    <tr>
                        <td><a href="<?php echo "/User/Details/" . $user['Id'];?>"><?php echo $user['DisplayName'];?></a></td>
                        <td><?php echo $user['Username'];?></td>
                        <td><a href="<?php echo "/User/Edit/" . $user['Id'];?>" class="btn btn-sm- btn-default"><span class="glyphicon glyphicon-edit"></span></td>
                        <td><a href="<?php echo "/User/Delete/" . $user['Id'];?>" class="btn btn-sm- btn-default"><span class="glyphicon glyphicon-trash"></span></td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>

<div class="row">
    <div class="col-lg-2">
        <a href="/User/Create/" class="btn btn-md- btn-primary">Create</a>
    </div>
</div>
