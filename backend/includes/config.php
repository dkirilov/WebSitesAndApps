<?php

$SETTINGS['production_mode'] = true;

$SETTINGS['site_name'] = "troyan-cleaning.com";
$SETTINGS['site_email'] = "no-reply@mail.troyan-cleaning.com";
$SETTINGS['site_default_title'] = "Троян клийнинг";

$SETTINGS['frontend_files_path'] = "frontend/";
$SETTINGS['frontend_files_url'] = "http://" . $SETTINGS['site_name'] . "/frontend/";
$SETTINGS['files_dir_url'] = "http://" . $SETTINGS['site_name'] . "/files/";

$SETTINGS['home_page'] = 'about';

$SETTINGS['charset'] = "UTF-8";

$SETTINGS['db_driver'] = "mysql";
$SETTINGS['db_host'] = "localhost";
$SETTINGS['db_name'] = "troyan-cleaning";
$SETTINGS['db_charset'] = "utf8mb4";
$SETTINGS['db_username'] = "dian";
$SETTINGS['db_password'] = "******";

$SETTINGS['meta_description'] = "Професионално почистване на жилища, офиси, магазини, заведения, банки, хотели, административни сгради, складови помещения и др.";
$SETTINGS['meta_author'] = "Troyan cleaning";
$SETTINGS['meta_robots'] = "index,follow";

$SETTINGS['uploaded_image_file_max_size'] = 1024*200;
$SETTINGS['allowed_image_types'] = array(
                                        "image/gif",
                                        "image/jpeg",
                                        "image/png"
                                   );
$SETTINGS['allowed_image_extensions'] = array(
                                            "png",
                                            "jpg",
                                            "jpeg",
                                            "gif"
                                        );
$SETTINGS['clients_logos_dir'] = "files/images/clients-logos/";
