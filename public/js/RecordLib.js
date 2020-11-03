const frequencyType = {
    Random: 0,
    Scheduled: 1
};

const frequencyInterval = {
    EverySecond: 0,
    EveryMinute: 1,
    EveryHour: 2
};

function RecorderLib(oVideoSS, oScreenSS){
    var camShot = oVideoSS,
        screenShot = oScreenSS,
        videoRecorder = null
        screenRecorder = null;
    var isRunning = false;
    var ajaxPath = "";
    
    var frequencySettings = {
        //Type refers whether capturing is random or captured
        Type:                   frequencyType.Random,             
        
        //Interval refers to the standard unit of measurement
        //         of what is the minimum duration from the last capturing
        //         for the next capturing to occur
        // Example 1: If Type is Random, Interval is EveryMinute, PerNthInterval is 15
        //            Capturing is random but it means capturing should randomly fire
        //            atleast 15 minutes after the last capturing
        // Example 2: If Type is Scheduled, Interval is EveryMinute, PerNthInterval is 15
        //            Capturing is scheduled every 15 minutes

        Interval:               frequencyInterval.EveryMinute,     
        
        //PerNthInterval refers to the countable value of the interval
        // Example: Interval is EveryMinute, and PerNthInterval is 15
        //          It means capturing is scheduled every 15 minutes or 
        //          randomly taken after 15 minutes + randomly generated duration
        PerNthInterval:         15
    };


    this.setAjaxPath = function(url){
        ajaxPath = url;
    };

    this.startRecording = function(){
        isRunning = true;
        startCapturingScreen();
        startCapturingCamera();
        setTimeout(startRecursiveCamSS, 3000);
        setTimeout(startRecursiveScreenSS, 3000);
    };

    this.stopRecording = function(){
        isRunning = false;
        stopCapturingScreen();
        stopCapturingCamera();
    }

    this.setFrequencySettings = function(oType, oInterval, oPerNthInterval){
        frequencySettings.Type = oType;
        frequencySettings.Interval = oInterval;
        frequencySettings.PerNthInterval = oPerNthInterval;
    };

    function startRecursiveCamSS(){
        var oInterval =  getInterval();
        console.log("[TAKING CAMERASHOT IN]: " + oInterval / 1000 + " seconds.");
        
        if(isRunning){
            setTimeout(function(){
                takeScreenshot(videoRecorder.camera, camShot, "camera");
                startRecursiveCamSS();
            }, oInterval);
        }
    }

    function startRecursiveScreenSS(){
        var oInterval =  getInterval();
        console.log("[TAKING SCREENSHOT IN]: " + oInterval / 1000 + " seconds.");
        if(isRunning){
            setTimeout(function(){
                takeScreenshot(screenRecorder.screen, screenShot, "screen");
                startRecursiveScreenSS();
            }, oInterval);
        }
    }

    function getInterval(){
        var oInt = 0;
        switch(frequencySettings.Interval){
            case frequencyInterval.EverySecond: oInt = frequencySettings.PerNthInterval * 1000;             break;
            case frequencyInterval.EveryMinute: oInt = frequencySettings.PerNthInterval * 1000 * 60;        break;
            case frequencyInterval.EveryHour:   oInt = frequencySettings.PerNthInterval * 1000 * 60 * 60;   break;
        }

        if(frequencySettings.Type == frequencyType.Random) oInt = oInt + (oInt * Math.random());
        return Math.floor(oInt);
    }

    function takeScreenshot(stream, canvasObj, type){
        var track = stream.getVideoTracks()[0];
        imageCapture = new ImageCapture(track);
        
        imageCapture.grabFrame()
            .then(imageBitmap => {
                canvasObj.width = imageBitmap.width;
                canvasObj.height = imageBitmap.height;
                canvasObj.getContext('2d').drawImage(imageBitmap, 0, 0, imageBitmap.width, imageBitmap.height);

                canvasObj.toBlob(function(blob){
                    var formData = new FormData();
                    formData.append('photo', blob);
                    formData.append('image_type', type);
                    
                    $.ajaxSetup({
                        headers:
                        { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
                    });

                    $.ajax({
                        url: ajaxPath,
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response){
                            console.log("[UPLOAD SUCCESS]");
                        },
                    });
                });
            })
            .catch(error => console.log(error));
    }

    function startCapturingScreen(){
        captureScreen(function(screen) {
    
            screenRecorder = RecordRTC(screen, {
                type: 'video'
            });
    
            screenRecorder.startRecording();
            screenRecorder.screen = screen;
            
        });
    };
    
    function stopCapturingScreen() {        
        screenRecorder.screen.stop();
        screenRecorder.destroy();
        screenRecorder = null;
    }

    function startCapturingCamera(){
        captureCamera(function(camera) {
            videoRecorder = RecordRTC(camera, {
                type: 'video'
            });

            videoRecorder.startRecording();
            videoRecorder.camera = camera;
        });
    }

    function stopCapturingCamera(){    
        videoRecorder.camera.stop();
        videoRecorder.destroy();
        videoRecorder = null;
    }

    function captureCamera(callback){
        navigator.mediaDevices.getUserMedia({ video: true }).then(function(camera) {
            callback(camera);
        }).catch(function(error) {
            alert('Unable to capture your camera. Please check console logs.');
            console.error(error);
        });
    }

    function invokeGetDisplayMedia(success, error) {
        var displaymediastreamconstraints = {
            video: {
                displaySurface: 'monitor', // monitor, window, application, browser
                logicalSurface: true,
                cursor: 'always' // never, always, motion
            }
        };
    
        // above constraints are NOT supported YET
        // that's why overriding them
        displaymediastreamconstraints = {
            video: true
        };
    
        if(navigator.mediaDevices.getDisplayMedia) {
            navigator.mediaDevices.getDisplayMedia(displaymediastreamconstraints).then(success).catch(error);
        }
        else {
            navigator.getDisplayMedia(displaymediastreamconstraints).then(success).catch(error);
        }
    }

    function captureScreen(callback) {
        invokeGetDisplayMedia(function(screen) {
            addStreamStopListener(screen, function() {
                //document.getElementById('btn-stop-recording').click();
            });
            callback(screen);
        }, function(error) {
            console.error(error);
            alert('Unable to capture your screen. Please check console logs.\n' + error);
        });
    }

    function addStreamStopListener(stream, callback) {
        stream.addEventListener('ended', function() {
            callback();
            callback = function() {};
        }, false);
        stream.addEventListener('inactive', function() {
            callback();
            callback = function() {};
        }, false);
        stream.getTracks().forEach(function(track) {
            track.addEventListener('ended', function() {
                callback();
                callback = function() {};
            }, false);
            track.addEventListener('inactive', function() {
                callback();
                callback = function() {};
            }, false);
        });
    }
}
