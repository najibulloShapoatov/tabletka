<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class SiteProperty extends Model
{
    //
    public static function getProperty(string $propKey)
    {
        return (SiteProperty::where('prop_key', $propKey)->get()->first())->prop_value;
    }

    public function getList()
    {
        return $this->orderBy('id', 'asc')->get();
    }

    public function updateProps(Request $request)
    {
        $in = $request->all();
        $this->setProp('SITE_NAME', trim(htmlspecialchars($in['site_name'])));
        $this->setProp('TELEGRAM_LINK', trim(htmlspecialchars($in['telegram_link'])));
        $this->setProp('YOUTUBE_LINK', trim(htmlspecialchars($in['youtube_link'])));
        $this->setProp('INSTAGRAM_LINK', trim(htmlspecialchars($in['instagram_link'])));
        $this->setProp('FB_LINK', trim(htmlspecialchars($in['fb_link'])));
        $this->setProp('EMAIL', trim(htmlspecialchars($in['email'])));
        $this->setProp('PHONE_TWO', trim(htmlspecialchars($in['phone_two'])));
        $this->setProp('PHONE_ONE', trim(htmlspecialchars($in['phone_one'])));
        $this->setProp('ADDRESS', trim(htmlspecialchars($in['address'])));
    }

    public function setProp($propKey, $propValue){
        $prop = $this->where('prop_key', $propKey)->get()->first();
        $prop->prop_value = $propValue;
        $prop->save();
    }

    public function getProp($propKey){
        return ($this->where('prop_key', $propKey)->get()->first())->prop_value;
    }
}
