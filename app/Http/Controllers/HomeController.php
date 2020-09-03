<?php

namespace App\Http\Controllers;

use App\Http\Requests\DownloadCvRequest;

class HomeController extends Controller
{
    public function home()
    {
        return view('public.home', [
            'posts' => json_encode([[
                'title' => 'Eloquent Relationships In Depth',
                'teaser' => [
                    'Understand what Eloquent relationships are available, when they should be used, and how to customize them.',
                    'We will explore the default relationships that ship with Laravel, as well as some very useful third-party relationships that can be installed via packages.',
                ],
                'image' => asset('storage/posts/eloquent-relationships-in-depth/teaser.png'),
                'href' => url('#'),
                'status' => 'Coming Soon',
                'tags' => [[
                    'label' => 'php',
                    'color' => 'blue',
                ], [
                    'label' => 'sql',
                    'color' => 'blue',
                ], [
                    'label' => 'laravel',
                    'color' => 'red',
                ], [
                    'label' => 'eloquent',
                    'color' => 'red',
                ]],
                'created_at' => 'August 31st, 2020',
            ]]),
        ]);
    }

    public function cv()
    {
        return view('public.cv', []);
    }

    public function downloadCv(DownloadCvRequest $request)
    {
        return response()->file(storage_path('private/Kurt Friars - Resume.pdf'));
    }

    public function packages()
    {
        return view('public.packages', [
            'packages' => json_encode([[
                'title' => 'Laravel Translation Manager',
                'ref' => 'kfriars/laravel-translations-manager',
                'repo' => 'https://github.com/kfriars/laravel-translations-manager',
                'description' => 'A package to manage translations for multilingual Laravel applications. Automatically detect errors, generate files to be translated and fix the all errors using the translated files.',
                'shields' => [[
                    'label' => 'php',
                    'alt' => 'Packagist PHP Version Support',
                    'shield_url' => 'https://img.shields.io/packagist/php-v/kfriars/laravel-translations-manager?color=%234ccd98&label=php&logo=php&logoColor=%23fff',
                    'click_url' => 'https://packagist.org/packages/kfriars/laravel-translations-manager',
                ], [
                    'label' => 'laravel',
                    'alt' => 'Laravel Version Support',
                    'shield_url' => 'https://img.shields.io/badge/laravel-6.x--7.x-%2343d399?logo=laravel&logoColor=%23ffffff',
                    'click_url' => 'https://packagist.org/packages/kfriars/laravel-translations-manager',
                ], [
                    'label' => 'packagist',
                    'alt' => 'Latest Version on Packagist',
                    'shield_url' => 'https://img.shields.io/packagist/v/kfriars/laravel-translations-manager.svg?color=%234ccd98&style=flat-square',
                    'click_url' => 'https://packagist.org/packages/kfriars/laravel-translations-manager',
                ], [
                    'label' => 'downloads',
                    'alt' => 'Total Downloads',
                    'shield_url' => 'https://img.shields.io/packagist/dt/kfriars/laravel-translations-manager.svg?color=%234ccd98&style=flat-square',
                    'click_url' => 'https://packagist.org/packages/kfriars/laravel-translations-manager',
                ], [
                    'label' => 'tests',
                    'alt' => 'GitHub Workflow Status',
                    'shield_url' => 'https://img.shields.io/github/workflow/status/kfriars/laravel-translations-manager/Tests?color=%234ccd98&label=Tests&logo=github&logoColor=%23fff',
                    'click_url' => 'https://github.com/kfriars/laravel-translations-manager/actions?query=workflow%3ATests',
                ], [
                    'label' => 'coverage',
                    'alt' => 'Code Climate coverage',
                    'shield_url' => 'https://img.shields.io/codeclimate/coverage/kfriars/laravel-translations-manager?color=%234ccd98&label=test%20coverage&logo=code-climate&logoColor=%23fff',
                    'click_url' => 'https://codeclimate.com/github/kfriars/laravel-translations-manager/test_coverage',
                ], [
                    'label' => 'maintainability',
                    'alt' => 'Code Climate maintainability',
                    'shield_url' => 'https://img.shields.io/codeclimate/maintainability/kfriars/laravel-translations-manager?color=%234ccd98&label=maintainablility&logo=code-climate&logoColor=%23fff',
                    'click_url' => 'https://codeclimate.com/github/kfriars/laravel-translations-manager/maintainability',
                ]],
            ], [
                'title' => 'PHP Array to File',
                'ref' => 'kfriars/php-array-to-file',
                'repo' => 'https://github.com/kfriars/php-array-to-file',
                'description' => 'A php package to write an array to a file in a human readable format.',
                'shields' => [[
                    'label' => 'php',
                    'alt' => 'Packagist PHP Version Support',
                    'shield_url' => 'https://img.shields.io/packagist/php-v/kfriars/php-array-to-file?color=%234ccd98&label=php&logo=php&logoColor=%23fff',
                    'click_url' => 'https://packagist.org/packages/kfriars/php-array-to-file',
                ], [
                    'label' => 'packagist',
                    'alt' => 'Latest Version on Packagist',
                    'shield_url' => 'https://img.shields.io/packagist/v/kfriars/php-array-to-file.svg?color=%234ccd98&style=flat-square',
                    'click_url' => 'https://packagist.org/packages/kfriars/php-array-to-file',
                ], [
                    'label' => 'downloads',
                    'alt' => 'Total Downloads',
                    'shield_url' => 'https://img.shields.io/packagist/dt/kfriars/php-array-to-file.svg?color=%234ccd98&style=flat-square',
                    'click_url' => 'https://packagist.org/packages/kfriars/php-array-to-file',
                ], [
                    'label' => 'tests',
                    'alt' => 'GitHub Workflow Status',
                    'shield_url' => 'https://img.shields.io/github/workflow/status/kfriars/php-array-to-file/Tests?color=%234ccd98&label=Tests&logo=github&logoColor=%23fff',
                    'click_url' => 'https://github.com/kfriars/php-array-to-file/actions?query=workflow%3ATests',
                ], [
                    'label' => 'coverage',
                    'alt' => 'Code Climate coverage',
                    'shield_url' => 'https://img.shields.io/codeclimate/coverage/kfriars/php-array-to-file?color=%234ccd98&label=test%20coverage&logo=code-climate&logoColor=%23fff',
                    'click_url' => 'https://codeclimate.com/github/kfriars/php-array-to-file/test_coverage',
                ], [
                    'label' => 'maintainability',
                    'alt' => 'Code Climate maintainability',
                    'shield_url' => 'https://img.shields.io/codeclimate/maintainability/kfriars/php-array-to-file?color=%234ccd98&label=maintainablility&logo=code-climate&logoColor=%23fff',
                    'click_url' => 'https://codeclimate.com/github/kfriars/php-array-to-file/maintainability',
                ]],
            ]]),
        ]);
    }
}
