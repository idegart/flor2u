<?php

Route::view('/', 'welcome');

Route::view('{any}', 'app')->where('any', '(.*)');
