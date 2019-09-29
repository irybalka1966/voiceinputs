function Record(th, wArr, goNext, isText){ 
            var priority   = th.getAttribute('priority'); 
            var id         = th.getAttribute('tid');             
            var mic        = th.getElementsByClassName('mic')[0];
            mic.classList.add("voice-active");                  
            
            if (window.hasOwnProperty('webkitSpeechRecognition')) {                
                if (typeof recognition != "undefined") {
                    delete recognition;
                } else {
                    recognition = new webkitSpeechRecognition();
                }
                               
                recognition.continuous = true;
                recognition.interimResults = false;
                recognition.lang = "en-US";
                recognition.start();
                
                recognition.onresult = function(e) {
                    var soundRes = e.results[0][0].transcript;
                        recognition.stop();
                        delete recognition;
                        mic.classList.remove("voice-active");
                        if(isText === 1){
                            if(!wArr.includes(soundRes)){
                                soundRes = "?? " + soundRes;
                            };
                            document.getElementById('voice-text-' + id).value =  soundRes;
                        } else {
                            var selectElement = document.getElementById('voice-select-' + id);
                            var options       = selectElement.options;
                            var flagSelect    = 0;
                            for (var i = 0, optionsLength = options.length; i < optionsLength; i++) {                                
                                options[i].removeAttribute("selected");
                                if (options[i].value == soundRes) {
                                    options[i].setAttribute("selected", "selected");
                                    flagSelect = 1;
                                }
                            }
                            if(!flagSelect){
                                options[0].setAttribute("selected", "selected");
                            }
                        };
                        
                        if(goNext === 1){
                     
                            var priority1 = parseInt(priority) + 1;
                            var arr_elms = [];
                            arr_elms = document.body.getElementsByTagName("button");
                            var elms_len = arr_elms.length;                            
                     
                            for (var i = 0; i < elms_len; i++) {
                              if(arr_elms[i].getAttribute("priority") == priority1){  
                                    arr_elms[i].click();
                               }
                            }
                        }
                    } 
                    
                recognition.onerror = function(e) {                    
                    console.log(e);                    
                }
        }
     }  
