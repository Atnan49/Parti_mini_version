# Graph Report - parti2026  (2026-08-24)

## Corpus Check
- 130 files · ~202,019 words
- Verdict: corpus is large enough that graph structure adds value.

## Summary
- 521 nodes · 830 edges · 70 communities (66 shown, 4 thin omitted)
- Extraction: 99% EXTRACTED · 1% INFERRED · 0% AMBIGUOUS · INFERRED: 7 edges (avg confidence: 0.8)
- Token cost: 0 input · 0 output

## Community Hubs (Navigation)
- Controllers
- JS Grid Menu
- Models
- Database Migrations
- Controllers
- NPM Package Config
- Controllers
- Models
- Composer Config
- Controllers
- Composer Config
- Component 11
- Composer Config
- Component 13
- Composer Config
- Composer Config
- Component 16
- Composer Config
- Component 18
- Component 19
- Component 20
- Composer Config
- Composer Config
- Composer Config
- Component 24
- Component 25
- Component 26

## God Nodes (most connected - your core abstractions)
1. `SubEvent` - 45 edges
2. `AuditLog` - 37 edges
3. `User` - 33 edges
4. `Controller` - 28 edges
5. `Sponsor` - 21 edges
6. `TimelineItem` - 18 edges
7. `SubEventDocument` - 15 edges
8. `InfiniteGridMenu` - 15 edges
9. `require` - 13 edges
10. `Geometry` - 13 edges

## Surprising Connections (you probably didn't know these)
- `ProfileController` --inherits--> `Controller`  [EXTRACTED]
  app/Http/Controllers/ProfileController.php → app/Http/Controllers/Controller.php
- `HomeController` --inherits--> `Controller`  [EXTRACTED]
  app/Http/Controllers/Public/HomeController.php → app/Http/Controllers/Controller.php
- `SubEventController` --inherits--> `Controller`  [EXTRACTED]
  app/Http/Controllers/Public/SubEventController.php → app/Http/Controllers/Controller.php
- `AuditLogController` --inherits--> `Controller`  [EXTRACTED]
  app/Http/Controllers/Admin/AuditLogController.php → app/Http/Controllers/Controller.php
- `ChangePasswordController` --inherits--> `Controller`  [EXTRACTED]
  app/Http/Controllers/Admin/ChangePasswordController.php → app/Http/Controllers/Controller.php

## Import Cycles
- None detected.

## Communities (70 total, 4 thin omitted)

### Community 0 - "Controllers"
Cohesion: 0.06
Nodes (19): AuditLogController, ChangePasswordController, DashboardController, DocumentController, RegistrationLinkController, SponsorController, SubEventController, TimelineController (+11 more)

### Community 1 - "JS Grid Menu"
Cohesion: 0.06
Nodes (13): ArcballControl, createAndSetupTexture(), createProgram(), createShader(), DiscGeometry, Face, Geometry, IcosahedronGeometry (+5 more)

### Community 2 - "Models"
Cohesion: 0.08
Nodes (16): User, AdminSeeder, Illuminate\Database\Eloquent\Attributes\Fillable, Illuminate\Database\Eloquent\Attributes\Hidden, Illuminate\Database\Eloquent\Relations\HasMany, Illuminate\Foundation\Auth\User, Illuminate\Foundation\Testing\RefreshDatabase, Illuminate\Foundation\Testing\TestCase (+8 more)

### Community 3 - "Database Migrations"
Cohesion: 0.08
Nodes (3): Illuminate\Database\Migrations\Migration, Illuminate\Database\Schema\Blueprint, Illuminate\Support\Facades\Schema

### Community 4 - "Controllers"
Cohesion: 0.09
Nodes (9): SubEventController, SubEventDocument, TimelineItem, Illuminate\Database\Eloquent\Builder, Illuminate\Database\Eloquent\Factories\HasFactory, Illuminate\Database\Eloquent\Model, Illuminate\Database\Eloquent\Relations\BelongsTo, Illuminate\Support\Facades\Cache (+1 more)

### Community 5 - "NPM Package Config"
Cohesion: 0.07
Nodes (28): alpinejs, autoprefixer, concurrently, gl-matrix, laravel-vite-plugin, dependencies, gl-matrix, devDependencies (+20 more)

### Community 6 - "Controllers"
Cohesion: 0.11
Nodes (10): HomeController, Sponsor, AppLayout, GuestLayout, DatabaseSeeder, SponsorSeeder, SubEventSeeder, Illuminate\Database\Seeder (+2 more)

### Community 7 - "Models"
Cohesion: 0.09
Nodes (10): Setting, AppServiceProvider, UserFactory, Illuminate\Database\Eloquent\Factories\Factory, Illuminate\Support\Facades\URL, Illuminate\Support\Facades\View, Illuminate\Support\ServiceProvider, Illuminate\Support\Str (+2 more)

### Community 8 - "Composer Config"
Cohesion: 0.08
Nodes (26): scripts, dev, post-autoload-dump, post-create-project-cmd, post-root-package-install, post-update-cmd, pre-package-uninstall, setup (+18 more)

### Community 9 - "Controllers"
Cohesion: 0.11
Nodes (11): ProfileController, LoginRequest, GformLinkRequest, ProfileUpdateRequest, Illuminate\Auth\Events\Lockout, Illuminate\Contracts\Validation\ValidationRule, Illuminate\Foundation\Http\FormRequest, Illuminate\Support\Facades\RateLimiter (+3 more)

### Community 10 - "Composer Config"
Cohesion: 0.15
Nodes (13): require, laravel/framework, laravel/tinker, php, symfony/console, symfony/error-handler, symfony/finder, symfony/http-foundation (+5 more)

### Community 11 - "Component 11"
Cohesion: 0.18
Nodes (10): background_color, description, display, icons, name, orientation, scope, short_name (+2 more)

### Community 12 - "Composer Config"
Cohesion: 0.22
Nodes (9): require-dev, fakerphp/faker, laravel/breeze, laravel/pail, laravel/pao, laravel/pint, mockery/mockery, nunomaduro/collision (+1 more)

### Community 13 - "Component 13"
Cohesion: 0.43
Nodes (4): ForcePasswordChange, RoleMiddleware, Closure, Symfony\Component\HttpFoundation\Response

### Community 14 - "Composer Config"
Cohesion: 0.25
Nodes (7): description, license, minimum-stability, name, prefer-stable, $schema, type

### Community 15 - "Composer Config"
Cohesion: 0.25
Nodes (8): pestphp/pest-plugin, php-http/discovery, config, allow-plugins, optimize-autoloader, platform-check, preferred-install, sort-packages

### Community 16 - "Component 16"
Cohesion: 0.40
Nodes (3): Illuminate\Foundation\Application, Illuminate\Foundation\Configuration\Exceptions, Illuminate\Foundation\Configuration\Middleware

### Community 17 - "Composer Config"
Cohesion: 0.40
Nodes (5): autoload, psr-4, App\\, Database\\Factories\\, Database\\Seeders\\

### Community 18 - "Component 18"
Cohesion: 0.40
Nodes (4): Monolog\Handler\NullHandler, Monolog\Handler\StreamHandler, Monolog\Handler\SyslogUdpHandler, Monolog\Processor\PsrLogMessageProcessor

### Community 20 - "Component 20"
Cohesion: 0.50
Nodes (3): profile.partials.delete-user-form, profile.partials.update-password-form, profile.partials.update-profile-information-form

### Community 21 - "Composer Config"
Cohesion: 0.67
Nodes (3): autoload-dev, psr-4, Tests\\

### Community 22 - "Composer Config"
Cohesion: 0.67
Nodes (3): extra, laravel, dont-discover

### Community 23 - "Composer Config"
Cohesion: 0.67
Nodes (3): keywords, framework, laravel

## Knowledge Gaps
- **86 isolated node(s):** `$schema`, `name`, `type`, `description`, `laravel` (+81 more)
  These have ≤1 connection - possible missing edges or undocumented components.
- **4 thin communities (<3 nodes) omitted from report** — run `graphify query` to explore isolated nodes.

## Suggested Questions
_Questions this graph is uniquely positioned to answer:_

- **Why does `SubEvent` connect `Controllers` to `Models`, `Controllers`, `Controllers`, `Models`?**
  _High betweenness centrality (0.075) - this node is a cross-community bridge._
- **Why does `Sponsor` connect `Controllers` to `Controllers`, `Controllers`, `Models`?**
  _High betweenness centrality (0.065) - this node is a cross-community bridge._
- **Why does `User` connect `Models` to `Controllers`, `Controllers`, `Controllers`, `Models`?**
  _High betweenness centrality (0.056) - this node is a cross-community bridge._
- **What connects `$schema`, `name`, `type` to the rest of the system?**
  _86 weakly-connected nodes found - possible documentation gaps or missing edges._
- **Should `Controllers` be split into smaller, more focused modules?**
  _Cohesion score 0.06456140350877193 - nodes in this community are weakly interconnected._
- **Should `JS Grid Menu` be split into smaller, more focused modules?**
  _Cohesion score 0.06462585034013606 - nodes in this community are weakly interconnected._
- **Should `Models` be split into smaller, more focused modules?**
  _Cohesion score 0.07897793263646923 - nodes in this community are weakly interconnected._