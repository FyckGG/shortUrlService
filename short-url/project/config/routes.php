<?php
	use \Core\Route;
	
	return [

    new Route('/', 'url', 'index'),
        new Route('/post', 'url', 'post', ['validateUrl']),
        new Route('/:shortUrl', 'url', 'redirect')



    ];
	
