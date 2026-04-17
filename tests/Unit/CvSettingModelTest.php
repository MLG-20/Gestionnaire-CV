<?php

namespace Tests\Unit;

use App\Models\CvSetting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CvSettingModelTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function cv_setting_table_exists()
    {
        $this->assertTrue(
            \Illuminate\Support\Facades\Schema::hasTable('cv_settings')
        );
    }

    #[Test]
    public function cv_setting_has_user_id_column()
    {
        $this->assertTrue(
            \Illuminate\Support\Facades\Schema::hasColumn('cv_settings', 'user_id')
        );
    }

    #[Test]
    public function cv_setting_has_template_name_column()
    {
        $this->assertTrue(
            \Illuminate\Support\Facades\Schema::hasColumn('cv_settings', 'template_name')
        );
    }

    #[Test]
    public function cv_setting_has_primary_color_column()
    {
        $this->assertTrue(
            \Illuminate\Support\Facades\Schema::hasColumn('cv_settings', 'primary_color')
        );
    }

    #[Test]
    public function cv_setting_has_secondary_color_column()
    {
        $this->assertTrue(
            \Illuminate\Support\Facades\Schema::hasColumn('cv_settings', 'secondary_color')
        );
    }

    #[Test]
    public function cv_setting_has_user_relationship()
    {
        $setting = new CvSetting();
        $this->assertTrue(method_exists($setting, 'user'));
    }
}




