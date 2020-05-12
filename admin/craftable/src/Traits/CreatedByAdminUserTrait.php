<?php

namespace Savannabits\Craftable\Traits;

use Savannabits\AdminAuth\Models\AdminUser;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait CreatedByAdminUserTrait
{
    /**
     * @return BelongsTo
     */
    public function createdByAdminUser(): BelongsTo
    {
        return $this->belongsTo(AdminUser::class, 'created_by_admin_user_id');
    }
}
