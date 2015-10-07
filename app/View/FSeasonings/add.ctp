<?php 
$check_language = $this->Session->read('Config.language');
 ?>
<div class="inner">
        <?php $id = empty($id)?'':$id; ?>
        <?php echo $this->Form->create('FSeasoning',array('url'=>array('controller'=>'FMenus','action'=>'add',$id),'inputDefaults'=>array('label'=>false,'div'=>false,'novalidate'=>true))); ?>
            <?php echo $this->Form->hidden('form_data',array('value'=>$formData));?>
            <?php echo $this->Form->hidden('item_data',array('value'=>$itemData));?>
            <table class="three_table fourb_table" id='tbl_item'>
                <tbody id="t1">
                    <tr>
                        <th colspan="4" class="textCenter title"><?php echo __('調味料入力画面') ?></th>
                    </tr>
                    <tr>
                        <td colspan="4" class="textCenter ie_fourb"><label style="float:none"><?php echo __('調味料数') ?>：</label>
                        <?php if($check_language=='ja'): ?>
                            <input id="amount" class="noBorder width10" type="text" name="amount" value="<?php echo $numItem ?>">
                        <?php else: ?>
                            <input id="amount" class="noBorder width10" type="text" name="amount" value="<?php echo $numItem ?>" readonly>
                        <?php endif; ?>
                        </td>
                    </tr>
                    <?php if($numItem>0){
             
                        for($k=0;$k<ceil($numItem/2);$k++)
                        {
                            $m = $k*2+1;
                            $n = $m-1;

                    ?>
                    <tr id="<?php echo "row_".($k+1);?>">
                        <th><?php echo __('調味料') ?> <?php echo $m;?></th>
                        <td>  
                        <?php 
                            $vl = empty($seasoning_id[$n])?'':$seasoning_id[$n];
                                echo $this->Form->input('FSeasoning.item_name.'.$n,array('type'=>'textarea','rows'=>1,'value'=>isset($seasonItemName[$n])?$seasonItemName[$n]:'','id'=>'item_name_'.$n,'class'=>'noBorder width100','onblur'=>'return handleWord(this.id,3,'.$n.') ','onkeypress'=>'loadSuggest(this.id,'.$n.')'));
                            if(!empty($vl)){
                                echo $this->Form->hidden('sea_id_'.$n,array('value'=>$seasoning_id[$n]));}
                        ?>
                        </td>
                        <th><?php echo __('調味料') ?> <?php echo $m+1;?></th>
                        <td>
                        <?php   
                            $vl = empty($seasoning_id[$m])?'':$seasoning_id[$m];
                            echo $this->Form->input('FSeasoning.item_name.'.($m),array('type'=>'textarea','rows'=>1,'value'=>isset($seasonItemName[$m])?$seasonItemName[$m]:'','id'=>'item_name_'.$m,'class'=>'noBorder width100','onblur'=>'return handleWord(this.id,3,'.$m.') ','onkeypress'=>'loadSuggest(this.id,'.$m.')'));
                           if(!empty($vl)){echo $this->Form->hidden('sea_id_'.$m,array('value'=>$seasoning_id[$m]));}
                        ?>
                        </td>
                       
                    </tr>
                    <?php
                        }        
                    }
                    ?>
                </tbody>
            </table>
            <?php if($check_language == FROM_LANGUAGE): ?>
                <div onclick="addRow()" style='  margin-top: -16px; padding-left: 5px;  cursor: pointer;'>
                    <?php echo $this->Html->image('addRow.jpg'); ?>
                </div>
            <?php endif; ?>
            <!--
            <table class="three_table fourb_table">
                <tbody>
                    <tr>
                        <td class="ie_fourb">
                        <?php echo $this->Form->input('',array('class'=>'noBorder width92','type'=>'text','value'=>'調味料リスト')); ?>
                        </td>
                        <td><label>調味料候補：</label>
                        <?php echo $this->Form->input('',array('class'=>'noBorder width77','type'=>'text','value'=>'ぎ　→　牛肉')); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="ie_fourb"><input class="noBorder width92" type="text" value="穀物" name=""></td>
                        <td class="bdbt_none"><input class="noBorder width92" type="text" value="野菜" name=""></td>
                    </tr>
                    <tr>
                        <td class="bdr_none"><input class="noBorder width92" type="text" value="魚介類" name=""></td>
                        <td class="grColor"><input class="noBorder width92 grColor" type="text" value="肉類" name=""></td>
                    </tr>
                    <tr>
                        <td><input class="noBorder width92" type="text" value="フルーツ類" name=""></td>
                        <td><input class="noBorder width92" type="text" value="麺類" name=""></td>
                    </tr>
                </tbody>
            </table> -->
            <div class="sbButton">
                <?php echo $this->Form->button(BACK_BUTTON,array('class'=>'submitBut','type'=>'button','onclick'=>'window.history.back()')) ?>
                <?php echo $this->Form->button(ADD_SEA,array('class'=>'submitBut','type'=>'submit','div'=>false,'onclick'=>'return validateForm()')) ?>
            </div>
       <?php echo $this->Form->end(); ?>
    </div>
   <?php echo $this->Html->script('jquery.validate.min');?> 
   <?php echo $this->Html->script('autosize.min');?>
   <script type="text/javascript">
        var count = '<?php echo $numItem;?>';
        function stopEnter(evt) { 
              var evt = (evt) ? evt : ((event) ? event : null); 
              var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null); 
              if ((evt.keyCode == 13) && (node.type=="text"))  {return false;} 
        } 

        document.onkeypress = stopEnter; 
        jQuery(document).ready(function($) {
            var url,dta;
            var tr = '';
            autosize(document.querySelectorAll('textarea'));
           
            $('#amount').blur(function(){
                var amount = $('#amount').val();
                var numRow = $("#tbl_item tr").length-2;
                numRow = parseInt(numRow);
                if(checkPositiveNumber(amount)){

                    if(amount >numRow*2){
                        
                        count = Math.ceil(amount/2);
                        amount = count-numRow;
                        var j = numRow;
                        var num = numRow;
                        for(var i=0; i < amount;i++ ){
                            
                            j = num*2+1;
                            num++;
                            tr ="<tr id='row_"+num+"'>";
                                tr += "<th>調味料 "+j+"</th>";
                                tr += "<td>";
                                tr += "<textarea rows='1'  name='data[FSeasoning][item_name]["+j+"]' class='noBorder width100' type='text' id='item_name_"+j+"' onblur='return handleWord(this.id,3,"+j+") ' onkeypress='loadSuggest(this.id,"+j+")'></textarea>";
                                tr +="</td>";
                                j = j+ 1;
                                tr += "<th>調味料"+j+"</th>";
                                tr += "<td>";
                                tr += "<textarea rows='1'  name='data[FSeasoning][item_name]["+j+"]' class='noBorder width100' type='text' id='item_name_"+j+"' onblur='return handleWord(this.id,3,"+j+") ' onkeypress='loadSuggest(this.id,"+j+")'></textarea>";
                                tr +="</td>";
                                tr +="</tr>";
                           
                             $("#t1").append(tr);   
                             autosize(document.querySelectorAll('textarea'));           
                        }
                    }
                    else{
                        count = Math.ceil(amount/2);
                        while(numRow >count)
                        {
                            handleRemoveItem(3,numRow);
                            $("#row_"+numRow).remove();
                            numRow--;
                        }
                    }  
                }      
            });
             $('.three_table tr td').on('click', function(){
                $(this).find('textarea').trigger('focus');
                $(this).find('input').trigger('focus');
                $(".list_option").remove();
              
            });
        });
function checkPositiveNumber(value)
{
    var preg = /^[0-9]*$/;
    return preg.test(value) && (parseInt(value) >0);
}
jQuery.validator.addMethod("addItem", function(value, element){ 
    var idItem = $("#FSeasoningItemData").val();
    if(idItem=='')
    {
        return false;
    }
    else{
        return true;
    }
});
$.validator.addMethod('positiveNumber',  function (value,element) { 
   return checkPositiveNumber(value);
},""
);
function validateForm()
{
    $("#FSeasoningAddForm").validate({
        rules: {
            'amount': {
                required: true,
                number: true,
                positiveNumber:true,
                addItem:true
            },                 
        } , 
        messages:{
            'amount': {
                required: '<?php echo ERROR_EMPTY_FIELD; ?>',
                number: '<?php echo ERROR_NUMBER_FORMAT ;?>',
                positiveNumber: '<?php echo ERROR_POSITIVE_NUMBER_SEASON ;?>',
                addItem: '<?php echo ERROR_EMPTY_ITEM_SEASON ;?>'
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
}    
function handleWord(id,cateId,idHidden)
{
    var word = $("#"+id).val();
           if ($("#FSeasoningSeaId"+idHidden).length) {
                var list_item = $("#FSeasoningSeaId"+idHidden).val();
            }else{
                var list_item = '';
            }
        $.ajax({
            type:'POST',
            url:'<?php echo $this->Html->url(array('controller'=>'DictJas','action'=>'ajaxMulItem')); ?>',
            data:{word:word,cate_id:cateId,item:idHidden,list_item:list_item},
            async:false,
            success: function(data)
            {
                data = $.parseJSON(data);
                text = data.text;
                lang = "<?php echo $check_language ?>";
                if(lang == 'eng' && text == ''){
                    alert('福言語で表示する場合は、登録した内容を追加・削除することができません。');
                    $("#"+id).focus();
                }  
                id = data.id;
                $("#FSeasoningItemData").val(id);            
            }
        });
}
function handleRemoveItem(cateId,row)
{
    $.ajax({
        url:'<?php echo $this->Html->url(array('controller'=>'DictJas','action'=>'removeItem')) ?>',
        type: 'POST',
        async:false,
        data:{ cate_id:cateId,row:row},
        success:function(data)
        {
            $("#FSeasoningItemData").val(data);
        }
    });
}
function loadSuggest(id,k)
{
    var  word0= $("#"+id).val();
    var parentWidth= $("#"+id).css("width");
    var parentWidth = parseInt(parentWidth)-10;
    $.ajax({
        type:"POST",
        url:"<?php echo $this->Html->url(array('controller'=>'DictJas','action'=>'suggestWord'));?>",
        data:{word0:word0},
        success:function(data)
        {
            data = $.trim(data);
            var li = '';
            if(data)
            {
                data = $.parseJSON(data);
                $.each(data, function (index, value) {
                        li += '<li onclick="return setValue(\''+id+'\',\''+value+'\')">'+value+'</li>';
                });
                if(li){
                    if($("#suggest_"+k).length)
                    {
                        list = li;
                        $("#suggest_"+k).html(list);
                        
                    }
                    else
                    {
                        list = '<ul class="list_option" id="suggest_'+k+'">'
                        list += li;
                        list += '</ul>';
                        $("#"+id).parent().append(list);
                       
                    }
                    $(".list_option").css({'display':'block','width':parentWidth+'px'});
                }                
            }
        }
    });
    
}
function setValue(id,value)
{
    $("#"+id).val(value);
    $(".list_option").remove();
} 
document.onclick = function(){
    $(".list_option").remove();
}  
function addRow()   {
   
    var amount      = $('#amount').val();
    var numRow      = $("#tbl_item tr").length-2;
    numRow          = parseInt(numRow);
    amount          = parseInt(amount);
    amountCurrent   = amount;
    amount          = amount + 2;
    $('#amount').val(amount);
    count = Math.ceil(amount/2);
            amount  = count-numRow;
            var j   = numRow;
            var num = numRow;
            for(var i=0; i < amount;i++ ){                            
                j = num*2+1;
                num++;
                tr ="<tr id='row_"+num+"'>";
                tr += "<th>調味料 "+j+"</th>";
                tr += "<td>";
                tr += "<textarea rows='1'  name='data[FSeasoning][item_name]["+j+"]' class='noBorder width100' type='text' id='item_name_"+j+"' onblur='return handleWord(this.id,3,"+j+") ' onkeypress='loadSuggest(this.id,"+j+")'></textarea>";
                tr +="</td>";
                j = j+ 1;
                tr += "<th>調味料"+j+"</th>";
                tr += "<td>";
                tr += "<textarea rows='1'  name='data[FSeasoning][item_name]["+j+"]' class='noBorder width100' type='text' id='item_name_"+j+"' onblur='return handleWord(this.id,3,"+j+") ' onkeypress='loadSuggest(this.id,"+j+")'></textarea>";
                tr +="</td>";
                tr +="</tr>";
           
             $("#t1").append(tr);   
             autosize(document.querySelectorAll('textarea'));             
            }
                 
}    
</script>