cordova.define('cordova/plugin_list', function(require, exports, module) {
module.exports = [
    {
        "id": "cordova-plugin-device.device",
        "file": "plugins/cordova-plugin-device/www/device.js",
        "pluginId": "cordova-plugin-device",
        "clobbers": [
            "device"
        ]
    },
    {
        "id": "cordova-plugin-dialogs.notification",
        "file": "plugins/cordova-plugin-dialogs/www/notification.js",
        "pluginId": "cordova-plugin-dialogs",
        "merges": [
            "navigator.notification"
        ]
    },
    {
        "id": "cordova-plugin-dialogs.notification_android",
        "file": "plugins/cordova-plugin-dialogs/www/android/notification.js",
        "pluginId": "cordova-plugin-dialogs",
        "merges": [
            "navigator.notification"
        ]
    },
    {
        "id": "skwas-cordova-plugin-datetimepicker.DateTimePicker",
        "file": "plugins/skwas-cordova-plugin-datetimepicker/www/datetimepicker.js",
        "pluginId": "skwas-cordova-plugin-datetimepicker",
        "clobbers": [
            "cordova.plugins.DateTimePicker"
        ]
    }
];
module.exports.metadata = 
// TOP OF METADATA
{
    "cordova-plugin-whitelist": "1.3.2",
    "cordova-plugin-console": "1.0.7",
    "cordova-plugin-device": "1.1.6",
    "cordova-plugin-dialogs": "1.3.3",
    "skwas-cordova-plugin-datetimepicker": "1.0.0"
};
// BOTTOM OF METADATA
});