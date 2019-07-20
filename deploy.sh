#!/usr/bin/env bash
DIRECTORY=/home/arslvsec/public_html/hqCRUD

ssh -i ./deploy_key arslvsec@104.219.248.53 -p 21098 bash <<EOF

#Make temporary directory

cd "$DIRECTORY"
if [ -d "$DIRECTORY/tmp" ]; then
  rm -rf /home/arslvsec/public_html/hqCRUD/tmp
  echo "Old tmp directory deleted successfully."
fi

#Setup project in temporary directory

composer clearcache
git clone https://github.com/EresDev/hqCRUD.git "$DIRECTORY/tmp/"
rm -rf "$DIRECTORY/tmp/.git"
rm "$DIRECTORY/tmp/.env.travis"
rm "$DIRECTORY/tmp/.travis.yml"
rm "$DIRECTORY/tmp/deploy_key.enc"
rm "$DIRECTORY/tmp/readme.md"

cd "$DIRECTORY/tmp/"
APP_ENV=prod
composer install --no-dev

#generate JWT keys
mkdir -p config/jwt
openssl genpkey -out config/jwt/private.pem -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096 -pass pass:eresnoteApp1
openssl pkey -in config/jwt/private.pem -out config/jwt/public.pem -pubout -passin pass:eresnoteApp1

#Swap the temporary directory with app directory
if ! [ -d "$DIRECTORY/app" ]; then
  mkdir "$DIRECTORY/app"
  echo "New app directory created successfully."
fi
 mv "$DIRECTORY/app" "$DIRECTORY/app_tmp"
 mv "$DIRECTORY/tmp" "$DIRECTORY/app"

#Finally, delete old app directory

 rm -rf "$DIRECTORY/app_tmp"
EOF
