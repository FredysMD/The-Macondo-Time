<?php

    if(!function_exists('getShorterString')){
        
        function getShorterString($text, $length=null)
        {   
            $formatedString = ($text);

            if($length != null){
                if(strlen($formatedString) <= $length){
                    return $formatedString;
                }else{
                    $shortedString = substr($formatedString,0, $length).'...';
                    return $shortedString;
                }
            }else{
                return $formatedString;
            }
        }
    }    

?>