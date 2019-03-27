<?php

register_uninstall_hook( __FILE__, [ new EMS\Main\ems_uninstall_time(), 'ems_uninstall_time' ] );