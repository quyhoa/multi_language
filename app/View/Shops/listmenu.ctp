
<div class="inner">
    <?php echo $this->Form->create('Shops',array('action'=>'process_delete_menu')) ?>
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
                <?php if(!empty($menus['FMenu'])): ?>
                    <?php $i=1; foreach($menus['FMenu'] as $infomenu): ?>
                        <tr class="hover_content">
                            <td class='class-td'>メニュー <?php $name = $i++.": ".$infomenu['name']; 
                            echo $this->Html->link($name,'/FMenus/add/'.$infomenu['id']); ?>
                            </td>
                            <td style="width:10%"><?php echo $this->Html->link('削除','/Shops/deletemenu/'.$menus['FShop']['id'].'_'.$infomenu['id'],array('onclick'=>"return confirm('メニューを削除してもよろしいですか。?')")); ?></td>
                            <td style="width:2%">
                                <?php echo $this->Form->checkbox('News.id.'.$menus['FShop']['id'].'_'.$infomenu['id']); ?> 
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        <?php echo $this->Form->end(); ?>
        <div class="sbButton">
                    <?php echo $this->element('paginator');?>
                    <?php echo $this->Form->button(BACK_BUTTON,array('class'=>'submitBut','type'=>'button','onclick'=>"window.location.href='/Shops/index'")) ;?>
               
                 
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
                // $("#FShopProcessDeleteMenuForm").attr('action','Shops/process_delete_menu');
                $("#ShopsProcessDeleteMenuForm").submit();
            }
        }
    </script>