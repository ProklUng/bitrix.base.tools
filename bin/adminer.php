<?php function adminer_object() {
    // required to run any plugin
    include_once "../adminer/plugins/plugin.php";
    
    // autoloader
    foreach (glob("../adminer/plugins/*.php") as $filename) {
        include_once "./$filename";
    }
    
    // enable extra drivers just by including them
    //~ include "./plugins/drivers/simpledb.php";
    
    $plugins = array(
        // specify enabled plugins here
        new AdminerLoginPasswordLess(password_hash("1111111111", PASSWORD_DEFAULT)),
    );
    
    /* It is possible to combine customization and plugins:
    class AdminerCustomization extends AdminerPlugin {
    }
    return new AdminerCustomization($plugins);
    */
    
    return new AdminerPlugin($plugins);
}

// include original Adminer or Adminer Editor
include "../adminer/adminer.php";