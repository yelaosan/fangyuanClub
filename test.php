handle:
- rewrite: if(!is_dir() && !is_file() && path~"^(.*)$") goto "index.php/$1"
name: fangyuan
version: 1
accesskey: x05303k12n
cron:
    - description: GameInsert
      url: index.php/Admin/Auto/game/
      schedule: 00 22 * * *