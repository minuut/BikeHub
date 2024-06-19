<?php

namespace App\Filament\Mechanic\Pages;

use Filament\Pages\Page;
use Filament\Facades\Filament;

class Faq extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.mechanic.pages.faq';

    protected $tenant;
    public $faqTitles;
    public $faqContent;

    public function mount()
    {
        $this->tenant = Filament::getTenant();

        $this->faqTitles = [
            __('faq.titles.faq_1'),
            __('faq.titles.faq_2'),
            __('faq.titles.faq_3'),
        ];

        $this->faqContent = [
            __('faq.content.faq_1'),
            __('faq.content.faq_2'),
            __('faq.content.faq_3'),
        ];
    }

    public function getHeading(): string
    {
        return __('faq.heading');
    }

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }
}
