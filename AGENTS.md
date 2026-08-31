# Codex project instructions

This repository is a Laravel 13 + Livewire 4 application with Fortify, Flux UI, and Vite/Tailwind assets. For feature work, prefer the existing project structure, framework conventions, and the project-specific skills under [.github/skills](.github/skills) and [.agents/skills](.agents/skills).

## What to do

- Follow the existing app structure: `app/Models`, `app/Http`, `app/Livewire`, `resources/views`, `routes/`, and `tests/`.
- Reuse the project’s patterns before introducing new abstractions or one-off helpers.
- Keep PHP code in the Laravel style: typed methods, descriptive names, and explicit validation/authorization in app logic.
- Favor Livewire and Blade patterns already used in the app instead of ad hoc JavaScript.
- Add or update Pest tests for behavior changes. Prefer the smallest possible feature test.

## Commands

- Run the relevant test subset: `php artisan test --compact --filter="..."`
- Run the full app test suite when asked or before finishing a broader change: `php artisan test --compact`
- Format PHP after edits: `vendor/bin/pint --dirty --format agent`
- Build frontend assets when a UI change is not reflected: `npm run build`
- Start the app stack with: `composer run dev`
- Check routes or config when needed: `php artisan route:list` and `php artisan config:show ...`

## Architecture notes

- `routes/web.php` is the main storefront routing file.
- `app/Models/` holds the main Eloquent domain models.
- `app/Livewire/` contains interactive UI components.
- `resources/views/` and `resources/css/` drive the storefront presentation layer.
- `tests/Feature` and `tests/Unit` are the expected test locations for Pest coverage.

## Guardrails

- Do not add new base folders or dependencies without a clear reason.
- Do not create broad refactors or remove tests without approval.
- If front-end changes are not visible, check whether Vite needs a rebuild or dev server refresh.
- Keep explanations concise and focus on the repo’s actual patterns rather than generic Laravel advice.

## References

- [AGENTS.md](AGENTS.md)
- [.github/skills/laravel-best-practices/SKILL.md](.github/skills/laravel-best-practices/SKILL.md)
- [.github/skills/livewire-development/SKILL.md](.github/skills/livewire-development/SKILL.md)
- [.github/skills/testing-best-practices/SKILL.md](.github/skills/testing-best-practices/SKILL.md)
