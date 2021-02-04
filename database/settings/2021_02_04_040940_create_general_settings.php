<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateGeneralSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add("general.expires", [
            "day_1",
            "hour_6",
            "hour_3",
            "hour_1",
            "minute_30",
            "minute_15",
            "minute_5",
            "forever",
        ]);
    }
}
