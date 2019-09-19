<?php
/**
 * DokuWiki Plugin star (Action Component)
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author  monyer <monyer@126.com>
 */

// must be run within Dokuwiki
if(!defined('DOKU_INC')) die();

class action_plugin_star extends DokuWiki_Action_Plugin {

    public function register(Doku_Event_Handler $controller) {
       $controller->register_hook('TOOLBAR_DEFINE', 'AFTER', $this, 'handle_toolbar_define',array());
    }

    public function handle_toolbar_define(Doku_Event &$event, $param) {
	$event->data[] = array (
		'type' => 'format',
		'title' => 'Make Stars',
		'icon' => '../../plugins/star/images/toolbar.png',
		'open' => '<star 50>',
		'close' => '</star>',
        );
    }

}

// vim:ts=4:sw=4:et:
