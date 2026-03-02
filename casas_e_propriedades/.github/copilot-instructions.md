# AI Copilot Instructions for Casas & Propriedades

## Project Overview
A Portuguese real estate management system with dual-layer architecture:
- **Frontend**: Public-facing pages in root directory (index.php, portfolio.php, predios.php, projetos.php, etc.)
- **Backoffice**: Admin panel in `/backoffice/` for managing content via CRUD operations

## Architecture & Patterns

### Layered Structure
All pages follow: **Logic → Header/Components → View → Footer**
```
page.php → require "components/header.php"
        → require "views/{page}_view.php"
        → require "components/footer.php"
```
Views handle both form submission logic (at the top) and HTML rendering.

### Database & Helpers
- **Database**: MySQL (`casas_e_prop_bd`) with PDO connection in `helpers/base_dados_helper.php`
- **Helper Functions**: Each domain gets a helper file
  - `empresa_helper.php`, `portfolio_helper.php`, `predios_helper.php`, `projetos_helper.php`
  - Functions follow pattern: `get_{entity}()`, `get_{entity}($id)`, `get_{entity}_dropdown()`
  - Global functions: `select_sql()`, `select_sql_unico()`, `idu_sql()` for queries

### Bootstrap & UI
- Bootstrap 5.3.7 for responsive layout
- Custom CSS in `/backoffice/css/style.css` and `/public/css/style.css`
- Form fields use consistent classes: `empresa`, `contacto`, `guardar` (green/success), `cancelar` (red/danger)

## Key Workflows

### Adding New Backoffice CRUD Module
1. Create folder: `/backoffice/{entity}/` with `{entity}-add.php`, `{entity}-edit.php`, `{entity}-delete.php`
2. Create view: `/backoffice/views/{entity}_view.php` 
3. Create main page: `/backoffice/{entity}.php` - includes header, view, footer
4. Add helper functions in `helpers/{entity}_helper.php`
5. Pattern for image handling: Use `input_imagens` hidden field + JSON encoding for portfolios/projects

### Authentication
- Session-based: `verificar_logado()` in backoffice pages redirects to login if not authenticated
- Password recovery: `/backoffice/views/recuperar_password_view.php` uses `password_hash()` and `password_verify()`
- Session data stored in `$_SESSION["utilizador"]`

### Popup Windows for Add/Edit
- Add/Edit pages open in popup windows (modal dialogs)
- Use `window.close()` to close and optionally reload parent with `window.opener.location.reload()`
- Success messages trigger alert + parent reload pattern

## Common Patterns to Preserve

### Form Validation
```php
$form = !empty($_POST["field1"]) && !empty($_POST["field2"]);
if($form) { /* process */ }
```

### SQL Queries
- Always use prepared statements with `$stmt->execute([])` for user input (see `backoffice_helper.php`)
- Simple SELECT queries use raw strings: `select_sql("SELECT * FROM table")`
- Update position in bulk: `UPDATE entity SET posicao = posicao + 1 WHERE posicao >= $new_pos`

### Error/Success Messages
```php
<?php if(!empty($sucesso)): ?>
  <div class="guardar w-100 mb-y p-2 text-white"><?= $sucesso ?></div>
<?php endif; ?>
<?php if(!empty($erro)): ?>
  <div class="cancelar w-100 mb-y p-2 text-white"><?= $erro ?></div>
<?php endif; ?>
```

### Image Management
- File manager integration: `/public/filemanager/` handles uploads
- Images stored as JSON arrays: `json_encode($image_array)` in database
- Use `abrir_popup_filemanager('input_id_name')` to open file picker

## File Organization Rules
- Root level: Entry points and public pages
- `/helpers/`: Database functions and business logic
- `/backoffice/`: Admin pages, forms, and CRUD operations
- `/backoffice/views/`: Separate view templates
- `/backoffice/components/`: Reusable HTML (header, footer, head)
- `/public/`: Assets (CSS, JS, images, fonts)
- `/components/`: Frontend-only header/footer

## Dependencies & Setup
- **Framework**: Vanilla PHP (no framework)
- **Database**: PDO with MySQL
- **UI**: Bootstrap 5.3.7 CDN
- **JS**: TinyMCE editor, jQuery-based file manager
- **Connection**: `/helpers/base_dados_helper.php` creates global `$pdo` object
- All pages inherit helpers via `require_once "required.php"` (frontend) or `require_once "../components/head.php"` (backoffice)

## Important Notes
- Direct SQL injection vulnerability risk in some queries (use prepared statements for all user inputs)
- Position-based ordering uses `posicao` field across entities
- Backoffice pages use relative paths; be careful when adding new nested directories
- Views contain mixed logic and markup; keep business logic at the top
