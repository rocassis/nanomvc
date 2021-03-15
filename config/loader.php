<?php
/*
 * DON'T DELETE THIS FILE!
 * Author: Robert Carneiro de Assis
 * E-mail: gugoull55@gmail.com
 * Created on 2021/3/9 21:45
 * File: loader.php
 * Description: Global functions and files loader
 *
 * Copyright (c) 2021 
 */

// Avoid direct access
if (!defined('ABSPATH')) exit;


/********************************************
 *  --------  LOAD CONFIGS FILES  --------  *
 ********************************************/
/**
 * Load configurations file, enter the name of the configuration file
 * from the config folder.
 * Eg:. filename.php => loadConfig('filename');
 */
loadConfig('database');

/*********************************
 *  -------- SESSIONS  --------  *
 *********************************/
session_start();

/******************************************
 *  -------- HANDLER FUCNTIONS  --------  *
 ******************************************/
// Global exception handler
set_exception_handler(null);

// Global error handler
set_error_handler(null);