<?php

session_unset();
session_destroy();

header("Location:" . $SETTINGS['home_page']);
exit;