<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookmarkPart extends Model
{
    /**
     * A BookmarkPart belong to a bookmark
     *
     * @return BelongsTo
     */
    public function bookmark()
    {
        return $this->belongsTo(Bookmark::class);
    }

    /**
     * A BookmarkPart belong to a course
     *
     * @return BelongsTo
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function getTableColumns()
    {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }

}
