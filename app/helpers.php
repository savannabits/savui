<?php
function jsonRes($success, $message, $payload=[], $code=200) {
    if ($success === false && $code === 200) {
        $code = 400;
    }
    return response()->json(['success' => $success, "message" => $message, "payload" => $payload],$code);
}

/*function settings($key) {
    $setting = \App\Setting::where("key", "=", $key)->first();
    if (!$setting) {
        return null;
    }
    return $setting->val;
}*/


function perm($name, $guard=null) {
    $perm = \App\Permission::whereName($name);
    if ($guard) {
        $perm->whereGuardName($guard);
    }
    return $perm->first();
}
