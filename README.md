# 🌎 LatAm Capitals Theme (WordPress + Vue.js)

A custom WordPress theme that uses a Vue.js frontend and a custom REST API to display Latin American countries and their capitals.

## ⚙️ Features

- Custom WordPress theme with modular structure
- Custom Post Type (`country`) for storing countries and capitals
- Meta boxes for entering capital/country names
- Custom REST API endpoint: `/wp-json/capitals/v1/list`
- Vue.js frontend app built with Webpack
- Two stylized dropdowns for dynamic sorting:
  - `Sort by`: Country / Capital
  - `Direction`: Ascending / Descending
- Responsive, SCSS-styled layout with blue background dropdowns
- Clean code with WP best practices: security, i18n, escaping

## 🖥️ Tech Stack

- **WordPress** (Custom Theme, REST API)
- **PHP** (with WP best practices)
- **Vue.js 2**
- **Webpack 5**
- **SCSS** (custom styles)
- **LocalWP** (recommended for dev)

## 🚀 Setup Instructions

1. Clone this theme into your WordPress theme directory:

```bash
wp-content/themes/latam-capitals-theme/
```

2. Install Node.js dependencies:

```bash
npm install
```

3. Compile assets with Webpack:

```bash
npx webpack
```

4. Activate the theme from the WordPress admin.

5. Create a new page and assign it the template `Capitals Page`.

6. Go to **Settings > Reading**, and set that page as the homepage.

7. Add new entries under **Countries** in the WP admin, filling in country and capital names.

## 🔌 API Endpoint

**GET** `/wp-json/capitals/v1/list`

### Query Parameters

- `sort_by` = `country` | `capital`
- `direction` = `asc` | `desc`

**Example:**

```
/wp-json/capitals/v1/list?sort_by=capital&direction=desc
```

## 📁 Folder Structure

```
latam-capitals-theme/
├── dist/                   # Compiled assets
├── inc/                    # Modular PHP includes
│   ├── custom-post-type.php
│   ├── meta-boxes.php
│   ├── api-endpoint.php
│   └── assets.php
├── src/                    # Vue and SCSS sources
│   ├── app.js
│   └── styles.scss
├── functions.php
├── page-capitals.php
├── style.css
└── webpack.config.js
```

## 📝 Coding Best Practices

- Prefixed all functions to avoid naming collisions
- Escaped all outputs using `esc_attr()` / `esc_html_e()`
- Sanitized all input data with `sanitize_text_field()`
- Used WordPress nonces in custom meta boxes
- Internationalized all strings using `__()` and `esc_html_e()`