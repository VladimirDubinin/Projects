<?php
session_start();
session_destroy();

if (@$_SERVER['HTTP_REFERER'] != null) {
	header("Location: ".$_SERVER['HTTP_REFERER']);
}
else Sys::GoHome();