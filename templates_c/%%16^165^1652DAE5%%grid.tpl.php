<?php echo '<?xml'; ?>
 version="1.0" <?php if ($this->_tpl_vars['encoding']): ?>encoding="<?php echo $this->_tpl_vars['encoding']; ?>
"<?php endif; ?><?php echo '?>'; ?>

<editors>
<namesuffix><?php echo $this->_tpl_vars['EditorsNameSuffix']; ?>
</namesuffix>
<?php $_from = $this->_tpl_vars['ColumnEditors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['Editors'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['Editors']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['name'] => $this->_tpl_vars['editor']):
        $this->_foreach['Editors']['iteration']++;
?>
    <editor name="<?php echo $this->_tpl_vars['name']; ?>
">
        <html>
            <![CDATA[
                <?php echo $this->_tpl_vars['editor']['Html']; ?>

            ]]>
        </html>
        <script>
            <![CDATA[
                <?php echo $this->_tpl_vars['editor']['Script']; ?>

            ]]>
        </script>
    </editor>
<?php endforeach; endif; unset($_from); ?>
</editors>