# Laravel FilamentPHP Heroicons Helper

A simple and efficient solution for managing and translating Heroicons in FilamentPHP forms and tables. This helper provides an organized way to handle icon selection with multi-language support and category organization.

## 🌟 Features

- 🌐 Multi-language support for icon labels
- 📂 Organized icon categories (actions, media, security, etc.)
- 🔍 Search functionality for icons
- 🎯 Seamless integration with FilamentPHP
- ⚡ Ready-to-use helper methods for forms and tables

## 📁 Project Structure

```
laravel-filament-heroicons/
├── app/
│   └── Helpers/
│       └── HeroiconHelper.php      # Main helper class
├── config/
│   └── filament_heroicons.php      # Icon configuration and categories
└── lang/
    └── es/
        └── filament_heroicons.php  # Spanish translations (expandable to other languages)
```

## 🚀 Installation

1. Create the Helpers directory in your Laravel project if it doesn't exist:

```bash
mkdir app/Helpers
```

2. Create lang directories for your language(s) if they don't exist:

```bash
mkdir lang/es
```

3. Copy the following files into your Laravel project:


Copy *HeroiconHelper.php* to app/Helpers/
Copy *filament_heroicons.php* to config/
Copy the translation file(s) to lang/{language}/ (e.g., *lang/es/filament_heroicons.php* for Spanish)

That's it! The helper is ready to use in your FilamentPHP forms and tables.

## 💡 Usage

### In FilamentPHP Forms

```php
use App\Helpers\HeroiconHelper;
use Filament\Resources\Resource;
use Filament\Forms;

class YourResource extends Resource
{
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Simple icon selector
                Forms\Components\Select::make('icon')
                    ->label('Icon')
                    ->options(HeroiconHelper::getIconsForSelect())
                    ->searchable(),

                // Category-based icon selector
                Forms\Components\Select::make('icon')
                    ->label('Icon')
                    ->options(HeroiconHelper::getIconsByCategory('actions'))
                    ->searchable(),

                // Advanced usage with categories
                Forms\Components\Select::make('icon')
                    ->label('Icon')
                    ->options(HeroiconHelper::getAllCategorizedIcons())
                    ->searchable()
                    ->preload(),
            ]);
    }
}
```

### In FilamentPHP Tables

```php
use Filament\Resources\Table;
use Filament\Tables;

public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\IconColumn::make('icon')
                ->label('Icon')
                ->icon(fn(string $state): string => $state),
        ]);
}
```

### Available Helper Methods

```php
// Get all icons for select fields
HeroiconHelper::getIconsForSelect();

// Get icons from a specific category
HeroiconHelper::getIconsByCategory('actions');

// Get all categories with their icons
HeroiconHelper::getAllCategorizedIcons();

// Search icons by name
HeroiconHelper::searchIcons('user');

// Get available categories
HeroiconHelper::getCategories();

// Get category metadata
HeroiconHelper::getCategoryMetadata();
```

## 🌍 Adding New Languages

1. Create a new translation file in your language folder:

```php
// lang/your-language/filament_heroicons.php

return [
    'academic_cap' => 'Your Translation',
    'adjustments_horizontal' => 'Your Translation',
    // ... more translations

    'categories' => [
        'actions' => 'Your Translation',
        'media' => 'Your Translation',
        // ... more categories
    ],
];
```

## 🔧 Customization

### Adding New Icons

Add new icons in `config/filament_heroicons.php`:

```php
'icons' => [
    'heroicon-o-new-icon' => 'filament_heroicons.new_icon',
    // ... more icons
],
```

### Adding New Categories

```php
'categories' => [
    'new-category' => prefix_icons([
        'icon1',
        'icon2',
    ]),
],
```

## 🤝 Contributing

Contributions are welcome! Feel free to:

1. Fork the repository
2. Create your feature branch
3. Commit your changes
4. Push to the branch
5. Open a Pull Request

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🙏 Credits

- Icons from [Heroicons](https://heroicons.com/)
- Built for [FilamentPHP](https://filamentphp.com/)
