<?php 
class VoiceInputs {  

private static $inputCounter;
private $mic = <<<EOD
    <svg class="mic" xmlns="https://www.w3.org/2000/svg" width="20" height="23" viewBox="0 0 1692 1392">
        <path d="M1472 704v128q0 221-147.5 384.5t-364.5 187.5v132h256q26 0 45 19t19 45-19 45-45 19h-640q-26 0-45-19t-19-45 19-45 45-19h256v-132q-217-24-364.5-187.5t-147.5-384.5v-128q0-26 19-45t45-19 45 19 19 45v128q0 185 131.5 316.5t316.5 131.5 316.5-131.5 131.5-316.5v-128q0-26 19-45t45-19 45 19 19 45zm-256-384v512q0 132-94 226t-226 94-226-94-94-226v-512q0-132 94-226t226-94 226 94 94 226z"></path>
     </svg>
EOD;
 

function __construct() {
    $this->inputCounter = 0;
} 
    
/*
 * 
 */
public function TextVoice($name, $wArr, $goNext ){  
        $this->inputCounter++;        
        $wStr =  implode('","',$wArr);
        $wStr =  '"'.$wStr.'"';
$textVoice = <<<EOD
        <script>
             var wordArr_$this->inputCounter = [
                 $wStr
             ]
         </script> 
        <input name="$name" id="voice-text-$this->inputCounter" class="voice-text-input" placeholder="$name" type="text">
        <button class="voice-text-button" tid="$this->inputCounter" priority="$this->inputCounter" style="background:none; border:none" onclick="Record(this, wordArr_$this->inputCounter, $goNext, 1)">
           $this->mic
        </button>
    
EOD;
return $textVoice;
    }
    
/*
* 
*/
public function SelectVoice($name, $wArr, $goNext ){   
        $this->inputCounter++;
        $wStr =  implode('","',$wArr);
        $wStr =  '"'.$wStr.'"';
$selectVoice = <<<EOD
        <script>
             var wordArr_$this->inputCounter = [
                 $wStr
             ]
         </script>
        <select name="$name" id="voice-select-$this->inputCounter"  class="voice-text-input" >
        <option value="0">select $name</option>
EOD;
foreach($wArr as $option){
$selectVoice.= <<<EOD
        <option value="$option">$option</option>
EOD;
}
$selectVoice.= <<<EOD
      </select>
        <button class="voice-text-button" tid="$this->inputCounter" priority="$this->inputCounter" style="background:none; border:none" onclick="Record(this, wordArr_$this->inputCounter, $goNext, 0)">
             $this->mic
        </button>    
EOD;
        return $selectVoice;
    }    
}
