<?php
/**
 Admin Page Framework v3.5.6 by Michael Uno
 Generated by PHP Class Files Script Generator <https://github.com/michaeluno/PHP-Class-Files-Script-Generator>
 <http://en.michaeluno.jp/admin-page-framework>
 Copyright (c) 2013-2015, Michael Uno; Licensed under MIT <http://opensource.org/licenses/MIT>
 */
abstract class Fcache_AdminPageFramework_Utility extends Fcache_AdminPageFramework_Utility_SystemInformation {
    static public function sanitizeLength($sLength, $sUnit = 'px') {
        return is_numeric($sLength) ? $sLength . $sUnit : $sLength;
    }
    static public function getQueryValueInURLByKey($sURL, $sQueryKey) {
        $aURL = parse_url($sURL) + array('query' => '');
        parse_str($aURL['query'], $aQuery);
        return self::getElement($aQuery, $sQueryKey, null);
    }
    static public function generateInlineCSS(array $aCSSRules) {
        $_aOutput = array();
        foreach ($aCSSRules as $_sProperty => $_sValue) {
            $_aOutput[] = $_sProperty . ': ' . $_sValue;
        }
        return implode('; ', $_aOutput);
    }
    static public function generateStyleAttribute($asInlineCSSes) {
        $_aCSSRules = array();
        foreach (array_reverse(func_get_args()) as $_asCSSRules) {
            if (is_array($_asCSSRules)) {
                $_aCSSRules = array_merge($_asCSSRules, $_aCSSRules);
                continue;
            }
            $__aCSSRules = explode(';', $_asCSSRules);
            foreach ($__aCSSRules as $_sPair) {
                $_aCSSPair = explode(':', $_sPair);
                if (!isset($_aCSSPair[0], $_aCSSPair[1])) {
                    continue;
                }
                $_aCSSRules[$_aCSSPair[0]] = $_aCSSPair[1];
            }
        }
        return self::generateInlineCSS(array_unique($_aCSSRules));
    }
    static public function generateClassAttribute() {
        $_aClasses = array();
        foreach (func_get_args() as $_asClasses) {
            if (!in_array(gettype($_asClasses), array('array', 'string'))) {
                continue;
            }
            $_aClasses = array_merge($_aClasses, is_array($_asClasses) ? $_asClasses : explode(' ', $_asClasses));
        }
        $_aClasses = array_unique($_aClasses);
        return trim(implode(' ', $_aClasses));
    }
    static public function getDataAttributeArray(array $aArray) {
        $_aNewArray = array();
        foreach ($aArray as $sKey => $v) {
            if (in_array(gettype($v), array('array', 'object'))) {
                continue;
            }
            $_aNewArray["data-{$sKey}"] = $v ? $v : '0';
        }
        return $_aNewArray;
    }
    static public function getAOrB($mValue, $mTrue = null, $mFalse = null) {
        return $mValue ? $mTrue : $mFalse;
    }
    static public function isNumericInteger($mValue) {
        return is_numeric($mValue) && is_int($mValue + 0);
    }
}