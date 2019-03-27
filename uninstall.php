<?php

register_uninstall_hook( __FILE__, [EMS\Main\ems_uninstall_time(), 'ems_uninstall_time' ] );