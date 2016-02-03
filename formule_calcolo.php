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
    
    
    
    class formule_calcoloPage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->dataset = new TableDataset(
                new MyPDOConnectionFactory(),
                GetConnectionOptions(),
                '`formule_calcolo`');
            $field = new IntegerField('id', null, null, true);
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, true);
            $field = new IntegerField('codice');
            $this->dataset->AddField($field, false);
            $field = new StringField('formula');
            $this->dataset->AddField($field, false);
            $field = new StringField('critcalc');
            $this->dataset->AddField($field, false);
            $field = new DateTimeField('datains');
            $this->dataset->AddField($field, false);
            $field = new DateTimeField('datamod');
            $this->dataset->AddField($field, false);
        }
    
        protected function DoPrepare() {
    
        }
    
        protected function CreatePageNavigator()
        {
            $result = new CompositePageNavigator($this);
            
            $partitionNavigator = new PageNavigator('pnav', $this, $this->dataset);
            $partitionNavigator->SetRowsPerPage(25);
            $result->AddPageNavigator($partitionNavigator);
            
            return $result;
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
            $grid->SearchControl = new SimpleSearch('formule_calcolossearch', $this->dataset,
                array('codice', 'formula'),
                array($this->RenderText('Codice'), $this->RenderText('Formula')),
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
            $this->AdvancedSearchControl = new AdvancedSearchControl('formule_calcoloasearch', $this->dataset, $this->GetLocalizerCaptions(), $this->GetColumnVariableContainer(), $this->CreateLinkBuilder());
            $this->AdvancedSearchControl->setTimerInterval(1000);
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('codice', $this->RenderText('Codice')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('formula', $this->RenderText('Formula')));
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
            // View column for codice field
            //
            $column = new TextViewColumn('codice', 'Codice', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for formula field
            //
            $column = new TextViewColumn('formula', 'Formula', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('formule_calcoloGrid_formula_handler_list');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for codice field
            //
            $column = new TextViewColumn('codice', 'Codice', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for formula field
            //
            $column = new TextViewColumn('formula', 'Formula', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('formule_calcoloGrid_formula_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for datains field
            //
            $column = new DateTimeViewColumn('datains', 'Datains', $this->dataset);
            $column->SetDateTimeFormat('d-m-Y H:i:s');
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for datamod field
            //
            $column = new DateTimeViewColumn('datamod', 'Datamod', $this->dataset);
            $column->SetDateTimeFormat('d-m-Y H:i:s');
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for codice field
            //
            $editor = new TextEdit('codice_edit');
            $editColumn = new CustomEditColumn('Codice', 'codice', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for formula field
            //
            $editor = new TextEdit('formula_edit');
            $editor->SetSize(100);
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Formula', 'formula', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for codice field
            //
            $editor = new TextEdit('codice_edit');
            $editColumn = new CustomEditColumn('Codice', 'codice', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for formula field
            //
            $editor = new TextEdit('formula_edit');
            $editor->SetSize(100);
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Formula', 'formula', $editor, $this->dataset);
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
            // View column for codice field
            //
            $column = new TextViewColumn('codice', 'Codice', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for formula field
            //
            $column = new TextViewColumn('formula', 'Formula', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for codice field
            //
            $column = new TextViewColumn('codice', 'Codice', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for formula field
            //
            $column = new TextViewColumn('formula', 'Formula', $this->dataset);
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
        function formule_calcoloGrid_BeforeUpdateRecord($page, &$rowData, &$cancel, &$message, $tableName)
        {
            $date = new DateTime();
            $rowData['datamod'] = $date;
        }
        function formule_calcoloGrid_BeforeInsertRecord($page, &$rowData, &$cancel, &$message, $tableName)
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
        
        public function GetModalGridDeleteHandler() { return 'formule_calcolo_modal_delete'; }
        protected function GetEnableModalGridDelete() { return true; }
    
        protected function CreateGrid()
        {
            $result = new Grid($this, $this->dataset, 'formule_calcoloGrid');
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
            $result->BeforeUpdateRecord->AddListener('formule_calcoloGrid' . '_' . 'BeforeUpdateRecord', $this);
            $result->BeforeInsertRecord->AddListener('formule_calcoloGrid' . '_' . 'BeforeInsertRecord', $this);
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
            $this->SetShowTopPageNavigator(true);
            $this->SetShowBottomPageNavigator(false);
    
            //
            // Http Handlers
            //
            //
            // View column for formula field
            //
            $column = new TextViewColumn('formula', 'Formula', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'formule_calcoloGrid_formula_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);//
            // View column for formula field
            //
            $column = new TextViewColumn('formula', 'Formula', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'formule_calcoloGrid_formula_handler_view', $column);
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
        $Page = new formule_calcoloPage("formule_calcolo.php", "formule_calcolo", GetCurrentUserGrantForDataSource("formule_calcolo"), 'UTF-8');
        $Page->SetShortCaption('Formule Calcolo');
        $Page->SetHeader(GetPagesHeader());
        $Page->SetFooter(GetPagesFooter());
        $Page->SetCaption('Formule Calcolo');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("formule_calcolo"));
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
	
