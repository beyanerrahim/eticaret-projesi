

$(function(){

    'use strict';
     
    // Hide Placeholder On Form Focus
    $('[placeholder]').focus(function(){
        
        $(this).attr('data-text',$(this).attr('placeholder'));
        $(this).attr('placeholder','');
    }).blur(function(){
        $(this).attr('placeholder',$(this).attr('data-text'));
    });
  
  //Add Asterisk on required field
  $('input').each(function(){
    if($(this).attr('required') === 'required'){
        $(this).after('<span class="asterisk">*</span>');
    }
  });

// convert  password field to text field on hover
var passfield =$('.password');
$('.show-pass').hover(function(){
    passfield.attr('type','text');

},function(){
    passfield.attr('type','password');
});

// confirmation Message on button
$('.confirm').click(function(){
    return confirm('Are your sure ?');
});
  

// $('.links').hover(function(){
//     $('.links a').attr('class','active');

// },function(){
//     $('.links a').attr('class','');
// });
});
  