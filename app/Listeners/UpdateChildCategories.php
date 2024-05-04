<?php

namespace App\Listeners;

use App\Events\CategoryDeleted;
use App\Models\Category;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class UpdateChildCategories
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CategoryDeleted $event): void
    {
        $deleted_category = $event->data;
        $update = Category::where('parent_id', $deleted_category->id)
        ->update([
            'parent_id' => $deleted_category->parent_id,
        ]);
        // Log::info("CategoryDeleted");
        // Log::info(json_encode($deleted_category));
        // Log::info(json_encode($update));
    }
}
