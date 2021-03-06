<?php
/**
 * README
 * This configuration file is intended to run the bot with the webhook method.
 * Uncommented parameters must be filled
 *
 * Please note that if you open this file with your browser you'll get the "Input is empty!" Exception.
 * This is a normal behaviour because this address has to be reached only by the Telegram servers.
 */

// Load composer
require_once __DIR__ . '/vendor/autoload.php';

// Add you bot's API key and name
$bot_api_key  = 'your_bot_api_key';
$bot_username = 'username_bot';

// Define a path for your custom commands
//$commands_path = __DIR__ . '/Commands/';

// Enter your MySQL database credentials
//$mysql_credentials = [
//    'host'     => 'localhost',
//    'user'     => 'dbuser',
//    'password' => 'dbpass',
//    'database' => 'dbname',
//];

try {
    // Create Telegram API object
    $telegram = new Longman\TelegramBot\Telegram($bot_api_key, $bot_username);

    // Error, Debug and Raw Update logging - Don't forget to define the $path
    //Longman\TelegramBot\TelegramLog::initialize($your_external_monolog_instance);
    //Longman\TelegramBot\TelegramLog::initErrorLog($path . '/' . $bot_username . '_error.log');
    //Longman\TelegramBot\TelegramLog::initDebugLog($path . '/' . $bot_username . '_debug.log');
    //Longman\TelegramBot\TelegramLog::initUpdateLog($path . '/' . $bot_username . '_update.log');

    // Enable MySQL
    //$telegram->enableMySql($mysql_credentials);

    // Enable MySQL with table prefix
    //$telegram->enableMySql($mysql_credentials, $bot_username . '_');

    // Uncomment this line to load example commands
    //$telegram->addCommandsPath(BASE_PATH . '/../examples/Commands');

    // Add commands path containing your commands
    //$telegram->addCommandsPath($commands_path);

    // Enable admin user(s)
    //$telegram->enableAdmin(your_telegram_id);
    //$telegram->enableAdmins([your_telegram_id, other_telegram_id]);

    // Add the channel you want to manage
    //$telegram->setCommandConfig('sendtochannel', ['your_channel' => '@type_here_your_channel']);

    // Here you can set some command specific parameters,
    // for example, google geocode/timezone api key for /date command:
    //$telegram->setCommandConfig('date', ['google_api_key' => 'your_google_api_key_here']);

    // Set custom Upload and Download path
    //$telegram->setDownloadPath('../Download');
    //$telegram->setUploadPath('../Upload');

    // Botan.io integration
    // Second argument are options
    //$telegram->enableBotan('your_token');
    //$telegram->enableBotan('your_token', ['timeout' => 3]);

    // Requests Limiter (tries to prevent reaching Telegram API limits)
    // First argument are options
    $telegram->enableLimiter();
    //$telegram->enableLimiter(['interval' => 0.5);

    // Handle telegram webhook request
    $telegram->handle();
} catch (Longman\TelegramBot\Exception\TelegramException $e) {
    // Silence is golden!
    //echo $e;
    // Log telegram errors
    Longman\TelegramBot\TelegramLog::error($e);
} catch (Longman\TelegramBot\Exception\TelegramLogException $e) {
    // Silence is golden!
    // Uncomment this to catch log initilization errors
    //echo $e;
}
