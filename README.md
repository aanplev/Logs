# Logs

## Create log entry in file

```php
use Logs\LogFile;

$log = (new LogFile);

$log->setDirectory($directory)->setFilename($filename);
$log->setMessage($message);

$log->write();
```

## Create log entry in Telegram

```php
use Logs\LogTelegram;

$log = (new LogTelegram);

$log->setBotId($botId)->setToken($token)->setChatId($chatId);
$log->setMessage($message);

$log->write();
```
