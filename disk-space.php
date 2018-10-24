<?php
//credit to: http://www.thecave.info/display-disk-free-space-percentage-in-php/
//mostrar así: <iframe width="100%" height="200" src="http://formato7.com/disk-space.php"></iframe>
/* get disk space free (in bytes) */
$df = disk_free_space(__FILE__);
/* and get disk space total (in bytes)  */
$dt = disk_total_space(__FILE__);
/* now we calculate the disk space used (in bytes) */
$du = $dt - $df;
/* percentage of disk used - this will be used to also set the width % of the progress bar */
$dp = sprintf('%.2f', ($du / $dt) * 100);

/* and we formate the size from bytes to MB, GB, etc. */
$df = formatSize($df);
$du = formatSize($du);
$dt = formatSize($dt);

function formatSize($bytes)
{
    $types = array('B', 'KB', 'MB', 'GB', 'TB');
    for ($i = 0; $bytes >= 1024 && $i < (count($types) - 1); $bytes /= 1024, $i++);
    return (round($bytes, 2) . " " . $types[$i]);
}

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
        <style type='text/css'>
    .progress {
            border: 2px solid #5E96E4;
            height: 32px;
            width: 350px;
            margin: 30px auto;
    }
    .progress .prgbar {
            background: #A7C6FF;
            width: <?php echo $dp; ?>%;
            position: relative;
            height: 32px;
            z-index: 999;
    }
    .progress .prgtext {
            color: #286692;
            text-align: center;
            font-size: 13px;
            padding: 9px 0 0;
            width: 350px;
            position: absolute;
            z-index: 1000;
    }
    .progress .prginfo {
            margin: 3px 0;
    }

    .progress .prgbar-danger{background: red;}
    .progress .prgtext-danger {color: #FCFCFC;}

    </style>
    <title>Espacio en Disco</title>
  </head>
  <body>  
  <h1 style="text-align:center">Espacio en Disco</h1>
  <p style="text-align:center">Total: <?=$dt?></p>
        <div class='progress'>
            <div class='prgtext <?php if($dp>90)echo "prgtext-danger"?>'><?php echo $dp; ?>% Usado</div>
            <div class='prgbar <?php if($dp>90)echo "prgbar-danger"?>'></div>
            <div class='prginfo'>
                    <span style='float: left;'><?php echo "$du usado"; ?></span>
                    <span style='float: right;'><?php echo "$df libre"; ?></span>
                    <span style='clear: both;'></span>
            </div>
    </div>
  </body>
</html>
