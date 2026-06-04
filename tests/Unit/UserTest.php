<?php

namespace Tests\Unit;

use App\Models\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    /**
     * Test isAdmin returns true untuk role admin.
     */
    public function test_is_admin_returns_true_for_admin_role(): void
    {
        $user = new User();
        $user->role = 'admin';

        $this->assertTrue($user->isAdmin());
    }

    /**
     * Test isAdmin returns false untuk role seller.
     */
    public function test_is_admin_returns_false_for_seller_role(): void
    {
        $user = new User();
        $user->role = 'seller';

        $this->assertFalse($user->isAdmin());
    }

    /**
     * Test isAdmin returns false jika role null.
     */
    public function test_is_admin_returns_false_for_null_role(): void
    {
        $user = new User();
        $user->role = null;

        $this->assertFalse($user->isAdmin());
    }
}
