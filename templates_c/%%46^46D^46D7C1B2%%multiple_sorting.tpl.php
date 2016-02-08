<div class="modal hide multiple-sorting" id="multiple-sorting-<?php echo $this->_tpl_vars['GridId']; ?>
">

    <div class="modal-header">
        <h3 class="title"><?php echo $this->_tpl_vars['Captions']->GetMessageString('MultipleColumnSorting'); ?>
</h3>
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
                                        <?php echo $this->_tpl_vars['Captions']->GetMessageString('AddLevel'); ?>

                                    </button>
                                    <button class="btn btn-default delete-sorting-level">
                                        <i class="icon icon-minus"></i>
                                        <?php echo $this->_tpl_vars['Captions']->GetMessageString('DeleteLevel'); ?>

                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr class="header">
                        <th></th>
                        <th><?php echo $this->_tpl_vars['Captions']->GetMessageString('Column'); ?>
</th>
                        <th><?php echo $this->_tpl_vars['Captions']->GetMessageString('Order'); ?>
</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $_from = $this->_tpl_vars['Levels']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['Index'] => $this->_tpl_vars['Level']):
?>
                    <tr class="sorting-level">
                        <?php if ($this->_tpl_vars['Index'] == 0): ?>
                            <td><?php echo $this->_tpl_vars['Captions']->GetMessageString('SortBy'); ?>
</td>
                        <?php else: ?>
                            <td><?php echo $this->_tpl_vars['Captions']->GetMessageString('ThenBy'); ?>
</td>
                        <?php endif; ?>
                        <td>
                            <select class="multi-sort-name">
                            <?php $_from = $this->_tpl_vars['SortableHeaders']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
?>
                                <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if (( $this->_tpl_vars['Level']->getFieldName() == $this->_tpl_vars['key'] )): ?> selected<?php endif; ?>><?php echo $this->_tpl_vars['value']; ?>
</option>
                            <?php endforeach; endif; unset($_from); ?>
                            </select>
                        </td>
                        <td>
                            <select class="multi-sort-order">
                                <option value="a"<?php if (( $this->_tpl_vars['Level']->getShortOrderType() == 'a' )): ?> selected<?php endif; ?>><?php echo $this->_tpl_vars['Captions']->GetMessageString('Ascending'); ?>
</option>
                                <option value="d"<?php if (( $this->_tpl_vars['Level']->getShortOrderType() == 'd' )): ?> selected<?php endif; ?>><?php echo $this->_tpl_vars['Captions']->GetMessageString('Descending'); ?>
</option>
                            </select>
                        </td>
                    </tr>
                    <?php endforeach; endif; unset($_from); ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal-footer">
        <a href="#" class="btn" data-dismiss="modal"><?php echo $this->_tpl_vars['Captions']->GetMessageString('Cancel'); ?>
</a>
        <a href="#" class="sort-button btn btn-primary"><?php echo $this->_tpl_vars['Captions']->GetMessageString('Sort'); ?>
</a>
    </div>

</div>