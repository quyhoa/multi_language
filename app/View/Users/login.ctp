<div class="inner">
        <div class="form-signin">        
            <?php echo $this->Form->create('User',array('inputDefaults'=>array('label'=>false,'div'=>false,'novalidate'=>true,'required'=>false))); ?>
                <h2 class="h2Login"><?php echo TITLE_LOGIN; ?></h2> 
                <?php echo $this->Session->flash();?>               
                <?php echo $this->Form->input('email',array('id'=>'email','class'=>'form-control','type'=>'email','placeholder'=>'Email address')); ?>                
                <?php echo $this->Form->input('password',array('id'=>'password','class'=>'form-control','type'=>'password','placeholder'=>'Password')); ?>
                <div class="checkbox">
                    <label>
                        <?php echo $this->Form->input('Remember',array('type'=>'checkbox')); ?>
                        <?php echo LABEL_REMEMER;?>
                    </label>
                </div>
                <?php echo $this->Form->input(LOGIN_BUTTON,array('class'=>'btn-submit','type'=>'submit','style'=>"float: left; margin: 0px;")); ?>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
   <?php echo $this->Html->script('jquery.validate.min');?>     
<script>
$("#UserLoginForm").validate({
    rules: {
        'data[User][email]': {
            required: true,
            email: true,
           
        },
        'data[User][password]':{
             required: true,
             minlength: 6,
        }
       
  
    } , 
    messages:{
        'data[User][email]': {
            required: '<?php echo ERROR_EMPTY_FIELD_ADDRESS; ?>',
            email: '<?php echo ERROR_EMAIL_FORMAT ;?>',
            
        },
        'data[User][password]': {
            required: '<?php echo ERROR_EMPTY_FIELD_PASS; ?>',
            minlength: '<?php echo ERROR_LENGTH_PASS ;?>',
            
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
</script>    