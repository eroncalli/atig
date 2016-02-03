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
    
    
    
    class listino_articoliPage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->dataset = new TableDataset(
                new MyPDOConnectionFactory(),
                GetConnectionOptions(),
                '`listino_articoli`');
            $field = new IntegerField('id', null, null, true);
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, true);
            $field = new StringField('lis-codlis');
            $this->dataset->AddField($field, false);
            $field = new StringField('lisdesc');
            $this->dataset->AddField($field, false);
            $field = new StringField('lis-unimis');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('lis-przacq');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('lis-moltipl');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('lis-oneriacc');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('lis-scarto');
            $this->dataset->AddField($field, false);
            $field = new DateTimeField('lis-dataini');
            $this->dataset->AddField($field, false);
            $field = new DateTimeField('lis-datafin');
            $this->dataset->AddField($field, false);
            $field = new DateTimeField('datains');
            $this->dataset->AddField($field, false);
            $field = new DateTimeField('datamod');
            $this->dataset->AddField($field, false);
            $field = new StringField('lis-codart');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, false);
            $this->dataset->AddLookupField('lis-codart', '(SELECT `art-codart`, concat(RTRIM(`art-codart`) , \' - \', RTRIM(`art-descart`)) as descrizione FROM atig.articoli)', new StringField('art-codart'), new StringField('descrizione', 'lis-codart_descrizione', 'lis-codart_descrizione_elenco_articoli_view'), 'lis-codart_descrizione_elenco_articoli_view');
            $this->dataset->AddLookupField('lisdesc', '(SELECT `art-codart`, concat(RTRIM(`art-codart`) , \' - \', RTRIM(`art-descart`)) as descrizione FROM atig.articoli)', new StringField('art-codart'), new StringField('descrizione', 'lisdesc_descrizione', 'lisdesc_descrizione_elenco_articoli_view'), 'lisdesc_descrizione_elenco_articoli_view');
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
            $grid->SearchControl = new SimpleSearch('listino_articolissearch', $this->dataset,
                array('lis-codart_descrizione', 'lisdesc_descrizione', 'lis-unimis', 'lis-przacq', 'lis-moltipl', 'lis-oneriacc', 'lis-scarto', 'lis-dataini', 'lis-datafin'),
                array($this->RenderText('Codice Articolo'), $this->RenderText('Descrizione'), $this->RenderText('Unità misura'), $this->RenderText('Prezzo acquisto'), $this->RenderText('Moltiplicatore'), $this->RenderText('Oneri e accessori'), $this->RenderText('Scarto'), $this->RenderText('Data inizio decorrenza'), $this->RenderText('Data fine decorrenza')),
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
            $this->AdvancedSearchControl = new AdvancedSearchControl('listino_articoliasearch', $this->dataset, $this->GetLocalizerCaptions(), $this->GetColumnVariableContainer(), $this->CreateLinkBuilder());
            $this->AdvancedSearchControl->setTimerInterval(1000);
            $selectQuery = 'SELECT `art-codart`, concat(RTRIM(`art-codart`) , \' - \', RTRIM(`art-descart`)) as descrizione FROM atig.articoli';
            $insertQuery = array();
            $updateQuery = array();
            $deleteQuery = array();
            $lookupDataset = new QueryDataset(
              new MyPDOConnectionFactory(), 
              GetConnectionOptions(),
              $selectQuery, $insertQuery, $updateQuery, $deleteQuery, 'elenco_articoli_view');
            $field = new StringField('art-codart');
            $lookupDataset->AddField($field, false);
            $field = new StringField('descrizione');
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('descrizione', GetOrderTypeAsSQL(otAscending));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateLookupSearchInput('lis-codart', $this->RenderText('Codice Articolo'), $lookupDataset, 'art-codart', 'descrizione', false, 8));
            
            $selectQuery = 'SELECT `art-codart`, concat(RTRIM(`art-codart`) , \' - \', RTRIM(`art-descart`)) as descrizione FROM atig.articoli';
            $insertQuery = array();
            $updateQuery = array();
            $deleteQuery = array();
            $lookupDataset = new QueryDataset(
              new MyPDOConnectionFactory(), 
              GetConnectionOptions(),
              $selectQuery, $insertQuery, $updateQuery, $deleteQuery, 'elenco_articoli_view');
            $field = new StringField('art-codart');
            $lookupDataset->AddField($field, false);
            $field = new StringField('descrizione');
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('descrizione', GetOrderTypeAsSQL(otAscending));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateLookupSearchInput('lisdesc', $this->RenderText('Descrizione'), $lookupDataset, 'art-codart', 'descrizione', false, 8));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('lis-unimis', $this->RenderText('Unità misura')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('lis-przacq', $this->RenderText('Prezzo acquisto')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('lis-moltipl', $this->RenderText('Moltiplicatore')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('lis-oneriacc', $this->RenderText('Oneri e accessori')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('lis-scarto', $this->RenderText('Scarto')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateDateTimeSearchInput('lis-dataini', $this->RenderText('Data inizio decorrenza'), 'd-m-Y'));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateDateTimeSearchInput('lis-datafin', $this->RenderText('Data fine decorrenza'), 'd-m-Y'));
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
            // View column for descrizione field
            //
            $column = new TextViewColumn('lis-codart_descrizione', 'Codice Articolo', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for descrizione field
            //
            $column = new TextViewColumn('lisdesc_descrizione', 'Descrizione', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('listino_articoliGrid_descrizione_handler_list');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for descrizione field
            //
            $column = new TextViewColumn('lis-codart_descrizione', 'Codice Articolo', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for descrizione field
            //
            $column = new TextViewColumn('lisdesc_descrizione', 'Descrizione', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('listino_articoliGrid_descrizione_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for lis-unimis field
            //
            $column = new TextViewColumn('lis-unimis', 'Unità misura', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for lis-przacq field
            //
            $column = new TextViewColumn('lis-przacq', 'Prezzo acquisto', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for lis-moltipl field
            //
            $column = new TextViewColumn('lis-moltipl', 'Moltiplicatore', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for lis-oneriacc field
            //
            $column = new TextViewColumn('lis-oneriacc', 'Oneri e accessori', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for lis-scarto field
            //
            $column = new TextViewColumn('lis-scarto', 'Scarto', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for lis-dataini field
            //
            $column = new DateTimeViewColumn('lis-dataini', 'Data inizio decorrenza', $this->dataset);
            $column->SetDateTimeFormat('d-m-Y');
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for lis-datafin field
            //
            $column = new DateTimeViewColumn('lis-datafin', 'Data fine decorrenza', $this->dataset);
            $column->SetDateTimeFormat('d-m-Y');
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for lis-codart field
            //
            $editor = new ComboBox('lis-codart_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $selectQuery = 'SELECT `art-codart`, concat(RTRIM(`art-codart`) , \' - \', RTRIM(`art-descart`)) as descrizione FROM atig.articoli';
            $insertQuery = array();
            $updateQuery = array();
            $deleteQuery = array();
            $lookupDataset = new QueryDataset(
              new MyPDOConnectionFactory(), 
              GetConnectionOptions(),
              $selectQuery, $insertQuery, $updateQuery, $deleteQuery, 'elenco_articoli_view');
            $field = new StringField('art-codart');
            $lookupDataset->AddField($field, false);
            $field = new StringField('descrizione');
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('descrizione', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Codice Articolo', 
                'lis-codart', 
                $editor, 
                $this->dataset, 'art-codart', 'descrizione', $lookupDataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for lisdesc field
            //
            $editor = new AutocomleteComboBox('lisdesc_edit', $this->CreateLinkBuilder());
            $editor->SetSize('250px');
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $selectQuery = 'SELECT `art-codart`, concat(RTRIM(`art-codart`) , \' - \', RTRIM(`art-descart`)) as descrizione FROM atig.articoli';
            $insertQuery = array();
            $updateQuery = array();
            $deleteQuery = array();
            $lookupDataset = new QueryDataset(
              new MyPDOConnectionFactory(), 
              GetConnectionOptions(),
              $selectQuery, $insertQuery, $updateQuery, $deleteQuery, 'elenco_articoli_view');
            $field = new StringField('art-codart');
            $lookupDataset->AddField($field, false);
            $field = new StringField('descrizione');
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('descrizione', GetOrderTypeAsSQL(otAscending));
            $editColumn = new DynamicLookupEditColumn('Descrizione', 'lisdesc', 'lisdesc_descrizione', 'edit_lisdesc_descrizione_search', $editor, $this->dataset, $lookupDataset, 'art-codart', 'descrizione', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for lis-unimis field
            //
            $editor = new TextEdit('lis-unimis_edit');
            $editor->SetSize(3);
            $editor->SetMaxLength(3);
            $editColumn = new CustomEditColumn('Unità misura', 'lis-unimis', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for lis-przacq field
            //
            $editor = new TextEdit('lis-przacq_edit');
            $editColumn = new CustomEditColumn('Prezzo acquisto', 'lis-przacq', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for lis-moltipl field
            //
            $editor = new TextEdit('lis-moltipl_edit');
            $editColumn = new CustomEditColumn('Moltiplicatore', 'lis-moltipl', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for lis-oneriacc field
            //
            $editor = new TextEdit('lis-oneriacc_edit');
            $editColumn = new CustomEditColumn('Oneri e accessori', 'lis-oneriacc', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for lis-scarto field
            //
            $editor = new TextEdit('lis-scarto_edit');
            $editColumn = new CustomEditColumn('Scarto', 'lis-scarto', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for lis-dataini field
            //
            $editor = new DateTimeEdit('lis-dataini_edit', false, 'd-m-Y', GetFirstDayOfWeek());
            $editColumn = new CustomEditColumn('Data inizio decorrenza', 'lis-dataini', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for lis-datafin field
            //
            $editor = new DateTimeEdit('lis-datafin_edit', false, 'd-m-Y', GetFirstDayOfWeek());
            $editColumn = new CustomEditColumn('Data fine decorrenza', 'lis-datafin', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for lis-codart field
            //
            $editor = new ComboBox('lis-codart_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $selectQuery = 'SELECT `art-codart`, concat(RTRIM(`art-codart`) , \' - \', RTRIM(`art-descart`)) as descrizione FROM atig.articoli';
            $insertQuery = array();
            $updateQuery = array();
            $deleteQuery = array();
            $lookupDataset = new QueryDataset(
              new MyPDOConnectionFactory(), 
              GetConnectionOptions(),
              $selectQuery, $insertQuery, $updateQuery, $deleteQuery, 'elenco_articoli_view');
            $field = new StringField('art-codart');
            $lookupDataset->AddField($field, false);
            $field = new StringField('descrizione');
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('descrizione', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Codice Articolo', 
                'lis-codart', 
                $editor, 
                $this->dataset, 'art-codart', 'descrizione', $lookupDataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for lisdesc field
            //
            $editor = new AutocomleteComboBox('lisdesc_edit', $this->CreateLinkBuilder());
            $editor->SetSize('250px');
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $selectQuery = 'SELECT `art-codart`, concat(RTRIM(`art-codart`) , \' - \', RTRIM(`art-descart`)) as descrizione FROM atig.articoli';
            $insertQuery = array();
            $updateQuery = array();
            $deleteQuery = array();
            $lookupDataset = new QueryDataset(
              new MyPDOConnectionFactory(), 
              GetConnectionOptions(),
              $selectQuery, $insertQuery, $updateQuery, $deleteQuery, 'elenco_articoli_view');
            $field = new StringField('art-codart');
            $lookupDataset->AddField($field, false);
            $field = new StringField('descrizione');
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('descrizione', GetOrderTypeAsSQL(otAscending));
            $editColumn = new DynamicLookupEditColumn('Descrizione', 'lisdesc', 'lisdesc_descrizione', 'insert_lisdesc_descrizione_search', $editor, $this->dataset, $lookupDataset, 'art-codart', 'descrizione', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for lis-unimis field
            //
            $editor = new TextEdit('lis-unimis_edit');
            $editor->SetSize(3);
            $editor->SetMaxLength(3);
            $editColumn = new CustomEditColumn('Unità misura', 'lis-unimis', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for lis-przacq field
            //
            $editor = new TextEdit('lis-przacq_edit');
            $editColumn = new CustomEditColumn('Prezzo acquisto', 'lis-przacq', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for lis-moltipl field
            //
            $editor = new TextEdit('lis-moltipl_edit');
            $editColumn = new CustomEditColumn('Moltiplicatore', 'lis-moltipl', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for lis-oneriacc field
            //
            $editor = new TextEdit('lis-oneriacc_edit');
            $editColumn = new CustomEditColumn('Oneri e accessori', 'lis-oneriacc', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for lis-scarto field
            //
            $editor = new TextEdit('lis-scarto_edit');
            $editColumn = new CustomEditColumn('Scarto', 'lis-scarto', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for lis-dataini field
            //
            $editor = new DateTimeEdit('lis-dataini_edit', false, 'd-m-Y', GetFirstDayOfWeek());
            $editColumn = new CustomEditColumn('Data inizio decorrenza', 'lis-dataini', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for lis-datafin field
            //
            $editor = new DateTimeEdit('lis-datafin_edit', false, 'd-m-Y', GetFirstDayOfWeek());
            $editColumn = new CustomEditColumn('Data fine decorrenza', 'lis-datafin', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
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
            // View column for descrizione field
            //
            $column = new TextViewColumn('lis-codart_descrizione', 'Codice Articolo', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for lisdesc field
            //
            $column = new TextViewColumn('lisdesc', 'Lisdesc', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for lis-unimis field
            //
            $column = new TextViewColumn('lis-unimis', 'Unità misura', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for lis-przacq field
            //
            $column = new TextViewColumn('lis-przacq', 'Prezzo acquisto', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $grid->AddPrintColumn($column);
            
            //
            // View column for lis-moltipl field
            //
            $column = new TextViewColumn('lis-moltipl', 'Moltiplicatore', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for lis-oneriacc field
            //
            $column = new TextViewColumn('lis-oneriacc', 'Oneri e accessori', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $grid->AddPrintColumn($column);
            
            //
            // View column for lis-scarto field
            //
            $column = new TextViewColumn('lis-scarto', 'Scarto', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $grid->AddPrintColumn($column);
            
            //
            // View column for lis-dataini field
            //
            $column = new DateTimeViewColumn('lis-dataini', 'Data inizio decorrenza', $this->dataset);
            $column->SetDateTimeFormat('d-m-Y');
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for lis-datafin field
            //
            $column = new DateTimeViewColumn('lis-datafin', 'Data fine decorrenza', $this->dataset);
            $column->SetDateTimeFormat('d-m-Y');
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for descrizione field
            //
            $column = new TextViewColumn('lis-codart_descrizione', 'Codice Articolo', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for lisdesc field
            //
            $column = new TextViewColumn('lisdesc', 'Lisdesc', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for lis-unimis field
            //
            $column = new TextViewColumn('lis-unimis', 'Unità misura', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for lis-przacq field
            //
            $column = new TextViewColumn('lis-przacq', 'Prezzo acquisto', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $grid->AddExportColumn($column);
            
            //
            // View column for lis-moltipl field
            //
            $column = new TextViewColumn('lis-moltipl', 'Moltiplicatore', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for lis-oneriacc field
            //
            $column = new TextViewColumn('lis-oneriacc', 'Oneri e accessori', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $grid->AddExportColumn($column);
            
            //
            // View column for lis-scarto field
            //
            $column = new TextViewColumn('lis-scarto', 'Scarto', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $grid->AddExportColumn($column);
            
            //
            // View column for lis-dataini field
            //
            $column = new DateTimeViewColumn('lis-dataini', 'Data inizio decorrenza', $this->dataset);
            $column->SetDateTimeFormat('d-m-Y');
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for lis-datafin field
            //
            $column = new DateTimeViewColumn('lis-datafin', 'Data fine decorrenza', $this->dataset);
            $column->SetDateTimeFormat('d-m-Y');
            $column->SetOrderable(true);
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
        function listino_articoliGrid_BeforeUpdateRecord($page, &$rowData, &$cancel, &$message, $tableName)
        {
            $date = new DateTime();
            $rowData['datamod'] = $date;
        }
        function listino_articoliGrid_BeforeInsertRecord($page, &$rowData, &$cancel, &$message, $tableName)
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
        
        public function GetModalGridDeleteHandler() { return 'listino_articoli_modal_delete'; }
        protected function GetEnableModalGridDelete() { return true; }
    
        protected function CreateGrid()
        {
            $result = new Grid($this, $this->dataset, 'listino_articoliGrid');
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
            $result->BeforeUpdateRecord->AddListener('listino_articoliGrid' . '_' . 'BeforeUpdateRecord', $this);
            $result->BeforeInsertRecord->AddListener('listino_articoliGrid' . '_' . 'BeforeInsertRecord', $this);
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
            $this->SetFilterRowAvailable(false);
            $this->SetVisualEffectsEnabled(true);
            $this->SetShowTopPageNavigator(false);
            $this->SetShowBottomPageNavigator(false);
    
            //
            // Http Handlers
            //
            //
            // View column for descrizione field
            //
            $column = new TextViewColumn('lisdesc_descrizione', 'Descrizione', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'listino_articoliGrid_descrizione_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);//
            // View column for descrizione field
            //
            $column = new TextViewColumn('lisdesc_descrizione', 'Descrizione', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'listino_articoliGrid_descrizione_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            $selectQuery = 'SELECT `art-codart`, concat(RTRIM(`art-codart`) , \' - \', RTRIM(`art-descart`)) as descrizione FROM atig.articoli';
            $insertQuery = array();
            $updateQuery = array();
            $deleteQuery = array();
            $lookupDataset = new QueryDataset(
              new MyPDOConnectionFactory(), 
              GetConnectionOptions(),
              $selectQuery, $insertQuery, $updateQuery, $deleteQuery, 'elenco_articoli_view');
            $field = new StringField('art-codart');
            $lookupDataset->AddField($field, false);
            $field = new StringField('descrizione');
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('descrizione', GetOrderTypeAsSQL(otAscending));
            $lookupDataset->AddCustomCondition(EnvVariablesUtils::EvaluateVariableTemplate($this->GetColumnVariableContainer(), ''));
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_lisdesc_descrizione_search', 'art-codart', 'descrizione', null);
            GetApplication()->RegisterHTTPHandler($handler);
            $selectQuery = 'SELECT `art-codart`, concat(RTRIM(`art-codart`) , \' - \', RTRIM(`art-descart`)) as descrizione FROM atig.articoli';
            $insertQuery = array();
            $updateQuery = array();
            $deleteQuery = array();
            $lookupDataset = new QueryDataset(
              new MyPDOConnectionFactory(), 
              GetConnectionOptions(),
              $selectQuery, $insertQuery, $updateQuery, $deleteQuery, 'elenco_articoli_view');
            $field = new StringField('art-codart');
            $lookupDataset->AddField($field, false);
            $field = new StringField('descrizione');
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('descrizione', GetOrderTypeAsSQL(otAscending));
            $lookupDataset->AddCustomCondition(EnvVariablesUtils::EvaluateVariableTemplate($this->GetColumnVariableContainer(), ''));
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_lisdesc_descrizione_search', 'art-codart', 'descrizione', null);
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
        $Page = new listino_articoliPage("listino_articoli.php", "listino_articoli", GetCurrentUserGrantForDataSource("listino_articoli"), 'UTF-8');
        $Page->SetShortCaption('Listino Articoli');
        $Page->SetHeader(GetPagesHeader());
        $Page->SetFooter(GetPagesFooter());
        $Page->SetCaption('Listino Articoli');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("listino_articoli"));
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
	
