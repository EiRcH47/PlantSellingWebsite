

    class WPH_Class  {
            
            selectText(node) 
                {
                    
                    node = document.getElementById(node);

                    if (document.body.createTextRange) {
                        const range = document.body.createTextRange();
                        range.moveToElementText(node);
                        range.select();
                    } else if (window.getSelection) {
                        const selection = window.getSelection();
                        const range = document.createRange();
                        range.selectNodeContents(node);
                        selection.removeAllRanges();
                        selection.addRange(range);
                    } else {
                        console.warn("Could not select text in node: Unsupported browser.");
                    }
                }
                
            showAdvanced( element )
                {
                    jQuery( element ).closest('.wph_input').find('div.advanced').show('fast');
                    jQuery( element ).closest('.advanced_notice').slideUp('fast', function() { jQuery(this).hide()  });
                    
                    
                }
                
            randomWord( element, extension ) 
                {
                    var length  =   7;
                    var consonants = 'bcdfghjlmnpqrstv',
                        vowels = 'aeiou',
                        rand = function(limit) {
                            return Math.floor(Math.random()*limit);
                        },
                        i, word='', length = parseInt(length,10),
                        consonants = consonants.split(''),
                        vowels = vowels.split('');
                        
                    for (i=0;i<length/2;i++) 
                        {
                            var randConsonant = consonants[rand(consonants.length)],
                                randVowel = vowels[rand(vowels.length)];
                            word += randConsonant;
                            word += i*2<length-1 ? randVowel : '';
                        }
                    
                    if ( extension != '' )
                        word    =   word.concat( '.' + extension );
                    
                    jQuery( element ).closest('.wph_input').find('.entry input.text').val( word );                    
                }
                
            
            clear ( element )
                {
                    jQuery( element ).closest('.wph_input').find('.entry input.text').val( '' );    
                }
                
                
            confirm_sample_setup()
                {
                    
                    var agree   =   confirm( wph_vars.confirm_message );
                    if (agree)
                        {
                            jQuery('#wph-run-sample-setup').submit();
                        }
                        else
                        {
                            return false ;
                        }        
                }
                
                
            check_headers( nonce )
                {
                    jQuery('#wph-check-headers .spinner').css( 'visibility', 'visible');
                    
                    jQuery('#wph-headers-container').html('');
                    jQuery('#wph-headers-graph .wph-graph-data').html( 'Loading..' );
                    jQuery('#wph-headers-graph .wph-graph-progress').css( 'transform', 'rotate(0deg)')
                    
                    jQuery.ajax({
                        type: 'POST',
                        url: ajaxurl,
                        dataType: "json",
                        data: {
                            'action':'wph_check_headers',
                            'nonce' : nonce
                        },
                        success:function(data) {
                            jQuery('#wph-check-headers .spinner').css( 'visibility', 'hidden');
                            jQuery('#wph-headers-container').html( data.html );
                            jQuery('#wph-headers-graph .wph-graph-data').html( data.graph.message );
                            jQuery('#wph-headers-graph .wph-graph-progress').css( 'transform', 'rotate(' +  data.graph.value +'deg)')
                        },  
                        error: function(errorThrown){
                            jQuery('#wph-check-headers .spinner').css( 'visibility', 'hidden');
                            jQuery('#wph-headers-container').html( 'Unable to call AJAX.' );
                            jQuery('#wph-headers-graph .wph-graph-data').html( data.graph.message );
                            jQuery('#wph-headers-graph .wph-graph-progress').css( 'transform', 'rotate(' + data.graph.value + 'deg);')
                        }
                    });
                }
                
                
            runSampleHeaders ()
                {
                    var agree   =   confirm( wph_vars.run_sample_headers );
                    if ( !agree )
                        return false;
                        
                    document.getElementById("wph-form").submit();  
                    
                }
            
    }
    
    var WPH = new WPH_Class();
    
    
    
    
    jQuery( document ).ready( function() {
        
        jQuery('.options span').tipsy({fade: false, gravity: 's'});    
    })
    