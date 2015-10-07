<div class="inner">
        <?php echo $this->Form->create('FMenu',array('id'=>'FMenuAddForm','inputDefaults'=>array('label'=>false,'div'=>false,'novalidate'=>true))) ?>
            <table class="three_table four_table">
                <tbody>
                    <tr>
                        <td colspan="2" class="ie_four"><label>メニュー名称 ：</label>
                            <?php 
                                echo $this->Form->input('word_0',array('value'=>$formEditData['FMenu']['word_0'],'class'=>'noBorder width88','type'=>'text','onblur'=>"return handleWord(this.id,1,'FMenuMenuJpId')"));
                            ?>
                            <?php 
                                echo $this->Form->hidden('menu_jp_id');
                            ?>
                    
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="tabView active" id="food" onclick="addItem('FMenuAddForm','1')">
                            <label> 食材<?php echo ($numFoodItem >0)?'（'.$numFoodItem.'品種）':'';?>： </label>
                            <?php 
                                echo $this->Form->input('foodstuff_list_name',array('value'=>$formEditData['FMenu']['foodstuff_list_name'],'type'=>'text','class'=>'noBorder  button'));
                            ?>
                            <?php 
                                echo $this->Form->hidden('foodstuff_id');
                            ?>
                        
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="tabView active" id="seasion" onclick="addItem('FMenuAddForm','2')">
                       
                            <label>  調味料<?php echo ($numSeasonItem >0)?'（'.$numSeasonItem.'品種）':'';?>：</label>
                            <?php 
                                echo $this->Form->input('seasoning_list_name',array('value'=>$formEditData['FMenu']['seasoning_list_name'],'type'=>'text','class'=>'noBorder  button'));
                            ?>
                            <?php 
                            echo $this->Form->hidden('seasoning_id');
                             ?>
                        
                        </td>
                    </tr>
                    <tr>
                        <td><label>価格 ：</label>
                            <?php echo $this->Form->input('price',array('id'=>'price','type'=>'text','class'=>'noBorder width81')); ?>
                        </td>
                        <td id="td_payment"><label>支払方法 ：</label>
                            <?php echo $this->Form->input('payment_method',array('value'=>$formEditData['FMenu']['payment_method'],'id'=>'payment_method','type'=>'text','class'=>'noBorder width81','onblur'=>"return handleWord(this.id,5,'FMenuPaymentMethodJpId')")); ?>
                            <?php echo $this->Form->hidden('payment_method_jp_id') ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><label>紹介情報：</label>
                            <?php echo $this->Form->input('description_name',array('value'=>$formEditData['FMenu']['description_name'],'id'=>'description','type'=>'text','class'=>'noBorder width91','onblur'=>"return handleWord(this.id,7,'FMenuDescriptionJpId')")); ?>
                            <?php echo $this->Form->hidden('description_jp_id'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><label>お得情報：</label>
                            <?php echo $this->Form->input('speacial_deal_name',array('value'=>$formEditData['FMenu']['speacial_deal_name'],'id'=>'deals','type'=>'text','class'=>'noBorder width91','onblur'=>"return handleWord(this.id,7,'FMenuSpecialDealJpId')")); ?>
                             <?php echo $this->Form->hidden('special_deal_jp_id'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><label>おいしい食べ方：</label>
                            <?php echo $this->Form->input('tasty_eating_name',array('value'=>$formEditData['FMenu']['tasty_eating_name'],'id'=>'way_eat','type'=>'text','class'=>'noBorder width87','onblur'=>"return handleWord(this.id,7,'FMenuTastyEatingJpId')")); ?>
                            <?php echo $this->Form->hidden('tasty_eating_jp_id'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><label>ボリューム：</label>
                            <?php echo $this->Form->input('volum',array('id'=>'volum','type'=>'text','class'=>'noBorder width90')); ?>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="sbButton">
                    <?php echo $this->Form->input('Submit',array('type'=>'submit','class'=>'submitBut')); ?>
            </div>

        <?php echo $this->Form->end(); ?>
    </div>
    <?php 
         echo $this->Form->create('Item',array('id'=>'frmId'));
         echo $this->Form->hidden('form_data',array('id'=>'item_data'));
    ?>
    <?php echo $this->Html->script('jquery.validate.min');?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            var url,dta;
            function handleMenu(id,action){
                // alert(id);
                var url,dta;
                $(id).blur(function(){
                dta = {keyWord: $(id).val()};
                url = '/dictjas/'+action;
                // use ajax
                $.ajax({
                    type: 'post',
                    url: url,
                    data: dta,
                    dataType: 'JSON',
                    success: function (res) {
                        $('#price').val(res.data.FMenu.price);                      
                    },
                });
                
            });
            }
        });
$("#FMenuAddForm").validate({
    rules: {
        'data[FMenu][word_0]': {
            required: true,
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
        'data[FMenu][payment_method]':{
            required: true,
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
        'data[FMenu][volum]':{
            required: true,
        }
  
    } , 
    messages:{
        'data[FMenu][word_0]': {
            required: '<?php echo ERROR_EMPTY_FIELD; ?>',
        },
        'data[FMenu][foodstuff_list_name]': {
            required: '<?php echo ERROR_EMPTY_FIELD; ?>',
        },  
        'data[FMenu][seasoning_list_name]': {
            required: '<?php echo ERROR_EMPTY_FIELD; ?>',
        },   
         'data[FMenu][price]':{
            required: '<?php echo ERROR_EMPTY_FIELD; ?>',
        },   
        'data[FMenu][payment_method]':{
            required: '<?php echo ERROR_EMPTY_FIELD; ?>',
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
        'data[FMenu][volum]':{
            required: '<?php echo ERROR_EMPTY_FIELD; ?>',
        }        

    }  ,
    invalidHandler: function(event, validator) {
        var errors = validator.numberOfInvalids();

       

    },
     errorPlacement: function( label, element ) {
         if(label.text() !=''){
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
    $.ajax({
        type:'POST',
        url:'<?php echo $this->Html->url(array('controller'=>'DictJas','action'=>'ajaxMulWord')); ?>',
        data:{word:word,cate_id:cateId},
        async:false,
        success: function(data)
        {
            data = $.parseJSON(data);
            id = data.id;
            $("#"+idHidden).val(id);
            console.log(data);
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
            console.log(data);
        }

    });
}     
</script>