<script type="text/javascript">
var LAppDefine = {
    
    
    DEBUG_LOG : true,
    DEBUG_MOUSE_LOG : false, 
    // DEBUG_DRAW_HIT_AREA : false, 
    // DEBUG_DRAW_ALPHA_MODEL : false, 
    
    
    
    
    VIEW_MAX_SCALE : 2,
    VIEW_MIN_SCALE : 0.5,

    VIEW_LOGICAL_LEFT : -1,
    VIEW_LOGICAL_RIGHT : 1,

    VIEW_LOGICAL_MAX_LEFT : -2,
    VIEW_LOGICAL_MAX_RIGHT : 2,
    VIEW_LOGICAL_MAX_BOTTOM : -2,
    VIEW_LOGICAL_MAX_TOP : 2,
    
    
    PRIORITY_NONE : 0,
    PRIORITY_IDLE : 1,
    PRIORITY_NORMAL : 2,
    PRIORITY_FORCE : 3,
    
    
    BACK_IMAGE_NAME : "assets/image/none.png",

    <?php
    $live2d_asset_location  = 'assets/live2d/';
    $live2d_asset_location .= strtolower($live2d_location) . '/';
    $live2d_asset_location .= strtolower($live2d_modelname) . '.json';
    // echo 'MODEL_'.strtoupper($live2d_modelname).' : "'.$live2d_asset_location.'",';
    echo 'MODEL_METAL_MAIDEN : "'.$live2d_asset_location.'",';
    ?>
    
    MOTION_GROUP_IDLE : "idle", 
    MOTION_GROUP_TAP_BODY : "tap_body", 
    MOTION_GROUP_FLICK_HEAD : "flick_head", 
    MOTION_GROUP_PINCH_IN : "pinch_in", 
    MOTION_GROUP_PINCH_OUT : "pinch_out", 
    MOTION_GROUP_SHAKE : "shake", 

    
    HIT_AREA_HEAD : "head",
    HIT_AREA_BODY : "body"
    
};
</script>