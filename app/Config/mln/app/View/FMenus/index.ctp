
<div class="inner">
    <?php echo $this->Form->create('FMenu',array('action'=>'process_delete')) ?>
        <ul class="butthree">
            <li>
               <?php echo $this->Html->link('一括登録',array('controller'=>'Pages','action'=>'index')); ?>
            </li>   
            <li>
            <?php echo $this->Html->link('新規登録',array('controller'=>'FMenus','action'=>'add')); ?>
            </li>
            <li>
            <?php echo $this->Html->link('一括削除',array(),array('onclick'=>"return manyDelete(this.id)",'id'=>'btn_delete')) ?>
            </li>
        </ul>
        <div style="display:block;clear:both;">
            <?php echo $this->Session->flash();?>
        </div>
        <table class="small_table" style="border-bottom: 1px solid #ccc">
            <tbody>
                <tr>
                    <td class="title" colspan="3">
                        メニュー一覧
                    </td>
                </tr>
            <?php $i=1; foreach($menus as $menu): ?>
                <tr class="hover_content">
                    <td class='class-td'>メニュー <?php $name = $i++.": ".$menu['DictJa']['word_0']; 
                    echo $this->Html->link($name,'/FMenus/add/'.$menu['FMenu']['id']); ?>
                    </td>
                    <td style="width:10%"><?php echo $this->Html->link('削除','/FMenus/delete/'.$menu['FMenu']['id'],array('onclick'=>"return confirm('メニューを削除してもよろしいですか。?')")); ?></td>
                    <td style="width:2%">
                        <?php echo $this->Form->checkbox('News.id.'.$menu['FMenu']['id']); ?> 
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <?php echo $this->Form->end(); ?>
        <div class="sbButton">
                    <?php echo $this->element('paginator');?>
                    <?php echo $this->Form->button(BACK_BUTTON,array('class'=>'submitBut','type'=>'button','onclick'=>"window.location.href='/Pages/index'")) ;?>
               
                 
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $(".class-td").on('click',function(){
                link = $(this).find('a').attr('href');                
                window.location.href=link;
            });
        })
        function manyDelete(id)
        {
            $("#"+id).removeAttr('href');
            var result= confirm('メニューを削除してもよろしいですか。?');
            if(result)
            {
                $("#FMenuProcessDeleteForm").submit();
            }
        }
    </script>