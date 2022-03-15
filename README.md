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



# Code Review

Code review written by [Nelly Petrén](https://github.com/NellySP) & [Amanda Karlsson Printz](https://github.com/amandaprintz).
1. `DashboardController:41-42` - These rows are not used in the application. Could be removed. 
2. `DashboardController:18-19` - These rows has the same issue, can also be removed. 
3.  `LoginTest.php:6`- The hash is not properly included and gives of an error-in the code. 
4. `ChatroomController.php:7`- Same issue here as the comment above. 
5. `ChatroomController.php:9`- This row seem to be inactive, maybe it could be removed as well.
6. `AddFriendController.php:8-9` - Crypt and Hash doesn’t seem to be used in this file but are included in use.
7. `AddFriendController.php:30`- The error-message repeats the word exists twice and the word “doesn’t” is missing it’s apostrophe. 
8. `ChatController.php:7`- Crypt is not properly included here, gives an error message. 
9. `NewMessageController.php:9`- Crypt is not properly included here either. 
10. `RemoveFriendController.php:7` - Auth is not properly included here, error message. 
11. `RegisterController.php:24` - no minimun-length on password, could be good to add for extra protection. 
12. `General` - the code doesn’t have a lot of comments which could be a problem for a new programmer who wants to continue this amazing application. 
13. `General`: a css could make your site more inviting and fun to use. 
14. `General`: The application could have more detailed messages for example when a frend request is pending instead of “not accepted yet”. 
15. `Navigation`: We’re missing navigation between the pages. It would be useful to have a button with a return to the dashboard from a chat if you’re chatting with multiple friends. 
16. `Typography`: Make sure to use capital letters in the beginning of messages. It makes it look more official. 
17. `Tip!`: For the future you could add notifications when someone’s messaging you and accepts friend requests. 
18. `README.md`- Your README.md is missing it’s most valuable piece, a gif. Please add one now. 
19. `Praise!` - Great installation guide, wouldn’t survived without it! 
20. `More praise!` So impressed by how you’ve build this application. It was hard finding mistakes. Fantastic job! 


