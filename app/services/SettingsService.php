<?php

namespace App\Services;

class SettingsService
{
    public function getAvailableThemes(): array
    {
        return [
            'default' => ['label' => 'Amber', 'dot' => '#d4a373'],
            'green' => ['label' => 'Green', 'dot' => '#00ff41'],
            'blue' => ['label' => 'Blue', 'dot' => '#00d4ff'],
            'red' => ['label' => 'Red', 'dot' => '#ff3355'],
            'ghost' => ['label' => 'Ghost', 'dot' => '#aaaaaa'],
        ];
    }

    public function getAvailableFonts(): array
    {
        return [
            'default' => ['label' => 'Default', 'preview' => 'The quick brown fox'],
            'bytesized' => ['label' => 'Bytesized', 'preview' => 'The quick brown fox'],
            'vt323' => ['label' => 'VT323', 'preview' => 'The quick brown fox'],
            'doto' => ['label' => 'Doto', 'preview' => 'The quick brown fox'],
            'pixelify' => ['label' => 'Pixelify', 'preview' => 'The quick brown fox'],
            'rubik' => ['label' => 'Rubik Pixels', 'preview' => 'The quick brown fox'],
        ];
    }

    public function getAvailableFontFamilies(): array
    {
        return [
            'default' => 'ui-sans-serif, system-ui, sans-serif',
            'bytesized' => 'Bytesized, monospace',
            'vt323' => 'VT323, monospace',
            'doto' => 'Doto, monospace',
            'pixelify' => 'Pixelify, monospace',
            'rubik' => '"Rubik Pixels", monospace',
            // 'default' => ['label' => 'Default', 'css' => 'var(--font-default)'],
            // 'bytesized' => ['label' => 'Bytesized', 'css' => 'var(--font-bytesized)'],
            // 'vt323' => ['label' => 'VT323', 'css' => 'var(--font-vt323)'],
            // 'doto' => ['label' => 'Doto', 'css' => 'var(--font-doto)'],
            // 'pixelify' => ['label' => 'Pixelify', 'css' => 'var(--font-pixelify)'],
            // 'rubik' => ['label' => 'Rubik Pixels', 'css' => 'var(--font-rubik)'],
        ];
    }

    public function saveUserSettings($user, $settings): void
    {
        $user->settings = json_encode($settings); //$settings;
        $user->save();
        session(['chat_settings' => $settings]);
    }
}
