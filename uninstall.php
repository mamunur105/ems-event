<?php

// register_uninstall_hook(['EMS\Main\ems_uninstall_time', 'ems_uninstall_time' ] );
$uninstall_hooks = new EMS\Main\ems_uninstall_time();
$uninstall_hooks->ems_uninstall_time();