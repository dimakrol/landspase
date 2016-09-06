<?php

function companyLogo($type='small') {
  return setting('company_logo_' . $type);
}
function getCode($title) {
  return strtoupper(str_slug($title, '_'));
}