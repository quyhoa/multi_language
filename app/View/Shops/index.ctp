<div class="inner">
    <?php echo $this->Form->create('FShop',array('controller'=>'Shops','action'=>'process_delete')) ?>
        <ul class="butthree">
            <li>
               <?php echo $this->Html->link('一括登録',array('controller'=>'Pages','action'=>'index')); ?>
            </li>   
            <li>
            <?php echo $this->Html->link('新規登録',array('controller'=>'Shops','action'=>'add')); ?>
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
                    <td class="title" colspan="4">
                       <?php echo __('店舗情報登録') ?>
                    <br>
                    <?php echo __('個別登録') ?> ／ <?php echo __('一括登録') ?>
                    </td>
                </tr>
            <?php $i=1; foreach($menus as $menu): ?>
                <tr class="hover_content">
                    <td class='class-td'>メニュー <?php $name = $i++.": ".$menu['DictJa']['word_0']; 
                    echo $this->Html->link($name,'/Shops/listmenu/'.$menu['FShop']['id']); ?>
                    </td>
                    <td style="width:10%"><?php echo $this->Html->link('Edit','/Shops/edit/'.$menu['FShop']['id'],array()); ?>
                    </td>
                    <td style="width:10%"><?php echo $this->Html->link('削除','/Shops/delete/'.$menu['FShop']['id'],array('onclick'=>"return confirm('メニューを削除してもよろしいですか。?')")); ?>
                    </td>
                    <td style="width:2%">
                        <?php echo $this->Form->checkbox('News.id.'.$menu['FShop']['id']); ?> 
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
            {   $("#FShopProcessDeleteForm").attr('action','Shops/process_delete');
                $("#FShopProcessDeleteForm").submit();
            }
        }
    </script>