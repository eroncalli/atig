<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *                                   ATTENTION!
 * If you see this message in your browser (Internet Explorer, Mozilla Firefox, Google Chrome, etc.)
 * this means that PHP is not properly installed on your web server. Please refer to the PHP manual
 * for more details: http://php.net/manual/install.php 
 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 */


    include_once dirname(__FILE__) . '/' . 'components/utils/check_utils.php';
    CheckPHPVersion();
    CheckTemplatesCacheFolderIsExistsAndWritable();


    include_once dirname(__FILE__) . '/' . 'phpgen_settings.php';
    include_once dirname(__FILE__) . '/' . 'database_engine/mysql_engine.php';
    include_once dirname(__FILE__) . '/' . 'components/page.php';
    include_once dirname(__FILE__) . '/' . 'authorization.php';

    function GetConnectionOptions()
    {
        $result = GetGlobalConnectionOptions();
        $result['client_encoding'] = 'utf8';
        GetApplication()->GetUserAuthorizationStrategy()->ApplyIdentityToConnectionOptions($result);
        return $result;
    }

    
    // OnGlobalBeforePageExecute event handler
    
    
    // OnBeforePageExecute event handler
    
    
    
    class scontistica_clientiPage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->dataset = new TableDataset(
                new MyPDOConnectionFactory(),
                GetConnectionOptions(),
                '`scontistica_clienti`');
            $field = new IntegerField('id', null, null, true);
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, true);
            $field = new StringField('sco-codcli');
            $this->dataset->AddField($field, false);
            $field = new StringField('sco-codart');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('sco-codvoc');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('sco-sconto');
            $this->dataset->AddField($field, false);
            $field = new DateTimeField('datains');
            $this->dataset->AddField($field, false);
            $field = new DateTimeField('datamod');
            $this->dataset->AddField($field, false);
            $this->dataset->AddLookupField('sco-codcli', 'clienti', new StringField('cli-codcli'), new StringField('cli-ragsoc', 'sco-codcli_cli-ragsoc', 'sco-codcli_cli-ragsoc_clienti'), 'sco-codcli_cli-ragsoc_clienti');
            $this->dataset->AddLookupField('sco-codart', 'elenco_articoli_view', new StringField('art-codart'), new StringField('descrizione', 'sco-codart_descrizione', 'sco-codart_descrizione_elenco_articoli_view'), 'sco-codart_descrizione_elenco_articoli_view');
            $this->dataset->AddLookupField('sco-codvoc', '(select `id`, concat(`voc-codvoce`, IF(`voc-descriz` <> \'\', concat(\' - \', `voc-descriz`),\'\')) as descvoce from voci_costo)', new IntegerField('id'), new StringField('descvoce', 'sco-codvoc_descvoce', 'sco-codvoc_descvoce_query_listino_voci'), 'sco-codvoc_descvoce_query_listino_voci');
        }
    
        protected function DoPrepare() {
    
        }
    
        protected function CreatePageNavigator()
        {
            return null;
        }
    
        public function GetPageList()
        {
            $currentPageCaption = $this->GetShortCaption();
            $result = new PageList($this);
            $result->AddGroup($this->RenderText('Default'));
            if (GetCurrentUserGrantForDataSource('clienti')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Clienti'), 'clienti.php', $this->RenderText('Clienti'), $currentPageCaption == $this->RenderText('Clienti'), false, $this->RenderText('Default')));
            if (GetCurrentUserGrantForDataSource('articoli')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Articoli'), 'articoli.php', $this->RenderText('Articoli'), $currentPageCaption == $this->RenderText('Articoli'), false, $this->RenderText('Default')));
            if (GetCurrentUserGrantForDataSource('famiglie')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Famiglie'), 'famiglie.php', $this->RenderText('Famiglie'), $currentPageCaption == $this->RenderText('Famiglie'), false, $this->RenderText('Default')));
            if (GetCurrentUserGrantForDataSource('offerte')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Offerte'), 'offerte.php', $this->RenderText('Offerte'), $currentPageCaption == $this->RenderText('Offerte'), false, $this->RenderText('Default')));
            if (GetCurrentUserGrantForDataSource('listino_voci')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Listino Voci'), 'listino_voci.php', $this->RenderText('Listino Voci'), $currentPageCaption == $this->RenderText('Listino Voci'), false, $this->RenderText('Default')));
            if (GetCurrentUserGrantForDataSource('listino_articoli')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Listino Articoli'), 'listino_articoli.php', $this->RenderText('Listino Articoli'), $currentPageCaption == $this->RenderText('Listino Articoli'), false, $this->RenderText('Default')));
            if (GetCurrentUserGrantForDataSource('voci_costo')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Voci Costo'), 'voci_costo.php', $this->RenderText('Voci Costo'), $currentPageCaption == $this->RenderText('Voci Costo'), false, $this->RenderText('Default')));
            if (GetCurrentUserGrantForDataSource('formule_calcolo')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Formule Calcolo'), 'formule_calcolo.php', $this->RenderText('Formule Calcolo'), $currentPageCaption == $this->RenderText('Formule Calcolo'), false, $this->RenderText('Default')));
            if (GetCurrentUserGrantForDataSource('listini')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Listini'), 'listini.php', $this->RenderText('Listini'), $currentPageCaption == $this->RenderText('Listini'), false, $this->RenderText('Default')));
            if (GetCurrentUserGrantForDataSource('scontistica_clienti')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Scontistica Clienti'), 'scontistica_clienti.php', $this->RenderText('Scontistica Clienti'), $currentPageCaption == $this->RenderText('Scontistica Clienti'), false, $this->RenderText('Default')));
            if (GetCurrentUserGrantForDataSource('query_listino_voci')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Query Listino Voci'), 'query_listino_voci.php', $this->RenderText('Query Listino Voci'), $currentPageCaption == $this->RenderText('Query Listino Voci'), false, $this->RenderText('Default')));
            
            if ( HasAdminPage() && GetApplication()->HasAdminGrantForCurrentUser() ) {
              $result->AddGroup('Admin area');
              $result->AddPage(new PageLink($this->GetLocalizerCaptions()->GetMessageString('AdminPage'), 'phpgen_admin.php', $this->GetLocalizerCaptions()->GetMessageString('AdminPage'), false, false, 'Admin area'));
            }
            return $result;
        }
    
        protected function CreateRssGenerator()
        {
            return null;
        }
    
        protected function CreateGridSearchControl(Grid $grid)
        {
            $grid->UseFilter = true;
            $grid->SearchControl = new SimpleSearch('scontistica_clientissearch', $this->dataset,
                array('sco-codcli_cli-ragsoc'),
                array($this->RenderText('Codice cliente')),
                array(
                    '=' => $this->GetLocalizerCaptions()->GetMessageString('equals'),
                    '<>' => $this->GetLocalizerCaptions()->GetMessageString('doesNotEquals'),
                    '<' => $this->GetLocalizerCaptions()->GetMessageString('isLessThan'),
                    '<=' => $this->GetLocalizerCaptions()->GetMessageString('isLessThanOrEqualsTo'),
                    '>' => $this->GetLocalizerCaptions()->GetMessageString('isGreaterThan'),
                    '>=' => $this->GetLocalizerCaptions()->GetMessageString('isGreaterThanOrEqualsTo'),
                    'ILIKE' => $this->GetLocalizerCaptions()->GetMessageString('Like'),
                    'STARTS' => $this->GetLocalizerCaptions()->GetMessageString('StartsWith'),
                    'ENDS' => $this->GetLocalizerCaptions()->GetMessageString('EndsWith'),
                    'CONTAINS' => $this->GetLocalizerCaptions()->GetMessageString('Contains')
                    ), $this->GetLocalizerCaptions(), $this, 'CONTAINS'
                );
        }
    
        protected function CreateGridAdvancedSearchControl(Grid $grid)
        {
            $this->AdvancedSearchControl = new AdvancedSearchControl('scontistica_clientiasearch', $this->dataset, $this->GetLocalizerCaptions(), $this->GetColumnVariableContainer(), $this->CreateLinkBuilder());
            $this->AdvancedSearchControl->setTimerInterval(1000);
            $lookupDataset = new TableDataset(
                new MyPDOConnectionFactory(),
                GetConnectionOptions(),
                '`clienti`');
            $field = new IntegerField('id', null, null, true);
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new StringField('cli-codcli');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('cli-ragsoc');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('cli-codlis');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('datains');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('datamod');
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('cli-ragsoc', GetOrderTypeAsSQL(otAscending));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateLookupSearchInput('sco-codcli', $this->RenderText('Codice cliente'), $lookupDataset, 'cli-codcli', 'cli-ragsoc', false, 8));
            
            $lookupDataset = new TableDataset(
                new MyPDOConnectionFactory(),
                GetConnectionOptions(),
                '`elenco_articoli_view`');
            $field = new StringField('art-codart');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('descrizione');
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('descrizione', GetOrderTypeAsSQL(otAscending));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateLookupSearchInput('sco-codart', $this->RenderText('Codice articolo'), $lookupDataset, 'art-codart', 'descrizione', false, 8));
            
            $selectQuery = 'select `id`, concat(`voc-codvoce`, IF(`voc-descriz` <> \'\', concat(\' - \', `voc-descriz`),\'\')) as descvoce from voci_costo';
            $insertQuery = array();
            $updateQuery = array();
            $deleteQuery = array();
            $lookupDataset = new QueryDataset(
              new MyPDOConnectionFactory(), 
              GetConnectionOptions(),
              $selectQuery, $insertQuery, $updateQuery, $deleteQuery, 'query_listino_voci');
            $field = new IntegerField('id');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new StringField('descvoce');
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('descvoce', GetOrderTypeAsSQL(otAscending));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateLookupSearchInput('sco-codvoc', $this->RenderText('Codice tipo voce'), $lookupDataset, 'id', 'descvoce', false, 8));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('sco-sconto', $this->RenderText('Sconto')));
        }
    
        protected function AddOperationsColumns(Grid $grid)
        {
            $actionsBandName = 'actions';
            $grid->AddBandToBegin($actionsBandName, $this->GetLocalizerCaptions()->GetMessageString('Actions'), true);
            if ($this->GetSecurityInfo()->HasViewGrant())
            {
                $column = new RowOperationByLinkColumn($this->GetLocalizerCaptions()->GetMessageString('View'), OPERATION_VIEW, $this->dataset);
                $grid->AddViewColumn($column, $actionsBandName);
                $column->SetImagePath('images/view_action.png');
            }
            if ($this->GetSecurityInfo()->HasEditGrant())
            {
                $column = new RowOperationByLinkColumn($this->GetLocalizerCaptions()->GetMessageString('Edit'), OPERATION_EDIT, $this->dataset);
                $grid->AddViewColumn($column, $actionsBandName);
                $column->SetImagePath('images/edit_action.png');
                $column->OnShow->AddListener('ShowEditButtonHandler', $this);
            }
            if ($this->GetSecurityInfo()->HasDeleteGrant())
            {
                $column = new RowOperationByLinkColumn($this->GetLocalizerCaptions()->GetMessageString('Delete'), OPERATION_DELETE, $this->dataset);
                $grid->AddViewColumn($column, $actionsBandName);
                $column->SetImagePath('images/delete_action.png');
                $column->OnShow->AddListener('ShowDeleteButtonHandler', $this);
                $column->SetAdditionalAttribute('data-modal-delete', 'true');
                $column->SetAdditionalAttribute('data-delete-handler-name', $this->GetModalGridDeleteHandler());
            }
        }
    
        protected function AddFieldColumns(Grid $grid)
        {
            //
            // View column for cli-ragsoc field
            //
            $column = new TextViewColumn('sco-codcli_cli-ragsoc', 'Codice cliente', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for descrizione field
            //
            $column = new TextViewColumn('sco-codart_descrizione', 'Codice articolo', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for descvoce field
            //
            $column = new TextViewColumn('sco-codvoc_descvoce', 'Codice tipo voce', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for sco-sconto field
            //
            $column = new TextViewColumn('sco-sconto', 'Sconto', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for cli-ragsoc field
            //
            $column = new TextViewColumn('sco-codcli_cli-ragsoc', 'Codice cliente', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for descrizione field
            //
            $column = new TextViewColumn('sco-codart_descrizione', 'Codice articolo', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for descvoce field
            //
            $column = new TextViewColumn('sco-codvoc_descvoce', 'Codice tipo voce', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for sco-sconto field
            //
            $column = new TextViewColumn('sco-sconto', 'Sconto', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for sco-codcli field
            //
            $editor = new AutocomleteComboBox('sco-codcli_edit', $this->CreateLinkBuilder());
            $editor->SetSize('250px');
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                new MyPDOConnectionFactory(),
                GetConnectionOptions(),
                '`clienti`');
            $field = new IntegerField('id', null, null, true);
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new StringField('cli-codcli');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('cli-ragsoc');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('cli-codlis');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('datains');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('datamod');
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('cli-ragsoc', GetOrderTypeAsSQL(otAscending));
            $editColumn = new DynamicLookupEditColumn('Codice cliente', 'sco-codcli', 'sco-codcli_cli-ragsoc', 'edit_sco-codcli_cli-ragsoc_search', $editor, $this->dataset, $lookupDataset, 'cli-codcli', 'cli-ragsoc', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for sco-codart field
            //
            $editor = new AutocomleteComboBox('sco-codart_edit', $this->CreateLinkBuilder());
            $editor->SetSize('250px');
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                new MyPDOConnectionFactory(),
                GetConnectionOptions(),
                '`elenco_articoli_view`');
            $field = new StringField('art-codart');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('descrizione');
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('descrizione', GetOrderTypeAsSQL(otAscending));
            $editColumn = new DynamicLookupEditColumn('Codice articolo', 'sco-codart', 'sco-codart_descrizione', 'edit_sco-codart_descrizione_search', $editor, $this->dataset, $lookupDataset, 'art-codart', 'descrizione', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for sco-codvoc field
            //
            $editor = new ComboBox('sco-codvoc_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $selectQuery = 'select `id`, concat(`voc-codvoce`, IF(`voc-descriz` <> \'\', concat(\' - \', `voc-descriz`),\'\')) as descvoce from voci_costo';
            $insertQuery = array();
            $updateQuery = array();
            $deleteQuery = array();
            $lookupDataset = new QueryDataset(
              new MyPDOConnectionFactory(), 
              GetConnectionOptions(),
              $selectQuery, $insertQuery, $updateQuery, $deleteQuery, 'query_listino_voci');
            $field = new IntegerField('id');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new StringField('descvoce');
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('descvoce', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Codice tipo voce', 
                'sco-codvoc', 
                $editor, 
                $this->dataset, 'id', 'descvoce', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for sco-sconto field
            //
            $editor = new TextEdit('sco-sconto_edit');
            $editColumn = new CustomEditColumn('Sconto', 'sco-sconto', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new NumberValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('NumberValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for sco-codcli field
            //
            $editor = new AutocomleteComboBox('sco-codcli_edit', $this->CreateLinkBuilder());
            $editor->SetSize('250px');
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                new MyPDOConnectionFactory(),
                GetConnectionOptions(),
                '`clienti`');
            $field = new IntegerField('id', null, null, true);
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new StringField('cli-codcli');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('cli-ragsoc');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('cli-codlis');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('datains');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('datamod');
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('cli-ragsoc', GetOrderTypeAsSQL(otAscending));
            $editColumn = new DynamicLookupEditColumn('Codice cliente', 'sco-codcli', 'sco-codcli_cli-ragsoc', 'insert_sco-codcli_cli-ragsoc_search', $editor, $this->dataset, $lookupDataset, 'cli-codcli', 'cli-ragsoc', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for sco-codart field
            //
            $editor = new AutocomleteComboBox('sco-codart_edit', $this->CreateLinkBuilder());
            $editor->SetSize('250px');
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                new MyPDOConnectionFactory(),
                GetConnectionOptions(),
                '`elenco_articoli_view`');
            $field = new StringField('art-codart');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('descrizione');
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('descrizione', GetOrderTypeAsSQL(otAscending));
            $editColumn = new DynamicLookupEditColumn('Codice articolo', 'sco-codart', 'sco-codart_descrizione', 'insert_sco-codart_descrizione_search', $editor, $this->dataset, $lookupDataset, 'art-codart', 'descrizione', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for sco-codvoc field
            //
            $editor = new ComboBox('sco-codvoc_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $selectQuery = 'select `id`, concat(`voc-codvoce`, IF(`voc-descriz` <> \'\', concat(\' - \', `voc-descriz`),\'\')) as descvoce from voci_costo';
            $insertQuery = array();
            $updateQuery = array();
            $deleteQuery = array();
            $lookupDataset = new QueryDataset(
              new MyPDOConnectionFactory(), 
              GetConnectionOptions(),
              $selectQuery, $insertQuery, $updateQuery, $deleteQuery, 'query_listino_voci');
            $field = new IntegerField('id');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new StringField('descvoce');
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('descvoce', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Codice tipo voce', 
                'sco-codvoc', 
                $editor, 
                $this->dataset, 'id', 'descvoce', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for sco-sconto field
            //
            $editor = new TextEdit('sco-sconto_edit');
            $editColumn = new CustomEditColumn('Sconto', 'sco-sconto', $editor, $this->dataset);
            $editColumn->SetInsertDefaultValue($this->RenderText('0'));
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $validator = new NumberValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('NumberValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            if ($this->GetSecurityInfo()->HasAddGrant())
            {
                $grid->SetShowAddButton(true);
                $grid->SetShowInlineAddButton(false);
            }
            else
            {
                $grid->SetShowInlineAddButton(false);
                $grid->SetShowAddButton(false);
            }
        }
    
        protected function AddPrintColumns(Grid $grid)
        {
            //
            // View column for cli-ragsoc field
            //
            $column = new TextViewColumn('sco-codcli_cli-ragsoc', 'Codice cliente', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for descrizione field
            //
            $column = new TextViewColumn('sco-codart_descrizione', 'Codice articolo', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for descvoce field
            //
            $column = new TextViewColumn('sco-codvoc_descvoce', 'Codice tipo voce', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for sco-sconto field
            //
            $column = new TextViewColumn('sco-sconto', 'Sconto', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for cli-ragsoc field
            //
            $column = new TextViewColumn('sco-codcli_cli-ragsoc', 'Codice cliente', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for descrizione field
            //
            $column = new TextViewColumn('sco-codart_descrizione', 'Codice articolo', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for descvoce field
            //
            $column = new TextViewColumn('sco-codvoc_descvoce', 'Codice tipo voce', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for sco-sconto field
            //
            $column = new TextViewColumn('sco-sconto', 'Sconto', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $grid->AddExportColumn($column);
        }
    
        public function GetPageDirection()
        {
            return null;
        }
    
        protected function ApplyCommonColumnEditProperties(CustomEditColumn $column)
        {
            $column->SetDisplaySetToNullCheckBox(false);
            $column->SetDisplaySetToDefaultCheckBox(false);
    		$column->SetVariableContainer($this->GetColumnVariableContainer());
        }
    
        function GetCustomClientScript()
        {
            return ;
        }
        
        function GetOnPageLoadedClientScript()
        {
            return ;
        }
        function scontistica_clientiGrid_BeforeUpdateRecord($page, &$rowData, &$cancel, &$message, $tableName)
        {
            $date = new DateTime();
            $rowData['datamod'] = $date;
        }
        function scontistica_clientiGrid_BeforeInsertRecord($page, &$rowData, &$cancel, &$message, $tableName)
        {
            $date = new DateTime();
            $rowData['datamod'] = $date;
            $rowData['datains'] = $date;
        }
        public function ShowEditButtonHandler(&$show)
        {
            if ($this->GetRecordPermission() != null)
                $show = $this->GetRecordPermission()->HasEditGrant($this->GetDataset());
        }
        public function ShowDeleteButtonHandler(&$show)
        {
            if ($this->GetRecordPermission() != null)
                $show = $this->GetRecordPermission()->HasDeleteGrant($this->GetDataset());
        }
        
        public function GetModalGridDeleteHandler() { return 'scontistica_clienti_modal_delete'; }
        protected function GetEnableModalGridDelete() { return true; }
    
        protected function CreateGrid()
        {
            $result = new Grid($this, $this->dataset, 'scontistica_clientiGrid');
            if ($this->GetSecurityInfo()->HasDeleteGrant())
               $result->SetAllowDeleteSelected(false);
            else
               $result->SetAllowDeleteSelected(false);   
            
            ApplyCommonPageSettings($this, $result);
            
            $result->SetUseImagesForActions(true);
            $result->SetUseFixedHeader(false);
            $result->SetShowLineNumbers(true);
            
            $result->SetAllowOrdering(false);
            
            $result->SetHighlightRowAtHover(false);
            $result->SetWidth('');
            $result->BeforeUpdateRecord->AddListener('scontistica_clientiGrid' . '_' . 'BeforeUpdateRecord', $this);
            $result->BeforeInsertRecord->AddListener('scontistica_clientiGrid' . '_' . 'BeforeInsertRecord', $this);
            $this->CreateGridSearchControl($result);
            $this->CreateGridAdvancedSearchControl($result);
    
            $this->AddFieldColumns($result);
            $this->AddSingleRecordViewColumns($result);
            $this->AddEditColumns($result);
            $this->AddInsertColumns($result);
            $this->AddPrintColumns($result);
            $this->AddExportColumns($result);
            $this->AddOperationsColumns($result);
            $this->SetShowPageList(true);
            $this->SetHidePageListByDefault(false);
            $this->SetExportToExcelAvailable(false);
            $this->SetExportToWordAvailable(false);
            $this->SetExportToXmlAvailable(false);
            $this->SetExportToCsvAvailable(false);
            $this->SetExportToPdfAvailable(false);
            $this->SetPrinterFriendlyAvailable(false);
            $this->SetSimpleSearchAvailable(false);
            $this->SetAdvancedSearchAvailable(false);
            $this->SetFilterRowAvailable(true);
            $this->SetVisualEffectsEnabled(true);
            $this->SetShowTopPageNavigator(false);
            $this->SetShowBottomPageNavigator(false);
    
            //
            // Http Handlers
            //
            $lookupDataset = new TableDataset(
                new MyPDOConnectionFactory(),
                GetConnectionOptions(),
                '`clienti`');
            $field = new IntegerField('id', null, null, true);
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new StringField('cli-codcli');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('cli-ragsoc');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('cli-codlis');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('datains');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('datamod');
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('cli-ragsoc', GetOrderTypeAsSQL(otAscending));
            $lookupDataset->AddCustomCondition(EnvVariablesUtils::EvaluateVariableTemplate($this->GetColumnVariableContainer(), ''));
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_sco-codcli_cli-ragsoc_search', 'cli-codcli', 'cli-ragsoc', null);
            GetApplication()->RegisterHTTPHandler($handler);
            $lookupDataset = new TableDataset(
                new MyPDOConnectionFactory(),
                GetConnectionOptions(),
                '`elenco_articoli_view`');
            $field = new StringField('art-codart');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('descrizione');
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('descrizione', GetOrderTypeAsSQL(otAscending));
            $lookupDataset->AddCustomCondition(EnvVariablesUtils::EvaluateVariableTemplate($this->GetColumnVariableContainer(), ''));
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_sco-codart_descrizione_search', 'art-codart', 'descrizione', null);
            GetApplication()->RegisterHTTPHandler($handler);
            $lookupDataset = new TableDataset(
                new MyPDOConnectionFactory(),
                GetConnectionOptions(),
                '`clienti`');
            $field = new IntegerField('id', null, null, true);
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new StringField('cli-codcli');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('cli-ragsoc');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('cli-codlis');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('datains');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('datamod');
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('cli-ragsoc', GetOrderTypeAsSQL(otAscending));
            $lookupDataset->AddCustomCondition(EnvVariablesUtils::EvaluateVariableTemplate($this->GetColumnVariableContainer(), ''));
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_sco-codcli_cli-ragsoc_search', 'cli-codcli', 'cli-ragsoc', null);
            GetApplication()->RegisterHTTPHandler($handler);
            $lookupDataset = new TableDataset(
                new MyPDOConnectionFactory(),
                GetConnectionOptions(),
                '`elenco_articoli_view`');
            $field = new StringField('art-codart');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('descrizione');
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('descrizione', GetOrderTypeAsSQL(otAscending));
            $lookupDataset->AddCustomCondition(EnvVariablesUtils::EvaluateVariableTemplate($this->GetColumnVariableContainer(), ''));
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_sco-codart_descrizione_search', 'art-codart', 'descrizione', null);
            GetApplication()->RegisterHTTPHandler($handler);
            return $result;
        }
        
        public function OpenAdvancedSearchByDefault()
        {
            return false;
        }
    
        protected function DoGetGridHeader()
        {
            return '';
        }
    }

    SetUpUserAuthorization(GetApplication());

    try
    {
        $Page = new scontistica_clientiPage("scontistica_clienti.php", "scontistica_clienti", GetCurrentUserGrantForDataSource("scontistica_clienti"), 'UTF-8');
        $Page->SetShortCaption('Scontistica Clienti');
        $Page->SetHeader(GetPagesHeader());
        $Page->SetFooter(GetPagesFooter());
        $Page->SetCaption('Scontistica Clienti');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("scontistica_clienti"));
        GetApplication()->SetEnableLessRunTimeCompile(GetEnableLessFilesRunTimeCompilation());
        GetApplication()->SetCanUserChangeOwnPassword(
            !function_exists('CanUserChangeOwnPassword') || CanUserChangeOwnPassword());
        GetApplication()->SetMainPage($Page);
        GetApplication()->Run();
    }
    catch(Exception $e)
    {
        ShowErrorPage($e->getMessage());
    }
	
