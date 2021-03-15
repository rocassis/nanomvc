<?php

/*************************************************************************
 *  File with generic global function to help and avoid duplicated code  *
 *************************************************************************/

 /**
  * Load asset from assets folder. Eg:. 'css/file.css' or 'js/file.js'
  *
  * @param string $asset Asset folder and name. Eg:. 'css/file.css'
  * @return mixed
  */
 function assets($asset)
 {
   return ASSETS . $asset;
 }