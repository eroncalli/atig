<?php echo '<?xml'; ?>
 version="1.0" <?php if ($this->_tpl_vars['encoding']): ?>encoding="<?php echo $this->_tpl_vars['encoding']; ?>
"<?php endif; ?><?php echo '?>'; ?>

<fieldvalues>
<?php $_from = $this->_tpl_vars['ColumnValues']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['Values'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['Values']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['name'] => $this->_tpl_vars['Column']):
        $this->_foreach['Values']['iteration']++;
?>
    <fieldvalue name="<?php echo $this->_tpl_vars['name']; ?>
">
        <value>
            <![CDATA[
            <div><?php echo $this->_tpl_vars['Column']['Value']; ?>
</div>
            ]]>
        </value>
        <style>
            <![CDATA[
            <?php echo $this->_tpl_vars['Column']['Style']; ?>

            ]]>
        </style>
    </fieldvalue>
<?php endforeach; endif; unset($_from); ?>
</fieldvalues>