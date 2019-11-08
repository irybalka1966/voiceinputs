let recognition;

function Record(th, wArr, goNext, isText) {
    const priority = th.getAttribute('priority');
    const id = th.getAttribute('tid');
    const mic = th.getElementsByClassName('mic')[0];

    if (!init()) {
        return;
    }

    stop();

    recognition = new webkitSpeechRecognition();

    mic.classList.add("voice-active");

    // recognition.continuous = true;
    recognition.interimResults = false;
    recognition.lang = "en-US";
    recognition.maxAlternatives = 3;
    recognition.start();

    recognition.onresult = function (e) {
        let soundRes = e.results[(e.results.length - 1)][0].transcript;

        stop();

        if (isText === 1) {
            if (!wArr.includes(soundRes)) {
                soundRes = "?? " + soundRes;
            }

            document.getElementById('voice-text-' + id).value = soundRes;
        } else {
            let selectElement = document.getElementById('voice-select-' + id);
            let options = selectElement.options;
            let flagSelect = 0;

            for (let i = 0, optionsLength = options.length; i < optionsLength; i++) {
                options[i].removeAttribute("selected");
                if (options[i].value === soundRes) {
                    options[i].setAttribute("selected", "selected");
                    flagSelect = 1;
                }
            }

            if (!flagSelect) {
                options[0].setAttribute("selected", "selected");
            }
        }

        if (goNext === 1) {
            let priority1 = parseInt(priority) + 1;
            let arr_elms = document.body.getElementsByTagName("button");
            let elms_len = arr_elms.length;

            for (let i = 0; i < elms_len; i++) {
                if (arr_elms[i].getAttribute("priority") === priority1) {
                    arr_elms[i].click();
                }
            }
        }
    };

    recognition.onspeechend = function (event) {
        console.info('Speech ended.', event)
        stop();
    };

    recognition.onerror = function (event) {
        console.error('Recognition Error :: ', event);
        stop();
    };

    recognition.onnomatch = function (event) {
        console.info('Does not match any value!', event);
        stop();
    };

    /**
     * Initilize SpeechRecognition
     * @returns {boolean|SpeechRecognition}
     */
    function init() {
        if (!window.hasOwnProperty('webkitSpeechRecognition') && !window.hasOwnProperty('SpeechRecognition')) {
            return false;
        }

        return new webkitSpeechRecognition();
    }

    /**
     * Stop recognition if exist
     */
    function stop() {
        (typeof recognition !== "undefined") && recognition.stop();
        console.info('Stop!!!');

        let mics = document.getElementsByClassName('mic');
        for (let micObject in mics) {
            if (mics.hasOwnProperty(micObject)) {
                mics[micObject].classList.remove("voice-active");
            }
        }
    }
}
