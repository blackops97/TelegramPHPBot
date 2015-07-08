Telegram Bot PHP API
=====================
> Let's you integrate with [Telegram Bot API](https://core.telegram.org/bots) using PHP.

## Quick Start

### Installation

Step 1: By using Composer

```cli
$ composer require curiouscoder/telegram-php-bot
```

or

composer.json file

```cli
{
    "require": {
        "curiouscoder/telegram-php-bot": "dev-master"
    }
}
```

Step 2: Assuming composer's autoloader is made use of. [```require 'vendor/autoload.php';```]

```php
use CuriousCoder\TelegramBot\TelegramBot;
use CuriousCoder\TelegramBot\Config\Config;
```

Step 3: Create new instance of Config class and set your api key. Check [botfather](https://core.telegram.org/bots#botfather) to register your app.

```php
$config = new Config();
$config->setApiKey("Your Key");
```

Step 4: Create new instance of TelegramBot class and pass your Config class instance

```php
$telegram = new TelegramBot($config);
```

All the methods listed on [Telegam Bot API](https://core.telegram.org/bots/api) page are fully supported.

###Example

To get info on your Bot

```php
print_r($telegram->getMe());
```

To send a text message

```php
$response = $telegram->sendMessage('CHAT_ID','Hello!');
print_r($response);
```
###Extra info
By default video, audio, sticker and photo formats are preset. You can view or add formats using Config class

```php
$config = new Config();

$config->getAudioFormats();
$config->setAudioFormats(['mp3']);

$config->getVideoFormats();
$config->setVideoFormats(['avi']);

$config->getPhotoFormats();
$config->setPhotoFormats(['png','jpg']);

```

## Contributing

Thank you for considering contributing to the project.

## Disclaimer

This project and its author is neither associated, nor affiliated with [Telegram](https://telegram.org/) in anyway.
See License section for more details.
