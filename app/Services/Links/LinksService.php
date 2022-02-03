<?php


namespace App\Services\Links;


use App\Models\Link;

class LinksService
{
    /**
     * @throws \Exception
     */
    public function compress(string $link): string
    {
        try {
            $link = Link::create([
                'code' => substr(uniqid(), 0, 5),
                'url' => $link
            ]);
            return env('APP_URL') . "/c/$link->code";
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
