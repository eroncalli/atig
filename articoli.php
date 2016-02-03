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
    
    
    
    class articoliPage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->dataset = new TableDataset(
                new MyPDOConnectionFactory(),
                GetConnectionOptions(),
                '`articoli`');
            $field = new IntegerField('id', null, null, true);
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, true);
            $field = new StringField('art-codart');
            $this->dataset->AddField($field, false);
            $field = new StringField('art-descart');
            $this->dataset->AddField($field, false);
            $field = new StringField('art-dessup');
            $this->dataset->AddField($field, false);
            $field = new StringField('art-codprod');
            $this->dataset->AddField($field, false);
            $field = new StringField('art-codfam');
            $this->dataset->AddField($field, false);
            $field = new StringField('art-gruppo-merc');
            $this->dataset->AddField($field, false);
            $field = new StringField('art-categoria-omogenea');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('art-lungsmu');
            $this->dataset->AddField($field, false);
            $field = new DateTimeField('datains');
            $this->dataset->AddField($field, false);
            $field = new DateTimeField('datamod');
            $this->dataset->AddField($field, false);
            $this->dataset->AddLookupField('art-codfam', 'famiglie', new StringField('fam-codfam'), new StringField('fam-descriz', 'art-codfam_fam-descriz', 'art-codfam_fam-descriz_famiglie'), 'art-codfam_fam-descriz_famiglie');
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
            $grid->SearchControl = new SimpleSearch('articolissearch', $this->dataset,
                array('id', 'art-codart', 'art-descart', 'art-codfam_fam-descriz', 'art-dessup', 'art-codprod', 'art-gruppo-merc', 'art-categoria-omogenea'),
                array($this->RenderText('Id'), $this->RenderText('Codice articolo'), $this->RenderText('Descrizione'), $this->RenderText('Famiglia'), $this->RenderText('Art-dessup'), $this->RenderText('Art-codprod'), $this->RenderText('Art-gruppo-merc'), $this->RenderText('Art-categoria-omogenea')),
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
            $this->AdvancedSearchControl = new AdvancedSearchControl('articoliasearch', $this->dataset, $this->GetLocalizerCaptions(), $this->GetColumnVariableContainer(), $this->CreateLinkBuilder());
            $this->AdvancedSearchControl->setTimerInterval(1000);
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('id', $this->RenderText('Id')));
            
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
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateLookupSearchInput('art-codart', $this->RenderText('Codice articolo'), $lookupDataset, 'descrizione', '', false, 8));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('art-descart', $this->RenderText('Descrizione')));
            
            $lookupDataset = new TableDataset(
                new MyPDOConnectionFactory(),
                GetConnectionOptions(),
                '`famiglie`');
            $field = new IntegerField('id', null, null, true);
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new StringField('fam-codfam');
            $lookupDataset->AddField($field, false);
            $field = new StringField('fam-descriz');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('datains');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('datamod');
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('fam-descriz', GetOrderTypeAsSQL(otAscending));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateLookupSearchInput('art-codfam', $this->RenderText('Famiglia'), $lookupDataset, 'fam-codfam', 'fam-descriz', false, 8));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('art-dessup', $this->RenderText('Art-dessup')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('art-codprod', $this->RenderText('Art-codprod')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('art-gruppo-merc', $this->RenderText('Art-gruppo-merc')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('art-categoria-omogenea', $this->RenderText('Art-categoria-omogenea')));
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
            // View column for art-codart field
            //
            $column = new TextViewColumn('art-codart', 'Codice articolo', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for art-descart field
            //
            $column = new TextViewColumn('art-descart', 'Descrizione', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('articoliGrid_art-descart_handler_list');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for art-dessup field
            //
            $column = new TextViewColumn('art-dessup', 'Art-dessup', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('articoliGrid_art-dessup_handler_list');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for art-codart field
            //
            $column = new TextViewColumn('art-codart', 'Codice articolo', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for art-descart field
            //
            $column = new TextViewColumn('art-descart', 'Descrizione', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('articoliGrid_art-descart_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for fam-descriz field
            //
            $column = new TextViewColumn('art-codfam_fam-descriz', 'Famiglia', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for datains field
            //
            $column = new DateTimeViewColumn('datains', 'Data ins', $this->dataset);
            $column->SetDateTimeFormat('d-m-Y H:i:s');
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for datamod field
            //
            $column = new DateTimeViewColumn('datamod', 'Data mod', $this->dataset);
            $column->SetDateTimeFormat('d-m-Y H:i:s');
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for art-dessup field
            //
            $column = new TextViewColumn('art-dessup', 'Art-dessup', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('articoliGrid_art-dessup_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for art-codprod field
            //
            $column = new TextViewColumn('art-codprod', 'Art-codprod', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for art-gruppo-merc field
            //
            $column = new TextViewColumn('art-gruppo-merc', 'Art-gruppo-merc', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for art-categoria-omogenea field
            //
            $column = new TextViewColumn('art-categoria-omogenea', 'Art-categoria-omogenea', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for art-codart field
            //
            $editor = new AutocomleteComboBox('art-codart_edit', $this->CreateLinkBuilder());
            $editor->SetSize('250px');
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $editColumn = new CustomEditColumn('Codice articolo', 'art-codart', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for art-descart field
            //
            $editor = new AutocomleteComboBox('art-descart_edit', $this->CreateLinkBuilder());
            $editor->SetSize('250px');
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $editColumn = new CustomEditColumn('Descrizione', 'art-descart', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for art-codfam field
            //
            $editor = new ComboBox('art-codfam_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new MyPDOConnectionFactory(),
                GetConnectionOptions(),
                '`famiglie`');
            $field = new IntegerField('id', null, null, true);
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new StringField('fam-codfam');
            $lookupDataset->AddField($field, false);
            $field = new StringField('fam-descriz');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('datains');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('datamod');
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('fam-descriz', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Famiglia', 
                'art-codfam', 
                $editor, 
                $this->dataset, 'fam-codfam', 'fam-descriz', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for art-dessup field
            //
            $editor = new TextEdit('art-dessup_edit');
            $editor->SetSize(100);
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Art-dessup', 'art-dessup', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for art-codprod field
            //
            $editor = new TextEdit('art-codprod_edit');
            $editor->SetSize(45);
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Art-codprod', 'art-codprod', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for art-gruppo-merc field
            //
            $editor = new TextEdit('art-gruppo-merc_edit');
            $editor->SetSize(5);
            $editor->SetMaxLength(5);
            $editColumn = new CustomEditColumn('Art-gruppo-merc', 'art-gruppo-merc', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for art-categoria-omogenea field
            //
            $editor = new TextEdit('art-categoria-omogenea_edit');
            $editor->SetSize(5);
            $editor->SetMaxLength(5);
            $editColumn = new CustomEditColumn('Art-categoria-omogenea', 'art-categoria-omogenea', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for art-codart field
            //
            $editor = new AutocomleteComboBox('art-codart_edit', $this->CreateLinkBuilder());
            $editor->SetSize('250px');
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $editColumn = new CustomEditColumn('Codice articolo', 'art-codart', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for art-descart field
            //
            $editor = new AutocomleteComboBox('art-descart_edit', $this->CreateLinkBuilder());
            $editor->SetSize('250px');
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $editColumn = new CustomEditColumn('Descrizione', 'art-descart', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for art-codfam field
            //
            $editor = new ComboBox('art-codfam_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new MyPDOConnectionFactory(),
                GetConnectionOptions(),
                '`famiglie`');
            $field = new IntegerField('id', null, null, true);
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new StringField('fam-codfam');
            $lookupDataset->AddField($field, false);
            $field = new StringField('fam-descriz');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('datains');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('datamod');
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('fam-descriz', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Famiglia', 
                'art-codfam', 
                $editor, 
                $this->dataset, 'fam-codfam', 'fam-descriz', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for art-dessup field
            //
            $editor = new TextEdit('art-dessup_edit');
            $editor->SetSize(100);
            $editor->SetMaxLength(100);
            $editColumn = new CustomEditColumn('Art-dessup', 'art-dessup', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for art-codprod field
            //
            $editor = new TextEdit('art-codprod_edit');
            $editor->SetSize(45);
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Art-codprod', 'art-codprod', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for art-gruppo-merc field
            //
            $editor = new TextEdit('art-gruppo-merc_edit');
            $editor->SetSize(5);
            $editor->SetMaxLength(5);
            $editColumn = new CustomEditColumn('Art-gruppo-merc', 'art-gruppo-merc', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for art-categoria-omogenea field
            //
            $editor = new TextEdit('art-categoria-omogenea_edit');
            $editor->SetSize(5);
            $editor->SetMaxLength(5);
            $editColumn = new CustomEditColumn('Art-categoria-omogenea', 'art-categoria-omogenea', $editor, $this->dataset);
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
            $column = new TextViewColumn('id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for art-codart field
            //
            $column = new TextViewColumn('art-codart', 'Codice articolo', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for art-descart field
            //
            $column = new TextViewColumn('art-descart', 'Art-descart', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for fam-descriz field
            //
            $column = new TextViewColumn('art-codfam_fam-descriz', 'Famiglia', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for art-dessup field
            //
            $column = new TextViewColumn('art-dessup', 'Art-dessup', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for art-codprod field
            //
            $column = new TextViewColumn('art-codprod', 'Art-codprod', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for art-gruppo-merc field
            //
            $column = new TextViewColumn('art-gruppo-merc', 'Art-gruppo-merc', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for art-categoria-omogenea field
            //
            $column = new TextViewColumn('art-categoria-omogenea', 'Art-categoria-omogenea', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for id field
            //
            $column = new TextViewColumn('id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for art-codart field
            //
            $column = new TextViewColumn('art-codart', 'Codice articolo', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for art-descart field
            //
            $column = new TextViewColumn('art-descart', 'Art-descart', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for fam-descriz field
            //
            $column = new TextViewColumn('art-codfam_fam-descriz', 'Famiglia', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for art-dessup field
            //
            $column = new TextViewColumn('art-dessup', 'Art-dessup', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for art-codprod field
            //
            $column = new TextViewColumn('art-codprod', 'Art-codprod', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for art-gruppo-merc field
            //
            $column = new TextViewColumn('art-gruppo-merc', 'Art-gruppo-merc', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for art-categoria-omogenea field
            //
            $column = new TextViewColumn('art-categoria-omogenea', 'Art-categoria-omogenea', $this->dataset);
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
        function articoliGrid_BeforeUpdateRecord($page, &$rowData, &$cancel, &$message, $tableName)
        {
            $date = new DateTime();
            $rowData['datamod'] = $date;
        }
        function articoliGrid_BeforeInsertRecord($page, &$rowData, &$cancel, &$message, $tableName)
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
        
        public function GetModalGridDeleteHandler() { return 'articoli_modal_delete'; }
        protected function GetEnableModalGridDelete() { return true; }
    
        protected function CreateGrid()
        {
            $result = new Grid($this, $this->dataset, 'articoliGrid');
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
            $result->BeforeUpdateRecord->AddListener('articoliGrid' . '_' . 'BeforeUpdateRecord', $this);
            $result->BeforeInsertRecord->AddListener('articoliGrid' . '_' . 'BeforeInsertRecord', $this);
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
            // View column for art-descart field
            //
            $column = new TextViewColumn('art-descart', 'Descrizione', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'articoliGrid_art-descart_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for art-dessup field
            //
            $column = new TextViewColumn('art-dessup', 'Art-dessup', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'articoliGrid_art-dessup_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);//
            // View column for art-descart field
            //
            $column = new TextViewColumn('art-descart', 'Descrizione', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'articoliGrid_art-descart_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            //
            // View column for art-dessup field
            //
            $column = new TextViewColumn('art-dessup', 'Art-dessup', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'articoliGrid_art-dessup_handler_view', $column);
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
        $Page = new articoliPage("articoli.php", "articoli", GetCurrentUserGrantForDataSource("articoli"), 'UTF-8');
        $Page->SetShortCaption('Articoli');
        $Page->SetHeader(GetPagesHeader());
        $Page->SetFooter(GetPagesFooter());
        $Page->SetCaption('Articoli');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("articoli"));
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
	
