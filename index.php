<?php
/**
 * This file instantiates the Event manager interface.
 *
 * PHP version 5
 *
 * @category  Events
 * @package   UNL_UCBCN_Manager
 * @author    Brett Bieber <brett.bieber@gmail.com>
 * @copyright 2009 Regents of the University of Nebraska
 * @license   http://www1.unl.edu/wdn/wiki/Software_License BSD License
 * @link      http://code.google.com/p/unl-event-publisher/
 */
ini_set('display_errors', false);
require_once 'UNL/UCBCN/Autoload.php';
require_once 'Auth.php';
$GLOBALS['unl_template_dependents'] = $_SERVER['DOCUMENT_ROOT'].'/ucomm/templatedependents';

$a = new Auth('DB',array('dsn'=>'mysql://eventcal:eventcal@localhost/eventcal'),null,false);

$frontend = new UNL_UCBCN_Manager(array('template'=>'default',
                                        'dsn'=>'mysql://eventcal:eventcal@localhost/eventcal',
                                        'default_calendar_id'=>1,
                                        'a'=>$a,
                                        'frontenduri'=>'../'));
$frontend->run();
UNL_UCBCN::displayRegion($frontend);

?>