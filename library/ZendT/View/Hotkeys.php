<?php

/**
 * This class make jquery hotkeys 
 * @author KSANTOJA
 */
class ZendT_View_Hotkeys implements ZendT_JS_Interface {

    protected $_dictionary = array(
        'backspace' => '8',
        'tab' => '9',
        'enter' => '13',
        'shift' => '16',
        'ctrl' => '17',
        'alt' => '18',
        'pause/break' => '19',
        'caps lock' => '20',
        'escape' => '27',
        'page up' => '33',
        'page down' => '34',
        'end' => '35',
        'home' => '36',
        'left arrow' => '37',
        'up arrow' => '38',
        'right arrow' => '39',
        'down arrow' => '40',
        'insert' => '45',
        '0' => '48',
        '1' => '49',
        'delete' => '46',
        '2' => '50',
        '3' => '51',
        '4' => '52',
        '5' => '53',
        '6' => '54',
        '7' => '55',
        '8' => '56',
        '9' => '57',
        'a' => '65',
        'b' => '66',
        'c' => '67',
        'd' => '68',
        'e' => '69',
        'f' => '70',
        'g' => '71',
        'h' => '72',
        'i' => '73',
        'j' => '74',
        'k' => '75',
        'l' => '76',
        'm' => '77',
        'n' => '78',
        'o' => '79',
        'p' => '80',
        'q' => '81',
        'r' => '82',
        's' => '83',
        't' => '84',
        'u' => '85',
        'v' => '86',
        'w' => '87',
        'x' => '88',
        'y' => '89',
        'z' => '90',
        'left window key' => '91',
        'right window key' => '92',
        'select key' => '93',
        'numpad 0' => '96',
        'numpad 1' => '97',
        'numpad 2' => '98',
        'numpad 3' => '99',
        'numpad 4' => '100',
        'numpad 5' => '101',
        'numpad 6' => '102',
        'numpad 7' => '103',
        'numpad 8' => '104',
        'numpad 9' => '105',
        'multiply' => '106',
        'add' => '107',
        'subtract' => '109',
        'decimal point' => '110',
        'divide' => '111',
        'f1' => '112',
        'f2' => '113',
        'f3' => '114',
        'f4' => '115',
        'f5' => '116',
        'f6' => '117',
        'f7' => '118',
        'f8' => '119',
        'f9' => '120',
        'f10' => '121',
        'f11' => '122',
        'f12' => '123',
        'num lock' => '144',
        'scroll lock' => '145',
        'semi-colon' => '186',
        'equal sign' => '187',
        'comma' => '188',
        'dash' => '189',
        'period' => '190',
        'forward slash' => '191',
        'grave accent' => '192',
        'open bracket' => '219',
        'back slash' => '220',
        'close braket' => '221',
        'single quote' => '222'
    );
    protected $_dictionaryW = array(
        'backspace' => '8',
        'enter' => '13',
        '0' => '48',
        '1' => '49',
        '2' => '50',
        '3' => '51',
        '4' => '52',
        '5' => '53',
        '6' => '54',
        '7' => '55',
        '8' => '56',
        '9' => '57',
        'a' => '97',
        'b' => '98',
        'c' => '99',
        'd' => '100',
        'e' => '101',
        'f' => '102',
        'g' => '103',
        'h' => '104',
        'i' => '105',
        'j' => '106',
        'k' => '107',
        'l' => '108',
        'm' => '109',
        'n' => '110',
        'o' => '111',
        'p' => '112',
        'q' => '113',
        'r' => '114',
        's' => '115',
        't' => '116',
        'u' => '117',
        'v' => '118',
        'w' => '119',
        'x' => '120',
        'y' => '121',
        'z' => '122',
        'numpad 0' => '48',
        'numpad 1' => '49',
        'numpad 2' => '50',
        'numpad 3' => '51',
        'numpad 4' => '52',
        'numpad 5' => '53',
        'numpad 6' => '54',
        'numpad 7' => '55',
        'numpad 8' => '56',
        'numpad 9' => '57',
        'multiply' => '42',
        'add' => '43',
        'subtract' => '45',
        'decimal point' => '46',
        'divide' => '47',
        'semi-colon' => '59',
        'equal sign' => '61',
        'comma' => '44',
        'dash' => '45',
        'period' => '46',
        'forward slash' => '47',
        'grave accent' => '180',
        'open bracket' => '91',
        'back slash' => '92',
        'close braket' => '93',
        'single quote' => '39'
    );

    /**
     * Keep the hotkeys
     */
    protected $_hotkeys = array();

    /**
     * Add a hotkey to a array.
     * 
     * 
     * @param string $name
     * @param string $keys
     * @param string $action
     * @return \ZendT_Hotkeys 
     */
    public function addHotkey($name, $keys, $action) {
        $this->_hotkeys[$name]['key'] = $keys;
        $this->_hotkeys[$name]['action'] = $action;
        return $this;
    }

    public function createJS() {
        $js = '';
        $js2 = '';
        $script = ' if({{condition}}){' . "\n";
        $script.= 'e.preventDefault();' . "\n";
        $script.= 'e.stopPropagation();' . "\n";
        $script.= '{{action}}';
        $script.= 'return false;' . "\n";
        $script.= '} ';
        $specialKeys = array('ctrlON','altON','shiftON');
        if (count($this->_hotkeys) > 0) {
            foreach ($this->_hotkeys as $values) {
                $arrKey = explode('+', $values['key']);
                $hotkeys = array();
                $hotkeys2 = array();
                foreach ($arrKey as $key) {
                    $hkey = $this->_getKey($key);
                    if(in_array($hkey,$specialKeys)){
                        $hotkeys2[] = $hkey;
                    }else{
                        $hotkeys2[] = $this->_getKey($key, 'w');
                    }
                    $hotkeys[] = $hkey;
                    
                }
                $js.= str_replace('{{action}}', $values['action'], $script);
                $js = str_replace('{{condition}}',implode(' && ', $hotkeys),$js);
                $js2.= str_replace('{{action}}', '', $script);
                $js2 = str_replace('{{condition}}',implode(' && ', $hotkeys2),$js2);
            }
            $js = '<script type="text/javascript">' . "\n" .
                    '$(document).ready(function(){' . "\n" .
                    'var ctrlON = false;' . "\n" .
                    'var altON = false;' . "\n" .
                    'var shiftON = false;' . "\n" .
                    '$(document).keydown(function(e){' . "\n" .
                    'if(e.which == 17){' . "\n" .
                    'ctrlON = true;' . "\n" .
                    '}' . "\n" .
                    'if(e.which == 18){' . "\n" .
                    'altON = true;' . "\n" .
                    '}' . "\n" .
                    'if(e.which == 16){' . "\n" .
                    'shiftON = true;' . "\n" .
                    '}' . "\n" .
                    $js . "\n" .
                    '});' . "\n" .
                    '$(document).keyup(function(e){' . "\n" .
                    'if(e.which == 17){' . "\n" .
                    'ctrlON = false;' . "\n" .
                    '}' . "\n" .
                    'if(e.which == 18){' . "\n" .
                    'altON = false;' . "\n" .
                    '}' . "\n" .
                    'if(e.which == 16){' . "\n" .
                    'shiftON = false;' . "\n" .
                    '}' . "\n" .
                    '})' . "\n" .
                    '$(document).keypress(function(e){' . "\n" .
                    $js2 .
                    '});' .
                    '});' . "\n" .
                    '</script>';
        }
        return $js;
    }

    private function _getKey($value, $type = 'n') {
        if($type=='w'){
            $value = $this->_searchDictonary($value, $type);
            if($value != ''){
                $value = 'e.which == ' . $value;
            }
        }else if ($this->_searchDictonary($value) == '17') {
            $value = 'ctrlON';
        } else if ($this->_searchDictonary($value) == '18') {
            $value = 'altON';
        } else if ($this->_searchDictonary($value) == '16') {
            $value = 'shiftON';
        }else{
            $value = 'e.which == '.$this->_searchDictonary($value);
        }
        return $value;
    }

    private function _searchDictonary($key, $type = 'n') {
        if ($type != 'w') {
            $value = $this->_dictionary[strtolower(trim($key))];
        } else {
            $value = $this->_dictionaryW[strtolower(trim($key))];
        }
        return $value;
    }

    public function getAllDictionary() {
        return $this->_dictionary;
    }

    public function getFromDictionary($key) {
        return $this->_dictionary[$key];
    }

    public function replaceAllDictionary(array $values) {
        $this->_dictionary = $values;
        return $this;
    }

    public function replaceDictionary($key, $keycode) {
        $this->_dictionary[$key] = $keycode;
        return $this;
    }

    public function render() {
        return $this->createJS();
    }

}