<style type="text/css">
        label.error {
            float: none; color: red;
            padding-left: .3em; vertical-align: top;  
        }    
</style>

<div class="inner">
        <?php echo $this->Form->create('FMenu',array('url'=>array('action'=>'saveFmenu'),'id'=>'FMenuAddForm','inputDefaults'=>array('label'=>false,'div'=>false,'novalidate'=>true))) ?>
             <?php 
                echo $this->Form->hidden('id');
            ?> 
            <table class="three_table four_table">
                <tbody>
                    <tr>
                        <td class="title" colspan="6">
                            <?php echo __('メニュー登録'); ?>
                        </td>
                    </tr>
                    <?php if(!empty($language)): ?>
                    <tr>
                        <th class="width20" style="width:10%">
                           <?php echo __('言語を選択') ?>
                        </th>
                        <td colspan="5">
                            <?php $selected = $this->Session->check('select_language')?$this->Session->read('select_language'):1;?>
                            <?php  echo $this->Form->input('listMenu',array('options'=>$language,'empty'=>false,'selected'=>$selected,'onchange'=>'change_language(this.id)','style'=>'min-width:20%')); ?>
                        </td>
                    </tr>
                <?php endif; ?>
                       
                    <tr>
                        <th class="width20">
                            <?php echo __('メニュー名称'); ?> 
                        </th> 
                        <?php if(!empty($options)): ?>    
                        <td colspan="5" class="ie_four select-editable " id="tdMenu0">
                            <?php  echo $this->Form->input('listMenu',array('options'=>$options,'empty'=>SELECT_MENU,'onchange'=>'resetHeight(this.id)')); ?>
                            <?php 
                                echo $this->Form->input('word_0',array('type'=>'textarea','style'=>'border: none','rows'=>1,'onblur'=>"return handleWord(this.id,1,'FMenuMenuJpId')",'onkeypress'=>'changeHeight(this.id)'));
                            ?>
                            <?php 
                                echo $this->Form->hidden('menu_jp_id');
                            ?> 
                                     
                        </td>
                    <?php else: ?>
                        <td colspan="5" class="ie_four" >
                        
                            <?php 
                                echo $this->Form->input('word_0',array('class'=>'noBorder width100','type'=>'textarea','rows'=>1,'onblur'=>"return handleWord(this.id,1,'FMenuMenuJpId')"));
                            ?>
                            <?php 
                                echo $this->Form->hidden('menu_jp_id');
                            ?>                    
                        </td>
                        
                    <?php endif; ?>    
                    </tr>
                    <tr>
                        <th class="width20">
                            <?php echo __(' 食材') ?><?php echo ($numFoodItem >0)?'（'.$numFoodItem.__('品種').'）':'';?>
                        </th>
                        <td colspan="5" class="tabView " id="food" onclick="addItem('FMenuAddForm','1')">
                            <?php 
                                echo $this->Form->input('foodstuff_list_name',array('type'=>'textarea','rows'=>1,'contenteditable'=>"true",'class'=>'noBorder  pointer width100 ',));
                            ?>
                            <?php 
                                echo $this->Form->hidden('foodstuff_id');
                            ?>                        
                        </td>
                    </tr>
                    <tr>
                        <th class="width20">
                             <?php echo __(' 調味料'); echo ($numSeasonItem >0)?'（'.$numSeasonItem.__('品種').'）':'';?>
                        </th>
                        <td colspan="5" class="tabView" id="seasion" onclick="addItem('FMenuAddForm','2')">
                            <?php 
                                echo $this->Form->input('seasoning_list_name',array('type'=>'textarea','rows'=>1,'class'=>'noBorder  pointer width100 '));
                            ?>
                            <?php 
                            echo $this->Form->hidden('seasoning_id');
                             ?>                        
                        </td>
                    </tr>
                    <tr>
                        <th class="width20"><?php echo __('価格') ?></th>
                        <td style="border-right:none">
                            <?php echo $this->Form->input('price',array('id'=>'price','type'=>'text','class'=>'noBorder','maxlength'=>30,'style'=>'width:80%')); ?>
                        </td>
                        <th ><?php echo __('通貨');?></th>
                        <td >
                            <?php
                            $options = array("1"=>__('円'),"2"=>__('米国ドル'));
                            

                            $sl = (!empty($this->request->data['FMenu']['priceunit_jp_id']))?$this->request->data['FMenu']['priceunit_jp_id']:'';
                             echo $this->Form->input('priceunit_jp_id',array('type'=>'select','options'=>$options,'empty'=>false,'style'=>'width:100%;','selected'=>$sl)); ?>
                                                   
                        </td>
                    </tr>
                    <tr>
                        <th class="width20">
                            <?php echo __('支払方法'); ?> 
                        </th>
                        <td colspan="5" id="td_payment" class="width50" style="margin: 0px;padding: 0px 15px;">
                            <fieldset>
                        <?php                         
                             $selected = (!empty($method))?$method:'';
                        echo $this->Form->input('payment_method', array('type'=>'select', 'multiple'=>'checkbox','options'=> array( '1'=>__('現金'), '2'=>__('クレジットカード'), '3'=>__('トラベラーカード')),'selected'=>$selected,'div'=>false,'label'=>false));
                         ?> 
                         </fieldset> 
                         <?php echo $this->Form->hidden('payment_method_jp_id') ?> 
                        </td>
                    </tr>
                    <tr>
                        <th class="width20" style="width:10%">
                            <?php echo __('紹介情報'); ?> 
                        </th>
                        <td colspan="5">
                            <?php echo $this->Form->input('description_name',array('id'=>'description','type'=>'textarea','rows'=>1,'class'=>'noBorder width100','onblur'=>"return handleWord(this.id,7,'FMenuDescriptionJpId')")); ?>
                            <?php echo $this->Form->hidden('description_jp_id'); ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="width20" style="width:10%">
                            <?php echo __('お得情報'); ?> 
                        </th>
                        <td colspan="5">
                            <?php echo $this->Form->input('speacial_deal_name',array('id'=>'deals','type'=>'textarea','rows'=>1,'class'=>'noBorder width100','onblur'=>"return handleWord(this.id,8,'FMenuSpeacialDealJpId')")); ?>
                             <?php echo $this->Form->hidden('speacial_deal_jp_id'); ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="width20">
                            <?php echo __('おいしい食べ方') ?> 
                        </th>
                        <td colspan="5">
                            <?php echo $this->Form->input('tasty_eating_name',array('id'=>'way_eat','type'=>'textarea','rows'=>1,'class'=>'noBorder width100','onblur'=>"return handleWord(this.id,9,'FMenuTastyEatingJpId')")); ?>
                            <?php echo $this->Form->hidden('tasty_eating_jp_id'); ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="width20">
                           <?php echo __(' ボリューム ') ?>
                        </th>
                        <td colspan="5">
                            <?php echo $this->Form->input('calories',array('type'=>'textarea','rows'=>1,'class'=>'noBorder width100','onblur'=>"return handleWord(this.id,7,'FMenuCalorie')")); ?>
                            <?php echo $this->Form->hidden('calorie'); ?>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="sbButton">
                    <?php echo $this->Form->button(BACK_BUTTON,array('class'=>'submitBut','type'=>'button','onclick'=>"window.location.href='/FMenus/'")) ;?>
                    <?php echo $this->Form->button('変更',array('type'=>'submit','class'=>'submitBut','div'=>false)); ?>
                    <?php if(!empty($exit_id)): ?>
                        <?php $id = $exit_id;?>
                        <?php echo $this->Form->button(SUBMIT_BUTTON,array('type'=>'button','class'=>'submitBut','div'=>false,'onclick'=>'return addmoi()')); ?>
                        <?php echo $this->Form->button('削除',array('type'=>'button','class'=>'submitBut','onclick'=>"return deleteMenus($id)")); ?>
                    <?php else: ?>
					<?php echo $this->Form->button(__('登録'),array('type'=>'submit','class'=>'submitBut','div'=>false)); ?>
                    <?php endif; ?>
            </div>
        <?php echo $this->Form->end(); ?>
    </div>
    <?php 
         echo $this->Form->create('Item',array('id'=>'frmId'));
         echo $this->Form->hidden('form_data',array('id'=>'item_data'));
    ?>
    <?php echo $this->Html->script('jquery.validate.min');?>
    <?php echo $this->Html->script('autosize.min');?>
    <script type="text/javascript">
        
       jQuery(document).ready(function($) {

           autosize(document.querySelectorAll('textarea'));
           $("#FMenuListMenu").change(function(){
            
            var data = $('#FMenuListMenu').val();
                  $.ajax({
                    type:'POST',
                    url:'<?php echo $this->Html->url(array('controller'=>'FMenus','action'=>'loadMenu')); ?>',
                    data:{word:data},
                    async:false,
                    success: function(data)
                    {   
                        data = $.parseJSON(data);
                        console.log(data);
                        /*load name*/
                        word_0 = data.FMenu.word_0;
                        foodstuff_list_name = data.FMenu.foodstuff_list_name;
                        seasoning_list_name = data.FMenu.seasoning_list_name;
                        price = data.id.FMenu.price;
                        priceunit_name = data.FMenu.priceunit_name;
                        payment_method = data.FMenu.payment_method;
                        description_name = data.FMenu.description_name;
                        speacial_deal_name = data.FMenu.speacial_deal_name;
                        tasty_eating_name = data.FMenu.tasty_eating_name;
                        calorie = data.id.FMenu.calorie;
                        $("#FMenuWord0").val(word_0);
                        $("#FMenuFoodstuffListName").val(foodstuff_list_name);
                        $("#FMenuSeasoningListName").val(seasoning_list_name);                    
                        $("#price").val(price);
                        $("#FMenuPriceunitName").val(priceunit_name);
                        $("#payment_method").val(payment_method);
                        $("#description").val(description_name);
                        $("#deals").val(speacial_deal_name);
                        $("#way_eat").val(tasty_eating_name);
                        $("#FMenuCalorie").val(calorie);
                        /*load id*/
                        menu_jp_id = data.id.FMenu.menu_jp_id;
                        foodstuff_id = data.id.FMenu.foodstuff_id;
                        seasoning_id = data.id.FMenu.seasoning_id;
                        priceunit_jp_id = data.id.FMenu.priceunit_jp_id;
                        payment_method_jp_id = data.id.FMenu.payment_method_jp_id;
                        description_jp_id = data.id.FMenu.description_jp_id;
                        speacial_deal_jp_id = data.id.FMenu.speacial_deal_jp_id;
                        tasty_eating_jp_id = data.id.FMenu.tasty_eating_jp_id;
                        
                        $("#FMenuMenuJpId").val(menu_jp_id);
                        $("#FMenuFoodstuffId").val(foodstuff_id);
                        $("#FMenuSeasoningId").val(seasoning_id);
                        $("#FMenuPriceunitJpId").val(priceunit_jp_id);
                        $("#FMenuPaymentMethodJpId").val(payment_method_jp_id);
                        $("#FMenuDescriptionJpId").val(description_jp_id);
                        $("#FMenuSpeacialDealJpId").val(speacial_deal_jp_id);
                        $("#FMenuTastyEatingJpId").val(tasty_eating_jp_id);
                    }

                });
            });
            var url,dta;
            $('.three_table tr td').on('click', function(){
               $(this).find('textarea.noBorder ').trigger('focus');
               $(this).find('input.noBorder ').trigger('focus');              
            });
            $(document).on("focusin", "#FMenuFoodstuffListName", function(event) {
                $(this).prop('readonly', true);
            });

            $(document).on("focusout", "#FMenuFoodstuffListName", function(event) {
                $(this).prop('readonly', false);
            });
             $(document).on("focusin", "#FMenuSeasoningListName", function(event) {
                $(this).prop('readonly', true);
            });

            $(document).on("focusout", "#FMenuSeasoningListName", function(event) {
                $(this).prop('readonly', false);
            });

        });
 $.validator.addMethod('onecheck', function(value, ele) {
            return $("input:checked").length >= 1;
        }, 'Please Select Atleast One CheckBox');


$("#FMenuAddForm").validate({
    rules: {
        'data[FMenu][word_0]': {
            required: true,
            // remote:{
            //      url:"<?php echo $this->Html->url(array('controller'=>'FMenus','action'=>'checkMenusExist'));?>",
            //         method: 'POST',
            //         data:{word0:function(){ return $("#FMenuWord0").val();},menu_id:function(){ return $("#FMenuId").val();}}
            // }        
        },
        'data[FMenu][foodstuff_list_name]': {
            required: true,
        },  
        'data[FMenu][seasoning_list_name]': {
            required: true,
        },   
        'data[FMenu][price]':{
            required: true,
            number: true
        }, 
        'data[FMenu][priceunit_jp_id]':{
            required: true,
        },   
        'data[FMenu][payment_method][]': {
            onecheck: true
        },   
        'data[FMenu][description_name]':{
            required: true,
        },   
        'data[FMenu][speacial_deal_name]':{
            required: true,
        },   
        'data[FMenu][tasty_eating_name]':{
            required: true,
        },   
        'data[FMenu][calories]':{
            required: true,
        },
  
    } , 
    messages:{
        'data[FMenu][word_0]': {
            required: '<?php echo ERROR_EMPTY_FIELD; ?>',
            // remote:'<?php echo ERROR_MENU_EXIST; ?>'
        },
        'data[FMenu][foodstuff_list_name]': {
            required: '<?php echo ERROR_EMPTY_FIELD; ?>',
        },  
        'data[FMenu][seasoning_list_name]': {
            required: '<?php echo ERROR_EMPTY_FIELD; ?>',
        },   
         'data[FMenu][price]':{
            required: '<?php echo ERROR_EMPTY_FIELD; ?>',
            number: '<?php echo ERROR_NUMBER_FORMAT; ?>',
        },  
        'data[FMenu][priceunit_jp_id]':{
            required: '<?php echo ERROR_EMPTY_FIELD; ?>',
        },   
        'data[FMenu][payment_method][]':{
            onecheck: '<?php echo ERROR_EMPTY_FIELD; ?>',
           
        },   
        'data[FMenu][description_name]':{
            required: '<?php echo ERROR_EMPTY_FIELD; ?>',
        },   
        'data[FMenu][speacial_deal_name]':{
            required: '<?php echo ERROR_EMPTY_FIELD; ?>',
        },   
        'data[FMenu][tasty_eating_name]':{
            required: '<?php echo ERROR_EMPTY_FIELD; ?>',
        },   
        'data[FMenu][calories]':{
            required: '<?php echo ERROR_EMPTY_FIELD; ?>'
            
        },


    }  ,
    invalidHandler: function(event, validator) {
        var errors = validator.numberOfInvalids();
    },
     errorPlacement: function( label, element ) {
         
        if(element.attr( "name" ) === "data[FMenu][payment_method][]")
        {
            $("#td_payment").append('<label id="data[FMenu][payment_method][]-error" class="error" for="data[FMenu][payment_method][]">'+label.text()+'</label>');
        }
        else if(label.text() !=''){
            label.insertAfter( element );
            }
    },
    submitHandler: function(form) {
       form.submit();
    }
});

function handleWord(id,cateId,idHidden)
{
    var word = $("#"+id).val();
    var datahidden = $('#'+idHidden).val();
    $.ajax({
        type:'POST',
        url:'<?php echo $this->Html->url(array('controller'=>'DictJas','action'=>'ajaxMulWord')); ?>',
        data:{word:word,cate_id:cateId,lang_ja_id:datahidden},
        async:false,
        success: function(data)
        {
            data = $.parseJSON(data);
            id = data.id;
            $("#"+idHidden).val(id);
        }

    });
}
function addItem(formId,type)
{
    if(type=='1')
    {
        action = '<?php echo $this->Html->url(array('controller'=>'FFoodstuffs','action'=>'add'));?>';
    }
    if(type == '2'){
        action = '<?php echo $this->Html->url(array('controller'=>'FSeasonings','action'=>'add'));?>';
    }
    $("#frmId").attr('action',action);
    dataForm = $("#"+formId).serialize();
    $("#item_data").val(dataForm);
    $('#frmId').submit();
    
} 
function handleItem(id,cateId,idHidden){
    var word = $("#"+id).val();
    $.ajax({
        type:'POST',
        url:'<?php echo $this->Html->url(array('controller'=>'DictJas','action'=>'handleItem')); ?>',
        data:{word:word,cate_id:cateId,item:idHidden},
        async:false,
        success: function(data)
        {
            data = $.parseJSON(data);
            id = data.id;
            if(!empty(id)){
                iput = "<input name='data[FMenu][priceunit_jp_id]' value='"+id+"'>";
                $("#td_payment").append(iput);            
            }
        }

    });
}
function changeHeight(id)
{
    var h = $("#"+id).height();
    $("#FMenuListMenu").css('height',(h+10)+"px");
    $("#tdMenu0").css('height',(h+12)+"px");
}
function resetHeight(id)
{
    $("#"+id).css('height','auto');
    $("#FMenuWord0").css('height','auto');
    $("#tdMenu0").css('height','auto');
}     
function addmoi(){
    $('#FMenuAddForm').attr('action','/f_menus/saveFmenu');
    $('#FMenuId').val('');     
    $('#FMenuAddForm').submit();

}
function change_language(id){
    $('#'+id).find('options selected').css({"color": "red", "border": "2px solid red"});
    var id = $('#'+id).val();
    var id_menu = $('#FMenuId').val();    
    $.ajax({
        type:'POST',
        url:'<?php echo $this->Html->url(array('controller'=>'FMenus','action'=>'changeLanguage')); ?>',
        data:{id:id,id_menu:id_menu},
        async:false,
        success: function(data){
        data = $.parseJSON(data);
           if(data.status == 1 && data.id_menu){
                location.reload();            
            } 
        }
    });
}
function deleteMenus(id)
{
    var result = confirm('メニューを削除してもよろしいですか。?');
    if(result)
    {
        window.location.href="/FMenus/delete/"+id;
    }
}
</script>