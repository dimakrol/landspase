<?php

function admin() {
  return \Auth::guard('admin')->user();
}

function user() {
  return \Auth::guard()->user();
}
