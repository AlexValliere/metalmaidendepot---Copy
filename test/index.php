<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
            <title>Sherman Mk-IV HD test</title>
        </meta>
        
        <meta name="viewport" content="width=device-width, initial-scale=0.5, minimum-scale=1.0, maximum-scale=4.0">
        </meta>

        <style>
            html, body {
                oveflow: hidden;
                height: 100%;
            }
            
            body{
                margin:0px ;
                padding:0px ;
            }
            
            #glcanvas {
                /*
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                */
                background-size: 150%;
                background-position: 50% 50%;
                background-image: url(assets/image/empty.png);
            }
        </style>

    </head>

    <body onload="sampleApp1()">
        
        <p>
            <button id="btnChange" class="active" <!--style="display: none;"-->>Change Model</button>
        </p>
        
        <div>
            <canvas id="glcanvas" width="1360" height="1880" 
                style="border:dashed 1px #CCC">
            </canvas>
        </div>
        
        <div id="myconsole" style="color:#000">---- Log ----</div>

        <!-- Live2D Library -->
        <script src="lib/live2d.min.js"></script>

        <!-- Live2D Framework -->
        <script src="framework/Live2DFramework.js"></script>
        
        <!-- User's Script -->
        <script src="src/utils/MatrixStack.js"></script>
        <script src="src/utils/ModelSettingJson.js"></script>
        <script src="src/PlatformManager.js"></script>
        <script src="src/LAppDefine.js"></script>
        <script src="src/LAppModel.js"></script>
        <script src="src/LAppLive2DManager.js"></script>
        <script src="src/SampleApp1.js"></script>

    </body>
</html>
