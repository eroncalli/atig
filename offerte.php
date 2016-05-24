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

    
    
    // OnBeforePageExecute event handler
    
    
    
    class offerte_dettaglio_articoliDetailView0offertePage extends DetailPage
    {
        protected function DoBeforeCreate()
        {
            $this->dataset = new TableDataset(
                new MyPDOConnectionFactory(),
                GetConnectionOptions(),
                '`offerte_dettaglio_articoli`');
            $field = new IntegerField('id', null, null, true);
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, true);
            $field = new IntegerField('ofa-offid');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, false);
            $field = new IntegerField('ofa-numoff');
            $this->dataset->AddField($field, false);
            $field = new StringField('ofa-codart');
            $this->dataset->AddField($field, false);
            $field = new StringField('ofa-descart');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('ofa-lungsmu');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('ofa-moltipl');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('ofa-oneriacc');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('ofa-scarto');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('ofa-lunghezza');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('ofa-larghezza');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('ofa-spessore');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('ofa-quantita');
            $this->dataset->AddField($field, false);
            $field = new StringField('ofa-unimis');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('ofa-przacq-net');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('ofa-przacq-lor');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('ofa-totuni');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('ofa-totunit-fin');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('ofa-totgen');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('ofa-przven');
            $this->dataset->AddField($field, false);
            $field = new DateTimeField('datains');
            $this->dataset->AddField($field, false);
            $field = new DateTimeField('datamod');
            $this->dataset->AddField($field, false);
        }
    
        protected function DoPrepare() {
    
        }
    
        protected function AddFieldColumns(Grid $grid)
        {
            //
            // View column for ofa-numoff field
            //
            $column = new TextViewColumn('ofa-numoff', 'Ofa-numoff', $this->dataset);
            $column->SetOrderable(false);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ofa-codart field
            //
            $column = new TextViewColumn('ofa-codart', 'Ofa-codart', $this->dataset);
            $column->SetOrderable(false);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ofa-descart field
            //
            $column = new TextViewColumn('ofa-descart', 'Ofa-descart', $this->dataset);
            $column->SetOrderable(false);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ofa-lungsmu field
            //
            $column = new TextViewColumn('ofa-lungsmu', 'Ofa-lungsmu', $this->dataset);
            $column->SetOrderable(false);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ofa-moltipl field
            //
            $column = new TextViewColumn('ofa-moltipl', 'Ofa-moltipl', $this->dataset);
            $column->SetOrderable(false);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ofa-oneriacc field
            //
            $column = new TextViewColumn('ofa-oneriacc', 'Ofa-oneriacc', $this->dataset);
            $column->SetOrderable(false);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ofa-scarto field
            //
            $column = new TextViewColumn('ofa-scarto', 'Ofa-scarto', $this->dataset);
            $column->SetOrderable(false);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ofa-lunghezza field
            //
            $column = new TextViewColumn('ofa-lunghezza', 'Ofa-lunghezza', $this->dataset);
            $column->SetOrderable(false);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ofa-larghezza field
            //
            $column = new TextViewColumn('ofa-larghezza', 'Ofa-larghezza', $this->dataset);
            $column->SetOrderable(false);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ofa-spessore field
            //
            $column = new TextViewColumn('ofa-spessore', 'Ofa-spessore', $this->dataset);
            $column->SetOrderable(false);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ofa-quantita field
            //
            $column = new TextViewColumn('ofa-quantita', 'Ofa-quantita', $this->dataset);
            $column->SetOrderable(false);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ofa-unimis field
            //
            $column = new TextViewColumn('ofa-unimis', 'Ofa-unimis', $this->dataset);
            $column->SetOrderable(false);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ofa-przacq-net field
            //
            $column = new TextViewColumn('ofa-przacq-net', 'Ofa-przacq-net', $this->dataset);
            $column->SetOrderable(false);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ofa-przacq-lor field
            //
            $column = new TextViewColumn('ofa-przacq-lor', 'Ofa-przacq-lor', $this->dataset);
            $column->SetOrderable(false);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ofa-totuni field
            //
            $column = new TextViewColumn('ofa-totuni', 'Ofa-totuni', $this->dataset);
            $column->SetOrderable(false);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ofa-totunit-fin field
            //
            $column = new TextViewColumn('ofa-totunit-fin', 'Ofa-totunit-fin', $this->dataset);
            $column->SetOrderable(false);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ofa-totgen field
            //
            $column = new TextViewColumn('ofa-totgen', 'Ofa-totgen', $this->dataset);
            $column->SetOrderable(false);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ofa-przven field
            //
            $column = new TextViewColumn('ofa-przven', 'Ofa-przven', $this->dataset);
            $column->SetOrderable(false);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
        
        function GetCustomClientScript()
        {
            return ;
        }
        
        function GetOnPageLoadedClientScript()
        {
            return ;
        }
    
        public function GetPageDirection()
        {
            return null;
        }
    
        protected function ApplyCommonColumnEditProperties(CustomEditColumn $column)
        {
            $column->SetDisplaySetToNullCheckBox(false);
            $column->SetDisplaySetToDefaultCheckBox(false);
        }
    
        protected function CreateGrid()
        {
            $result = new Grid($this, $this->dataset, 'offerte_dettaglio_articoliDetailViewGrid0offerte');
            $result->SetAllowDeleteSelected(false);
            $result->SetUseFixedHeader(false);
            $result->SetShowLineNumbers(true);
            
            $result->SetAllowOrdering(false);
            
            $result->SetHighlightRowAtHover(false);
            $result->SetWidth('');
            $this->AddFieldColumns($result);
    
            return $result;
        }
    }
    
    
    
    // OnBeforePageExecute event handler
    
    
    
    class offerte_dettaglio_articoliDetailEdit0offertePage extends DetailPageEdit
    {
        protected function DoBeforeCreate()
        {
            $this->dataset = new TableDataset(
                new MyPDOConnectionFactory(),
                GetConnectionOptions(),
                '`offerte_dettaglio_articoli`');
            $field = new IntegerField('id', null, null, true);
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, true);
            $field = new IntegerField('ofa-offid');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, false);
            $field = new IntegerField('ofa-numoff');
            $this->dataset->AddField($field, false);
            $field = new StringField('ofa-codart');
            $this->dataset->AddField($field, false);
            $field = new StringField('ofa-descart');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('ofa-lungsmu');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('ofa-moltipl');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('ofa-oneriacc');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('ofa-scarto');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('ofa-lunghezza');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('ofa-larghezza');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('ofa-spessore');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('ofa-quantita');
            $this->dataset->AddField($field, false);
            $field = new StringField('ofa-unimis');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('ofa-przacq-net');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('ofa-przacq-lor');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('ofa-totuni');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('ofa-totunit-fin');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('ofa-totgen');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('ofa-przven');
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
            return null;
        }
    
        public function GetPageList()
        {
            return null;
        }
    
        protected function CreateRssGenerator()
        {
            return null;
        }
    
        protected function CreateGridSearchControl(Grid $grid)
        {
            $grid->UseFilter = true;
            $grid->SearchControl = new SimpleSearch('offerte_dettaglio_articoliDetailEdit0offertessearch', $this->dataset,
                array('ofa-numoff', 'ofa-codart', 'ofa-descart', 'ofa-lungsmu', 'ofa-moltipl', 'ofa-oneriacc', 'ofa-scarto', 'ofa-lunghezza', 'ofa-larghezza', 'ofa-spessore', 'ofa-quantita', 'ofa-unimis', 'ofa-przacq-net', 'ofa-przacq-lor', 'ofa-totuni', 'ofa-totunit-fin', 'ofa-totgen', 'ofa-przven'),
                array($this->RenderText('Ofa-numoff'), $this->RenderText('Ofa-codart'), $this->RenderText('Ofa-descart'), $this->RenderText('Ofa-lungsmu'), $this->RenderText('Ofa-moltipl'), $this->RenderText('Ofa-oneriacc'), $this->RenderText('Ofa-scarto'), $this->RenderText('Ofa-lunghezza'), $this->RenderText('Ofa-larghezza'), $this->RenderText('Ofa-spessore'), $this->RenderText('Ofa-quantita'), $this->RenderText('Ofa-unimis'), $this->RenderText('Ofa-przacq-net'), $this->RenderText('Ofa-przacq-lor'), $this->RenderText('Ofa-totuni'), $this->RenderText('Ofa-totunit-fin'), $this->RenderText('Ofa-totgen'), $this->RenderText('Ofa-przven')),
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
            $this->AdvancedSearchControl = new AdvancedSearchControl('offerte_dettaglio_articoliDetailEdit0offerteasearch', $this->dataset, $this->GetLocalizerCaptions(), $this->GetColumnVariableContainer(), $this->CreateLinkBuilder());
            $this->AdvancedSearchControl->setTimerInterval(1000);
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('ofa-numoff', $this->RenderText('Ofa-numoff')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('ofa-codart', $this->RenderText('Ofa-codart')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('ofa-descart', $this->RenderText('Ofa-descart')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('ofa-lungsmu', $this->RenderText('Ofa-lungsmu')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('ofa-moltipl', $this->RenderText('Ofa-moltipl')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('ofa-oneriacc', $this->RenderText('Ofa-oneriacc')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('ofa-scarto', $this->RenderText('Ofa-scarto')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('ofa-lunghezza', $this->RenderText('Ofa-lunghezza')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('ofa-larghezza', $this->RenderText('Ofa-larghezza')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('ofa-spessore', $this->RenderText('Ofa-spessore')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('ofa-quantita', $this->RenderText('Ofa-quantita')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('ofa-unimis', $this->RenderText('Ofa-unimis')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('ofa-przacq-net', $this->RenderText('Ofa-przacq-net')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('ofa-przacq-lor', $this->RenderText('Ofa-przacq-lor')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('ofa-totuni', $this->RenderText('Ofa-totuni')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('ofa-totunit-fin', $this->RenderText('Ofa-totunit-fin')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('ofa-totgen', $this->RenderText('Ofa-totgen')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('ofa-przven', $this->RenderText('Ofa-przven')));
        }
    
        public function GetPageDirection()
        {
            return null;
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
        }
    
        protected function AddFieldColumns(Grid $grid)
        {
            //
            // View column for ofa-numoff field
            //
            $column = new TextViewColumn('ofa-numoff', 'Ofa-numoff', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ofa-codart field
            //
            $column = new TextViewColumn('ofa-codart', 'Ofa-codart', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ofa-descart field
            //
            $column = new TextViewColumn('ofa-descart', 'Ofa-descart', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ofa-lungsmu field
            //
            $column = new TextViewColumn('ofa-lungsmu', 'Ofa-lungsmu', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ofa-moltipl field
            //
            $column = new TextViewColumn('ofa-moltipl', 'Ofa-moltipl', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ofa-oneriacc field
            //
            $column = new TextViewColumn('ofa-oneriacc', 'Ofa-oneriacc', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ofa-scarto field
            //
            $column = new TextViewColumn('ofa-scarto', 'Ofa-scarto', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ofa-lunghezza field
            //
            $column = new TextViewColumn('ofa-lunghezza', 'Ofa-lunghezza', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ofa-larghezza field
            //
            $column = new TextViewColumn('ofa-larghezza', 'Ofa-larghezza', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ofa-spessore field
            //
            $column = new TextViewColumn('ofa-spessore', 'Ofa-spessore', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ofa-quantita field
            //
            $column = new TextViewColumn('ofa-quantita', 'Ofa-quantita', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ofa-unimis field
            //
            $column = new TextViewColumn('ofa-unimis', 'Ofa-unimis', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ofa-przacq-net field
            //
            $column = new TextViewColumn('ofa-przacq-net', 'Ofa-przacq-net', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ofa-przacq-lor field
            //
            $column = new TextViewColumn('ofa-przacq-lor', 'Ofa-przacq-lor', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ofa-totuni field
            //
            $column = new TextViewColumn('ofa-totuni', 'Ofa-totuni', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ofa-totunit-fin field
            //
            $column = new TextViewColumn('ofa-totunit-fin', 'Ofa-totunit-fin', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ofa-totgen field
            //
            $column = new TextViewColumn('ofa-totgen', 'Ofa-totgen', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ofa-przven field
            //
            $column = new TextViewColumn('ofa-przven', 'Ofa-przven', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for ofa-numoff field
            //
            $column = new TextViewColumn('ofa-numoff', 'Ofa-numoff', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ofa-codart field
            //
            $column = new TextViewColumn('ofa-codart', 'Ofa-codart', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ofa-descart field
            //
            $column = new TextViewColumn('ofa-descart', 'Ofa-descart', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ofa-lungsmu field
            //
            $column = new TextViewColumn('ofa-lungsmu', 'Ofa-lungsmu', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ofa-moltipl field
            //
            $column = new TextViewColumn('ofa-moltipl', 'Ofa-moltipl', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ofa-oneriacc field
            //
            $column = new TextViewColumn('ofa-oneriacc', 'Ofa-oneriacc', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ofa-scarto field
            //
            $column = new TextViewColumn('ofa-scarto', 'Ofa-scarto', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ofa-lunghezza field
            //
            $column = new TextViewColumn('ofa-lunghezza', 'Ofa-lunghezza', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ofa-larghezza field
            //
            $column = new TextViewColumn('ofa-larghezza', 'Ofa-larghezza', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ofa-spessore field
            //
            $column = new TextViewColumn('ofa-spessore', 'Ofa-spessore', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ofa-quantita field
            //
            $column = new TextViewColumn('ofa-quantita', 'Ofa-quantita', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ofa-unimis field
            //
            $column = new TextViewColumn('ofa-unimis', 'Ofa-unimis', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ofa-przacq-net field
            //
            $column = new TextViewColumn('ofa-przacq-net', 'Ofa-przacq-net', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ofa-przacq-lor field
            //
            $column = new TextViewColumn('ofa-przacq-lor', 'Ofa-przacq-lor', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ofa-totuni field
            //
            $column = new TextViewColumn('ofa-totuni', 'Ofa-totuni', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ofa-totunit-fin field
            //
            $column = new TextViewColumn('ofa-totunit-fin', 'Ofa-totunit-fin', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ofa-totgen field
            //
            $column = new TextViewColumn('ofa-totgen', 'Ofa-totgen', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ofa-przven field
            //
            $column = new TextViewColumn('ofa-przven', 'Ofa-przven', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for ofa-numoff field
            //
            $editor = new TextEdit('ofa-numoff_edit');
            $editColumn = new CustomEditColumn('Ofa-numoff', 'ofa-numoff', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ofa-codart field
            //
            $editor = new TextEdit('ofa-codart_edit');
            $editor->SetSize(20);
            $editor->SetMaxLength(20);
            $editColumn = new CustomEditColumn('Ofa-codart', 'ofa-codart', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ofa-descart field
            //
            $editor = new TextEdit('ofa-descart_edit');
            $editor->SetSize(45);
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Ofa-descart', 'ofa-descart', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ofa-lungsmu field
            //
            $editor = new TextEdit('ofa-lungsmu_edit');
            $editColumn = new CustomEditColumn('Ofa-lungsmu', 'ofa-lungsmu', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ofa-moltipl field
            //
            $editor = new TextEdit('ofa-moltipl_edit');
            $editColumn = new CustomEditColumn('Ofa-moltipl', 'ofa-moltipl', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ofa-oneriacc field
            //
            $editor = new TextEdit('ofa-oneriacc_edit');
            $editColumn = new CustomEditColumn('Ofa-oneriacc', 'ofa-oneriacc', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ofa-scarto field
            //
            $editor = new TextEdit('ofa-scarto_edit');
            $editColumn = new CustomEditColumn('Ofa-scarto', 'ofa-scarto', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ofa-lunghezza field
            //
            $editor = new TextEdit('ofa-lunghezza_edit');
            $editColumn = new CustomEditColumn('Ofa-lunghezza', 'ofa-lunghezza', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ofa-larghezza field
            //
            $editor = new TextEdit('ofa-larghezza_edit');
            $editColumn = new CustomEditColumn('Ofa-larghezza', 'ofa-larghezza', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ofa-spessore field
            //
            $editor = new TextEdit('ofa-spessore_edit');
            $editColumn = new CustomEditColumn('Ofa-spessore', 'ofa-spessore', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ofa-quantita field
            //
            $editor = new TextEdit('ofa-quantita_edit');
            $editColumn = new CustomEditColumn('Ofa-quantita', 'ofa-quantita', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ofa-unimis field
            //
            $editor = new TextEdit('ofa-unimis_edit');
            $editor->SetSize(3);
            $editor->SetMaxLength(3);
            $editColumn = new CustomEditColumn('Ofa-unimis', 'ofa-unimis', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ofa-przacq-net field
            //
            $editor = new TextEdit('ofa-przacq-net_edit');
            $editColumn = new CustomEditColumn('Ofa-przacq-net', 'ofa-przacq-net', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ofa-przacq-lor field
            //
            $editor = new TextEdit('ofa-przacq-lor_edit');
            $editColumn = new CustomEditColumn('Ofa-przacq-lor', 'ofa-przacq-lor', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ofa-totuni field
            //
            $editor = new TextEdit('ofa-totuni_edit');
            $editColumn = new CustomEditColumn('Ofa-totuni', 'ofa-totuni', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ofa-totunit-fin field
            //
            $editor = new TextEdit('ofa-totunit-fin_edit');
            $editColumn = new CustomEditColumn('Ofa-totunit-fin', 'ofa-totunit-fin', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ofa-totgen field
            //
            $editor = new TextEdit('ofa-totgen_edit');
            $editColumn = new CustomEditColumn('Ofa-totgen', 'ofa-totgen', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ofa-przven field
            //
            $editor = new TextEdit('ofa-przven_edit');
            $editColumn = new CustomEditColumn('Ofa-przven', 'ofa-przven', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for ofa-numoff field
            //
            $editor = new TextEdit('ofa-numoff_edit');
            $editColumn = new CustomEditColumn('Ofa-numoff', 'ofa-numoff', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ofa-codart field
            //
            $editor = new TextEdit('ofa-codart_edit');
            $editor->SetSize(20);
            $editor->SetMaxLength(20);
            $editColumn = new CustomEditColumn('Ofa-codart', 'ofa-codart', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ofa-descart field
            //
            $editor = new TextEdit('ofa-descart_edit');
            $editor->SetSize(45);
            $editor->SetMaxLength(45);
            $editColumn = new CustomEditColumn('Ofa-descart', 'ofa-descart', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ofa-lungsmu field
            //
            $editor = new TextEdit('ofa-lungsmu_edit');
            $editColumn = new CustomEditColumn('Ofa-lungsmu', 'ofa-lungsmu', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ofa-moltipl field
            //
            $editor = new TextEdit('ofa-moltipl_edit');
            $editColumn = new CustomEditColumn('Ofa-moltipl', 'ofa-moltipl', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ofa-oneriacc field
            //
            $editor = new TextEdit('ofa-oneriacc_edit');
            $editColumn = new CustomEditColumn('Ofa-oneriacc', 'ofa-oneriacc', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ofa-scarto field
            //
            $editor = new TextEdit('ofa-scarto_edit');
            $editColumn = new CustomEditColumn('Ofa-scarto', 'ofa-scarto', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ofa-lunghezza field
            //
            $editor = new TextEdit('ofa-lunghezza_edit');
            $editColumn = new CustomEditColumn('Ofa-lunghezza', 'ofa-lunghezza', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ofa-larghezza field
            //
            $editor = new TextEdit('ofa-larghezza_edit');
            $editColumn = new CustomEditColumn('Ofa-larghezza', 'ofa-larghezza', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ofa-spessore field
            //
            $editor = new TextEdit('ofa-spessore_edit');
            $editColumn = new CustomEditColumn('Ofa-spessore', 'ofa-spessore', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ofa-quantita field
            //
            $editor = new TextEdit('ofa-quantita_edit');
            $editColumn = new CustomEditColumn('Ofa-quantita', 'ofa-quantita', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ofa-unimis field
            //
            $editor = new TextEdit('ofa-unimis_edit');
            $editor->SetSize(3);
            $editor->SetMaxLength(3);
            $editColumn = new CustomEditColumn('Ofa-unimis', 'ofa-unimis', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ofa-przacq-net field
            //
            $editor = new TextEdit('ofa-przacq-net_edit');
            $editColumn = new CustomEditColumn('Ofa-przacq-net', 'ofa-przacq-net', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ofa-przacq-lor field
            //
            $editor = new TextEdit('ofa-przacq-lor_edit');
            $editColumn = new CustomEditColumn('Ofa-przacq-lor', 'ofa-przacq-lor', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ofa-totuni field
            //
            $editor = new TextEdit('ofa-totuni_edit');
            $editColumn = new CustomEditColumn('Ofa-totuni', 'ofa-totuni', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ofa-totunit-fin field
            //
            $editor = new TextEdit('ofa-totunit-fin_edit');
            $editColumn = new CustomEditColumn('Ofa-totunit-fin', 'ofa-totunit-fin', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ofa-totgen field
            //
            $editor = new TextEdit('ofa-totgen_edit');
            $editColumn = new CustomEditColumn('Ofa-totgen', 'ofa-totgen', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ofa-przven field
            //
            $editor = new TextEdit('ofa-przven_edit');
            $editColumn = new CustomEditColumn('Ofa-przven', 'ofa-przven', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            if ($this->GetSecurityInfo()->HasAddGrant())
            {
                $grid->SetShowAddButton(false);
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
            // View column for ofa-numoff field
            //
            $column = new TextViewColumn('ofa-numoff', 'Ofa-numoff', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for ofa-codart field
            //
            $column = new TextViewColumn('ofa-codart', 'Ofa-codart', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for ofa-descart field
            //
            $column = new TextViewColumn('ofa-descart', 'Ofa-descart', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for ofa-lungsmu field
            //
            $column = new TextViewColumn('ofa-lungsmu', 'Ofa-lungsmu', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $grid->AddPrintColumn($column);
            
            //
            // View column for ofa-moltipl field
            //
            $column = new TextViewColumn('ofa-moltipl', 'Ofa-moltipl', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for ofa-oneriacc field
            //
            $column = new TextViewColumn('ofa-oneriacc', 'Ofa-oneriacc', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $grid->AddPrintColumn($column);
            
            //
            // View column for ofa-scarto field
            //
            $column = new TextViewColumn('ofa-scarto', 'Ofa-scarto', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $grid->AddPrintColumn($column);
            
            //
            // View column for ofa-lunghezza field
            //
            $column = new TextViewColumn('ofa-lunghezza', 'Ofa-lunghezza', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $grid->AddPrintColumn($column);
            
            //
            // View column for ofa-larghezza field
            //
            $column = new TextViewColumn('ofa-larghezza', 'Ofa-larghezza', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $grid->AddPrintColumn($column);
            
            //
            // View column for ofa-spessore field
            //
            $column = new TextViewColumn('ofa-spessore', 'Ofa-spessore', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $grid->AddPrintColumn($column);
            
            //
            // View column for ofa-quantita field
            //
            $column = new TextViewColumn('ofa-quantita', 'Ofa-quantita', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for ofa-unimis field
            //
            $column = new TextViewColumn('ofa-unimis', 'Ofa-unimis', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for ofa-przacq-net field
            //
            $column = new TextViewColumn('ofa-przacq-net', 'Ofa-przacq-net', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $grid->AddPrintColumn($column);
            
            //
            // View column for ofa-przacq-lor field
            //
            $column = new TextViewColumn('ofa-przacq-lor', 'Ofa-przacq-lor', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $grid->AddPrintColumn($column);
            
            //
            // View column for ofa-totuni field
            //
            $column = new TextViewColumn('ofa-totuni', 'Ofa-totuni', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $grid->AddPrintColumn($column);
            
            //
            // View column for ofa-totunit-fin field
            //
            $column = new TextViewColumn('ofa-totunit-fin', 'Ofa-totunit-fin', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $grid->AddPrintColumn($column);
            
            //
            // View column for ofa-totgen field
            //
            $column = new TextViewColumn('ofa-totgen', 'Ofa-totgen', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $grid->AddPrintColumn($column);
            
            //
            // View column for ofa-przven field
            //
            $column = new TextViewColumn('ofa-przven', 'Ofa-przven', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for ofa-numoff field
            //
            $column = new TextViewColumn('ofa-numoff', 'Ofa-numoff', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for ofa-codart field
            //
            $column = new TextViewColumn('ofa-codart', 'Ofa-codart', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for ofa-descart field
            //
            $column = new TextViewColumn('ofa-descart', 'Ofa-descart', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for ofa-lungsmu field
            //
            $column = new TextViewColumn('ofa-lungsmu', 'Ofa-lungsmu', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $grid->AddExportColumn($column);
            
            //
            // View column for ofa-moltipl field
            //
            $column = new TextViewColumn('ofa-moltipl', 'Ofa-moltipl', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for ofa-oneriacc field
            //
            $column = new TextViewColumn('ofa-oneriacc', 'Ofa-oneriacc', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $grid->AddExportColumn($column);
            
            //
            // View column for ofa-scarto field
            //
            $column = new TextViewColumn('ofa-scarto', 'Ofa-scarto', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $grid->AddExportColumn($column);
            
            //
            // View column for ofa-lunghezza field
            //
            $column = new TextViewColumn('ofa-lunghezza', 'Ofa-lunghezza', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $grid->AddExportColumn($column);
            
            //
            // View column for ofa-larghezza field
            //
            $column = new TextViewColumn('ofa-larghezza', 'Ofa-larghezza', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $grid->AddExportColumn($column);
            
            //
            // View column for ofa-spessore field
            //
            $column = new TextViewColumn('ofa-spessore', 'Ofa-spessore', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $grid->AddExportColumn($column);
            
            //
            // View column for ofa-quantita field
            //
            $column = new TextViewColumn('ofa-quantita', 'Ofa-quantita', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for ofa-unimis field
            //
            $column = new TextViewColumn('ofa-unimis', 'Ofa-unimis', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for ofa-przacq-net field
            //
            $column = new TextViewColumn('ofa-przacq-net', 'Ofa-przacq-net', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $grid->AddExportColumn($column);
            
            //
            // View column for ofa-przacq-lor field
            //
            $column = new TextViewColumn('ofa-przacq-lor', 'Ofa-przacq-lor', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $grid->AddExportColumn($column);
            
            //
            // View column for ofa-totuni field
            //
            $column = new TextViewColumn('ofa-totuni', 'Ofa-totuni', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $grid->AddExportColumn($column);
            
            //
            // View column for ofa-totunit-fin field
            //
            $column = new TextViewColumn('ofa-totunit-fin', 'Ofa-totunit-fin', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $grid->AddExportColumn($column);
            
            //
            // View column for ofa-totgen field
            //
            $column = new TextViewColumn('ofa-totgen', 'Ofa-totgen', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $grid->AddExportColumn($column);
            
            //
            // View column for ofa-przven field
            //
            $column = new TextViewColumn('ofa-przven', 'Ofa-przven', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $grid->AddExportColumn($column);
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
    
        protected function CreateGrid()
        {
            $result = new Grid($this, $this->dataset, 'offerte_dettaglio_articoliDetailEditGrid0offerte');
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
            $field = new IntegerField('off-gg-termine-consegna');
            $field->SetIsNotNull(true);
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
            $field->SetIsNotNull(true);
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
            if (GetCurrentUserGrantForDataSource('offerte')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Offerte'), 'offerte.php', $this->RenderText('Offerte'), $currentPageCaption == $this->RenderText('Offerte'), false, $this->RenderText('Default')));
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
                array('off-numoff', 'off-codcli_cli-ragsoc', 'off-descriz', 'off-gg-termine-consegna', 'off-datains', 'off-dataeva', 'datains'),
                array($this->RenderText('Off-numoff'), $this->RenderText('cod.Cliente'), $this->RenderText('Off-descriz'), $this->RenderText('Off-gg-termine-consegna'), $this->RenderText('Data inserimento'), $this->RenderText('Data evasione'), $this->RenderText('Data ins')),
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
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('off-numoff', $this->RenderText('Off-numoff')));
            
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
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateLookupSearchInput('off-codcli', $this->RenderText('cod.Cliente'), $lookupDataset, 'cli-codcli', 'cli-ragsoc', false, 8));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('off-descriz', $this->RenderText('Off-descriz')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('off-gg-termine-consegna', $this->RenderText('Off-gg-termine-consegna')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateDateTimeSearchInput('off-datains', $this->RenderText('Data inserimento'), 'd-m-Y'));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateDateTimeSearchInput('off-dataeva', $this->RenderText('Data evasione'), 'd-m-Y'));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateDateTimeSearchInput('datains', $this->RenderText('Data ins'), 'd-m-Y'));
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
        }
    
        protected function AddFieldColumns(Grid $grid)
        {
            if (GetCurrentUserGrantForDataSource('offerte.offerte_dettaglio_articoli')->HasViewGrant())
            {
              //
            // View column for offerte_dettaglio_articoliDetailView0offerte detail
            //
            $column = new DetailColumn(array('id'), 'detail0offerte', 'offerte_dettaglio_articoliDetailEdit0offerte_handler', 'offerte_dettaglio_articoliDetailView0offerte_handler', $this->dataset, 'Offerte Dettaglio Articoli', $this->RenderText('Offerte Dettaglio Articoli'));
              $grid->AddViewColumn($column);
            }
            
            //
            // View column for off-numoff field
            //
            $column = new TextViewColumn('off-numoff', 'Off-numoff', $this->dataset);
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
            // View column for off-descriz field
            //
            $column = new TextViewColumn('off-descriz', 'Off-descriz', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for off-gg-termine-consegna field
            //
            $column = new TextViewColumn('off-gg-termine-consegna', 'Off-gg-termine-consegna', $this->dataset);
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
            
            //
            // View column for datains field
            //
            $column = new DateTimeViewColumn('datains', 'Data ins', $this->dataset);
            $column->SetDateTimeFormat('d-m-Y');
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for off-numoff field
            //
            $column = new TextViewColumn('off-numoff', 'Off-numoff', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for cli-ragsoc field
            //
            $column = new TextViewColumn('off-codcli_cli-ragsoc', 'cod.Cliente', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for off-descriz field
            //
            $column = new TextViewColumn('off-descriz', 'Off-descriz', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for off-gg-termine-consegna field
            //
            $column = new TextViewColumn('off-gg-termine-consegna', 'Off-gg-termine-consegna', $this->dataset);
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
            // Edit column for off-numoff field
            //
            $editor = new TextEdit('off-numoff_edit');
            $editColumn = new CustomEditColumn('Off-numoff', 'off-numoff', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
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
            $editColumn = new LookUpEditColumn(
                'cod.Cliente', 
                'off-codcli', 
                $editor, 
                $this->dataset, 'cli-codcli', 'cli-ragsoc', $lookupDataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for off-descriz field
            //
            $editor = new TextEdit('off-descriz_edit');
            $editor->SetSize(50);
            $editor->SetMaxLength(50);
            $editColumn = new CustomEditColumn('Off-descriz', 'off-descriz', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for off-gg-termine-consegna field
            //
            $editor = new TextEdit('off-gg-termine-consegna_edit');
            $editColumn = new CustomEditColumn('Off-gg-termine-consegna', 'off-gg-termine-consegna', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
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
            
            //
            // Edit column for datains field
            //
            $editor = new DateTimeEdit('datains_edit', false, 'd-m-Y', GetFirstDayOfWeek());
            $editColumn = new CustomEditColumn('Data ins', 'datains', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for off-numoff field
            //
            $editor = new TextEdit('off-numoff_edit');
            $editColumn = new CustomEditColumn('Off-numoff', 'off-numoff', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
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
            $editColumn = new LookUpEditColumn(
                'cod.Cliente', 
                'off-codcli', 
                $editor, 
                $this->dataset, 'cli-codcli', 'cli-ragsoc', $lookupDataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for off-descriz field
            //
            $editor = new TextEdit('off-descriz_edit');
            $editor->SetSize(50);
            $editor->SetMaxLength(50);
            $editColumn = new CustomEditColumn('Off-descriz', 'off-descriz', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for off-gg-termine-consegna field
            //
            $editor = new TextEdit('off-gg-termine-consegna_edit');
            $editColumn = new CustomEditColumn('Off-gg-termine-consegna', 'off-gg-termine-consegna', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
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
            
            //
            // Edit column for datains field
            //
            $editor = new DateTimeEdit('datains_edit', false, 'd-m-Y', GetFirstDayOfWeek());
            $editColumn = new CustomEditColumn('Data ins', 'datains', $editor, $this->dataset);
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
            // View column for off-numoff field
            //
            $column = new TextViewColumn('off-numoff', 'Off-numoff', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for cli-ragsoc field
            //
            $column = new TextViewColumn('off-codcli_cli-ragsoc', 'cod.Cliente', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for off-descriz field
            //
            $column = new TextViewColumn('off-descriz', 'Off-descriz', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for off-gg-termine-consegna field
            //
            $column = new TextViewColumn('off-gg-termine-consegna', 'Off-gg-termine-consegna', $this->dataset);
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
            
            //
            // View column for datains field
            //
            $column = new DateTimeViewColumn('datains', 'Data ins', $this->dataset);
            $column->SetDateTimeFormat('d-m-Y');
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for off-numoff field
            //
            $column = new TextViewColumn('off-numoff', 'Off-numoff', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for cli-ragsoc field
            //
            $column = new TextViewColumn('off-codcli_cli-ragsoc', 'cod.Cliente', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for off-descriz field
            //
            $column = new TextViewColumn('off-descriz', 'Off-descriz', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for off-gg-termine-consegna field
            //
            $column = new TextViewColumn('off-gg-termine-consegna', 'Off-gg-termine-consegna', $this->dataset);
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
            
            //
            // View column for datains field
            //
            $column = new DateTimeViewColumn('datains', 'Data ins', $this->dataset);
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
    
        function CreateMasterDetailRecordGridForofferte_dettaglio_articoliDetailEdit0offerteGrid()
        {
            $result = new Grid($this, $this->dataset, 'MasterDetailRecordGridForofferte_dettaglio_articoliDetailEdit0offerte');
            $result->SetAllowDeleteSelected(false);
            $result->SetShowFilterBuilder(false);
            $result->SetAdvancedSearchAvailable(false);
            $result->SetFilterRowAvailable(false);
            $result->SetShowUpdateLink(false);
            $result->SetEnabledInlineEditing(false);
            $result->SetShowKeyColumnsImagesInHeader(false);
            $result->SetName('master_grid');
            //
            // View column for off-numoff field
            //
            $column = new TextViewColumn('off-numoff', 'Off-numoff', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for cli-ragsoc field
            //
            $column = new TextViewColumn('off-codcli_cli-ragsoc', 'cod.Cliente', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for off-descriz field
            //
            $column = new TextViewColumn('off-descriz', 'Off-descriz', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for off-gg-termine-consegna field
            //
            $column = new TextViewColumn('off-gg-termine-consegna', 'Off-gg-termine-consegna', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for off-datains field
            //
            $column = new DateTimeViewColumn('off-datains', 'Data inserimento', $this->dataset);
            $column->SetDateTimeFormat('d-m-Y');
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for off-dataeva field
            //
            $column = new DateTimeViewColumn('off-dataeva', 'Data evasione', $this->dataset);
            $column->SetDateTimeFormat('d-m-Y');
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for datains field
            //
            $column = new DateTimeViewColumn('datains', 'Data ins', $this->dataset);
            $column->SetDateTimeFormat('d-m-Y');
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $result->AddViewColumn($column);
            
            //
            // View column for off-numoff field
            //
            $column = new TextViewColumn('off-numoff', 'Off-numoff', $this->dataset);
            $column->SetOrderable(true);
            $result->AddPrintColumn($column);
            
            //
            // View column for cli-ragsoc field
            //
            $column = new TextViewColumn('off-codcli_cli-ragsoc', 'cod.Cliente', $this->dataset);
            $column->SetOrderable(true);
            $result->AddPrintColumn($column);
            
            //
            // View column for off-descriz field
            //
            $column = new TextViewColumn('off-descriz', 'Off-descriz', $this->dataset);
            $column->SetOrderable(true);
            $result->AddPrintColumn($column);
            
            //
            // View column for off-gg-termine-consegna field
            //
            $column = new TextViewColumn('off-gg-termine-consegna', 'Off-gg-termine-consegna', $this->dataset);
            $column->SetOrderable(true);
            $result->AddPrintColumn($column);
            
            //
            // View column for off-datains field
            //
            $column = new DateTimeViewColumn('off-datains', 'Data inserimento', $this->dataset);
            $column->SetDateTimeFormat('d-m-Y');
            $column->SetOrderable(true);
            $result->AddPrintColumn($column);
            
            //
            // View column for off-dataeva field
            //
            $column = new DateTimeViewColumn('off-dataeva', 'Data evasione', $this->dataset);
            $column->SetDateTimeFormat('d-m-Y');
            $column->SetOrderable(true);
            $result->AddPrintColumn($column);
            
            //
            // View column for datains field
            //
            $column = new DateTimeViewColumn('datains', 'Data ins', $this->dataset);
            $column->SetDateTimeFormat('d-m-Y');
            $column->SetOrderable(true);
            $result->AddPrintColumn($column);
            
            return $result;
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
            $pageView = new offerte_dettaglio_articoliDetailView0offertePage($this, 'Offerte Dettaglio Articoli', 'Offerte Dettaglio Articoli', array('ofa-offid'), GetCurrentUserGrantForDataSource('offerte.offerte_dettaglio_articoli'), 'UTF-8', 20, 'offerte_dettaglio_articoliDetailEdit0offerte_handler');
            
            $pageView->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource('offerte.offerte_dettaglio_articoli'));
            $handler = new PageHTTPHandler('offerte_dettaglio_articoliDetailView0offerte_handler', $pageView);
            GetApplication()->RegisterHTTPHandler($handler);
            $pageEdit = new offerte_dettaglio_articoliDetailEdit0offertePage($this, array('ofa-offid'), array('id'), $this->GetForeingKeyFields(), $this->CreateMasterDetailRecordGridForofferte_dettaglio_articoliDetailEdit0offerteGrid(), $this->dataset, GetCurrentUserGrantForDataSource('offerte.offerte_dettaglio_articoli'), 'UTF-8');
            
            $pageEdit->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource('offerte.offerte_dettaglio_articoli'));
            $pageEdit->SetShortCaption('Offerte Dettaglio Articoli');
            $pageEdit->SetHeader(GetPagesHeader());
            $pageEdit->SetFooter(GetPagesFooter());
            $pageEdit->SetCaption('Offerte Dettaglio Articoli');
            $pageEdit->SetHttpHandlerName('offerte_dettaglio_articoliDetailEdit0offerte_handler');
            $handler = new PageHTTPHandler('offerte_dettaglio_articoliDetailEdit0offerte_handler', $pageEdit);
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
	
