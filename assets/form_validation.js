/****************************** validation on page load *****************************/
$(document).ready(function(e) {                 
    /****************************** validation on submit *****************************/
       $('.submit-form').click(function(e) {   
            var val=0;     
             /*------------------- first name validation --------------- */           
                var fntxt = $('#fntxt');                
                        if (!(fntxt.val().length<2)){
                            if(fntxt.val().match(/^[a-zA-Z]+$/)){
                                fntxt.next().empty();
                            }else{
                               fntxt.next().text("Only Alfabet Required");
                               fntxt.next().css({"color":"red"});
                               val=1; 
                            }
                        }else{
                            fntxt.next().text("Minimum 2 character Required");
                            fntxt.next().css({"color":"red"});                            
                            val=1; 
                        }           
           /*------------------- first name validation --------------- */  
           /*------------------- last name validation --------------- */           
                var lntxt = $('#lntxt');
                        if (!(lntxt.val().length<2)){
                            if(lntxt.val().match(/^[a-zA-Z]+$/)){
                                lntxt.next().empty();
                            }else{
                               lntxt.next().text("Only Alfabet Required");
                               lntxt.next().css({"color":"red"});
                               val=1; 
                            }
                        }else{
                            lntxt.next().text("Minimum 2 character Required");
                            lntxt.next().css({"color":"red"});                            
                            val=1; 
                        }           
           /*------------------- last name validation --------------- */
            /*------------------- email --------------- */         
                var email = $('#email');
                    if(!(email.val().match(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/))){
                             email.next().text("Enter proper email");
                             email.next().css({"color":"red"}); 
                             val=1; 
                    }else{
                       email.next().empty();
                    }
            /*------------------- email --------------- */              
            /*------------------- valid email --------------- */         
                var emailerr = $('#emailerr');
                    if(!(emailerr.val()=="")){
                             email.next().text("Enter proper email");
                             email.next().css({"color":"red"}); 
                             val=1; 
                    }else{
                       email.next().empty();
                    }
            /*------------------- email --------------- */
            /*------------------- password validation --------------- */        
                var pwd = $('#pwd');
                    if(pwd.val().match(/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%&]).*$/)){
                            if ((pwd.val().length<8) || (pwd.val().length>32)){
                                pwd.next().text("Password Must be at least 8 to 32 characters");
                                pwd.next().css({"color":"red"});
                                val=1; 
                            }else{
                               pwd.next().empty();
                            }
                    }else{
                        pwd.next().text("At least 1 number, 1 lowercase, 1 uppercase letter,At least 1 special character from @#$%& Required");
                        pwd.next().css({"color":"red"});
                        val=1; 
                    }
             /*------------------- password validation --------------- */
             /*------------------- confirm mobile validation --------------- */  
                var cpwd = $('#cpwd');
                        if(cpwd.val().match(pwd.val())){
                                cpwd.next().empty();
                            }else{
                                cpwd.next().text("Pawssword Not Match");
                                cpwd.next().css({"color":"red"});
                                val=1; 
                            }
            /*------------------- confirm mobile validation --------------- */
             /*------------------- occupation validation --------------- */
                var pro = $('#pro');
                        if (!(pro.val().length<2)){
                            if(pro.val().match(/^[a-zA-Z]+$/)){
                                pro.next().empty();
                            }else{
                               pro.next().text("Only Alfabet Required");
                               pro.next().css({"color":"red"});
                               val=1; 
                            }
                        }else{
                            pro.next().text("Minimum 2 character Required");
                            pro.next().css({"color":"red"});                            
                            val=1; 
                        }           
           /*------------------- occupation validation --------------- */ 
           /*------------------- mobile validation --------------- */
                var mbl = $('#mbl');
                    if((mbl.val().match(/^([+0-9]{1,3})?([0-9]{10,11})$/i))){
                          if (mbl.val().length==10){
                                mbl.next().empty();
                            }else{
                                mbl.next().text("Mobile Number Contain Only 10 Digit");
                                mbl.next().css({"color":"red"}); 
                                val=1; 
                            }   
                    }else{
                        mbl.next().text("Enter proper Mobail Number");
                        mbl.next().css({"color":"red"}); 
                        val=1; 
                    }                
            /*------------------- mobile validation --------------- */
             /*------------------- address validation --------------- */
                var add = $('#add');
                        if (add.val().length<10){
                            add.next().text("Minimum 10 character Required");
                            add.next().css({"color":"red"});
                            val=1; 
                        }else{
                           add.next().empty();
                        }   
             /*------------------- address validation --------------- */        
             /*------------------- captcha validation --------------- */                   
                var cap = $('#captcha_code');
                        if (cap.val().length==""){
                            cap.next().text("Required");
                            cap.next().css({"color":"red"});
                            val=1; 
                        }else{
                           cap.next().empty();
                        }   
             /*------------------- captch validation --------------- */   
             /*------------------- agree validation --------------- */   
                    var agg = $('#agreeterm');
                    if(agg.is(':checked')!=true){
                        val=1; 
                    }
             /*------------------- agree validation --------------- */  
              if(val==1){
                e.preventDefault();
                return false;
             }            
       }); 
    /****************************** validation on submit *****************************/   
   
    /****************************** validation on blur *****************************/
           /*------------------- firstname,lastname,occupation validation --------------- */   
                $("#fntxt,#lntxt,#pro").on("blur", function() {                
                        if (!($(this).val().length<2)){
                            if($(this).val().match(/^[a-zA-Z]+$/)){
                                $(this).next().empty();
                            }else{
                                $(this).next().text("Only Alfabet Required");
                                $(this).next().css({"color":"red"});  
                            }
                        }else{
                            $(this).next().text("Minimum 2 character Required");
                            $(this).next().css({"color":"red"});                            
                        }
            }); 
        /*------------------- firstname,lastname,occupation validation --------------- */      
        /*------------------- email validation --------------- */             
            $("#email").on("blur", function() {
                if(!($(this).val().match(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/))){
                         $(this).next().text("Enter proper email");
                         $(this).next().css({"color":"red"});  
                }else{
                   $(this).next().empty();
                }
            });       
        /*------------------- email validation --------------- */       
         /*------------------- password validation --------------- */      
            $("#pwd").on("blur", function() {
                if($(this).val().match(/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%&]).*$/)){
                        if (($(this).val().length<8) || ($(this).val().length>32)){
                            $(this).next().text("Password Must be at least 8 to 32 characters");
                            $(this).next().css({"color":"red"});                            
                        }else{
                           $(this).next().empty();
                        }
                }else{
                   $(this).next().text("At least 1 number, 1 lowercase, 1 uppercase letter,At least 1 special character from @#$%& Required");
                    $(this).next().css({"color":"red"});
                }
            });       
         /*------------------- password validation --------------- */    
         /*------------------- login password validation --------------- */      
            $("#lpwd").on("blur", function() {
                if($(this).val()!=""){
                        if (($(this).val().length<8) || ($(this).val().length>32)){
                            $(this).next().text("Password Must be at least 8 to 32 characters");
                            $(this).next().css({"color":"red"});                            
                        }else{
                           $(this).next().empty();
                        }
                }else{
                   $(this).next().text("Required");
                    $(this).next().css({"color":"red"});
                }
            });       
         /*------------------- login password validation --------------- */       
         /*------------------- confirm mobile validation --------------- */     
            $("#cpwd").on("blur", function() {
                if($(this).val().match($("#pwd").val())){
                        $(this).next().empty();
					}else{
						$(this).next().text("Pawssword Not Match");
                        $(this).next().css({"color":"red"});					   
					}
            });    
        /*------------------- confirm mobile validation --------------- */         
        /*------------------- mobile validation --------------- */       
           $("#mbl").on("blur", function() {
                if(($(this).val().match(/^([+0-9]{1,3})?([0-9]{10,11})$/i))){
                      if ($(this).val().length==10){
                            $(this).next().empty();
                        }else{
                            $(this).next().text("Mobile Number Contain Only 10 Digit");
                            $(this).next().css({"color":"red"});                   
                        }   
                }else{
                    $(this).next().text("Enter proper Mobail Number");
                    $(this).next().css({"color":"red"}); 
                }
            });
        /*------------------- mobile validation --------------- */ 
        /*------------------- address validation --------------- */
            $("#add").on("blur", function() {
                        if ($(this).val().length<10){
                    $(this).next().text("Minimum 10 character Required");
                            $(this).next().css({"color":"red"});                            
                        }else{
                           $(this).next().empty();
                        }       
            });    
         /*------------------- address validation --------------- */      
        /*------------------- address validation --------------- */   
            $("#captcha_code").on("blur", function() {
                        if ($(this).val().length==""){
                            $(this).next().text("Required");
                            $(this).next().css({"color":"red"});
                        }else{
                           $(this).next().empty();
                        }       
            });    
         /*------------------- address validation --------------- */  
    /****************************** validation on blur *****************************/
    /****************************** validation on submit *****************************/
       $('.add-form').click(function(e) {        
             /*------------------- first name validation --------------- */           
                var txt = $('#txt');                
                    if (txt.val()==""){
                            txt.next().text("Required");
                            txt.next().css({"color":"red"});
                            e.preventDefault();
					        return false;
                        }else{
                            txt.next().empty();                          
                        }   
           /*------------------- first name validation --------------- */        
       });
     /*------------------- firstname,lastname,occupation validation --------------- */   
                $("#txt").on("blur", function() {                
                        if ($(this).val()==""){
                            $(this).next().text("Required");
                            $(this).next().css({"color":"red"});  
                        }else{
                            $(this).next().empty();                          
                        }
                }); 
        /*------------------- firstname,lastname,occupation validation --------------- */         
    /****************************** validation on submit *****************************/
       $('.add1-form').click(function(e) {        
             /*------------------- first name validation --------------- */           
                var txt1 = $('#txt1');                
                    if (txt1.val()==""){
                            txt1.next().next().text("Required");
                            txt1.next().next().css({"color":"red"});
                            e.preventDefault();
					        return false;
                        }else{
                            txt1.next().next().empty();                          
                        }   
           /*------------------- first name validation --------------- */        
       });
     /*------------------- firstname,lastname,occupation validation --------------- */   
                $("#txt1").on("blur", function() {                
                        if ($(this).val()==""){
                            $(this).next().next().text("Required");
                            $(this).next().next().css({"color":"red"});  
                        }else{
                            $(this).next().next().empty();                          
                        }
                });     
        /*------------------- firstname,lastname,occupation validation --------------- */      
        /****************************** validation on submit *****************************/ 
    /****************************** validation on comment-form *****************************/
       $('.comment-form').click(function(e) {        
             /*------------------- first name validation --------------- */           
                var fntxt = $('#fntxt');                
                        if (!(fntxt.val().length<2)){
                            if(fntxt.val().match(/^[a-zA-Z]+$/)){
                                fntxt.next().empty();
                            }else{
                               fntxt.next().text("Only Alfabet Required");
                               fntxt.next().css({"color":"red"});
                               e.preventDefault();
					           return false;
                            }
                        }else{
                            fntxt.next().text("Minimum 2 character Required");
                            fntxt.next().css({"color":"red"});                            
                            e.preventDefault();
					        return false;
                        }           
           /*------------------- first name validation --------------- */               
            /*------------------- email --------------- */         
                var email = $('#email');
                    if(!(email.val().match(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/))){
                             email.next().text("Enter proper email");
                             email.next().css({"color":"red"}); 
                             e.preventDefault();
                             return false;
                    }else{
                       email.next().empty();
                    }
           /*------------------- email --------------- */                          
             /*------------------- address validation --------------- */                   
                var add = $('#add');
                        if (add.val().length<10){
                            add.next().text("Minimum 10 character Required");
                            add.next().css({"color":"red"});
                            e.preventDefault();
					        return false;
                        }else{
                           add.next().empty();
                        }   
             /*------------------- address validation --------------- */   
       }); 
    /****************************** validation on comment-form *****************************/
    /****************************** validation on submit *****************************/
       $('.img-form').click(function(e) {        
             /*------------------- first name validation --------------- */           
                var img = $('.img');                
                    if (img.val()==""){
                            img.next().text("Required");
                            img.next().css({"color":"red"});
                            e.preventDefault();
					        return false;
                        }else{
                            img.next().empty();                          
                        }   
           /*------------------- first name validation --------------- */        
       });
     /*-------------------img validation --------------- */   
                $(".img").on("blur", function() {                
                        if ($(this).val()==""){
                            $(this).next().text("Required");
                            $(this).next().css({"color":"red"});  
                        }else{
                            $(this).next().empty();                          
                        }
                });     
        /*------------------- firstname,lastname,occupation validation --------------- */      
        /****************************** validation on submit *****************************/    
$('.post-form').click(function(e) {
        /*------------------- tittle validation --------------- */                   
                var title = $('#title');
                        if ((title.val().length<2) || (title.val().length>40)){
                            title.next().text("Tittle Between 2 to 40 Charcter");
                            title.next().css({"color":"red"});
                            e.preventDefault();
					        return false;
                        }else{
                           title.next().empty();
                        }   
             /*------------------- tittle validation --------------- */
            /*------------------- Description validation --------------- */                   
                var des = $('#des');
                        if ((des.val().length<2) || (des.val().length>500)){
                            des.next().text("Tittle Between 2 to 500 Charcter");
                            des.next().css({"color":"red"});
                            e.preventDefault();
					        return false;
                        }else{
                           des.next().empty();
                        }   
             /*------------------- Description validation --------------- */  
         /*-------------------img validation --------------- */   
            var imgp = $('.imgp');                               
                        if (imgp.val()==""){
                            imgp.next().text("Required");
                            imgp.next().css({"color":"red"});  
                            e.preventDefault();
					        return false;
                        }else{
                            imgp.next().empty();                          
                        }
     /*-------------------img validation --------------- */ 
                /*------------------- price validation --------------- */                   
                var user_price = $('#user_price');
                        if (user_price.val()==""){
                            user_price.next().text("Required");
                            user_price.next().css({"color":"red"});
                            e.preventDefault();
					        return false;
                        }else{
                           if(user_price.val().match(/^[0-9\b]+$/)){
                                user_price.next().empty();
                            }else{
                               user_price.next().text("Only Number Required");
                               user_price.next().css({"color":"red"});
                               e.preventDefault();
					           return false;
                            }
                        }               
             /*------------------- price validation --------------- */
             });
        /*------------------- tittle validation --------------- */
            $("#title").on("blur", function() {
                        if (($(this).val().length<2) || ($(this).val().length>40)){
                            $(this).next().text("Title Between 2 to 40 Charcter");
                            $(this).next().css({"color":"red"});
                        }else{
                           $(this).next().empty();
                        }    
                }); 
             /*------------------- tittle validation --------------- */
                 /*------------------- Description validation --------------- */
            $("#des").on("blur", function() {
                        if (($(this).val().length<2) || ($(this).val().length>500)){
                            $(this).next().text("Tittle Between 2 to 500 Charcter");
                            $(this).next().css({"color":"red"});
                        }else{
                           $(this).next().empty();
                        }    
                }); 
             /*------------------- Description validation --------------- */
     /*-------------------img validation --------------- */   
                $("#imgp").on("blur", function() {                
                        if ($(this).val()==""){
                            $(this).next().text("Required");
                            $(this).next().css({"color":"red"});  
                        }else{
                            $(this).next().empty();                          
                        }
                }); 
     /*-------------------img validation --------------- */  
/*************************** post of book ****************/     
});
/****************************** validation on page load *****************************/