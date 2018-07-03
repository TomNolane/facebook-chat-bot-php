# Simple Facebook (Messenger) chat bot on php
---
## Require
* PHP >= 5.6  
* Yours webhosting or local hosting (such are OpenServer, Xampp, Denwer and other) 
* Your's PUBLIC|GROUP in facebook   
* **SSL is strongly required!**  
> if you launch without this, you need install PHP >= 5.6[^1]  


## Install

### Step 1

1. git clone https://github.com/TomNolane/facebook-chat-bot-php.git demo-bot  
2. go to developers.facebook[^2] -> add new app (enter your's app name) -> select Messenger platform

3. Copy your's App's ID and select your's PUBLIC page and copy TOKEN  
4. Set up Webhooks -> fill out the form: indicate bot’s address and tick necessary events (you can get detailed information about each of them in the documentation).  
> What does “Verify Token” mean? It is a field which will be sent to your server in JSON and will allow to make subscription process secure. Another developer will not be able to subscribe your script to the events of his bot if he doesn’t know your “Verify Token”  
```php

```




Done
---
[Messenger bot - start, docs](https://developers.facebook.com/docs/messenger-platform/getting-started/)  

[^1]: https://metanit.com/web/php/1.2.php
[^2]: https://developers.facebook.com/apps/
[^3]: https://ngrok.com