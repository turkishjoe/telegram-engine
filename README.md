Hello! There is not completed project. This repository made for show idea.

I wrote telegram bot in laravel. I wanted to create something like this(with autowiring
in controller method)

```
<?php

// in laravel  routes/telegram.php

$route->text('/start', [StartController::class, 'index']);
$route->inlineKeyboard('okay_button', [StartController::class, 'okayPressed']);

```

I made it. But those code uses laravel engine and need to refactor. I started to refactor 
this and want to move some features to symfony and php/di framework(Maybe it enables to use
with swoole, but i'm not sure at now). 
Also maybe  you can use it for implement your own frawerowk.
