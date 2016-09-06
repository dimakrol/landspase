<?php

function companyLogo($type='small') {
  return setting('company_logo_' . $type);
}
function getCode($title,$type = 'alpha_num') {
    switch($type){
        case 'alpha':
            $pattern = '/[^a-zA-Z\_]/';
            break;
        case 'numeric':
            $pattern = '/[^0-9\_]/';
            break;
        default:
            $pattern = '/[^0-9a-zA-Z\_]/';
    }
    $title = strtoupper(str_slug($title, '_'));
    $title = preg_replace($pattern, '', $title);
    return $title;
}