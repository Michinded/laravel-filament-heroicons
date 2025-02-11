# Laravel FilamentPHP Heroicons Helper

Una solución simple y eficiente para gestionar y traducir Heroicons en formularios y tablas de FilamentPHP. Este helper proporciona una forma organizada de manejar la selección de iconos con soporte multilingüe y organización por categorías.

## 🌟 Características

- 🌐 Soporte multilingüe para etiquetas de iconos
- 📂 Categorías organizadas de iconos (acciones, medios, seguridad, etc.)
- 🔍 Funcionalidad de búsqueda de iconos
- 🎯 Integración perfecta con FilamentPHP
- ⚡ Métodos helper listos para usar en formularios y tablas

## 📁 Estructura del Proyecto

```
laravel-filament-heroicons/
├── app/
│   └── Helpers/
│       └── HeroiconHelper.php      # Clase helper principal
├── config/
│   └── filament_heroicons.php      # Configuración de iconos y categorías
└── lang/
    └── es/
        └── filament_heroicons.php  # Traducciones al español (expandible a otros idiomas)
```

## 🚀 Instalación

1. Crea el directorio Helpers en tu proyecto Laravel si no existe:

```bash
mkdir app/Helpers
```

2. Crea los directorios de idiomas si no existen:

```bash
mkdir lang/es
```

3. Copia los siguientes archivos en tu proyecto Laravel:

Copia *HeroiconHelper.php* a app/Helpers/
Copia *filament_heroicons.php* a config/
Copia el/los archivo(s) de traducción a lang/{idioma}/ (ej., *lang/es/filament_heroicons.php* para español)

¡Eso es todo! El helper está listo para usarse en tus formularios y tablas de FilamentPHP.

## 💡 Uso

### En Formularios FilamentPHP

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
                // Selector de iconos simple
                Forms\Components\Select::make('icon')
                    ->label('Icono')
                    ->options(HeroiconHelper::getIconsForSelect())
                    ->searchable(),

                // Selector de iconos basado en categorías
                Forms\Components\Select::make('icon')
                    ->label('Icono')
                    ->options(HeroiconHelper::getIconsByCategory('actions'))
                    ->searchable(),

                // Uso avanzado con categorías
                Forms\Components\Select::make('icon')
                    ->label('Icono')
                    ->options(HeroiconHelper::getAllCategorizedIcons())
                    ->searchable()
                    ->preload(),
            ]);
    }
}
```

### En Tablas FilamentPHP

```php
use Filament\Resources\Table;
use Filament\Tables;

public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\IconColumn::make('icon')
                ->label('Icono')
                ->icon(fn(string $state): string => $state),
        ]);
}
```

### Métodos Helper Disponibles

```php
// Obtener todos los iconos para campos select
HeroiconHelper::getIconsForSelect();

// Obtener iconos de una categoría específica
HeroiconHelper::getIconsByCategory('actions');

// Obtener todas las categorías con sus iconos
HeroiconHelper::getAllCategorizedIcons();

// Buscar iconos por nombre
HeroiconHelper::searchIcons('user');

// Obtener categorías disponibles
HeroiconHelper::getCategories();

// Obtener metadatos de categorías
HeroiconHelper::getCategoryMetadata();
```

## 🌍 Agregar Nuevos Idiomas

1. Crea un nuevo archivo de traducción en tu carpeta de idioma:

```php
// lang/tu-idioma/filament_heroicons.php

return [
    'academic_cap' => 'Tu Traducción',
    'adjustments_horizontal' => 'Tu Traducción',
    // ... más traducciones

    'categories' => [
        'actions' => 'Tu Traducción',
        'media' => 'Tu Traducción',
        // ... más categorías
    ],
];
```

## 🔧 Personalización

### Agregar Nuevos Iconos

Agrega nuevos iconos en `config/filament_heroicons.php`:

```php
'icons' => [
    'heroicon-o-new-icon' => 'filament_heroicons.new_icon',
    // ... más iconos
],
```

### Agregar Nuevas Categorías

```php
'categories' => [
    'nueva-categoria' => prefix_icons([
        'icon1',
        'icon2',
    ]),
],
```

## 🤝 Contribuir

¡Las contribuciones son bienvenidas! Siéntete libre de:

1. Hacer fork del repositorio
2. Crear tu rama de función
3. Confirmar tus cambios
4. Empujar a la rama
5. Abrir un Pull Request

## 📄 Licencia

Este proyecto está licenciado bajo la Licencia MIT - consulta el archivo [LICENSE](LICENSE) para más detalles.

## 🙏 Créditos

- Iconos de [Heroicons](https://heroicons.com/)
- Construido para [FilamentPHP](https://filamentphp.com/)