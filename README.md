# VoiceInputs 

This package allows you to build "text" and "select" html form inputs with "filling-from-voice" option, 
using Chrome webkitSpeechRecognition. 
Here it is possible to automatic switch voice-recognition mode from input to input, in custom order 

Voice recognition option works only for Chrome web-browser and SSL connection only


## Example of usage

If you wish to put inputs with voice recognition into your html form, 
for example car brands with a possible choice of Toyota, Ferrari et c.,
year with a strict choice between 2016, 2017, etc. and colors:


<?php
require '...\vendor\autoload.php';
use irybalka1966\VoiceInputs\VoiceInputs;
$voice = new VoiceInputs();
?>
<link rel="stylesheet" href="/css/voiceinputs.css">
<form  ...>
    <label for="car-brand">Car brand:</label> 
    <?=$voice->TextVoice('car-brand',['Toyota','Ferrari', 'BMW', 'Nissan'], 1);?>

    <label for="year">Year:</label>
    <?= $voice->SelectVoice('year',['2016', '2017', '2018', '2019'], 0);?>

    <label for="color">Color:</label>
    <?= $voice->TextVoice('color',['yellow', 'black', 'white', 'red', 'blue'], 1); ?>

</form>
<script src="js/voiceinputs.js"></script>



## Installation

Using [composer](http://www.getcompser.com):

```bash
$ composer require irybalka1966/VoiceInputs
```

## Requirements

The following versions of PHP are supported by this version.

+ PHP >= 7.0
+ HHVM


## Author

This package is created and maintained by [Igor Rybalka](https://github.com/irybalka1966). If you have any questions feel free to contact me on facebook by using [igor.rybalka](https://www.facebook.com/igor.rybalka) in your message.

 
## License

MIT License

Copyright (c) 2019 Igor Rybalka

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
