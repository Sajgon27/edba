# 🔧 Project Context
You are working on a custom WordPress theme named `edba`. The stack includes PHP 8.x, SCSS (using BEM), and JavaScript.

# 🎯 General Goals
- Use **WordPress best practices**, clean architecture, and maintainable modular code.
- Follow **WordPress Coding Standards** for PHP and HTML.
- Optimize for **Core Web Vitals** and **PageSpeed**, using **mobile-first** design principles.
- Structure SCSS and templates cleanly, promoting reuse and avoiding code duplication.
- Make sure all sections will look properly on desktop, tablet and mobile version.

# 🖌️ SCSS Guidelines
- Follow **BEM naming conventions** (e.g., `.block__element--modifier`).
- Use **mobile-first** media queries in the form of "respond-to" mixin defined in_mixins.scss
- Always **nest SCSS properly** using `&`.
- Use `@use` or `@import` as needed to include partials (e.g., `_mixins.scss`, `_variables.scss`).
- Always use **variables** from `_variables.scss` for `color`, `padding`, `margin`, `gap`, etc.
- Use **mixins** from `_mixins.scss` for repetitive patterns or responsiveness.
- Layouts must use **flexbox**, but avoid brittle values like `flex: 0 0 30%`.
- Each SCSS component must live in its own logically named file.
- Use global styles: `.button--primary`, `.button--secondary` for buttons.
- Use rem for text sizes.

# 🧱 Layout & HTML
- Use semantic tags: `<header>`, `<main>`, `<section>`, `<nav>`, etc.
- Respect logical heading order (H1–H6).
- Add `aria-*`, `role`, `tabindex`, `lang`, `alt`, `aria-hidden` where necessary.
- `.container` class handles only `max-width margin width.


# 🐘 PHP / WordPress
- Use modern PHP syntax compatible with WP 6.x and PHP 8.x.
- Use `<?php // comment ?>` for dev-only notes. Never use `<!-- HTML comments -->`.
- Use PHPDoc for all functions.
- Never generate ACF code — assume ACF fields and IDs are pre-defined.
- Break large page templates into reusable partials inside the `template-parts` folder.


# 💼 Workflow & Collaboration
- Deliver **clean, production-ready code only**.
- Do **not** add explanations or summaries — only the code + where/how to apply it.
- Use includes and template parts for reused elements.
- Do **not guess** data structures — ask for field names or data formats.
- Propose performance and security optimizations where applicable.
- Maintain consistency and clarity in file structure.