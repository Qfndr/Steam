<?php

/** @group UserStats */
class UserStatsTest extends BaseTester {

    /** @test */
    public function it_gets_the_users_achievements_for_a_game()
    {
        $achievements = $this->steamClient->userStats($this->id64)->GetPlayerAchievements($this->appId);

        $this->assertInstanceOf('Syntax\SteamApi\Containers\Achievement', $achievements[0]);
        $this->checkAchievementProperties($achievements[0]);
    }

    /** @test */
    public function it_gets_the_global_achievement_percentage_for_a_game()
    {
        $achievements = $this->steamClient->userStats($this->id64)->GetGlobalAchievementPercentagesForApp($this->appId);

        $this->assertGreaterThan(0, $achievements);

        $attributes = ['name', 'percent'];
        $this->assertObjectHasAttributes($attributes, $achievements[0]);
    }

    /** @test */
    public function it_gets_the_user_stats_for_a_game()
    {
        $stats = $this->steamClient->userStats(76561198159417876)->GetUserStatsForGame(730);

        $this->assertTrue(is_array($stats));

        $attributes = ['name', 'achieved'];
        $this->assertObjectHasAttributes($attributes, $stats[0]);
    }

    /** @test */
    public function it_gets_all_the_user_stats_for_a_game()
    {
        $stats = $this->steamClient->userStats(76561198159417876)->GetUserStatsForGame(730, true);

        $this->assertTrue(is_object($stats));

        $attributes = ['name', 'achieved'];
        $this->assertObjectHasAttributes($attributes, $stats->achievements[0]);

        $attributes = ['name', 'value'];
        $this->assertObjectHasAttributes($attributes, $stats->stats[0]);
    }

}
