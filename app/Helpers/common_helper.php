<?php




if (!function_exists('setting')) {
    function setting()
    {
        $setting = \App\Models\Settings::find(1);
        return $setting;
    }
}

?>
