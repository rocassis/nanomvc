<?php
/*
 * DON'T DELETE THIS FILE!
 * Author: Robert Carneiro de Assis
 * E-mail: gugoull55@gmail.com
 * Created on 2021/3/9 21:56
 * File: config.php
 * Description: General configuration file
 *
 * Copyright (c) 2021 
 */

// Root path
define('ABSPATH', dirname(__DIR__));

// upload folder path
define('UPLOAD_PATH', ABSPATH . '/_uploads');

// HOME URL
define('HOME_URI', 'http://127.0.0.1:8183/nanomvc');

// DEBUG MODE, TRUE TO SHOW ERROS, FALSE TO NOT SHOW ERROS
define('DEBUG', true);

// ASSETES FOLDER
define('ASSETS', HOME_URI . '/public/assets/');

// VIEWS FOLDER
define('VIEWS', ABSPATH . '/public/views/');

// INITIAL DEFAULT HOME CONTROLLER
define('INITIAL_CONTROLLER', 'Home');

// INITIAL FUNCTION 
define('INITIAL_FUNCTION', 'index');

// SESSION NAME
define('SESSION_NAME', '');

// PATH TO LOG FOLDER
define('LOG_PATH', ABSPATH . '/logs/');

// LOG FILE NAME AND EXTENSION
define('LOG_FILE_NAME', date('Y-m-d').'_log.txt');

// HELPERS FUNCTION FILE PATH
define('HELPERS_PATH', ABSPATH . '/core/libs/helpers.php');
