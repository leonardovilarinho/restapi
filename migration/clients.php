<?php

use LegionLab\Rest\Persistence\Migration;
use LegionLab\Rest\Collections\Settings;

$migration = new Migration();

$migration
    ->database(Settings::get('default_dbname'))
    ->name('clients')
    ->pk('id')
    ->autoincrement('id')
    ->column('id', 'int', 11, false)
    ->column('name', 'varchar', '20', false)
    ->column('age', 'int', 2, false)
    ->make();