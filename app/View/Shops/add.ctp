<script type="text/javascript">
    $(document).ready(function() {
        $('#ListMenu').multiselect({
            // enableFiltering: true,
            filterBehavior: 'text',
            includeSelectAllOption: false,
            // maxHeight: 200,
            maxHeight:true,
            selectAll:true,
            nonSelectedText:"CHOOSE MENU",
            buttonWidth:'99%',
            disableIfEmpty:true,
            enableHTML:true
        });
    });
    $('.div_multiselect').find('.btn-group ul').addClass('test');
</script>
<style type="text/css">
        label.error {
            float: none; color: red;
            padding-left: .3em; vertical-align: top;  
        }    
        .ms-select-all li{float: left;}
        .dropdown-menu>.active>a, .dropdown-menu>.active>a:focus, .dropdown-menu>.active>a:hover{
            color: black !important;
            text-decoration: none;
            background-color: white !important;
            outline: 0;
        }
        .width_multiselect{ width: 445% !important;}
        /*.btn-group, .btn-group-vertical{
                position: relative;
                display: inline-block !important;
                vertical-align: middle;
                z-index: 9999999;
        }*/
        .test{width: 99% !important;}
        .dropdown-menu{width: 99% !important;margin-bottom: 20px !important}
</style>
<div class="inner">
        <?php echo $this->Form->create('FShop',array(/*'url'=>array('action'=>'saveShop'),*/'id'=>'FShopAddForm','inputDefaults'=>array('label'=>false,'div'=>false,'novalidate'=>true))) ?>
             <?php 
                echo $this->Form->hidden('id');
            ?> 
            <table class="three_table four_table">
                <tbody>
                    <tr>
                        <td class="title" colspan="6">
                            <?php echo __('店舗情報登録'); ?>                             
                    <br>
                    <?php echo __('個別登録') ?> ／ <?php echo __('一括登録') ?>
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
                            <?php echo __('Name shop'); ?> 
                        </th> 
                        <?php if(!empty($options)): ?>    
                        <td colspan="5" class="ie_four select-editable " id="tdMenu0">
                            <?php  echo $this->Form->input('listMenu',array('options'=>$options,'empty'=>SELECT_MENU,'onchange'=>'resetHeight(this.id)')); ?>
                            <?php 
                                echo $this->Form->input('word_0',array('type'=>'textarea','style'=>'border: none','rows'=>1,'onblur'=>"return handleWord(this.id,11,'FShopShopJpId')",'onkeypress'=>'changeHeight(this.id)'));
                            ?>
                            <?php 
                                echo $this->Form->hidden('shop_jp_id');
                            ?> 
                                     
                        </td>
                    <?php else: ?>
                        <td colspan="5" class="ie_four" >
                        
                            <?php 
                                echo $this->Form->input('word_0',array('id'=>'FShopWord0','class'=>'noBorder width100','type'=>'textarea','rows'=>1,'onblur'=>"return handleWord(this.id,11,'FShopShopJpId')"));
                            ?>
                            <?php 
                                echo $this->Form->hidden('shop_jp_id');
                            ?>                    
                        </td>
                        
                    <?php endif; ?>    
                    </tr>
                    <tr>
                        <th class="width20" style="width:10%">
                            <?php echo __('login_id'); ?> 
                        </th>
                        <td colspan="5">
                            <?php echo $this->Form->input('login_id',array('type'=>'textarea','rows'=>1,'class'=>'noBorder width100')); ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="width20" style="width:10%">
                            <?php echo __('password'); ?> 
                        </th>
                        <td colspan="5">
                            <?php echo $this->Form->input('password',array('type'=>'textarea','rows'=>1,'class'=>'noBorder width100')); ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="width20" style="width:10%">
                            <?php echo __('zipcode'); ?> 
                        </th>
                        <td colspan="5">
                            <?php echo $this->Form->input('zipcode',array('type'=>'textarea','rows'=>1,'class'=>'noBorder width100')); ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="width20" style="width:10%">
                            <?php echo __('address1'); ?> 
                        </th>
                        <td colspan="5">
                            <?php echo $this->Form->input('address1',array('id'=>'FShopAddress1','type'=>'textarea','rows'=>1,'class'=>'noBorder width100','onblur'=>"return handleWord(this.id,12,'FShopAddress1JpId')")); ?>
                            <?php echo $this->Form->hidden('address1_jp_id'); ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="width20" style="width:10%">
                            <?php echo __('address2'); ?> 
                        </th>
                        <td colspan="5">
                            <?php echo $this->Form->input('address2',array('id'=>'FShopAddress2','type'=>'textarea','rows'=>1,'class'=>'noBorder width100','onblur'=>"return handleWord(this.id,13,'FShopAddress2JpId')")); ?>
                            <?php echo $this->Form->hidden('address2_jp_id'); ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="width20" style="width:10%">
                            <?php echo __('lat'); ?> 
                        </th>
                        <td colspan="5">
                            <?php echo $this->Form->input('lat',array('id'=>'description','type'=>'textarea','rows'=>1,'class'=>'noBorder width100')); ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="width20" style="width:10%">
                            <?php echo __('long'); ?> 
                        </th>
                        <td colspan="5">
                            <?php echo $this->Form->input('long',array('id'=>'description','type'=>'textarea','rows'=>1,'class'=>'noBorder width100')); ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="width20" style="width:10%">
                            <?php echo __('url'); ?> 
                        </th>
                        <td colspan="5">
                            <?php echo $this->Form->input('url',array('id'=>'description','type'=>'textarea','rows'=>1,'class'=>'noBorder width100')); ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="width20" style="width:10%">
                            <?php echo __('email'); ?> 
                        </th>
                        <td colspan="5">
                            <?php echo $this->Form->input('email',array('id'=>'description','type'=>'textarea','rows'=>1,'class'=>'noBorder width100')); ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="width20" style="width:10%">
                            <?php echo __('tel'); ?> 
                        </th>
                        <td colspan="5">
                            <?php echo $this->Form->input('tel',array('id'=>'description','type'=>'textarea','rows'=>1,'class'=>'noBorder width100')); ?>
                        </td>
                    </tr> 
                    <tr>
                        <th class="width20" style="width:10%">
                            <?php echo __('List menu'); ?> 
                        </th>
                        <td colspan="5" class="div_multiselect">
                                <?php  
                                    echo $this->Form->input('listMenu',array(
                                        'multiple'  =>'multiple',
                                        'options'   => $listmenu,
                                        'id'        =>'ListMenu',
                                        'size'      => 5,
                                  )); 
                                  ?> 
                                        
                        </td>
                    </tr>                   
                </tbody>
            </table>
            <div class="sbButton">
                    <?php echo $this->Form->button(BACK_BUTTON,array('class'=>'submitBut','type'=>'button','onclick'=>"window.location.href='/Shops/'")) ;?>
                    <?php echo $this->Form->button('変更',array('type'=>'submit','class'=>'submitBut','div'=>false)); ?>
                    <?php if(!empty($exit_id)): ?>
                        <?php $id = $exit_id;?>
                        <?php echo $this->Form->button(SUBMIT_BUTTON,array('type'=>'button','class'=>'submitBut','div'=>false,'onclick'=>'return addmoi()')); ?>
                        <?php echo $this->Form->button('削除',array('type'=>'button','class'=>'submitBut','onclick'=>"return deleteMenus($id)")); ?>
                    <?php else: ?>
					<?php //echo $this->Form->button(__('登録'),array('type'=>'submit','class'=>'submitBut','div'=>false)); ?>
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

$("#FShopAddForm").validate({
    rules: {
        'data[FShop][word_0]': {
            required: true,
            // remote:{
            //      url:"<?php echo $this->Html->url(array('controller'=>'FMenus','action'=>'checkMenusExist'));?>",
            //         method: 'POST',
            //         data:{word0:function(){ return $("#FMenuWord0").val();},menu_id:function(){ return $("#FMenuId").val();}}
            // }        
        },
        'data[FShop][login_id]': {
            required: true,
            number: true,
        },  
        'data[FShop][password]': {
            required: true,
        },   
        // 'data[FShop][zipcode]':{
        //     // required: true,
        //     number: true
        // }, 
        // 'data[FShop][address1]':{
        //     required: true,
        // },   
        // 'data[FShop][address2]': {
        //     onecheck: true
        // },   
        // 'data[FShop][lat]':{
        //     number: true,
        // },   
        // 'data[FShop][long]':{
        //     number: true,
        // },   
        // 'data[FShop][url]':{
        //     required: true,
        // },   
        // 'data[FShop][email]':{
        //     email: true,
        // },
        // 'data[FShop][tel]':{
        //     maxlength: true,
        // },
  
    } , 
    messages:{
        'data[FShop][word_0]': {
            required: '<?php echo ERROR_EMPTY_FIELD; ?>',
            // remote:'<?php echo ERROR_MENU_EXIST; ?>'
        },
        'data[FShop][login_id]': {
            required: '<?php echo ERROR_EMPTY_FIELD; ?>',
            number: 'Must enter number',
        },  
        'data[FShop][password]': {
            required: '<?php echo ERROR_EMPTY_FIELD; ?>',
        },   
        //  'data[FShop][zipcode]':{
        //     required: '<?php echo ERROR_EMPTY_FIELD; ?>',
        //     number: '<?php echo ERROR_NUMBER_FORMAT; ?>',
        // },  
        // 'data[FShop][address1]':{
        //     required: '<?php echo ERROR_EMPTY_FIELD; ?>',
        // },   
        // 'data[FShop][address2]':{
        //     onecheck: '<?php echo ERROR_EMPTY_FIELD; ?>',
           
        // },   
        // 'data[FShop][lat]':{
        //     required: '<?php echo ERROR_EMPTY_FIELD; ?>',
        // },   
        // 'data[FShop][long]':{
        //     required: '<?php echo ERROR_EMPTY_FIELD; ?>',
        // },   
        // 'data[FShop][url]':{
        //     required: '<?php echo ERROR_EMPTY_FIELD; ?>',
        // },   
        // 'data[FShop][tel]':{
        //     maxlength: '<?php echo ERROR_EMPTY_FIELD; ?>'
            
        // },


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
    if(word != ''){
        $.ajax({
            type:'POST',
            url:'<?php echo $this->Html->url(array('controller'=>'DictJas','action'=>'ajaxMulWord')); ?>',
            data:{word:word,cate_id:cateId,lang_ja_id:datahidden},
            async:true,
            success: function(data)
            {
                data = $.parseJSON(data);
                id = data.id;
                $("#"+idHidden).val(id);
                console.log(data);
            }

        });
    }
    return;
    
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
                console.log(data);          
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
        window.location.href="/shops/delete/"+id;
    }
}

</script>