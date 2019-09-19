<?php
/**
 * DokuWiki Plugin star (Syntax Component)
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author  monyer <monyer@126.com>
 */

// must be run within Dokuwiki
if (!defined('DOKU_INC')) die();

class syntax_plugin_star extends DokuWiki_Syntax_Plugin {

    public function getType() {
        return 'formatting';
    }

    public function getSort() {
        return 158;
    }

    public function getAllowedTypes() { 
        return array('disabled');
    }

    public function connectTo($mode) {
        $this->Lexer->addEntryPattern('<star[^>]*>(?=.*?</star>)',$mode,'plugin_star');
    }

    public function postConnect() {
        $this->Lexer->addExitPattern('</star>','plugin_star');
    }

    public function handle($match, $state, $pos, Doku_Handler $handler){
        switch($state){
	    case DOKU_LEXER_ENTER :
		    $match = substr($match, 5, -1);
		    $match = empty($match) ? '00' : $match;
            $class = "bigstar".intval(trim($match));
            return array($state, array($class));
        case DOKU_LEXER_UNMATCHED :  
            return array($state, $match);
        case DOKU_LEXER_EXIT :       
            return array($state, '');
	    }
        return array();
    }

    public function render($mode, Doku_Renderer $renderer, $data) {
	    if($mode == 'xhtml'){
            list($state, $match) = $data;
            switch ($state) {
                case DOKU_LEXER_ENTER :      
                    list($class) = $match;
                    $renderer->doc .= "<span class='$class'>"; 
                    break;
                case DOKU_LEXER_EXIT :       
                    $renderer->doc .= "</span>"; 
                    break;
            }
            return true;
        }
        return false;
    }
}

// vim:ts=4:sw=4:et:
