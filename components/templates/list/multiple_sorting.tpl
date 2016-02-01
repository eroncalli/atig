<div class="modal hide multiple-sorting" id="multiple-sorting-{$GridId}">

    <div class="modal-header">
        <h3 class="title">{$Captions->GetMessageString('MultipleColumnSorting')}</h3>
    </div>

    <div class="modal-body">
        <div class=fixed-table-container>
            <table class="pgui-grid multiple-sorting-table" style="width: 100%">
                <thead>
                    <tr>
                        <td colspan="3" class="header-panel">
                            <div class="btn-toolbar pull-left">
                                <div class="btn-group">
                                    <button class="btn btn-default add-sorting-level">
                                        <i class="icon icon-plus"></i>
                                        {$Captions->GetMessageString('AddLevel')}
                                    </button>
                                    <button class="btn btn-default delete-sorting-level">
                                        <i class="icon icon-minus"></i>
                                        {$Captions->GetMessageString('DeleteLevel')}
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr class="header">
                        <th></th>
                        <th>{$Captions->GetMessageString('Column')}</th>
                        <th>{$Captions->GetMessageString('Order')}</th>
                    </tr>
                </thead>
                <tbody>
                    {foreach item=Level key=Index from=$Levels}
                    <tr class="sorting-level">
                        {if $Index == 0}
                            <td>{$Captions->GetMessageString('SortBy')}</td>
                        {else}
                            <td>{$Captions->GetMessageString('ThenBy')}</td>
                        {/if}
                        <td>
                            <select class="multi-sort-name">
                            {foreach from=$SortableHeaders item="value" key="key"}
                                <option value="{$key}" {if ($Level->getFieldName() == $key)} selected{/if}>{$value}</option>
                            {/foreach}
                            </select>
                        </td>
                        <td>
                            <select class="multi-sort-order">
                                <option value="a"{if ($Level->getShortOrderType() == 'a')} selected{/if}>{$Captions->GetMessageString('Ascending')}</option>
                                <option value="d"{if ($Level->getShortOrderType() == 'd')} selected{/if}>{$Captions->GetMessageString('Descending')}</option>
                            </select>
                        </td>
                    </tr>
                    {/foreach}
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal">{$Captions->GetMessageString('Cancel')}</a>
        <a href="#" class="sort-button btn btn-primary">{$Captions->GetMessageString('Sort')}</a>
    </div>

</div>
