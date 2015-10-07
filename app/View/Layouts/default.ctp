<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

?>
<!DOCTYPE html>
<html>
<head>
	<meta content="" name="keywords">
    <meta content="" name="description">
    <meta content="" name="copyright">
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <meta content="ja" http-equiv="Content-Language">
    <meta content="text/css" http-equiv="Content-Style-Type">
    <meta content="text/javascript" http-equiv="Content-Script-Type">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <meta content="width=device-width; initial-scale=1.0" name="viewport"> -->
	<title>
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
		echo $this->Html->css('common');
		echo $this->Html->script('jquery');
        echo $this->Html->script('jquery-1.11.2');
        // 
        echo $this->Html->css('bootstrap-multiselect');
        echo $this->Html->css('bootstrap-3.3.2.min');
        echo $this->Html->script('doc/jquery-2.1.3.min');
        echo $this->Html->script('doc/bootstrap-3.3.2.min');
        echo $this->Html->script('doc/prettify');
        echo $this->Html->script('common');
        echo $this->Html->script('dict/bootstrap-multiselect');
        // 
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
	<script>
		$(document).ready(function() {
		 	$('.flash-message-success').animate({opacity: 1.0}, 3000).slideUp("slow");
		  	$('.flash-message-error').animate({opacity: 1.0}, 3000).slideUp("slow");
		  	$('.flash-message-info').animate({opacity: 1.0}, 3000).slideUp("slow");
		  	$('.flash-message-warning').animate({opacity: 1.0}, 3000).slideUp("slow");
		});
	</script>
</head>
<body>
		<header class="header">
            <a href="/" class="logo">
                Multi-language
            </a>
            <nav class="navbar">
                <div class="logout-top">
                   <div class="pull-right">
                      <a href="<?php echo $this->Html->url(array('controller'=>'Users','action'=>'logout'));?>" class="btn btn-default">ログアウト</a>                    </div>
                </div>
            </nav>
        </header>
		<div id="wrapper">
				<?php echo $this->fetch('content'); ?>
		</div>
	<?php //echo $this->element('sql_dump'); ?>
</body>
</html>
