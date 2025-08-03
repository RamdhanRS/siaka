<?php
$dynamicScripts = [];

function addScript($scriptTag)
{
  global $dynamicScripts;
  $dynamicScripts[] = $scriptTag;
}

function printScripts()
{
  global $dynamicScripts;
  foreach ($dynamicScripts as $script) {
    echo $script . "\n";
  }
}
