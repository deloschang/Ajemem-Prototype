<?php /* Smarty version 2.6.7, created on 2012-06-13 02:48:30
         compiled from meme/premade_image.tpl.html */ ?>

<!-- Template: meme/premade_image.tpl.html Start 13/06/2012 02:48:30 --> 
 <?php unset($this->_sections['cur_img']);
$this->_sections['cur_img']['name'] = 'cur_img';
$this->_sections['cur_img']['loop'] = is_array($_loop=$this->_tpl_vars['sm']['premade_imgs']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['cur_img']['show'] = true;
$this->_sections['cur_img']['max'] = $this->_sections['cur_img']['loop'];
$this->_sections['cur_img']['step'] = 1;
$this->_sections['cur_img']['start'] = $this->_sections['cur_img']['step'] > 0 ? 0 : $this->_sections['cur_img']['loop']-1;
if ($this->_sections['cur_img']['show']) {
    $this->_sections['cur_img']['total'] = $this->_sections['cur_img']['loop'];
    if ($this->_sections['cur_img']['total'] == 0)
        $this->_sections['cur_img']['show'] = false;
} else
    $this->_sections['cur_img']['total'] = 0;
if ($this->_sections['cur_img']['show']):

            for ($this->_sections['cur_img']['index'] = $this->_sections['cur_img']['start'], $this->_sections['cur_img']['iteration'] = 1;
                 $this->_sections['cur_img']['iteration'] <= $this->_sections['cur_img']['total'];
                 $this->_sections['cur_img']['index'] += $this->_sections['cur_img']['step'], $this->_sections['cur_img']['iteration']++):
$this->_sections['cur_img']['rownum'] = $this->_sections['cur_img']['iteration'];
$this->_sections['cur_img']['index_prev'] = $this->_sections['cur_img']['index'] - $this->_sections['cur_img']['step'];
$this->_sections['cur_img']['index_next'] = $this->_sections['cur_img']['index'] + $this->_sections['cur_img']['step'];
$this->_sections['cur_img']['first']      = ($this->_sections['cur_img']['iteration'] == 1);
$this->_sections['cur_img']['last']       = ($this->_sections['cur_img']['iteration'] == $this->_sections['cur_img']['total']);
 $this->assign('i', $this->_tpl_vars['sm']['premade_imgs'][$this->_sections['cur_img']['index']]); ?>
    <div class='idrag' style='float:left'><img height='100px' width='100px' src='http://localhost/image/orig/premade_images/<?php echo $this->_tpl_vars['i']['img_name']; ?>
' onclick='create_Imagebox(this.src)'/></div>
<?php endfor; endif; ?>


<!-- Template: meme/premade_image.tpl.html End --> 