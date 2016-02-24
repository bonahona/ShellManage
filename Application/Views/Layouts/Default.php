<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width">
        <title><?php echo $title;?></title>
        <?php echo $this->Html->Css('Default.css');?>
    </head>
    <body>
        <div id="page">
            <div id="content">
                <?php echo $view;?>
            </div>
        </div>
        <?php echo $this->Html->Js('jquery-2.2.0.min.js');?>
        <?php echo $this->Html->Js('jquery.tablesorter.min.js');?>
        <?php echo $this->Html->Js('Default.js');?>
    </body>
</html>
