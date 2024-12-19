<?php

namespace App\Observers;

use App\Models\Header;

class HeaderObserver
{
    /**
     * Handle the Header "created" event.
     */
    public function creating(Header $header): void
    {
        if (is_null($header->position)) {
            $header->position = Header::where(function ($q) use ($header) {
                    if (!empty($header->ward)) {
                        $q->where("ward", $header->ward);
                    }
                })
                    ->max('position') + 1;

            return;
        }

        $lowerPriorityHeaders = Header::where(function($q) use($header){
            if(!empty($header->ward)){
                $q->where("ward", $header->ward);
            }
        })
            ->where('position', '>=', $header->position)
            ->get();

        foreach ($lowerPriorityHeaders as $lowerPriorityHeader) {
            $lowerPriorityHeader->position++;
            $lowerPriorityHeader->saveQuietly();
        }
    }

    /**
     * Handle the Header "updated" event.
     */
    public function updating(Header $header): void
    {
        if ($header->isClean('position')) {
            return;
        }

        if (is_null($header->position)) {
            $header->position = Header::where(function($q) use($header){
                if(!empty($header->ward)){
                    $q->where("ward", $header->ward);
                }
            })
                ->max('position');
        }

        if ($header->getOriginal('position') > $header->position) {
            $positionRange = [
                $header->position, $header->getOriginal('position'),
            ];
        } else {
            $positionRange = [
                $header->getOriginal('position'), $header->position,
            ];
        }

        $lowerPriorityHeaders = Header::where(function($q) use($header){
            if(!empty($header->ward)){
                $q->where("ward", $header->ward);
            }
        })
            ->whereBetween('position', $positionRange)
            ->where('id', '!=', $header->id)
            ->get();

        foreach ($lowerPriorityHeaders as $lowerPriorityHeader) {
            if ($header->getOriginal('position') < $header->position) {
                $lowerPriorityHeader->position--;
            } else {
                $lowerPriorityHeader->position++;
            }
            $lowerPriorityHeader->saveQuietly();
        }
    }

    /**
     * Handle the Header "deleted" event.
     */
    public function deleting(Header $header): void
    {
        $lowerPriorityHeaders = Header::where(function($q) use($header){
            if(!empty($header->ward)){
                $q->where("ward", $header->ward);
            }
        })
            ->where('position', '>', $header->position)
            ->get();

        foreach ($lowerPriorityHeaders as $lowerPriorityHeader) {
            $lowerPriorityHeader->position--;
            $lowerPriorityHeader->saveQuietly();
        }
    }
}
