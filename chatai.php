<?php
$token = "7373572747:AAHCHNScZsa205RmMSlLgFiCCMsqBc_s8DM";//توكن بوتك
$apiUrl = "https://api.telegram.org/bot$token/";
function sendMessage($chat_id, $text) {
    global $apiUrl;
    file_get_contents($apiUrl . "sendMessage?chat_id=" . $chat_id . "&text=" . urlencode($text));
}
/*غير الحقوق واثبت انك فاشل
اذا تريد تنقل اذكر اسمي او اسم قناتي */

/*====================
CH : @AX_GB
DEV : @Mr_xe2
Translator : @AX_GB
/*====================*/
function generateImage($prompt) {
    $apiEndpoint = "http://tamtam.freewebhostmost.com/api_img.php?text=" . urlencode($prompt);

    $response = file_get_contents($apiEndpoint);
    $responseData = json_decode($response, true);

    if (isset($responseData['image_url'])) {
        return $responseData['image_url'];
    }

    return null;
}
$update = json_decode(file_get_contents("php://input"), true);

if (isset($update["message"])) {
    $chat_id = $update["message"]["chat"]["id"];
    $text = $update["message"]["text"];

    if (strtolower($text) == "/start") {
        sendMessage($chat_id, "اهلاً! ابعتلي أي وصف نصي وانا هحولها لصورة ليك.");
    } else {
        
        $imageUrl = generateImage($text);

        if ($imageUrl) {
            
            file_get_contents($apiUrl . "sendPhoto?chat_id=" . $chat_id . "&photo=" . $imageUrl);
        } else {
            sendMessage($chat_id, "معرفتش أعمل صورة من الوصف ده، حاول بوصف تاني.");
        }
    }
}
?>