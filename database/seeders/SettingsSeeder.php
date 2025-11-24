<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // UMUM
            [
                'group' => 'UMUM',
                'key' => 'site_title',
                'icon' => 'ri-text',
                'label' => 'Site Title',
                'value' => 'My CMS Website',
                'type' => 'text',
                'description' => 'The main title of your website',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'group' => 'UMUM',
                'key' => 'site_description',
                'icon' => 'ri-file-text-line',
                'label' => 'Site Description',
                'value' => 'A powerful content management system',
                'type' => 'textarea',
                'description' => 'Brief description of your website',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'group' => 'UMUM',
                'key' => 'site_image_url',
                'icon' => 'ri-image-line',
                'label' => 'Site Image URL',
                'value' => null,
                'type' => 'image',
                'description' => 'Default image for social media sharing',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'group' => 'UMUM',
                'key' => 'footer_text',
                'icon' => 'ri-layout-bottom-line',
                'label' => 'Footer Text',
                'value' => '© 2025 My CMS. All rights reserved.',
                'type' => 'textarea',
                'description' => 'Text displayed in the website footer',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'group' => 'UMUM',
                'key' => 'contact_phone',
                'icon' => 'ri-phone-line',
                'label' => 'Contact Phone',
                'value' => '+62 812-3456-7890',
                'type' => 'text',
                'description' => 'Contact phone number',
                'order' => 5,
                'is_active' => true,
            ],
            [
                'group' => 'UMUM',
                'key' => 'whatsapp_number',
                'icon' => 'ri-whatsapp-line',
                'label' => 'WhatsApp Number',
                'value' => '6281234567890',
                'type' => 'text',
                'description' => 'WhatsApp number (without + or spaces)',
                'order' => 6,
                'is_active' => true,
            ],
            [
                'group' => 'UMUM',
                'key' => 'whatsapp_message',
                'icon' => 'ri-message-3-line',
                'label' => 'WhatsApp Default Message',
                'value' => 'Halo, saya ingin bertanya tentang...',
                'type' => 'textarea',
                'description' => 'Default message when opening WhatsApp chat',
                'order' => 7,
                'is_active' => true,
            ],
            [
                'group' => 'UMUM',
                'key' => 'sidebar_header',
                'icon' => 'ri-image-2-line',
                'label' => 'Sidebar Header Image',
                'value' => null,
                'type' => 'image',
                'description' => 'Image displayed in the sidebar header',
                'order' => 8,
                'is_active' => true,
            ],
            [
                'group' => 'UMUM',
                'key' => 'favicon',
                'icon' => 'ri-window-line',
                'label' => 'Favicon',
                'value' => null,
                'type' => 'file',
                'description' => 'Website favicon (ico, png, or svg)',
                'order' => 9,
                'is_active' => true,
            ],

            // SEO
            [
                'group' => 'SEO',
                'key' => 'google_site_verification',
                'icon' => 'ri-google-line',
                'label' => 'Google Site Verification',
                'value' => null,
                'type' => 'text',
                'description' => 'Google Search Console verification code',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'group' => 'SEO',
                'key' => 'yahoo_site_verification',
                'icon' => 'ri-yahoo-line',
                'label' => 'Yahoo Site Verification',
                'value' => null,
                'type' => 'text',
                'description' => 'Yahoo Webmaster verification code',
                'order' => 2,
                'is_active' => true,
            ],

            // SMO (Social Media Optimization)
            [
                'group' => 'SMO',
                'key' => 'facebook_url',
                'icon' => 'ri-facebook-line',
                'label' => 'Facebook URL',
                'value' => null,
                'type' => 'url',
                'description' => 'Facebook page or profile URL',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'group' => 'SMO',
                'key' => 'tiktok_url',
                'icon' => 'ri-tiktok-line',
                'label' => 'TikTok URL',
                'value' => null,
                'type' => 'url',
                'description' => 'TikTok profile URL',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'group' => 'SMO',
                'key' => 'youtube_url',
                'icon' => 'ri-youtube-line',
                'label' => 'YouTube URL',
                'value' => null,
                'type' => 'url',
                'description' => 'YouTube channel URL',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'group' => 'SMO',
                'key' => 'instagram_url',
                'icon' => 'ri-instagram-line',
                'label' => 'Instagram URL',
                'value' => null,
                'type' => 'url',
                'description' => 'Instagram profile URL',
                'order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($settings as $setting) {
            DB::table('settings')->updateOrInsert(
                ['key' => $setting['key']],
                array_merge($setting, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }
    }
}
