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
    
    
    
    class offerte_dettaglio_costiPage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->dataset = new TableDataset(
                new MyPDOConnectionFactory(),
                GetConnectionOptions(),
                '`offerte_dettaglio_costi`');
            $field = new IntegerField('id', null, null, true);
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, true);
            $field = new IntegerField('ofv-numoff');
            $this->dataset->AddField($field, false);
            $field = new StringField('ofv-codart');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('ofv-codvoce');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('ofv-num-riga-voce');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('ofv-quantita');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('ofv-lunghezza');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('ofv-larghezza');
            $this->dataset->AddField($field, false);
            $field = new StringField('ofv-tiposmu');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('ofv-przacq');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('ofv-sconto');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('ofv-valuni-cal');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('ofv-valuni-fin');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('ofv-durata');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('ofv-valtot-fin');
            $this->dataset->AddField($field, false);
            $field = new StringField('ofv-codart-agg');
            $this->dataset->AddField($field, false);
            $field = new IntegerField('ofv-codart-agg-prz-lor');
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
            $grid->SearchControl = new SimpleSearch('offerte_dettaglio_costissearch', $this->dataset,
                array('id', 'ofv-numoff', 'ofv-codvoce', 'ofv-quantita', 'ofv-lunghezza', 'ofv-larghezza', 'ofv-tiposmu', 'ofv-przacq', 'ofv-sconto', 'ofv-valuni-cal', 'ofv-valuni-fin', 'datains', 'datamod'),
                array($this->RenderText('Id'), $this->RenderText('Ofv-numoff'), $this->RenderText('Ofv-codvoce'), $this->RenderText('Ofv-quantita'), $this->RenderText('Ofv-lunghezza'), $this->RenderText('Ofv-larghezza'), $this->RenderText('Ofv-tiposmu'), $this->RenderText('Ofv-przacq'), $this->RenderText('Ofv-sconto'), $this->RenderText('Ofv-valuni-cal'), $this->RenderText('Ofv-valuni-fin'), $this->RenderText('Datains'), $this->RenderText('Datamod')),
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
            $this->AdvancedSearchControl = new AdvancedSearchControl('offerte_dettaglio_costiasearch', $this->dataset, $this->GetLocalizerCaptions(), $this->GetColumnVariableContainer(), $this->CreateLinkBuilder());
            $this->AdvancedSearchControl->setTimerInterval(1000);
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('id', $this->RenderText('Id')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('ofv-numoff', $this->RenderText('Ofv-numoff')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('ofv-codvoce', $this->RenderText('Ofv-codvoce')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('ofv-quantita', $this->RenderText('Ofv-quantita')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('ofv-lunghezza', $this->RenderText('Ofv-lunghezza')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('ofv-larghezza', $this->RenderText('Ofv-larghezza')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('ofv-tiposmu', $this->RenderText('Ofv-tiposmu')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('ofv-przacq', $this->RenderText('Ofv-przacq')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('ofv-sconto', $this->RenderText('Ofv-sconto')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('ofv-valuni-cal', $this->RenderText('Ofv-valuni-cal')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('ofv-valuni-fin', $this->RenderText('Ofv-valuni-fin')));
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
            $column->SetAdditionalAttribute("data-modal-delete", "true");
            $column->SetAdditionalAttribute("data-delete-handler-name", $this->GetModalGridDeleteHandler());
            }
        }
    
        protected function AddFieldColumns(Grid $grid)
        {
            //
            // View column for ofv-numoff field
            //
            $column = new TextViewColumn('ofv-numoff', 'Ofv-numoff', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ofv-codvoce field
            //
            $column = new TextViewColumn('ofv-codvoce', 'Ofv-codvoce', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ofv-quantita field
            //
            $column = new TextViewColumn('ofv-quantita', 'Ofv-quantita', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ofv-lunghezza field
            //
            $column = new TextViewColumn('ofv-lunghezza', 'Ofv-lunghezza', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ofv-larghezza field
            //
            $column = new TextViewColumn('ofv-larghezza', 'Ofv-larghezza', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ofv-tiposmu field
            //
            $column = new TextViewColumn('ofv-tiposmu', 'Ofv-tiposmu', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ofv-przacq field
            //
            $column = new TextViewColumn('ofv-przacq', 'Ofv-przacq', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ofv-sconto field
            //
            $column = new TextViewColumn('ofv-sconto', 'Ofv-sconto', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ofv-valuni-cal field
            //
            $column = new TextViewColumn('ofv-valuni-cal', 'Ofv-valuni-cal', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $column->SetDescription($this->RenderText(''));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for ofv-valuni-fin field
            //
            $column = new TextViewColumn('ofv-valuni-fin', 'Ofv-valuni-fin', $this->dataset);
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
            // View column for ofv-numoff field
            //
            $column = new TextViewColumn('ofv-numoff', 'Ofv-numoff', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ofv-codvoce field
            //
            $column = new TextViewColumn('ofv-codvoce', 'Ofv-codvoce', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ofv-quantita field
            //
            $column = new TextViewColumn('ofv-quantita', 'Ofv-quantita', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ofv-lunghezza field
            //
            $column = new TextViewColumn('ofv-lunghezza', 'Ofv-lunghezza', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ofv-larghezza field
            //
            $column = new TextViewColumn('ofv-larghezza', 'Ofv-larghezza', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ofv-tiposmu field
            //
            $column = new TextViewColumn('ofv-tiposmu', 'Ofv-tiposmu', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ofv-przacq field
            //
            $column = new TextViewColumn('ofv-przacq', 'Ofv-przacq', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ofv-sconto field
            //
            $column = new TextViewColumn('ofv-sconto', 'Ofv-sconto', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ofv-valuni-cal field
            //
            $column = new TextViewColumn('ofv-valuni-cal', 'Ofv-valuni-cal', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for ofv-valuni-fin field
            //
            $column = new TextViewColumn('ofv-valuni-fin', 'Ofv-valuni-fin', $this->dataset);
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
            // Edit column for ofv-numoff field
            //
            $editor = new TextEdit('ofv-numoff_edit');
            $editColumn = new CustomEditColumn('Ofv-numoff', 'ofv-numoff', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ofv-codvoce field
            //
            $editor = new TextEdit('ofv-codvoce_edit');
            $editColumn = new CustomEditColumn('Ofv-codvoce', 'ofv-codvoce', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ofv-quantita field
            //
            $editor = new TextEdit('ofv-quantita_edit');
            $editColumn = new CustomEditColumn('Ofv-quantita', 'ofv-quantita', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ofv-lunghezza field
            //
            $editor = new TextEdit('ofv-lunghezza_edit');
            $editColumn = new CustomEditColumn('Ofv-lunghezza', 'ofv-lunghezza', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ofv-larghezza field
            //
            $editor = new TextEdit('ofv-larghezza_edit');
            $editColumn = new CustomEditColumn('Ofv-larghezza', 'ofv-larghezza', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ofv-tiposmu field
            //
            $editor = new TextEdit('ofv-tiposmu_edit');
            $editor->SetSize(1);
            $editor->SetMaxLength(1);
            $editColumn = new CustomEditColumn('Ofv-tiposmu', 'ofv-tiposmu', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ofv-przacq field
            //
            $editor = new TextEdit('ofv-przacq_edit');
            $editColumn = new CustomEditColumn('Ofv-przacq', 'ofv-przacq', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ofv-sconto field
            //
            $editor = new TextEdit('ofv-sconto_edit');
            $editColumn = new CustomEditColumn('Ofv-sconto', 'ofv-sconto', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ofv-valuni-cal field
            //
            $editor = new TextEdit('ofv-valuni-cal_edit');
            $editColumn = new CustomEditColumn('Ofv-valuni-cal', 'ofv-valuni-cal', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ofv-valuni-fin field
            //
            $editor = new TextEdit('ofv-valuni-fin_edit');
            $editColumn = new CustomEditColumn('Ofv-valuni-fin', 'ofv-valuni-fin', $editor, $this->dataset);
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
            // Edit column for ofv-numoff field
            //
            $editor = new TextEdit('ofv-numoff_edit');
            $editColumn = new CustomEditColumn('Ofv-numoff', 'ofv-numoff', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ofv-codvoce field
            //
            $editor = new TextEdit('ofv-codvoce_edit');
            $editColumn = new CustomEditColumn('Ofv-codvoce', 'ofv-codvoce', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ofv-quantita field
            //
            $editor = new TextEdit('ofv-quantita_edit');
            $editColumn = new CustomEditColumn('Ofv-quantita', 'ofv-quantita', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ofv-lunghezza field
            //
            $editor = new TextEdit('ofv-lunghezza_edit');
            $editColumn = new CustomEditColumn('Ofv-lunghezza', 'ofv-lunghezza', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ofv-larghezza field
            //
            $editor = new TextEdit('ofv-larghezza_edit');
            $editColumn = new CustomEditColumn('Ofv-larghezza', 'ofv-larghezza', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ofv-tiposmu field
            //
            $editor = new TextEdit('ofv-tiposmu_edit');
            $editor->SetSize(1);
            $editor->SetMaxLength(1);
            $editColumn = new CustomEditColumn('Ofv-tiposmu', 'ofv-tiposmu', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ofv-przacq field
            //
            $editor = new TextEdit('ofv-przacq_edit');
            $editColumn = new CustomEditColumn('Ofv-przacq', 'ofv-przacq', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ofv-sconto field
            //
            $editor = new TextEdit('ofv-sconto_edit');
            $editColumn = new CustomEditColumn('Ofv-sconto', 'ofv-sconto', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ofv-valuni-cal field
            //
            $editor = new TextEdit('ofv-valuni-cal_edit');
            $editColumn = new CustomEditColumn('Ofv-valuni-cal', 'ofv-valuni-cal', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ofv-valuni-fin field
            //
            $editor = new TextEdit('ofv-valuni-fin_edit');
            $editColumn = new CustomEditColumn('Ofv-valuni-fin', 'ofv-valuni-fin', $editor, $this->dataset);
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
            // View column for ofv-numoff field
            //
            $column = new TextViewColumn('ofv-numoff', 'Ofv-numoff', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for ofv-codvoce field
            //
            $column = new TextViewColumn('ofv-codvoce', 'Ofv-codvoce', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for ofv-quantita field
            //
            $column = new TextViewColumn('ofv-quantita', 'Ofv-quantita', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for ofv-lunghezza field
            //
            $column = new TextViewColumn('ofv-lunghezza', 'Ofv-lunghezza', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $grid->AddPrintColumn($column);
            
            //
            // View column for ofv-larghezza field
            //
            $column = new TextViewColumn('ofv-larghezza', 'Ofv-larghezza', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $grid->AddPrintColumn($column);
            
            //
            // View column for ofv-tiposmu field
            //
            $column = new TextViewColumn('ofv-tiposmu', 'Ofv-tiposmu', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for ofv-przacq field
            //
            $column = new TextViewColumn('ofv-przacq', 'Ofv-przacq', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $grid->AddPrintColumn($column);
            
            //
            // View column for ofv-sconto field
            //
            $column = new TextViewColumn('ofv-sconto', 'Ofv-sconto', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $grid->AddPrintColumn($column);
            
            //
            // View column for ofv-valuni-cal field
            //
            $column = new TextViewColumn('ofv-valuni-cal', 'Ofv-valuni-cal', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $grid->AddPrintColumn($column);
            
            //
            // View column for ofv-valuni-fin field
            //
            $column = new TextViewColumn('ofv-valuni-fin', 'Ofv-valuni-fin', $this->dataset);
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
            // View column for ofv-numoff field
            //
            $column = new TextViewColumn('ofv-numoff', 'Ofv-numoff', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for ofv-codvoce field
            //
            $column = new TextViewColumn('ofv-codvoce', 'Ofv-codvoce', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for ofv-quantita field
            //
            $column = new TextViewColumn('ofv-quantita', 'Ofv-quantita', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for ofv-lunghezza field
            //
            $column = new TextViewColumn('ofv-lunghezza', 'Ofv-lunghezza', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $grid->AddExportColumn($column);
            
            //
            // View column for ofv-larghezza field
            //
            $column = new TextViewColumn('ofv-larghezza', 'Ofv-larghezza', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $grid->AddExportColumn($column);
            
            //
            // View column for ofv-tiposmu field
            //
            $column = new TextViewColumn('ofv-tiposmu', 'Ofv-tiposmu', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for ofv-przacq field
            //
            $column = new TextViewColumn('ofv-przacq', 'Ofv-przacq', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $grid->AddExportColumn($column);
            
            //
            // View column for ofv-sconto field
            //
            $column = new TextViewColumn('ofv-sconto', 'Ofv-sconto', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $grid->AddExportColumn($column);
            
            //
            // View column for ofv-valuni-cal field
            //
            $column = new TextViewColumn('ofv-valuni-cal', 'Ofv-valuni-cal', $this->dataset);
            $column->SetOrderable(true);
            $column = new NumberFormatValueViewColumnDecorator($column, 2, '.', ',');
            $grid->AddExportColumn($column);
            
            //
            // View column for ofv-valuni-fin field
            //
            $column = new TextViewColumn('ofv-valuni-fin', 'Ofv-valuni-fin', $this->dataset);
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
        
        public function GetModalGridDeleteHandler() { return 'offerte_dettaglio_costi_modal_delete'; }
        protected function GetEnableModalGridDelete() { return true; }
    
        protected function CreateGrid()
        {
            $result = new Grid($this, $this->dataset, 'offerte_dettaglio_costiGrid');
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

    SetUpUserAuthorization(GetApplication());

    try
    {
        $Page = new offerte_dettaglio_costiPage("offerte_dettaglio_costi.php", "offerte_dettaglio_costi", GetCurrentUserGrantForDataSource("offerte_dettaglio_costi"), 'UTF-8');
        $Page->SetShortCaption('Offerte Dettaglio Costi');
        $Page->SetHeader(GetPagesHeader());
        $Page->SetFooter(GetPagesFooter());
        $Page->SetCaption('Offerte Dettaglio Costi');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("offerte_dettaglio_costi"));
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
	
