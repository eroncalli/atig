<?php

//  define('SHOW_VARIABLES', 1);
//  define('DEBUG_LEVEL', 1);

//  error_reporting(E_ALL ^ E_NOTICE);
//  ini_set('display_errors', 'On');

set_include_path('.' . PATH_SEPARATOR . get_include_path());


include_once dirname(__FILE__) . '/' . 'components/utils/system_utils.php';

//  SystemUtils::DisableMagicQuotesRuntime();

SystemUtils::SetTimeZoneIfNeed('Europe/Rome');

function GetGlobalConnectionOptions()
{
    return array(
  'server' => 'localhost',
  'port' => '3306',
  'username' => 'atig',
  'password' => '20152015',
  'database' => 'S01225_erikroncalli'
);
}

function HasAdminPage()
{
    return true;
}

function GetPageGroups()
{
    $result = array('Default');
    return $result;
}

function GetPageInfos()
{
    $result = array();
    $result[] = array('caption' => 'Clienti', 'short_caption' => 'Clienti', 'filename' => 'clienti.php', 'name' => 'clienti', 'group_name' => 'Default', 'add_separator' => false);
    $result[] = array('caption' => 'Articoli', 'short_caption' => 'Articoli', 'filename' => 'articoli.php', 'name' => 'articoli', 'group_name' => 'Default', 'add_separator' => false);
    $result[] = array('caption' => 'Famiglie', 'short_caption' => 'Famiglie', 'filename' => 'famiglie.php', 'name' => 'famiglie', 'group_name' => 'Default', 'add_separator' => false);
    $result[] = array('caption' => 'Listino Voci', 'short_caption' => 'Listino Voci', 'filename' => 'listino_voci.php', 'name' => 'listino_voci', 'group_name' => 'Default', 'add_separator' => false);
    $result[] = array('caption' => 'Listino Articoli', 'short_caption' => 'Listino Articoli', 'filename' => 'listino_articoli.php', 'name' => 'listino_articoli', 'group_name' => 'Default', 'add_separator' => false);
    $result[] = array('caption' => 'Voci Costo', 'short_caption' => 'Voci Costo', 'filename' => 'voci_costo.php', 'name' => 'voci_costo', 'group_name' => 'Default', 'add_separator' => false);
    $result[] = array('caption' => 'Formule Calcolo', 'short_caption' => 'Formule Calcolo', 'filename' => 'formule_calcolo.php', 'name' => 'formule_calcolo', 'group_name' => 'Default', 'add_separator' => false);
    $result[] = array('caption' => 'Listini', 'short_caption' => 'Listini', 'filename' => 'listini.php', 'name' => 'listini', 'group_name' => 'Default', 'add_separator' => false);
    $result[] = array('caption' => 'Scontistica Clienti', 'short_caption' => 'Scontistica Clienti', 'filename' => 'scontistica_clienti.php', 'name' => 'scontistica_clienti', 'group_name' => 'Default', 'add_separator' => false);
    return $result;
}

function GetPagesHeader()
{
    return
    '<h1>ATIG - Preventivi</h1>';
}

function GetPagesFooter()
{
    return
        '<a href="http://www.media-web.net">&copy; Media web</a> - Data rilascio 02/12/2015'; 
    }

function ApplyCommonPageSettings(Page $page, Grid $grid)
{
    $page->SetShowUserAuthBar(true);
    $page->OnCustomHTMLHeader->AddListener('Global_CustomHTMLHeaderHandler');
    $page->OnGetCustomTemplate->AddListener('Global_GetCustomTemplateHandler');
    $grid->BeforeUpdateRecord->AddListener('Global_BeforeUpdateHandler');
    $grid->BeforeDeleteRecord->AddListener('Global_BeforeDeleteHandler');
    $grid->BeforeInsertRecord->AddListener('Global_BeforeInsertHandler');
}

/*
  Default code page: 1252
*/
function GetAnsiEncoding() { return 'windows-1252'; }

function Global_CustomHTMLHeaderHandler($page, &$customHtmlHeaderText)
{

}

function Global_GetCustomTemplateHandler($part, $mode, &$result, &$params, Page $page = null)
{

}

function Global_BeforeUpdateHandler($page, &$rowData, &$cancel, &$message, $tableName)
{

}

function Global_BeforeDeleteHandler($page, &$rowData, &$cancel, &$message, $tableName)
{

}

function Global_BeforeInsertHandler($page, &$rowData, &$cancel, &$message, $tableName)
{

}

function GetDefaultDateFormat()
{
    return 'd-m-Y';
}

function GetFirstDayOfWeek()
{
    return 1;
}

function GetEnableLessFilesRunTimeCompilation()
{
    return false;
}



?>