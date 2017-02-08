
        function clickIE4(){
            if (event.button==2){
                alert(message);
                return false;
            }
        }//end of function clickIE4

        function clickNS4(e){
            if (document.layers||document.getElementById&&!document.all){
                if (e.which==2||e.which==3){
                    alert(message);
                    return false;
                }//end of if
            }//end of if
        }//end of function clickNS4

        if (document.layers){
            document.captureEvents(Event.MOUSEDOWN);
            document.onmousedown=clickNS4;
        }
        else if (document.all&&!document.getElementById){
             document.onmousedown=clickIE4;
        }
        

 