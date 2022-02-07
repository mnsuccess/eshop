<?php

namespace Tests\Unit;

use App\Models\Wallet;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
// use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;

    public function test_user_has_wallet()
    {
        $user = user::factory()->create();

        $this->assertInstanceOf(Wallet::class, $user->wallet);
    }
}
