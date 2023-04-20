<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset = "UTF-8">
        <meta http-equiv = "x-ua-compatible" content = "IE=edge">
        <meta name = "viewport" content= "width=device-width, initial-scale=1.0">
        <script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
        
        <title>portfolio</title>

        <style>
            .box {display:flex;}
            mode-viewer {width: 800px; height: 500px; margin:0, auto}
        </style>
    </head>

    <body>
        <div class = "box">
            <div>Hey check this out</div>
            <div style="border:1px solid black">
                <model-viewer camera-controls alt="Model" src="https://streamlinepharma.ltd/Stream X Detox box.glb">
                </model-viewer>
            </div>
        </div>
    </body> 

</html>