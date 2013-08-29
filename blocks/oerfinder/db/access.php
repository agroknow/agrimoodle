<?php
/**
 * Block OER Finder.
 *
 * @package   block_oerfinder
 * @developer Tasos Koutoumanos <anastasios.koutoumanos@gmail.com>
 * @copyright 2012, 2013 AgroKnow Technologies
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$capabilities = array(
    
    // 'block/oerfinder:myaddinstance' => array(
    //     'captype' => 'write',
    //     'contextlevel' => CONTEXT_SYSTEM,
    //     'archetypes' => array(
    //         'user' => CAP_ALLOW
    //     ),

    //     'clonepermissionsfrom' => 'moodle/my:manageblocks'
    // ),

    'block/oerfinder:addinstance' => array(
        'riskbitmask' => RISK_SPAM | RISK_XSS,

        'captype' => 'write',
        'contextlevel' => CONTEXT_BLOCK,
        'archetypes' => array(
            'editingteacher' => CAP_ALLOW,
            'manager' => CAP_ALLOW
        ),

        'clonepermissionsfrom' => 'moodle/site:manageblocks'
    ),
);