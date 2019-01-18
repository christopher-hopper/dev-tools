<?php

// Only enable aliases if Bay integration was fully setup or this is running
// in Bay.
if (!getenv('BAY_INTEGRATION_ENABLED') && !getenv('LAGOON_GIT_BRANCH')) {
  return;
}

// Don't change anything here, it's magic!
global $aliases_stub;
if (empty($aliases_stub)) {
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
  curl_setopt($ch, CURLOPT_HEADER, 0);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_URL, 'http://drush-alias-lagoon-master.lagoon.vicsdp.amazee.io/aliases.drushrc.php.stub');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
  $aliases_stub = curl_exec($ch);
  curl_close($ch);
}
eval($aliases_stub);
