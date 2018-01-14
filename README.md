# eBot-stats
eBot Stats

Small project that lets you show stats from eBot to stream or to screens.

Demo: http://match.csgofinland.fi/

### Install ###

Upload files to your webserver. <br />
Edit config.php from includes folder.

### Open Broadcaster Software Studio (OBS Studio) demo settings ###
Download and install OBS from https://obsproject.com/  
Make sure you have browser plugin installed.

Create scene and add new browserSource  
Url: http://match.csgofinland.fi/stats.php?id=713&Stream=Stream%2Fstats  
Width: 1400  
Height: 800  
Add tab to Refresh browser when scene becomes active. This way you get the latest stats.  
Press OK  
From the preview make the window the size that you want.  
From the filters add color correction and change opacity. I used 74-76   
After this add new game capture source and add csgo.

### Todo ###
* ~~Pagination to index page~~
* Match search and seasons to index page
* ~~Round series~~
* ~~Favorite weapon~~
* ~~Team total ammount of kills~~
* ~~Country flag next to team name~~

<h2>Demo screenshot</h2>

![Alt text](/Screens/screen4.jpg?raw=true "Screenshot from OBS")