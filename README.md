# ChatUp!

laravel app that uses websockets to transfer your messages to your friends.

INSTALL!!!!!!!!!

run these commands: 0. run bash install.sh and skip to 5 4. cp .env.example .env

1. composer update
2. php artisan key:generate
3. npm install
4. make database
5. add db to env
   IMPORTANT!!! BROADCAST_DRIVER must be set to pusher in the .env or it wont work
6. npm run dev

#### if you want to test it with someone:

run:

1. npm run build
2. npm run local

todo

-   [x] fix chat routes
-   [x] encrypt messages maybe?
-   [ ] fix names on events
-   [ ] maybe one line of css, prefarably not
-   [x] FRIEND SYSTEM!!!! events for that would be cool aswell.

1.  -   [x] accept
2.  -   [x] reject
3.  -   [x] delete
4.  -   [x] send
5.  -   [x] no duplicates

-   [x] optimize queries
-   [x] fix ugly code pieces (specificly get friends user method)
