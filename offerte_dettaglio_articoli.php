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
    
    
    
    class offerte_dettaglio_articoliPage extends Page
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
            $this->dataset->AddLookupField('ofa-codart', 'articoli', new StringField('art-codart'), new StringField('art-descart', 'ofa-codart_art-descart', 'ofa-codart_art-descart_articoli'), 'ofa-codart_art-descart_articoli');
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
            $grid->SearchControl = new SimpleSearch('offerte_dettaglio_articolissearch', $this->dataset,
                array('id', 'ofa-numoff', 'ofa-codart_art-descart', 'ofa-descart', 'ofa-lunghezza', 'ofa-larghezza', 'ofa-spessore', 'ofa-quantita', 'ofa-przacq-net', 'ofa-przacq-lor', 'ofa-totuni', 'ofa-totunit-fin', 'ofa-totgen', 'ofa-przven', 'datains', 'datamod'),
                array($this->RenderText('Id'), $this->RenderText('Numero Offerta'), $this->RenderText('Codice articolo'), $this->RenderText('Ofa-descart'), $this->RenderText('Lunghezza'), $this->RenderText('Ofa-larghezza'), $this->RenderText('Ofa-spessore'), $this->RenderText('Ofa-quantita'), $this->RenderText('Ofa-przacq-net'), $this->RenderText('Ofa-przacq-lor'), $this->RenderText('Ofa-totuni'), $this->RenderText('Ofa-totunit-fin'), $this->RenderText('Ofa-totgen'), $this->RenderText('Ofa-przven'), $this->RenderText('Datains'), $this->RenderText('Datamod')),
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
            $this->AdvancedSearchControl = new AdvancedSearchControl('offerte_dettaglio_articoliasearch', $this->dataset, $this->GetLocalizerCaptions(), $this->GetColumnVariableContainer(), $this->CreateLinkBuilder());
            $this->AdvancedSearchControl->setTimerInterval(1000);
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('id', $this->RenderText('Id')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('ofa-numoff', $this->RenderText('Numero Offerta')));
            
            $lookupDataset = new TableDataset(
                new MyPDOConnectionFactory(),
                GetConnectionOptions(),
                '`articoli`');
            $field = new IntegerField('id', null, null, true);
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new StringField('art-codart');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('art-descart');
            $lookupDataset->AddField($field, false);
            $field = new StringField('art-dessup');
            $lookupDataset->AddField($field, false);
            $field = new StringField('art-codprod');
            $lookupDataset->AddField($field, false);
            $field = new StringField('art-codfam');
            $lookupDataset->AddField($field, false);
            $field = new StringField('art-gruppo-merc');
            $lookupDataset->AddField($field, false);
            $field = new StringField('art-categoria-omogenea');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('art-lungsmu');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('datains');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('datamod');
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('art-descart', GetOrderTypeAsSQL(otAscending));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateLookupSearchInput('ofa-codart', $this->RenderText('Codice articolo'), $lookupDataset, 'art-codart', 'art-descart', false, 8));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('ofa-descart', $this->RenderText('Ofa-descart')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('ofa-lunghezza', $this->RenderText('Lunghezza')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('ofa-larghezza', $this->RenderText('Ofa-larghezza')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('ofa-spessore', $this->RenderText('Ofa-spessore')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('ofa-quantita', $this->RenderText('Ofa-quantita')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('ofa-przacq-net', $this->RenderText('Ofa-przacq-net')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('ofa-przacq-lor', $this->RenderText('Ofa-przacq-lor')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('ofa-totuni', $this->RenderText('Ofa-totuni')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('ofa-totunit-fin', $this->RenderText('Ofa-totunit-fin')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('ofa-totgen', $this->RenderText('Ofa-totgen')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('ofa-przven', $this->RenderText('Ofa-przven')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateDateTimeSearchInput('datains', $this->RenderText('Datains'), 'd-m-Y H:i:s'));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateDateTimeSearchInput('datamod', $this->RenderText('Datamod'), 'd-m-Y H:i:s'));
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
            $column = new TextViewColumn('id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ofa-numoff field
            //
            $column = new TextViewColumn('ofa-numoff', 'Numero Offerta', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for art-descart field
            //
            $column = new TextViewColumn('ofa-codart_art-descart', 'Codice articolo', $this->dataset);
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
            // View column for ofa-lunghezza field
            //
            $column = new TextViewColumn('ofa-lunghezza', 'Lunghezza', $this->dataset);
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
            
            //
            // View column for datains field
            //
            $column = new DateTimeViewColumn('datains', 'Datains', $this->dataset);
            $column->SetDateTimeFormat('d-m-Y H:i:s');
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for datamod field
            //
            $column = new DateTimeViewColumn('datamod', 'Datamod', $this->dataset);
            $column->SetDateTimeFormat('d-m-Y H:i:s');
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
            $column = new TextViewColumn('id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ofa-numoff field
            //
            $column = new TextViewColumn('ofa-numoff', 'Numero Offerta', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for art-descart field
            //
            $column = new TextViewColumn('ofa-codart_art-descart', 'Codice articolo', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ofa-descart field
            //
            $column = new TextViewColumn('ofa-descart', 'Ofa-descart', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ofa-lunghezza field
            //
            $column = new TextViewColumn('ofa-lunghezza', 'Lunghezza', $this->dataset);
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
            // Edit column for ofa-numoff field
            //
            $editor = new TextEdit('ofa-numoff_edit');
            $editColumn = new CustomEditColumn('Numero Offerta', 'ofa-numoff', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ofa-codart field
            //
            $editor = new ComboBox('ofa-codart_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new MyPDOConnectionFactory(),
                GetConnectionOptions(),
                '`articoli`');
            $field = new IntegerField('id', null, null, true);
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new StringField('art-codart');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('art-descart');
            $lookupDataset->AddField($field, false);
            $field = new StringField('art-dessup');
            $lookupDataset->AddField($field, false);
            $field = new StringField('art-codprod');
            $lookupDataset->AddField($field, false);
            $field = new StringField('art-codfam');
            $lookupDataset->AddField($field, false);
            $field = new StringField('art-gruppo-merc');
            $lookupDataset->AddField($field, false);
            $field = new StringField('art-categoria-omogenea');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('art-lungsmu');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('datains');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('datamod');
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('art-descart', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Codice articolo', 
                'ofa-codart', 
                $editor, 
                $this->dataset, 'art-codart', 'art-descart', $lookupDataset);
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
            // Edit column for ofa-lunghezza field
            //
            $editor = new TextEdit('ofa-lunghezza_edit');
            $editColumn = new CustomEditColumn('Lunghezza', 'ofa-lunghezza', $editor, $this->dataset);
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
            
            //
            // Edit column for datains field
            //
            $editor = new DateTimeEdit('datains_edit', true, 'Y-m-d H:i:s', GetFirstDayOfWeek());
            $editColumn = new CustomEditColumn('Datains', 'datains', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for datamod field
            //
            $editor = new DateTimeEdit('datamod_edit', true, 'Y-m-d H:i:s', GetFirstDayOfWeek());
            $editColumn = new CustomEditColumn('Datamod', 'datamod', $editor, $this->dataset);
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
            $editColumn = new CustomEditColumn('Numero Offerta', 'ofa-numoff', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ofa-codart field
            //
            $editor = new ComboBox('ofa-codart_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new MyPDOConnectionFactory(),
                GetConnectionOptions(),
                '`articoli`');
            $field = new IntegerField('id', null, null, true);
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new StringField('art-codart');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('art-descart');
            $lookupDataset->AddField($field, false);
            $field = new StringField('art-dessup');
            $lookupDataset->AddField($field, false);
            $field = new StringField('art-codprod');
            $lookupDataset->AddField($field, false);
            $field = new StringField('art-codfam');
            $lookupDataset->AddField($field, false);
            $field = new StringField('art-gruppo-merc');
            $lookupDataset->AddField($field, false);
            $field = new StringField('art-categoria-omogenea');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('art-lungsmu');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('datains');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('datamod');
            $lookupDataset->AddField($field, false);
            $lookupDataset->setOrderByField('art-descart', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Codice articolo', 
                'ofa-codart', 
                $editor, 
                $this->dataset, 'art-codart', 'art-descart', $lookupDataset);
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
            // Edit column for ofa-lunghezza field
            //
            $editor = new TextEdit('ofa-lunghezza_edit');
            $editColumn = new CustomEditColumn('Lunghezza', 'ofa-lunghezza', $editor, $this->dataset);
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
            
            //
            // Edit column for datains field
            //
            $editor = new DateTimeEdit('datains_edit', true, 'Y-m-d H:i:s', GetFirstDayOfWeek());
            $editColumn = new CustomEditColumn('Datains', 'datains', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for datamod field
            //
            $editor = new DateTimeEdit('datamod_edit', true, 'Y-m-d H:i:s', GetFirstDayOfWeek());
            $editColumn = new CustomEditColumn('Datamod', 'datamod', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $editColumn->SetAllowSetToDefault(true);
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
            // View column for ofa-numoff field
            //
            $column = new TextViewColumn('ofa-numoff', 'Numero Offerta', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for art-descart field
            //
            $column = new TextViewColumn('ofa-codart_art-descart', 'Codice articolo', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for ofa-descart field
            //
            $column = new TextViewColumn('ofa-descart', 'Ofa-descart', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for ofa-lunghezza field
            //
            $column = new TextViewColumn('ofa-lunghezza', 'Lunghezza', $this->dataset);
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
            
            //
            // View column for datains field
            //
            $column = new DateTimeViewColumn('datains', 'Datains', $this->dataset);
            $column->SetDateTimeFormat('d-m-Y H:i:s');
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for datamod field
            //
            $column = new DateTimeViewColumn('datamod', 'Datamod', $this->dataset);
            $column->SetDateTimeFormat('d-m-Y H:i:s');
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
            // View column for ofa-numoff field
            //
            $column = new TextViewColumn('ofa-numoff', 'Numero Offerta', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for art-descart field
            //
            $column = new TextViewColumn('ofa-codart_art-descart', 'Codice articolo', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for ofa-descart field
            //
            $column = new TextViewColumn('ofa-descart', 'Ofa-descart', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for ofa-lunghezza field
            //
            $column = new TextViewColumn('ofa-lunghezza', 'Lunghezza', $this->dataset);
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
            
            //
            // View column for datains field
            //
            $column = new DateTimeViewColumn('datains', 'Datains', $this->dataset);
            $column->SetDateTimeFormat('d-m-Y H:i:s');
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for datamod field
            //
            $column = new DateTimeViewColumn('datamod', 'Datamod', $this->dataset);
            $column->SetDateTimeFormat('d-m-Y H:i:s');
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
        
        public function GetModalGridDeleteHandler() { return 'offerte_dettaglio_articoli_modal_delete'; }
        protected function GetEnableModalGridDelete() { return true; }
    
        protected function CreateGrid()
        {
            $result = new Grid($this, $this->dataset, 'offerte_dettaglio_articoliGrid');
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
            $this->SetShowTopPageNavigator(true);
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
        $Page = new offerte_dettaglio_articoliPage("offerte_dettaglio_articoli.php", "offerte_dettaglio_articoli", GetCurrentUserGrantForDataSource("offerte_dettaglio_articoli"), 'UTF-8');
        $Page->SetShortCaption('Offerte Dettaglio Articoli');
        $Page->SetHeader(GetPagesHeader());
        $Page->SetFooter(GetPagesFooter());
        $Page->SetCaption('Offerte Dettaglio Articoli');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("offerte_dettaglio_articoli"));
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
	
