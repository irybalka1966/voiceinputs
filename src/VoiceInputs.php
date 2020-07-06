<?php
namespace irybalka1966\VoiceInputs;
class VoiceInputs
{
    /**
     * Counter of inputs, crated by the class
     *
     * @var int
     */
    private $inputCounter;

    /**
     * Microphone button SVG
     *
     * @var string
     */
    private $mic = <<<MIC
<svg class="mic" xmlns="https://www.w3.org/2000/svg" width="20" height="23" viewBox="0 0 1692 1392">
    <path d="M1472 704v128q0 221-147.5 384.5t-364.5 187.5v132h256q26 0 45 19t19 45-19 45-45 19h-640q-26 0-45-19t-19-45 19-45 45-19h256v-132q-217-24-364.5-187.5t-147.5-384.5v-128q0-26 19-45t45-19 45 19 19 45v128q0 185 131.5 316.5t316.5 131.5 316.5-131.5 131.5-316.5v-128q0-26 19-45t45-19 45 19 19 45zm-256-384v512q0 132-94 226t-226 94-226-94-94-226v-512q0-132 94-226t226-94 226 94 94 226z"></path>
</svg>
MIC;

    /**
     * VoiceInputs constructor
     */
    public function __construct()
    {
        $this->inputCounter = 0;
    }

    /**
     * Place "text" html form input with "filling-from-voice" option
     *
     * @param string $name
     * @param array   wArr    - array of values to select
     * @param int $goNext - after current recognition completion
     *      set "1" to start a new voice recognition on the next input with incremented id
     *      set "0" - to do nothing
     *
     * @param string $textVoice
     *
     * @return string textVoice
     */
    public function TextVoice(array $wArr = [], int $goNext = 0, string $textVoice = ''): string
    {
        $this->inputCounter++;
        $wStr      = implode('","', $wArr);
        $wStr      = '"' . $wStr . '"';
        $textVoice = "Record(this, wordArr_{$this->inputCounter}, {$goNext}, 1)";

        return $textVoice;
    }

    /**
     * Place "select" html form input with "filling-from-voice" option
     *
     * @param string  name    - input name
     * @param array   wArr    - array of values to select
     * @param integer $goNext - after current recognition completion
     *      set "1" to start a new voice recognition on the next input with incremented id
     *      set "0" - to do nothing
     *
     * @return string selectVoice
     */
    public function SelectVoice(string $name = '', array $wArr = [], int $goNext = 0): string
    {
        $this->inputCounter++;
        $wStr        = implode('","', $wArr);
        $selectVoice = <<<SELECT
        <script>
             let wordArr_{$this->inputCounter} = ["{$wStr}"];
         </script>
        <select name="$name" id="voice-select-$this->inputCounter"  class="voice-text-input" >
        <option value="0">select $name</option>
SELECT;

        foreach ($wArr as $option) {
            $selectVoice .= "<option value=\"{$option}\">{$option}</option>";
        }

        $selectVoice .= '</select>';
        $selectVoice .= <<<MICBUTTON
<button class="voice-text-button" data-id="{$this->inputCounter}" data-priority="{$this->inputCounter}" style="background:none; border:none"
        onclick="Record(this, wordArr_{$this->inputCounter}, {$goNext}, 0)">
    {$this->mic}
</button>
MICBUTTON;
        return $selectVoice;
    }
}
