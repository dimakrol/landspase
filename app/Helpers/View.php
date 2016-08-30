<?php

function companyLogo($type='small') {
  return setting('company_logo_' . $type);
}