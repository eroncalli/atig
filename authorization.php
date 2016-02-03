<?php

require_once 'phpgen_settings.php';
require_once 'components/security/security_info.php';
require_once 'components/security/datasource_security_info.php';
require_once 'components/security/tablebased_auth.php';
require_once 'components/security/user_grants_manager.php';
require_once 'components/security/table_based_user_grants_manager.php';

include_once 'components/security/user_identity_storage/user_identity_session_storage.php';

require_once 'database_engine/mysql_engine.php';

$grants = array();

$appGrants = array();

$dataSourceRecordPermissions = array();

$tableCaptions = array('clienti' => 'Clienti',
'articoli' => 'Articoli',
'famiglie' => 'Famiglie',
'famiglie.articoli' => 'Famiglie.Articoli',
'offerte' => 'Offerte',
'offerte_dettaglio_costi' => 'Offerte Dettaglio Costi',
'offerte_dettaglio_articoli' => 'Offerte Dettaglio Articoli',
'listino_voci' => 'Listino Voci',
'listino_articoli' => 'Listino Articoli',
'voci_costo' => 'Voci Costo',
'formule_calcolo' => 'Formule Calcolo',
'listini' => 'Listini',
'listini.listino_articoli' => 'Listini.Articoli',
'listini.clienti' => 'Listini.Clienti',
'atig_users' => 'Atig Users',
'tipo_lavorazioni' => 'Tipo Lavorazioni',
'spese_aggiuntive' => 'Spese Aggiuntive',
'scontistica_clienti' => 'Scontistica Clienti',
'atig_user_perms' => 'Atig User Perms',
'elenco_articoli_view' => 'Elenco Articoli View');

function CreateTableBasedGrantsManager()
{
    global $tableCaptions;
    $usersTable = array('TableName' => 'atig_users', 'UserName' => 'user_name', 'UserId' => 'user_id', 'Password' => 'user_password');
    $userPermsTable = array('TableName' => 'atig_user_perms', 'UserId' => 'user_id', 'PageName' => 'page_name', 'Grant' => 'perm_name');

    $passwordHasher = HashUtils::CreateHasher('MD5');
    $connectionOptions = GetGlobalConnectionOptions();
    $tableBasedGrantsManager = new TableBasedUserGrantsManager(new MyPDOConnectionFactory(), $connectionOptions,
        $usersTable, $userPermsTable, $tableCaptions, $passwordHasher, false);
    return $tableBasedGrantsManager;
}

function SetUpUserAuthorization()
{
    global $grants;
    global $appGrants;
    global $dataSourceRecordPermissions;
    $hardCodedGrantsManager = new HardCodedUserGrantsManager($grants, $appGrants);
    $tableBasedGrantsManager = CreateTableBasedGrantsManager();
    $grantsManager = new CompositeGrantsManager();
    $grantsManager->AddGrantsManager($hardCodedGrantsManager);
    if (!is_null($tableBasedGrantsManager)) {
        $grantsManager->AddGrantsManager($tableBasedGrantsManager);
        GetApplication()->SetUserManager($tableBasedGrantsManager);
    }
    $userAuthorizationStrategy = new TableBasedUserAuthorization(new UserIdentitySessionStorage(GetIdentityCheckStrategy()), new MyPDOConnectionFactory(), GetGlobalConnectionOptions(), 'atig_users', 'user_name', 'user_id', $grantsManager);
    GetApplication()->SetUserAuthorizationStrategy($userAuthorizationStrategy);

    GetApplication()->SetDataSourceRecordPermissionRetrieveStrategy(
        new HardCodedDataSourceRecordPermissionRetrieveStrategy($dataSourceRecordPermissions));
}

function GetIdentityCheckStrategy()
{
    return new TableBasedIdentityCheckStrategy(new MyPDOConnectionFactory(), GetGlobalConnectionOptions(), 'atig_users', 'user_name', 'user_password', 'MD5');
}

function CanUserChangeOwnPassword()
{
    return true;
}

?>