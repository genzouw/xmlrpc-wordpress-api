# xmlrpc-wordpress-api

`rolenweb/xml-rpc-wordpress-api` liberay wapper for Wide Char (ex: Japanese)

## Description

*Please contact me anytime if you have a problem or request! My information is posted at the bottom of this document.*

## Requirements

* PHP
* Composer

## Installation

```bash
composer global require genzouw/xmlrpc-wordpress-api
```

## Usage

Post a new entry.

```bash
cat <<'EOF' > wp-post.php
#!/usr/bin/env php
<?php

require getenv('HOME') . '/.composer/vendor/autoload.php';

use Genzouw\Wpapi\Wp;

$wp = new Wp(getenv('WP_URL'), getenv('WP_USER'), getenv('WP_PASSWORD'));

$lines = explode("\n", file_get_contents('php://stdin'));

$wp->newPost(array(
    'post_type' => 'post',
    'post_content' => implode(PHP_EOL, array_slice($lines, 2)),
    'post_title' => preg_replace('/^# +/su', '', $lines[0]),
    'post_status' => 'draft',
));
EOF

cat <<'EOF' | php ./wp-post.php
TITLEほげほげ

BODY1
BODY2
BODY3
EOF
```

## Relase Note

|date      |version|note          |
|---       |---    |---           |
|2020-05-24|0.1    |first release.|


## License

This software is released under the MIT License, see LICENSE.


## Help

Got a question ?

File a [Github issue](https://github.com/genzouw/app_name/issues), send an email to [genzouw@gmail.com](mailto:genzouw@gmail.com) or tweet to [@genzouw](https://twitter.com/genzouw) on Twitter.

## Author Information

[genzouw](https://genzouw.com)

* Twitter   : @genzouw ( https://twitter.com/genzouw )
* Facebook  : genzouw ( https://www.facebook.com/genzouw )
* LinkedIn  : genzouw ( https://www.linkedin.com/in/genzouw/ )
* Gmail     : genzouw@gmail.com
