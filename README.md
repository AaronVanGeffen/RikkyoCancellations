# Rikkyo University class cancellations checker

This script checks class cancellations for Rikkyo University (Tokyo, Japan). It does this by downloading the official webpage
listing all cancellations, extracting the content. A summary is then printed in plain text, filtering as needed. This may be
used in e.g. a crontab to receive updates by mail, or display the info when logging into a shell.

## Requirements

The script is pretty basic; just the PHP interpreter is needed — version 5.2.0 or higher will do.

## Usage

Use your favourite editor to edit the script's `COURSE_FILTER` constant to reflect the classes you're taking. Then, invoke
the PHP interpreter as usual:
```
$ php rikkyo_cancellation_check.php
```

To be notified by email of class cancellations, I use a crontab that runs every morning at 7:
```
 # m  h    dom mon dow  command
   0  7    *   *   *    /usr/bin/php /home/aaron/scripts/rikkyo_cancellation_check.php | mail -E -s "Rikkyo Class Cancellations" user@domain.com
```

Optionally, a list of all cancellations may be printed by providing the `--all` argument: 
```
$ php rikkyo_cancellation_check.php --all
```

## Licence

I am releasing this code under the BSD 2-clause licence as found on http://opensource.org/licenses/BSD-2-Clause

