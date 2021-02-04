<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateGeneralSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add("general.expires", [
            (object) [
                "time" => "+150 years",
                "name" => "never",
                "lang" => "expires.never",
                "requirements" => "auth",
            ],
            (object) [
                "time" => "+10 minutes",
                "name" => "minutes_10",
                "lang" => "expires.minutes_10",
                "requirements" => "",
            ],
            (object) [
                "time" => "+1 hours",
                "name" => "hours_1",
                "lang" => "expires.hours_1",
                "requirements" => "",
            ],
            (object) [
                "time" => "+1 days",
                "name" => "days_1",
                "lang" => "expires.days_1",
                "requirements" => "",
            ],
            (object) [
                "time" => "+1 weeks",
                "name" => "weeks_1",
                "lang" => "expires.weeks_1",
                "requirements" => "",
            ],
            (object) [
                "time" => "+2 weeks",
                "name" => "weeks_2",
                "lang" => "expires.weeks_2",
                "requirements" => "",
            ],
            (object) [
                "time" => "+1 months",
                "name" => "months_2",
                "lang" => "expires.months_2",
                "requirements" => "auth",
            ],
            (object) [
                "time" => "+6 months",
                "name" => "months_6",
                "lang" => "expires.months_6",
                "requirements" => "auth|premium",
            ],
            (object) [
                "time" => "+1 years",
                "name" => "years_1",
                "lang" => "expires.years_1",
                "requirements" => "auth|premium",
            ],
        ]);
    }
}
