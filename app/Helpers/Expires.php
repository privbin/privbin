<?php


namespace App\Helpers;


use App\Settings\GeneralSettings;
use Illuminate\Support\Collection;
use stdClass;

class Expires
{
    /**
     * @param array $expire
     * @return stdClass
     */
    public static function fromArray(array $expire) : stdClass
    {
        $object = new stdClass;
        $object->time = $expire["time"];
        $object->name = $expire["name"];
        $object->lang = $expire["lang"];
        $object->requirements = collect();
        $object->middlewares = collect();

        foreach (explode("|", $expire["requirements"]) as $requirement) {
            if (strlen($requirement) > 0) {
                $object->requirements->add(trim(strtolower($requirement)));
            }
        }

        foreach ($object->requirements as $requirement) {
            if ($requirement == "auth") {
                $object->middlewares->add(\App\Http\Middleware\Authenticate::class);
            }
        }

        return $object;
    }

    /**
     * @return Collection
     */
    public static function all() : Collection
    {
        $expires = app(GeneralSettings::class)->expires;
        $_expires = collect();
        foreach ($expires as $expire) {
            $_expire = self::fromArray($expire);
            $_expires->put($_expire->name, $_expire);
        }
        return $_expires;
    }

    /**
     * @param string $name
     * @return object|null
     */
    public static function find(string $name) : ?object
    {
        return self::all()->where("name", $name)->first();
    }
}
