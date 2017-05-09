Chat
========================
INSTALL
========================
git clone https://github.com/GavukaAlexandr/chat

create user, schema and setting chat/app/config/parameters.yml

composer install

bin/console doctrine:schema:update --force

bin/console fos:user:create --super-admin

bin/console server:start

http://127.0.0.1:8000/register/

http://127.0.0.1:8000/login

write first message? and update page
