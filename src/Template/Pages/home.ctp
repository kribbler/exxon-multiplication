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
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;

$this->layout = false;

$cakeDescription = 'Math for Bogdan - Multiplication';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    
    <?php echo $this->Html->css('all.css'); ?>
    <script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
    <?php echo $this->Html->script('all'); ?>
    <script type="text/javascript">var myBaseUrl = '<?php echo $this->Html->url; ?>';</script>

    <link href="https://fonts.googleapis.com/css?family=Raleway:500i|Roboto:300,400,700|Roboto+Mono" rel="stylesheet">
</head>

<body class="home">
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <br />
            <h1>Practice your math</h1>
            <hr />
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="consola">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12">
                                        <span id="show_number_1"></span><br />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <span id="show_sign"></span>
                                        <span id="show_number_2"></span><br />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="wow" />
                        <input class="my_result" type="number" value="" id="result" name="result" />
                        <hr class="wow" />
                        
                            <button id="check" class="btn btn-md btn-primary pull-left">Check</button>
                            <button id="again" class="btn btn-md btn-primary pull-right">Again</button>
                        <br />
                        <h3 class="align-right">Bonus minutes: <span id="minutes"></span></h3>

                        <br />
                        <br />
                        <table id="exercises">
                            <thead><tr><th width='55%'>Date</th><th>Total</th><th>Correct</th></tr></thead>
                        </table>
                    </div>
                    <div class="col-md-2">
                        <div id="response"></div>
                    </div>
                    <div class="col-md-3">
                        <div class="my_table" id="results"></div>
                    </div>
                    <div class="col-md-2">
                        <div class="happy"></div>
                        <div class="sad"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
