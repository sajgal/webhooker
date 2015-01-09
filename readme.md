#Installation

The recommended way to install Webhooker is through
[Composer](http://getcomposer.org).

```bash
# Install Composer
curl -sS https://getcomposer.org/installer | php
```

Next, run the Composer command to install the latest stable version of Webhooker:

```bash
composer require roarbb/webhooker
```

#Prerequisities

Make sure that you have rights to update files on server
```bash
chown -R www-data /path/to/website/root
```

#Webhook config

##Step 1
In website root, create webhook.php file

###basic

```php
<?php

use Webhook\Hook;

include_once('vendor/autoload.php');

$hook = new Hook();
echo $hook->pull();
```

###If you want to secure your webhook with secret token (token in file)

webhook.php
```php
<?php

use Webhook\Hook;

include_once('vendor/autoload.php');

$hook = new Hook();
$hook->setConfigFile(__DIR__ . '/config.neon');

if ($hook->isValidSignature()) {
    echo $hook->pull();
}
```

config.neon
```ini
github:
    secret: secretToken123
```

###If you want to secure your webhook with secret token (token as string)

webhook.php
```php
<?php

use Webhook\Hook;

include_once('vendor/autoload.php');

$hook = new Hook();
$hook->setGithubSecret('secretToken123');

if ($hook->isValidSignature()) {
    echo $hook->pull();
}
```

##Step 2
Login to github, and set up your webhook.
Link: [https://github.com/[username]/[repository]/settings/hooks](https://github.com/[username]/[repository]/settings/hooks)

![add-webhook](https://cloud.githubusercontent.com/assets/190549/5679146/d4d809fe-984e-11e4-822b-8ba210a48a15.png)

Payload Url: Link to your webhook.php
Content Type: application/json
Secret: secretToken123
Which events would you like to trigger this webhook? - Just the push event.
Active: checked

It may looks like this:
![webhook-config](https://cloud.githubusercontent.com/assets/190549/5679147/d4da61c2-984e-11e4-9be4-e6a9163b7ee1.png)

##Final Step
On producion server:
*Double-check permissions
*Dont forget to run `composer update` 