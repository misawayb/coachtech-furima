src/config/app.php 'timezone' => 'Asia/Tokyo',

fallback_locale → jaに変更
指定したlocaleの翻訳ファイルが見つからなかったときのフォールバック先です。jaにしておいて問題ないです。

faker_locale → ja_JPに変更
これが一番実感しやすい変化です。Fakerでダミーデータを生成するときに日本語・日本フォーマットになります。




src/.env
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=coachtech-furima_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass