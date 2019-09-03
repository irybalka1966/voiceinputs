<?php

namespace spec\irybalka1966\voiceinputs;

use PhpSpec\ObjectBehavior;
use irybalka1966\VoiceInputs\VoiceInputs;

class VoiceInputsSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(VoiceInputs::class);
    }

    function it_can_text()
    {
        $this->TextVoice('test name')->shouldReturn('test name');
    }

    function it_can_select(){
        $this->TextSelect('test name')->shouldReturn('test name');
    }

    
}
