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
    
    
    
    class offertePage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->dataset = new TableDataset(
                new MyPDOConnectionFactory(),
                GetConnectionOptions(),
                '`offerte`');
            $field = new IntegerField('id', null, null, true);
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, true);
            $field = new IntegerField('off-numoff');
            $this->dataset->AddField($field, false);
            $field = new StringField('off-codcli');
            $this->dataset->AddField($field, false);
            $field = new DateTimeField('off-datains');
            $this->dataset->AddField($field, false);
            $field = new DateTimeField('off-dataeva');
            $this->dataset->AddField($field, false);
            $field = new DateTimeField('datains');
            $this->dataset->AddField($field, false);
            $field = new DateTimeField('datamod');
            $this->dataset->AddField($field, false);
            $field = new StringField('off-stato');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, false);
            $field = new StringField('off-descriz');
            $this->dataset->AddField($field, false);
            $this->dataset->AddLookupField('off-codcli', 'clienti', new StringField('cli-codcli'), new StringField('cli-ragsoc', 'off-codcli_cli-ragsoc', 'off-codcli_cli-ragsoc_clienti'), 'off-codcli_cli-ragsoc_clienti');
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
            $grid->SearchControl = new SimpleSearch('offertessearch', $this->dataset,
                array('id', 'off-codcli_cli-ragsoc', 'off-datains', 'off-dataeva'),
                array($this->RenderText('Numero Offerta'), $this->RenderText('cod.Cliente'), $this->RenderText('Data inserimento'), $this->RenderText('Data evasione')),
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
            $this->AdvancedSearchControl = new AdvancedSearchControl('offerteasearch', $this->dataset, $this->GetLocalizerCaptions(), $this->GetColumnVariableContainer(), $this->CreateLinkBuilder());
            $this->AdvancedSearchControl->setTimerInterval(1000);
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('id', $this->RenderText('Numero Offerta')));
            
            $lookupDataset = new TableDataset(
                new MyPDOConnectionFactory(),
                GetConnectionOptions(),
                '`clienti`');
            $field = new IntegerField('id', null, null, true);
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new StringField('cli-codcli');
            $lookupDataset->AddField($field, false);
            $field = new StringField('cli-ragsoc');
            $lookupDataset->AddField($field, false);
            $field = new StringField('cli-codlis');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('datains');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('datamod');
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('cli-ragsoc', GetOrderTypeAsSQL(otAscending));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateLookupSearchInput('off-codcli', $this->RenderText('cod.Cliente'), $lookupDataset, 'cli-codcli', 'cli-ragsoc', false, 8));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateDateTimeSearchInput('off-datains', $this->RenderText('Data inserimento'), 'd-m-Y'));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateDateTimeSearchInput('off-dataeva', $this->RenderText('Data evasione'), 'd-m-Y'));
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
            // View column for id field
            //
            $column = new TextViewColumn('id', 'Numero Offerta', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for cli-ragsoc field
            //
            $column = new TextViewColumn('off-codcli_cli-ragsoc', 'cod.Cliente', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for off-datains field
            //
            $column = new DateTimeViewColumn('off-datains', 'Data inserimento', $this->dataset);
            $column->SetDateTimeFormat('d-m-Y');
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for off-dataeva field
            //
            $column = new DateTimeViewColumn('off-dataeva', 'Data evasione', $this->dataset);
            $column->SetDateTimeFormat('d-m-Y');
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for id field
            //
            $column = new TextViewColumn('id', 'Numero Offerta', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for cli-ragsoc field
            //
            $column = new TextViewColumn('off-codcli_cli-ragsoc', 'cod.Cliente', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for off-datains field
            //
            $column = new DateTimeViewColumn('off-datains', 'Data inserimento', $this->dataset);
            $column->SetDateTimeFormat('d-m-Y');
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for off-dataeva field
            //
            $column = new DateTimeViewColumn('off-dataeva', 'Data evasione', $this->dataset);
            $column->SetDateTimeFormat('d-m-Y');
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for datains field
            //
            $column = new DateTimeViewColumn('datains', 'Data ins', $this->dataset);
            $column->SetDateTimeFormat('d-m-Y');
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for datamod field
            //
            $column = new DateTimeViewColumn('datamod', 'Data mod', $this->dataset);
            $column->SetDateTimeFormat('d-m-Y');
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for off-codcli field
            //
            $editor = new ComboBox('off-codcli_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new MyPDOConnectionFactory(),
                GetConnectionOptions(),
                '`clienti`');
            $field = new IntegerField('id', null, null, true);
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new StringField('cli-codcli');
            $lookupDataset->AddField($field, false);
            $field = new StringField('cli-ragsoc');
            $lookupDataset->AddField($field, false);
            $field = new StringField('cli-codlis');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('datains');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('datamod');
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('cli-ragsoc', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'cod.Cliente', 
                'off-codcli', 
                $editor, 
                $this->dataset, 'cli-codcli', 'cli-ragsoc', $lookupDataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for off-datains field
            //
            $editor = new DateTimeEdit('off-datains_edit', true, 'd-m-Y', GetFirstDayOfWeek());
            $editColumn = new CustomEditColumn('Data inserimento', 'off-datains', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for off-dataeva field
            //
            $editor = new DateTimeEdit('off-dataeva_edit', true, 'd-m-Y', GetFirstDayOfWeek());
            $editColumn = new CustomEditColumn('Data evasione', 'off-dataeva', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for off-codcli field
            //
            $editor = new ComboBox('off-codcli_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new MyPDOConnectionFactory(),
                GetConnectionOptions(),
                '`clienti`');
            $field = new IntegerField('id', null, null, true);
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new StringField('cli-codcli');
            $lookupDataset->AddField($field, false);
            $field = new StringField('cli-ragsoc');
            $lookupDataset->AddField($field, false);
            $field = new StringField('cli-codlis');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('datains');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('datamod');
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('cli-ragsoc', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'cod.Cliente', 
                'off-codcli', 
                $editor, 
                $this->dataset, 'cli-codcli', 'cli-ragsoc', $lookupDataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for off-datains field
            //
            $editor = new DateTimeEdit('off-datains_edit', true, 'd-m-Y', GetFirstDayOfWeek());
            $editColumn = new CustomEditColumn('Data inserimento', 'off-datains', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for off-dataeva field
            //
            $editor = new DateTimeEdit('off-dataeva_edit', true, 'd-m-Y', GetFirstDayOfWeek());
            $editColumn = new CustomEditColumn('Data evasione', 'off-dataeva', $editor, $this->dataset);
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
            // View column for id field
            //
            $column = new TextViewColumn('id', 'Numero Offerta', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for cli-ragsoc field
            //
            $column = new TextViewColumn('off-codcli_cli-ragsoc', 'cod.Cliente', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for off-datains field
            //
            $column = new DateTimeViewColumn('off-datains', 'Data inserimento', $this->dataset);
            $column->SetDateTimeFormat('d-m-Y');
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for off-dataeva field
            //
            $column = new DateTimeViewColumn('off-dataeva', 'Data evasione', $this->dataset);
            $column->SetDateTimeFormat('d-m-Y');
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for id field
            //
            $column = new TextViewColumn('id', 'Numero Offerta', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for cli-ragsoc field
            //
            $column = new TextViewColumn('off-codcli_cli-ragsoc', 'cod.Cliente', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for off-datains field
            //
            $column = new DateTimeViewColumn('off-datains', 'Data inserimento', $this->dataset);
            $column->SetDateTimeFormat('d-m-Y');
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for off-dataeva field
            //
            $column = new DateTimeViewColumn('off-dataeva', 'Data evasione', $this->dataset);
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
        function offerteGrid_BeforeUpdateRecord($page, &$rowData, &$cancel, &$message, $tableName)
        {
            $date = new DateTime();
            $rowData['datamod'] = $date;
        }
        function offerteGrid_BeforeInsertRecord($page, &$rowData, &$cancel, &$message, $tableName)
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
        
        public function GetModalGridDeleteHandler() { return 'offerte_modal_delete'; }
        protected function GetEnableModalGridDelete() { return true; }
    
        protected function CreateGrid()
        {
            $result = new Grid($this, $this->dataset, 'offerteGrid');
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
            $result->BeforeUpdateRecord->AddListener('offerteGrid' . '_' . 'BeforeUpdateRecord', $this);
            $result->BeforeInsertRecord->AddListener('offerteGrid' . '_' . 'BeforeInsertRecord', $this);
            $this->CreateGridSearchControl($result);
            $this->CreateGridAdvancedSearchControl($result);
            $this->AddOperationsColumns($result);
            $this->AddFieldColumns($result);
            $this->AddSingleRecordViewColumns($result);
            $this->AddEditColumns($result);
            $this->AddInsertColumns($result);
            $this->AddPrintColumns($result);
            $this->AddExportColumns($result);
    
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
        $Page = new offertePage("offerte.php", "offerte", GetCurrentUserGrantForDataSource("offerte"), 'UTF-8');
        $Page->SetShortCaption('Offerte');
        $Page->SetHeader(GetPagesHeader());
        $Page->SetFooter(GetPagesFooter());
        $Page->SetCaption('Offerte');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("offerte"));
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
	
