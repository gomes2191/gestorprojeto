<?php

/**
 * Translate - Efetua as tradução do sistema
 *
 * Manipula os dados de usuários, faz login e logout, verifica permissões e
 * redireciona página para usuários logados.
 *
 * @package OdontoVision
 * @since 0.1
 */

class Translate
{
    static $_languageDefault = LANG; //--> Idioma padrão para a tradução
    static $_pathFileTranslate ='translate/'; //--> path onde ficarão os arquivos com as traduções

    public static function getLanguageDefault()
    {
        return self::$_languageDefault;

    }

    public static function setLanguageDefault($language)
    {
        self::$_languageDefault = $language;
    }

    public static function getPathFileTranslate()
    {
        return self::$_pathFileTranslate;
    }

    public static function setPathFileTranslate($path)
    {
        self::$_pathFileTranslate = $path;
    }

    public static function t($str, $languageDefault = NULL)
    {
        if($languageDefault === NULL)
        {
            $languageDefault = self::getLanguageDefault();
        }

        if(!file_exists(self::getPathFileTranslate().$languageDefault.'.php'))
        {
            return $str;

        }

        $traducao = require self::getPathFileTranslate().$languageDefault.'.php';

        if(isset($traducao[$str]))
        {
            return $traducao[$str];
        }
        else
        {
            return $str;
        }


    }



}
